@extends('layouts.auth.main')

@section('content')
<style>
    .auth-container{
        padding:30px;
    }
</style>
<div class="container">
    <div class="row vh-100 d-flex align-items-center justify-content-center">
<div class="col-lg-5">
    <div class="auth-container shadow">
    <form action="{{ route('login.process') }}" method="post">
        @csrf
        <div class="login__header">
            <h4>Login to your account</h4>
        </div>

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <div class="email mb-3">
            <label for="email">Email Address</label>
            <input type="email" name="email" class="form-control @error('email') is_invalid @enderror" value="{{ old('email') }}" placeholder="Email Address" />
        </div>

        <div class="password mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Password " />
        </div>

        <div class="submit">
            <button type="submit" class="btn btn-primary w-25">Login</button>
        </div>
    </form>
</div>
</div>
    </div>
</div>

@endsection
