@extends('layouts.master')

@section('title')
  Dashboard
@endsection

@section('content')
  @if (session('sukses'))
    <div class="alert alert-success mt-2">
      {{ session('sukses') }}
    </div>
  @endif
@endsection