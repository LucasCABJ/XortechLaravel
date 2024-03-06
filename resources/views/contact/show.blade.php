@extends('layouts.admin-layout')

@section('content')

    @component('components.navbar')
    @endcomponent
<div class="bg-white border rounded shadow-sm overflow-hidden">
    <a href="{{ route('contact.index') }}" class="btn btn-th-grey text-light my-3 ms-4">Back</a>
    <form action="{{ route('contact.update', $contact->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
            <div class="col-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $contact->name }}" disabled>
            </div>
            <div class="col-12 col-md-6">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-envelope text-th-tertiary"></i>
                    </span>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $contact->email }}" disabled>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <label for="phone" class="form-label">Phone Number</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-phone-alt text-th-tertiary"></i>
                    </span>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ $contact->phone }}" disabled>
                </div>
            </div>
            <div class="col-12">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="3" disabled>{{ $contact->message }}</textarea>
            </div>
            <div class="col-12">
                <div class="d-grid">
                    <button class="btn btn-th-primary text-light btn-lg" type="submit">Mark as Read</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
