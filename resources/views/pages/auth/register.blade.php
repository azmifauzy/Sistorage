@extends('master')
@section('auth')
<div id="authContainer" class="d-flex h-100vh flex-wrap">
  <div class="greeting">
    <div class="container d-grid justify-content-center">
      <h1 tabindex="0">Hello there, Welcome to <br> Online Storage System</h1>
      <img 
        src="{{ asset('images/welcome.png') }}" 
        alt="Selamat Datang Sistem Kasir Online"
        class="image-welcome"
      />
    </div>
  </div>
  <div class="form-input">
    <div class="container d-flex justify-content-center">
      <div class="card">
        <div class="switch">
          <a href="/login" class="login">Login</a>
          <a href="/register" class="register active">Register</a>
        </div>
        @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
          {{ session('error') }}
        </div>
        @endif
        <form id="formInput" action="/register" method="post">
          @csrf
          <div class="input-container">
            <input 
              id="username" 
              name="name"
              type="text"
              class="outskirt-input @error('name') is-invalid @enderror" 
              placeholder=""
            />
            <label for="username" class="outskirt-label">
              Fullname
            </label>
            @error('name')
            <div class="invalid-feedback bottom--4">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="input-container">
            <input 
              id="email" 
              name="email"
              type="email"
              class="outskirt-input @error('email') is-invalid @enderror" 
              placeholder=""
            />
            <label for="email" class="outskirt-label">
              Email Address
            </label>
            @error('email')
            <div class="invalid-feedback bottom--4">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="input-container">
            <input 
              id="password" 
              name="password"
              type="password"
              class="outskirt-input @error('password') is-invalid @enderror" 
              placeholder=""
            />
            <label for="password" class="outskirt-label">
              Password
            </label>
            @error('password')
            <div class="invalid-feedback bottom--4">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="input-container">
            <input 
              id="confirm-password" 
              name="password2"
              type="password"
              class="outskirt-input" 
              placeholder=""
            />
            <label for="confirm-password" class="outskirt-label">
              Confirm Password
            </label>
          </div>
          <button type="submit">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection