@extends('layouts.app')

@section('content')
<div class="authentication-box">
    <form class="login-form-container box" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="field">
            <label class="label">Username</label>
            <div class="control">
                <input name="username" class="input" type="text" placeholder="Username">
            </div>
            @if ($errors->has('username'))
                <p class="help is-danger">{{ $errors->first('username') }}</p>
            @endif
        </div>

        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input name="name" class="input" type="text" placeholder="Name">
            </div>
            @if ($errors->has('name'))
                <p class="help is-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input name="email" class="input" type="text" placeholder="Email">
            </div>
            @if ($errors->has('email'))
                <p class="help is-danger">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input name="password" class="input" type="password" placeholder="Password">
            </div>
            @if ($errors->has('password'))
                <p class="help is-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <div class="field">
            <label class="label">Password Confirmation</label>
            <div class="control">
                <input name="password_confirmation" class="input" type="password" placeholder="Password Confirmation">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-link">Register</button>
            </div>
        </div>
    </form>
</div>
@endsection
