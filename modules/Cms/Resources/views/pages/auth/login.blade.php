@extends('cms::layouts.app')
@section('content')
    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="login-content card">
                        <div class="login-form">
                            <h4>Login</h4>
                            <form action="/cms/login" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input name="email" type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox"> Remember Me
                                    </label>
                                    <label class="pull-right">
                                        <a href="#">Forgotten Password?</a>
                                    </label>

                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
                                <div class="register-link m-t-15 text-center">
                                    <p>Don't have account ? <a href="#"> Sign Up Here</a></p>
                                </div>
                            </form>

                            <!-- Social Login -->
                            <hr>
                            <div class="push text-center">or Login with</div>

                            <div class="button-list">
                                <a href="{{ route('cms.auth.google') }}" type="button" class="btn btn-default btn-block m-b-10"><i class="fa fa-share-square"></i> Google</a>
                                <a href="{{ route('cms.auth.facebook') }}" type="button" class="btn btn-default btn-block m-b-10"><i class="fa fa-share-square"></i> Facebook</a>
                            </div>


                            <!-- END Social Login -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
