@extends('layouts.AuthLayout')

@section('title', 'Register')

@section('content')
<div class="auth-form">
    <div class="card my-5">
        <div class="card-body">
            <div class="text-center">
                <h4 class="f-w-500 mb-1">Register with your email</h4>
                <p class="mb-3">Already have an Account? <a href="{{ route('login') }}" class="link-primary">Log
                        in</a></p>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="name">Full Name <span class="text-danger">*</span> </label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Enter name">
                    @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email Address <span class="text-danger">*</span> </label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email Address">
                    @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="contact_no">Contact Number <span class="text-danger">*</span> </label>
                    <input type="tel" id="contact_no" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" autocomplete="tel" placeholder="Contact Number">
                    @error('contact_no')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="dob">Date of Birth <span class="text-danger">*</span> </label>
                    <input type="date" id="dob" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" placeholder="Date of Birth">
                    @error('dob')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="address">Address <span class="text-danger">*</span> </label>
                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" rows="3" placeholder="Address" autocomplete="street-address">{{ old('address') }}</textarea>
                    @error('address')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password <span class="text-danger">*</span> </label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirm Password <span class="text-danger">*</span> </label>
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
