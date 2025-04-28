@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
@vite([
'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection


@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6 mx-4">
      <!-- Register Card -->
      <div class="card p-7">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="{{url('/admincp')}}" class="app-brand-link gap-3">
            <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20])</span>
            <span class="app-brand-text demo text-heading fw-semibold">Brand Evaluate</span>
          </a>
        </div>

        <!-- /Logo -->

        <!-- Alert  -->
        @if (session('notice'))
        <div class="alert alert-success mt-3" role="alert">
          {{session('notice')}}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger mt-3" role="alert">
          {{session('error')}}
        </div>
        @endif
        <!-- End alert  -->

        <div class="card-body mt-1">
          <h4 class="mb-1">Adventure starts here 🚀</h4>
          <p class="mb-5">Make your app management easy and fun!</p>

          <form id="formAuthentication" class="mb-5" action="{{ route('postRegister') }}" method="post">
            @csrf
            <div class="form-floating form-floating-outline mb-5">
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus>
              <label for="username">Username</label>
              @error('username')
              <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating form-floating-outline mb-5">
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
              <label for="email">Email</label>
              @error('email')
              <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating form-floating-outline mb-5">
              <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name">
              <label for="fullname">Fullname</label>
              @error('fullname')
              <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-5 form-password-toggle">
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

            <div class="mb-5 form-password-toggle">
              <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                  <input type="password" id="comfirm_password" class="form-control" name="comfirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="comfirm_password" />
                  <label for="comfirm_password">Comfirm password</label>
                  @error('comfirm_password')
                  <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                  @enderror
                </div>
                <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line ri-20px"></i></span>
              </div>
            </div>\
            <button class="btn btn-primary d-grid w-100 mb-5">
              Sign up
            </button>
          </form>

          <p class="text-center mb-5">
            <span>Already have an account?</span>
            <a href="{{ route('getLogin')}}">
              <span>Sign in instead</span>
            </a>
          </p>
        </div>
      </div>
      <!-- Register Card -->
      <img src="{{asset('assets/img/illustrations/tree-3.png')}}" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block">
      <img src="{{asset('assets/img/illustrations/auth-basic-mask-light.png')}}" class="authentication-image d-none d-lg-block" height="172" alt="triangle-bg">
      <img src="{{asset('assets/img/illustrations/tree.png')}}" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block">
    </div>
  </div>
</div>
@endsection