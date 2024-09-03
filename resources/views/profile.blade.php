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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Stamlotelsartan</title>

    <!-- Additional CSS -->
    <link rel="stylesheet" href="{{ asset('css/default.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
    <script type="text/javascript">
        // siteurl variable
        var siteurl = 'https://stamlotelsartan.intechify.in';
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href='#' onclick="window.history.back()" class="show-mob back-btn">
            <i class="fa fa-angle-left"></i>
        </a>
        <a href="{{ url('dashboard') }}" class="logo">
            <img src="{{ asset('img/Drs-Day-Activity-logo.svg') }}" alt="Logo" class="img-fluid">
        </a>
        <a class="navbar-brand show-mob" href="#">Dashboard</a>
        <div class="mob_api_logo">
            <img src="{{ asset('img/30-Years-Red-logo.svg') }}" alt="API Logo" class="img-fluid">
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
                    <a href="{{ url('add-doctor') }}" class="nav-link">Add New Doctor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('doctor-list') }}">Doctor List</a>
                </li>
                <li class="nav-item">
                    <!-- <a href="{{ url('conference') }}" class="nav-link">Conference</a> -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('profile') }}">My Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('logout') }}">Logout</a>
                </li>
            </ul>
            <div class="api_logo">
                <img src="{{ asset('img/30-Years-Red-logo.svg') }}" alt="API Logo" class="img-fluid">
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="custom-card">
                    <div class="formbox p-4">
                        <small>Note: Kindly report to HO if any changes required in your profile</small>
                        <hr>
                        <form action="{{ url('profile/update') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" value="Savitree" name="doctor_name" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" readonly value="400023" name="doctor_email_id" placeholder="Employee Code">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" readonly value="7738847850" name="doctor_mobile_no" placeholder="Mobile No.">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" readonly value="" name="doctor_region" placeholder="Region">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" readonly value="PATNA" name="doctor_hq" placeholder="HQ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <img src="{{ asset('img/brand-logos.svg') }}" class="img-fluid" alt="Brand Logos">
        </div>
    </footer>

    <footer class="footer bg-light">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="footerlogo">
                        <img src="{{ asset('img/stamlo-logo.svg') }}" alt="Stamlo Logo" class="img-fluid">
                    </div>
                </div>
                <div class="col-6 text-right">
                    <div class="footerlogo">
                        <img src="{{ asset('img/telsartan-logo.svg') }}" alt="Telsartan Logo" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</body>
</html>
