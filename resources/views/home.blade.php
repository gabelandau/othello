@extends('layouts.app')

@section('content')
<div>
    <div class="columns">
        <div class="column sidebar is-one-quarter">
            <messages game="{{ $game }}"></messages>
            <message-field game="{{ $game }}"></message-field>
        </div>
        <div class="column"><lobby game="{{ $game }}" userid="{{ Auth::user()->id }}"></lobby></div>
    </div>
</div>
@endsection
