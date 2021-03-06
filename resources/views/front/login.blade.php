@extends('layouts.front.app')

<div class="login">

    <div class="login__bg"></div>

    <div class="container">

        <div class="row">

            <div class="col-10 mx-auto col-md-6 bg-white mx-auto p-3">
                <h2 class="text-center">Netflix<span class="text-primary">ify</span></h2>

                <form action="{{route('register')}}" method="POST">
                    @csrf

                    <!--username-->
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>

                    <!--email-->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email">
                    </div>

                    <!--password-->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Register</button>
                    </div>

                    <p class="text-center">Already have an account<a href="login.html"> Login</a></p>

                    <hr>
                    <button class="btn btn-block btn-primary" style="background:#3b5998;"><span class="fab fa-facebook-f"></span> Login by facebook</button>
                    <button class="btn btn-block btn-primary" style="background:#ea4335;"><span class="fab fa-google"></span> Login by Gmail</button>

                </form><!-- end of form -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </div><!-- end of container -->
</div><!-- end of login -->

@endsection
