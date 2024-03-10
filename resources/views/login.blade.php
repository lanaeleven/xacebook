@extends('layouts.main')

@section('container')
    
<div class="container-fluid" style="background-color: #f0f2f5;">

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
      Registration Failed, try again, dont give up!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
      {{ session('loginError') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container d-flex flex-column flex-md-row justify-content-evenly" style="padding-top: 120px; padding-bottom: 120px;">
        <div>
            <h1 class="text-primary fw-bold text-center text-md-start">Xacebook</h1>
            <h3 class="text-secondary text-center text-md-start mt-3">Lets Have Xace!</h3>
        </div>
        <div class="w-70">
          <div class="card p-3 mt-5 shadow m-auto" style="width: 400px;">
            <form method="POST" action="/login">
              @csrf
              <div class="mb-3">
                <input type="email" class="form-control form-control-lg @error('email')
                {{ 'is-invalid' }}
                @enderror " id="email" name="email" placeholder="Email" required>
              </div>
              <div class="mb-3">
                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" required>
              </div>
              <button type="submit" class="btn btn-primary container-fluid py-2 fs-5">Login</button>
            </form>
            <hr>
              <p class="text-center">Belum punya akun?</p>

              <!-- Button trigger modal -->
              <div class="d-flex justify-content-center">
                <button class="btn btn-success py-2 fs-6 mx-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Register</button>
              </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create an Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    {{-- Form Register --}}
                    <form method="POST" action="/register">
                      @csrf
                      <div class="mb-3">
                        <input required type="text" class="form-control  @error('name')
                            {{ 'is-invalid' }}
                        @enderror " id="name" name="name" placeholder="Nama" value="{{ old('name') }}">
                        @error('name')
                        <div id="name" class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <input required type="email" class="form-control  @error('email')
                        {{ 'is-invalid' }}
                    @enderror " id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <div id="email" class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <input required type="password" class="form-control  @error('password')
                        {{ 'is-invalid' }}
                    @enderror " id="password" name="password" placeholder="Password">
                    @error('password')
                        <div id="password" class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <input required type="date" class="form-control  @error('birth_date')
                        {{ 'is-invalid' }}
                    @enderror " id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                    @error('birth_date')
                        <div id="birth_date" class="invalid-feedback">
                          Looks like you're too young to have xace
                        </div>
                        @enderror
                      </div>
                      <div class="mb-3 d-flex">
                        <p class="me-4">Jenis Kelamin</p>
                        <div class="form-check me-4">
                          <input class="form-check-input" type="radio" name="gender" id="gender1" value="Pria" checked>
                          <label class="form-check-label" for="gender1">
                            Laki-laki
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gender" id="gender2" value="Wanita">
                          <label class="form-check-label" for="gender2">
                            Perempuan
                          </label>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary container-fluid">Create</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>

            {{-- end of modal --}}

            </div>
          </div>
      </div>
    </div>
  </div>
  <div class="container-fluid bg-white py-2">
    <h6 class="text-secondary text-center">Made with ❤ by MaulanaElvn © 2024</h6>
  </div>

@endsection