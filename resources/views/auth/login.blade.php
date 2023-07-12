@extends('layouts.page_login')
@section('login')
<div class="card">
    <div class="card-body">
        <!-- Logo -->
        <div class="app-brand justify-content-center">
        <a href="index.html" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
           
            </span>
            <span class="app-brand-text demo text-body fw-bolder">Login</span>
        </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-2">Bienvenu! 👋</h4>
        <p class="mb-4">Connecter à votre compte , s'il vous plait</p>
        @if(Session::has('error'))
        <p class="text-danger">{{Session::get('error')}}</p>
        @endif
        <form  method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
            type="email"
            class="form-control"
         
            name="email"
            placeholder="Enter your email"
          
            
            />
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong style="color:red">{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
            <label class="form-label" for="password">Password</label>
           
            </div>
            <div class="input-group input-group-merge">
            <input
                type="password"
               
                class="form-control"
                name="password"
               
            />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong style="color:red">{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="mb-3">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember-me" />
            <label class="form-check-label" for="remember-me"> Remember Me </label>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Connecter</button>
        </div>
        </form>

        <p class="text-center">
        <span>Nouveau admin?</span>
        <a href="{{route('admin.register')}}">
            <span>Créer un compte</span>
        </a>
        </p>
    </div>
</div>
@endsection