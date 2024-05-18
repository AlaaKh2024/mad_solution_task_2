@extends('layouts.app')

@section('content')
    <h1>Register</h1>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="phone_number" placeholder="Phone Number" required><br>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br>
        <input type="file" name="profile_photo" accept="image/*" required><br>
        <input type="file" name="certificate" accept=".pdf" required><br>
        <button type="submit">Register</button>
    </form>

    <h1>Login</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

    <h1>Logout</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
