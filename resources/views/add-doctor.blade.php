<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="expires" content="0">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <title>Stamlotelsartan</title>
  <link rel="stylesheet" href="{{ asset('css/default.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">

  <script type="text/javascript">
    var siteurl = '';
  </script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href='#' onclick="window.history.back()" class="show-mob back-btn">
      <i class="fa fa-angle-left"></i>
    </a>
    <a href="{{ url('dashboard') }}" class="logo">
      <img src="{{ asset('img/Drs-Day-Activity-logo.svg') }}" alt="Logo"/>
    </a>
    <a class="navbar-brand show-mob" href="#">Dashboard</a>
    <div class="mob_api_logo">
      <img src="{{ asset('img/30-Years-Red-logo.svg') }}" alt="30 Years Red Logo"/>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navbarRight" id="navbarSupportedContent">
      <div class="overlay"></div>
      <div class="menu-close-btn show-mob show-close-btn">
        <a href="#" id="close-menu-btn">
          <i class='fa fa-close'></i>
        </a>
      </div>
      <ul class="navbar-nav mr-auto" id="main_menu">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('dashboard') }}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('add-doctor') }}">Add New Doctor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('doctor-list') }}">Doctor List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('profile') }}">My Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('logout') }}">Logout</a>
        </li>
      </ul>
      <div class="api_logo">
        <img src="{{ asset('img/30-Years-Red-logo.svg') }}" alt="30 Years Red Logo"/>
      </div>
    </div>
  </nav>

  <style type="text/css">
    #loader {
      position: absolute;
      z-index: 100;
      width: 90%;
      height: 100%;
      background-color: rgba(192, 192, 192, 0.5);
      font-size: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .img img {
      display: block;
      width: 100%;
    }

    .preview {
      text-align: center;
      overflow: hidden;
      width: 100px;
      height: 106px;
      margin: 10px;
      border: 1px solid red;
      margin-left: 20px;
      margin-top: 0px;
    }

    .section {
      margin-top: 150px;
      background: #fff;
      padding: 50px 30px;
    }

    .modal-lg {
      width: 90%;
    }
  </style>

  <div class="container">
    <div class="col-md-8 offset-md-2 custom-card mt-4">
      <div class="formbox">
        <!-- Show flash messages -->
        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @elseif (session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
        @endif

        <!-- Show validation errors -->
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form id="addDoctor" method="post" enctype="multipart/form-data" action="{{ route('doctor.store') }}">
          @csrf
          <div class="form-group">
              <label>Doctor Full Name<span class="star-error">*</span></label>
              <input type="text" class="form-control" name="name" placeholder="Doctor Full Name" value="{{ old('name') }}" required />
          </div>
          <div class="form-group">
              <label>City<span class="star-error">*</span></label>
              <input type="text" class="form-control" name="city" placeholder="Enter city name" value="{{ old('city') }}" required />
          </div>
          <div class="form-group">
              <label>Profile Photo<span class="star-error">*</span></label>
              <input type="file" class="form-control" name="profile_img" />
          </div>
          <div class="form-group">
              <label>In which year you started your practice?<span class="star-error">*</span></label>
              <select class="form-control" name="start_year" required>
                  <option value="" disabled selected>Select Start Year</option>
                  @for ($year = 1900; $year <= date('Y'); $year++)
                      <option value="{{ $year }}" {{ old('start_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                  @endfor
              </select>
          </div>
          <div class="form-group">
              <label>Specialist<span class="star-error">*</span></label>
              <input type="text" class="form-control" name="specialist" placeholder="Specialist" value="{{ old('specialist') }}" required />
          </div>
          <div class="form-group">
              <label>Upload Signature<span class="star-error">*</span></label>
              <input type="file" class="form-control" name="signature" />
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/toastr.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
