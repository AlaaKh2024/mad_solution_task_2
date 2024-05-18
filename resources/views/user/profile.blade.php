@extends('layouts.app')

@section('content')
<div class="py-4"></div>
<div class="container">
    <h1 class="my-3"style=" text-align: center;">Profile</h1>

    @isset($message)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{$message}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endisset

    <div class="card card-sm"style=" width: 80%;" >
        <div class="card-body"style=" background-color:#f0f0f0;">
            <img src="{{asset('storage/'.$user->image)}}" class="rounded-circle mb-3 img-fluid profile-image" alt="Profile Image">
            <form action="{{url('/users/'.$user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3"style=" width: 80%;">
                    <label for="name" class="form-label"> User Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
                </div>
                <div class="mb-3"style=" width: 80%;">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
                </div>
                <div class="mb-3"style=" width: 80%;">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" type="file" id="image" name="image"value="{{$user->image}}" required>
                    @error('image')
                    <div class="small-alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3" style="width: 80%;">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{$user->phone_number}}" required>
                </div>
            
                <div class="mb-3" style="width: 80%;">
                    <label for="certificate" class="form-label">Certificate</label>
                    <input type="text" class="form-control" id="certificate" name="certificate" value="{{$user->certificate}}" required>
                </div>
                <div class="mb-3"style=" width: 80%;">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Change your password">
                    @error('password')
                        <div class="small-alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3"style=" width: 80%;">
                    <label for="phone" class="form-label">phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Change your phone"value="{{$user-> phone}}" required>
                    @error('phone')
                        <div class="small-alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3"style=" width: 80%;">
                    <label for="city" class="form-label">city</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Change your city"value="{{$user-> city}}" required>
                    @error('city')
                        <div class="small-alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3"style=" width: 80%;">
                    <label for="new_phone" class="form-label"> close phone to order</label>
                    <input type="text" class="form-control" id="new_phone" name="new_phone" placeholder=" phone"value="{{$user-> new_phone}}" required>
                    @error('new_phone')
                        <div class="small-alert">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn.custom-btn">Update profile</button>
            </form>
        </div>
    </div>
</div>
<style>
    .profile-image {
        max-width: 100px; 
        height: auto;
    }
</style>
@endsection
