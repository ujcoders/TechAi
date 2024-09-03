<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- Optional JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

    <!-- Custom JavaScript -->
    <script type="text/javascript">
        siteurl = '{{ url("/") }}';
    </script>
</head>
<body style="background:url('{{ asset('images/login-bg.jpg') }}')">
    <div class="background-img">
        <div class="container">
            <div class="col-md-6 offset-md-3 login-wrapper">
                <div class="login-wrap">
                    <div class="branding">
                        <div class="api-brand">
                            <img src="{{ asset('img/Drs-Day-Activity-logo.svg') }}" class="img-responsive"/>
                        </div>
                        <img src="{{ asset('img/30-Years-Red-logo.svg') }}" class="img-responsive"/>
                    </div>
                    <div id="errors-list">
                        @if($errors->any())
                            <script>
                                toastr.error('{{ $errors->first() }}');
                            </script>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="empcode" class="form-control" placeholder="Employee Code" value="{{ old('empcode') }}" required />
                            @error('empcode')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required />
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="actions MRTB">
                            <button type="submit" class="btn btn-primary btn-full-width">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-light">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <div class="footerlogo">
                        <img src="{{ asset('img/stamlo-logo.svg') }}">
                    </div>
                </div>
                <div class="col-xs-6 text-right">
                    <div class="footerlogo">
                        <img src="{{ asset('img/telsartan-logo.svg') }}">
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
    <script src="{{ asset('js/signin.js') }}"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        $('ul.navbar-nav > li').click(function() {
            $('ul.navbar-nav > li').removeClass('active');
            $(this).addClass('active');
        });
        current_page = window.location.href;
        $('#main_menu a').each(function() {
            if (current_page == $(this).attr('href')) {
                $(this).parent().addClass('active');
            } else {
                $(this).parent().removeClass('active');
            }
        });
    </script>
</body>
</html>
