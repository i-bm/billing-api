@extends('layouts.dashboard.main')

@section('content')

<div class="container">
    Welcome {{ $user->first_name }}

    <ul>
    @foreach ($companies as  $company)
        <li>Name: {{ $company->name }}</li>
    @endforeach
    </ul>

    <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="{{ route('company.index') }}">Companies</a></li>
        <li><a href="{{ route('apikeys.index') }}">ApiKeys</a></li>
        <li><a href="#">Logout</a></li>
    </ul>
</div>



@endsection
