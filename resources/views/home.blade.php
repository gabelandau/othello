@extends('layouts.app')

@section('content')
<div>
    <div class="columns">
        <div class="column sidebar is-one-quarter">
            <messages></messages>
            <message-field></message-field>
        </div>
        <div class="column"><user-list></user-list></div>
    </div>
</div>
@endsection
