@extends('layouts.app')

@section('content')
<div class="authentication-box">
    <form class="login-form-container box" method="POST" action="{{ route('login') }}">
        @csrf

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
            <div class="control">
                <button class="button is-link">Log in</button>
            </div>
        </div>
    </form>
</div>
@endsection
