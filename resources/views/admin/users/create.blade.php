@extends('layouts.template')

@section('title', 'Create new user')

@section('main')
    <h1>Create new genre</h1>
    <form action="/admin/users" method="post">
        @include('admin.users.form')
    </form>
@endsection
