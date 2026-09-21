@extends('components.layout.admin')
@section('title','Welcome In Quizer')
@section('content')

<div class="text-center">
    <a href="{{route('logout')}}">Logout</a>
</div>

@endsection