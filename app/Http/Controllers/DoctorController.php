<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Doctor;
use Illuminate\Support\Facades\Session;
use thiagoalessio\TesseractOCR\TesseractOCR;

class DoctorController extends Controller
{
    // Show the list of doctors
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctor-list', compact('doctors'));
    }

    // Show the form to add a new doctor
    public function create()
    {
        return view('add-doctor');
    }


    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'start_year' => 'required|integer',
        'specialist' => 'required|string|max:255',
        'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Create a new Doctor instance
    $doctor = new Doctor();
    $doctor->name = $request->input('name');
    $doctor->city = $request->input('city');
    $doctor->start_year = $request->input('start_year');
    $doctor->specialist = $request->input('specialist');

    // Define directories
    $profileImgDir = public_path('stored_data2/profile_photos');
    $signatureDir = public_path('stored_data2/signatures');
    $certificatesDir = public_path('stored_data2/certificates');

    // Create directories if they don't exist
    if (!File::exists($profileImgDir)) {
        File::makeDirectory($profileImgDir, 0755, true);
    }

    if (!File::exists($signatureDir)) {
        File::makeDirectory($signatureDir, 0755, true);
    }

    if (!File::exists($certificatesDir)) {
        File::makeDirectory($certificatesDir, 0755, true);
    }

    // Handle profile image upload
    if ($request->hasFile('profile_img')) {
        $profileImg = $request->file('profile_img');
        $profileImgName = time() . '_' . preg_replace('/\s+/', '_', trim($profileImg->getClientOriginalName()));
        $profileImgPath = $profileImgDir . '/' . $profileImgName;
        $profileImg->move($profileImgDir, $profileImgName);
        $doctor->profile_img = 'stored_data2/profile_photos/' . $profileImgName;
    }

    // Handle signature upload
    if ($request->hasFile('signature')) {
        $signature = $request->file('signature');
        $signatureName = time() . '_' . preg_replace('/\s+/', '_', trim($signature->getClientOriginalName()));
        $signaturePath = $signatureDir . '/' . $signatureName;
        $signature->move($signatureDir, $signatureName);
        $doctor->signature = 'stored_data2/signatures/' . $signatureName;

        // Perform OCR on the signature image
        try {
            $ocr = new TesseractOCR($signaturePath);
            $text = $ocr->run();
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['signature' => 'No text found in the signature image. Please provide a clear image with readable text.']);
        }

        $values = [
            "Your signature conveys confidence professionalism, and authenticity with each swirl and curve. It speaks volumes about you. It demonstrates your confidence, originality, and attention to detail. Continue signing your story with pride.",
            "Your signature reflects your particular personality: bold, distinct, and full of possibilities. It is a declaration of your honesty, dependability and dedication to greatness. With each stroke, you create a lasting impression of trust.",
            "Your signature tells a story of determination, endurance, and self-assurance. It demonstrates your strength, both on paper and in life. Continue to write your narrative ,with boldness and confidence.",
            "Your signature is a work of art, demonstrating your taste for beauty and sophistication. It is more than simply a name; it's a blend of confidence, elegance, and refinement. It reflects your poise, grace, and the distinct essence of who you are.",
            "Your signature exudes vitality, optimism and zest for life. With each sign, you reaffirm your place in the world, with dignity and integrity. Let it serve as a reminder to approach, each day with enthusiasm and a grin.",
            "Your signature unfolds a story of professionalism, authenticity and a commitment to achievement. It is not merely ink on paper; it is an expression, of your personality. Keep exuding confidence wherever you sign!"
        ];

        // Retrieve the stored value from session
        $storedText = Session::get('signature_text');
        $storedValue = Session::get('signature_value');

        // Check if OCR text is empty
        if (empty(trim($text))) {
            return redirect()->back()->withErrors(['signature' => 'No text found in the signature image. Please provide a clear image with readable text.']);
        }

        // Check if the text matches the stored value
        if ($storedText && $storedText === $text) {
            $selectedValue = $storedValue;
        } else {
            $randomKey = array_rand($values);
            $selectedValue = $values[$randomKey];
            Session::put('signature_text', $text);
            Session::put('signature_value', $selectedValue);
        }

        $doctor->signature_comment = $selectedValue;

        // Create certificate image with profile photo and comment
        $fileName = uniqid() . '_' . time() . '.png';
        $framePath = public_path("reports/mx.png"); // Certificate template
        $profileImgPath = $doctor->profile_img ? public_path($doctor->profile_img) : null; // Profile image path

        // Load the frame and profile image
        $frame = imagecreatefrompng($framePath);
        $textColor = imagecolorallocatealpha($frame, 0, 255, 0, 0);  // Green color with alpha

        if ($profileImgPath && file_exists($profileImgPath)) {
            $profileImg = imagecreatefrompng($profileImgPath);

            // Set the size and position of the profile image on the certificate
            $profileImgWidth = 100; // Adjust size as needed
            $profileImgHeight = 100; // Adjust size as needed
            $x = 50; // X position
            $y = 50; // Y position

            // Overlay the profile image on the certificate
            imagecopyresampled($frame, $profileImg, $x, $y, 0, 0, $profileImgWidth, $profileImgHeight, imagesx($profileImg), imagesy($profileImg));
            imagedestroy($profileImg);
        }

        // Add the selected text to the image
        $font = public_path('font/Arial.ttf'); // Path to your font file
        imagettftext($frame, 20, 0, 50, 200, $textColor, $font, $selectedValue);

        // Save the certificate image
        imagepng($frame, $certificatesDir . '/' . $fileName);
        imagedestroy($frame);

        $doctor->certificated_download = 'stored_data2/certificates/' . $fileName; // Save the path to the certificate image
    }

    // Save the doctor record
    $doctor->save();
    $certificatePath = 'stored_data2/certificates/' . $fileName;
    return redirect()->route('thankyou')->with('certificatePath', $certificatePath);
}


    // Show the doctor details
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctor-profile', compact('doctor'));
    }

    // Delete a doctor
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        // Optionally, delete associated files
        if ($doctor->profile_photo) {
            Storage::delete($doctor->profile_photo);
        }
        if ($doctor->upload_signature) {
            Storage::delete($doctor->upload_signature);
        }

        $doctor->delete();

        return redirect()->route('doctor-list')->with('success', 'Doctor deleted successfully!');
    }
    public function thankYou()
    {
        return view('thankyou');
    }
}
