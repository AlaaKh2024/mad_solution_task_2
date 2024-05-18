@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <h3>Welcome {{Auth::user()->name}}</h3>
    </div>
</div>

@endsection