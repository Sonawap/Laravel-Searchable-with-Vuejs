@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-white">
            <h4 class="card-title ">Users</h4>
        </div>
        <div class="card-body">
            <table class="table" id="DataTable">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Decription</th>
                        <th scope="col">Date Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <th scope="row"></th>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->description }}</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                    @empty

                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@include('partials.javascript')
@include('partials.styles')


