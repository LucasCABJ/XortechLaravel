@if(Auth::user()->role == 'admin' || Auth::user()->role == 'vendor')
    @extends('layouts.admin-layout')
@else
    @extends('layouts.app')
@endif

@section('content')

@component('components.navbar')
@endcomponent

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
