@extends('_template.master-public')

@section('page_title', 'Login')

@section('content')

<style>
    .login-page {
        background-image: url('{{ asset("dist/img/bg_login.jpg") }}');
        background-size: cover;
    }
</style>
<div class="login-page">
    <!-- page -->
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <div class="w-100">
                    <img src="{{ asset('dist/img/Logo_Kota_Yogyakarta_small.png') }}" class="img-fluid" alt="Responsive image" style="width:50px">
                </div>
                <a href="{{ route('login') }}" class="h1"><b>SI</b>Mentel</a>
            </div>
            <div class="card-body">
                <form action="{{ route('do-login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.page -->
</div>
@endsection