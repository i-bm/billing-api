@extends('layouts.dashboard.main')

@section('content')

<div class="container">

    <a href="{{ route('apikeys.create') }}" class="btn btn-primary">Add API Key</a>
    <table class="table table-boarded">
        <thead>
        <th></th>
        <th>Name</th>
        <th>Description</th>
        <th>Company</th>
        <th>Key</th>
        <th></th>
    </thead>

        <tbody>
            @forelse ($keys as $key)
            <tr>
                <td></td>
                <td>{{ $key->name }}</td>
                <td>{{ $key->description }}</td>
                <td>{{ $key->company->name }}</td>
                <td>{{ $key->key}}</td>
                <td></td>
                <td></td>
            </tr>
            @empty
            <td>No Keys</td>
            @endforelse
        </tbody>

    </table>
</div>
@endsection
