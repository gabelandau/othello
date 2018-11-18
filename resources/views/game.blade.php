@extends('layouts.app')

@section('content')
<div>
    <div class="columns">
        <div class="column sidebar is-one-quarter">
            <messages game="{{ $game->id }}"></messages>
            <message-field game="{{ $game->id }}"></message-field>
        </div>
        <div class="column">
            <game-header game="{{ json_encode($game) }}"></game-header>
            <board game="{{ json_encode($game) }}"></board>
        </div>
    </div>
</div>
@endsection
