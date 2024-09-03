<!DOCTYPE html>
<html lang="en" style="font-size: 16px;">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Thank You">
    <meta name="description" content="">
    <title>Thank You</title>
    <link rel="stylesheet" href="https://example.com/css/nicepage.css" media="screen">
    <link rel="stylesheet" href="https://example.com/css/thankyou.css" media="screen">
    <script src="https://example.com/js/jquery.js" defer></script>
    <script src="https://example.com/js/nicepage.js" defer></script>
    <meta name="generator" content="Nicepage 6.10.5, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster:400">
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "",
        "logo": "https://example.com/images/logo.png"
    }
    </script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Thank You">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 800px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="en" style="display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <section class="u-clearfix u-grey-10 u-section-1" id="sec-4ace">
        <div class="custom-expanded u-align-center u-container-style u-group u-radius u-shape-round u-white u-group-1" style="width: 100%; max-width: 600px; margin: auto; padding: 40px;">
            <div class="u-container-layout u-container-layout-1">
                <h1 class="u-custom-font u-font-lobster u-text u-text-default u-title u-text-1">Thank You</h1>
                <h3 class="u-custom-font u-font-lobster u-text u-text-default u-text-2">Stay tuned for more details</h3>
                <span class="infinite u-file-icon u-icon u-icon-circle u-palette-1-base u-icon-1" data-animation-name="shake" data-animation-duration="2000" data-animation-delay="1500" data-animation-direction="">
                    <img src="https://example.com/images/148808.png" alt="" style="width: 100px;">
                </span>
                <section>
                    <div id="head" class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12 text-center" style="margin-top: 20px;">
                                <a href="{{ route('dashboard') }}" class="btn btn-success" style="font-size: 20px; padding: 10px 20px; background-color: green; color: white; text-decoration: none; display: inline-block; border-radius: 5px; border: 1px solid green !important;">Dashboard</a>
                                <a href="#" id="viewCertificateButton" class="btn btn-success" style="font-size: 20px; padding: 10px 20px; background-color: green; color: white; text-decoration: none; display: inline-block; border-radius: 5px; border: 1px solid green !important;">View Certificate</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="u-container-style u-expanded-width u-group u-radius u-shape-round u-white u-group-2" style="display: flex; justify-content: center; align-items: center; padding: 20px;">
            <div class="u-container-layout u-container-layout-2" style="text-align: center;">
                <img class="u-absolute-hcenter-sm u-absolute-hcenter-xl u-absolute-hcenter-xs u-expanded-height u-image u-image-default u-image-1" src="https://example.com/images/Screenshot2024-07-19225537.png" alt="" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </section>

    <!-- Modal HTML -->
    <div id="certificateModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img id="certificateImage" src="" alt="Certificate" style="max-width: 100%; height: auto;">
            <a id="downloadLink" href="" download class="btn btn-primary" style="margin-top: 20px; display: inline-block; padding: 10px 20px; background-color: blue; color: white; text-decoration: none; border-radius: 5px;">Download Certificate</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('certificateModal');
            var viewButton = document.getElementById('viewCertificateButton');
            var closeButton = document.getElementsByClassName('close')[0];
            var certificateImage = document.getElementById('certificateImage');
            var downloadLink = document.getElementById('downloadLink');
            var certificatePath = "{{ session('certificatePath') }}"; // Access the certificate path from session

            viewButton.onclick = function(event) {
                event.preventDefault();
                if (certificatePath) {
                    // Set the certificate image source and download link
                    certificateImage.src = certificatePath;
                    downloadLink.href = certificatePath;
                    modal.style.display = 'block';
                } else {
                    alert('Certificate path is not available.');
                }
            };

            closeButton.onclick = function() {
                modal.style.display = 'none';
            };

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            };
        });
    </script>
</body>
</html>
