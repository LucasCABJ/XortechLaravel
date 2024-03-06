@extends('layouts.admin-layout')

@section('content')

    @component('components.navbar')
    @endcomponent

    <div class="container my-4">

        <h2 class="ms-2">Messages</h2>

        @if(count($contacts) > 0)
            <table class="table mt-3 table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>
                            <a href="{{ route('contact.show', $contact->id) }}">{{ $contact->name }}</a>
                        </td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td class="text-truncate pe-2" style="max-width: 200px">{{ $contact->message }}</td>
                        <td>
                            @if($contact->read == false)
                                <span class="badge bg-danger">Unread</span>
                            @else
                                <span class="badge bg-success">Read</span>
                            @endif
                        </td>
                        <td>{{ $contact->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No messages found</p>
        @endif
    </div>

@endsection

