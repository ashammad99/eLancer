<x-front-layout>
    <!-- Titlebar
    ================================================== -->
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2>{{__('Log In')}}</h2>

                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs" class="dark">
                        <ul>
                            <li><a href="#">{{__('Home')}}</a></li>
                            <li>{{__('Log In')}}</li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>


    <!-- Page Content
    ================================================== -->
    <div class="container">
        <div class="row">
            <div class="col-xl-5 offset-xl-3">


                <div class="login-register-page">
                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3>We're glad to see you again!</h3>
                        @if(\Illuminate\Support\Facades\Route::has('register'))
                            <span>Don't have an account? <a href="{{route('register')}}">Sign Up!</a></span>
                        @endif
                    </div>

                    <!-- Session Status (used to show messages of session status) -->
                    <x-auth-session-status class="mb-4" :status="session('status')"/>

                    <!-- Validation Errors (used to show messages of session status) -->
                    <x-auth-validation-errors class="mb-4" :status="$errors"/>
                    <!-- Form -->
                    <form method="post" action="{{route('login')}}" id="login-form">
                        @csrf
                        <div class="input-with-icon-left">
                            <i class="icon-material-baseline-mail-outline"></i>
                            <input type="text" class="input-text with-border" name="email" id="email"
                                   placeholder="{{__('Email Address')}}" required/>
                        </div>

                        <div class="input-with-icon-left">
                            <i class="icon-material-outline-lock"></i>
                            <input type="password" class="input-text with-border" name="password" id="password"
                                   placeholder="{{__('Password')}}" required/>
                        </div>
                        @if(\Illuminate\Support\Facades\Route::has('password.request'))
                            <a href="{{route('password.request')}}" class="forgot-password">Forgot Password?</a>
                        @endif
                    </form>

                    <!-- Button -->
                    <button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit"
                            form="login-form">{{__('Log In')}} <i class="icon-material-outline-arrow-right-alt"></i></button>

                    <!-- Social Login -->
                    <div class="social-login-separator"><span>or</span></div>
                    <div class="social-login-buttons">
                        <button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Log In via
                            Facebook
                        </button>
                        <button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Log In via
                            Google+
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Spacer -->
    <div class="margin-top-70"></div>
    <!-- Spacer / End-->
</x-front-layout>
