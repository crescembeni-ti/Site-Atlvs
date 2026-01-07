@extends('layouts.app')

@section('content')
    <x-ui.hero />
    <x-ui.metrics />
    <x-ui.features />
    <x-ui.cta />
    <x-ui.contact-form />
@endsection
@if(session('success'))
    <div class="mt-4 rounded-lg bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3">
        {{ session('success') }}
    </div>
@endif