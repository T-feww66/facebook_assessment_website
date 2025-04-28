@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
@vite([
'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6 mx-4">

      <!-- Login -->
      <div class="card p-7">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="{{url('/admincp')}}" class="app-brand-link gap-3">
            <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])</span>
            <span class="app-brand-text demo text-heading fw-semibold">Brand Evaluate</span>
          </a>
        </div>
        <!-- /Logo -->

        <!-- Alert  -->
        @if (session('notice'))
        <div class="alert alert-success mt-1" role="alert">
          {{session('notice')}}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger mt-1" role="alert">
          {{session('error')}}
        </div>
        @endif
        <!-- End alert  -->

        <div class="card-body mt-1">
          <h4 class="mb-1">Welcome to Brand Evaluate! 👋🏻</h4>
          <p class="mb-5">Please sign-in to your account and start the adventure</p>

          <form id="formAuthentication" class="mb-5" action="{{ route('postLogin') }}" method="post">
            @csrf
            <div class="form-floating form-floating-outline mb-5">
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus>
              <label for="username">Username</label>
              @error('username')
              <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-5">
              <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                    <label for="password">Password</label>
                    @error('password')
                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                  </div>
                  <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line ri-20px"></i></span>
                </div>
              </div>
            </div>

            <div class="mb-5">
              <button class="btn btn-primary d-grid w-100" type="submit">login</button>
            </div>
          </form>

          <p class="text-center mb-5">
            <span>New on our platform?</span>
            <a href="{{ route('getRegister')}}">
              <span>Create an account</span>
            </a>
          </p>
        </div>
      </div>
      <!-- /Login -->
      <img src="{{asset('assets/img/illustrations/tree-3.png')}}" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block">
      <img src="{{asset('assets/img/illustrations/auth-basic-mask-light.png')}}" class="authentication-image d-none d-lg-block" height="172" alt="triangle-bg">
      <img src="{{asset('assets/img/illustrations/tree.png')}}" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block">
    </div>
  </div>
</div>
@endsection