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
    <link rel="stylesheet" href="{{ asset('css/default.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cropper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/cropper.min.js') }}"></script>
    <script type="text/javascript">
        var siteurl = '{{ url('/') }}';
    </script>

    <title>Stamlotelsartan</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="#" onclick="window.history.back()" class="show-mob back-btn">
            <i class="fa fa-angle-left"></i>
        </a>
        <a href="{{ url('dashboard') }}" class="logo">
            <img src="{{ asset('img/Drs-Day-Activity-logo.svg') }}" alt="Logo">
        </a>
        <a class="navbar-brand show-mob" href="#">Dashboard</a>
        <div class="mob_api_logo">
            <img src="{{ asset('img/30-Years-Red-logo.svg') }}" alt="Mobile API Logo">
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <img src="{{ asset('img/30-Years-Red-logo.svg') }}" alt="API Logo">
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="col-md-10 offset-md-1 custom-card mt-4">
            <div class="dr-top-bar">
                <a href="{{ url('add-doctor') }}" class="btn btn-primary btn-full-width mb-5">Add New Doctors</a>
                <div class="form-group mb-10">
                    <input type="text" id="q" name="search" placeholder="Search doctor" class="form-control">
                </div>
            </div>

            <div class="list-view-wrapper" style="margin-top:30px;">
                <ul class="list-view">
                    @foreach ($doctors as $doctor)
                    <li>
                        <div class="list-card" id="doctordiv_{{ $doctor->id }}">
                            <div class="pull-left">
                                <div class="doctorimg">
                                    <a href="#" data-toggle="modal" data-target="#sealmodal{{ $doctor->id }}">
                                        <img src="{{ asset($doctor->profile_img) }}" alt="Doctor Image">
                                    </a>
                                </div>
                            </div>
                            <span class="desc"><strong>ID:</strong> {{ $doctor->id }}</span>
                            <span class="title doc-info-button">
                                <a href="{{ url('doctor-profile/' . $doctor->id) }}">{{ $doctor->name }}</a>
                            </span>
                            <span class="desc">{{ $doctor->city }}</span>
                            <div class="doctorlistboxlabel pull-right">
                                <a id="delete_confirmation" class="btnsuccess" href="{{ url('doctors/delete/' . $doctor->id) }}">
                                    <i class='fa fa-trash'></i> Delete
                                </a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

    @foreach ($doctors as $doctor)
    <!-- Modal for doctor {{ $doctor->id }} -->
    <div class="modal fade" id="sealmodal{{ $doctor->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Doctor Name: {{ $doctor->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>City: {{ $doctor->city }}</h5>
                    <div class="row">
                        <div class="col-8 col-md-8 offset-md-2 modal-img">
                            <img src="{{ asset($doctor->profile_img) }}" class="img-responsive" style="width:100%;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="delete_confirmation" class="btn btn-primary"
                        href="{{ url('doctors/delete/' . $doctor->id) }}">Delete</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    <!-- Optional JavaScript -->
    <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
