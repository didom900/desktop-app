<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Motion Law App</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/floating-labels/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/motionlaw-theme.css') }}" rel="stylesheet" />   

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('dist/img/favicon/favicon.ico') }}">
    <link rel="icon" href="{{ asset('dist/img/favicon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" href="{{ asset('dist/img/favicon/android-icon-192x192.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ asset('dist/img/favicon/apple-icon-180x180.png') }}" />  

  </head>

  <body>
    <form method="POST" action="{{ route('login') }}">
    @csrf
      <div class="text-center mb-4">
        <img class="mb-4" src="https://www.motionlaw.com/wp-content/uploads/Motion-Law-Immigration.png" alt="" width="250" />
      </div>

      <div class="form-label-group">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        <label for="email">{{ __('E-Mail Address') }}</label>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>

      <div class="form-label-group">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        <label for="password">{{ __('Password') }}</label>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> {{ __('Remember Me') }}
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>
      <p class="mt-5 mb-3 text-muted text-center small">Copyright @php echo date("Y"); @endphp Motion Law Inmigration LLC. All rights reserved</p>
    </form>
  </body>
</html>
