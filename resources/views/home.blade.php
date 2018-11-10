@extends('layouts.app')

@section('content')
<div>
    <div class="columns">
        <div class="column sidebar is-one-quarter">
            <messages room="{{ $room }}"></messages>
            <message-field room="{{ $room }}"></message-field>
        </div>
        <div class="column"><lobby room="{{ $room }}" user="{{ Auth::user()->id }}"></lobby></div>
    </div>
</div>
@endsection
