{{-- {{dd(\Session::get('hello'))}} --}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(\Request::segment(1) == 'admin')
        <title> DormDoctors  Admin Panel </title>
    @else
        <title> DormDoctors  Staff Panel </title>
    @endif
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <!-- Scripts -->
    <script src="{{ asset('login/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('login/app.css') }}" rel="stylesheet">

<style>
.card-header a.navbar-brand {
    padding: 0;
    margin: 0;
}
.card-header {
    text-align: center;
    padding: 5px 0;
    background: no-repeat;
    border: none;
}
.card {
   border-radius: 22px;
}
button.btn.btn-primary {
    width: 100%;
    border: none;
    background:#81d26b;
}
.form-group.register11 {
    text-align: center;
    text-decoration: underline;
}
.singupl label {
    margin: 0 !important;
    padding: 0 15px !important;
}
.singupl .form-group {
    float: left;
    width: 100%;
    margin: 0 0 6px;
}
.card-header1 {
    float: left;
    width: 100%;
    text-align: center;
    margin: 0;
    font-size: 20px;
    border-bottom: 1px solid #ddd;
    padding: 14px 0;
}
.singupl .form-check label {
    padding: 0 !important;
}

</style>
</head>
<body style="background: ##e0e2e0;">
    <div id="app">


        <main class="py-4">
           <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 singupl">
        <div class="card-header">
                <a class="navbar-brand" href="{{ url('/') }}">
			 <img src="{{ asset('images/logo.png') }}" style="width:310px;padding-bottom: 35px;">

                </a>
                </div>
            <div class="card">
            @if(\Request::segment(1) == 'admin')
                <div class="card-header1">{{ __('Admin Login') }}</div>
            @else
                <div class="card-header1">{{ __('Staff Login') }}</div>
            @endif

                <div class="card-body">
                    {{-- @if(\Rested) --}}
                    @if(\Request::segment(1) == 'admin')
                        <form method="POST" action="{{ route('login') }}">
                    @else
                        <form method="POST" action="{{ route('staff.login') }}">
                    @endif
                            @csrf

                        @if($errors->first('error'))
                            <span class="text-danger text-center" style="display:block;text-align:center " role="alert">
                            <strong>{{ $errors->first('error') }}</strong>
                            </span>
                        @endif

                        <div class="form-group">
                        <label for="email" class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group" style="padding-bottom:15px">
                            <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" style="background:#263238">
                                    {{ __('Login') }}
                                </button>

                                <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        </main>
    </div>
</body>
</html>
