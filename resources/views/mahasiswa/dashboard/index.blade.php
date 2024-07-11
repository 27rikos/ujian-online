@extends('partials.mahasiswa')
@section('content')
    <div class="pc-content">
        <p>Welcome {{ Auth::user()->name }}</p>
    </div>
@endsection
