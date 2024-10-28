<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
</head>

<body>
<!-- Login 12 - Bootstrap Brain Component -->
<section class="py-3 py-md-5 py-xl-8">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mb-5">
                    <h2 class="display-5 fw-bold text-center">Đăng nhập</h2>
                    <p class="text-center m-0">Bạn chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a></p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="row gy-5 justify-content-center">
                    <div class="col-12 col-lg-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row gy-3 overflow-hidden">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control border-2 border-bottom rounded-0"
                                               name="email" id="email" placeholder="ten@gmail.com">
                                        <label for="email" class="form-label">Email</label>
                                        @if($errors->any('email'))
                                            <div id="email" class="form-text text-danger">{{ $errors->first('email') }}
                                                .
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control border-2 border-bottom rounded-0"
                                               name="password" id="password" value="" placeholder="Nhập mật khẩu">
                                        <label for="password" class="form-label">Mật khẩu</label>
                                        @if($errors->any('password'))
                                            <div id="password"
                                                 class="form-text text-danger">{{ $errors->first('password') }}.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row justify-content-between">
                                        <div class="col-12">
                                            @if (Route::has('password.request'))
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                   href="{{ route('password.request') }}">
                                                    {{ __('Quên mật khẩu?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-lg btn-dark rounded-0 fs-6"
                                                type="submit">{{ __('Đăng nhập') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div
                        class="col-12 col-lg-2 d-flex align-items-center justify-content-center gap-3 flex-lg-column">
                        <div class="bg-dark h-100 d-none d-lg-block" style="width: 1px; --bs-bg-opacity: .1;"></div>
                        <div class="bg-dark w-100 d-lg-none" style="height: 1px; --bs-bg-opacity: .1;"></div>
                        <div>or</div>
                        <div class="bg-dark h-100 d-none d-lg-block" style="width: 1px; --bs-bg-opacity: .1;"></div>
                        <div class="bg-dark w-100 d-lg-none" style="height: 1px; --bs-bg-opacity: .1;"></div>
                    </div>
                    <div class="col-12 col-lg-5 d-flex align-items-center">
                        <div class="d-flex gap-3 flex-column w-100 ">
                            <a href="{{ url('/auth/google') }}"
                               class="btn bsb-btn-2xl btn-outline-dark rounded-0 d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-google text-danger" viewBox="0 0 16 16">
                                    <path
                                        d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                                </svg>
                                <span class="ms-2 fs-6 flex-grow-1">Đăng nhập Google</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>
