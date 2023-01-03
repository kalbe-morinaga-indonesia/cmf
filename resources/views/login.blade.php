<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="themes/sneat/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>Login - CMF</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="themes/sneat/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="{{asset('themes/sneat/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{asset('themes/sneat/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('themes/sneat/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('themes/sneat/css/demo.css')}}" />
    <link rel="stylesheet" href="{{asset('themes/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('themes/sneat/vendor/css/pages/page-auth.css')}}" />
    <script src="{{asset('themes/sneat/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('themes/sneat/js/config.js')}}"></script>
  </head>

  <body>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <div class="card">
            <div class="card-body">
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #696cff;transform: ;msFilter:;"><path d="M19 4h-3V2h-2v2h-4V2H8v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zM5 20V7h14V6l.002 14H5z"></path><path d="M7 9h10v2H7zm0 4h5v2H7z"></path></svg>
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">CMF Online</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to CMF Online! 👋</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p>

              <form id="formAuthentication" class="mb-3" action="#" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email-username" placeholder="Enter your email" autofocus />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="auth-forgot-password-basic.html">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password">
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <script src="{{asset('themes/sneat/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('themes/sneat/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('themes/sneat/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('themes/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('themes/sneat/vendor/js/menu.js')}}"></script>
    <script src="{{asset('themes/sneat/js/main.js')}}"></script>
  </body>
</html>
