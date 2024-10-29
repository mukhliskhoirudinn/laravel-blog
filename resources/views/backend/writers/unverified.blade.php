@extends('layouts.app')

@section('title', 'Writers')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card icon="tag" title="Writers">
                    <div class="table-responsive-sm">
                        <h2>
                            Unverified Writers: {{ auth()->user()->email }},<br>
                            Please wait or contact owner:
                            <a href="mailto:{{ $owner_email }}">{{ $owner_email }}</a>
                        </h2>
                    </div>
                </x-card>
            </div>
        </div>
    </div>

@endsection
