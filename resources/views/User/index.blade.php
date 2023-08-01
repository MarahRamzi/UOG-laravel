@extends('cms.master')

@section('title' , ' User')

@section('styles')
@endsection

@section('mainTitle',' Index User')

@section('subTitle',' user')

@section('content')

    <div class="container ">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
<div class="filter mb-5">
    <form action="{{ route('users.index') }}" method="GET">
        <select name="is_active" class="mr-3">
            <option value="1">Active</option>
            <option value="0">InActive</option>
        </select>
        <select name="is_admin" class="mr-3">
            <option value="1">Admin</option>
            <option value="0">User</option>
        </select>

        <input type="email"  class="mr-3" name="email" id="email" placeholder="email address">

        <input type="text" class="mr-3" name="username"id="username" placeholder="username">

        <input type="text" class="mr-3" name="fullNames" id="full_name" placeholder="full_name">


        <button type="submit">Filter</button>
    </form>
</div>
<div class="row">

@foreach ($user as $users )
   <div class="col-md-4">
    <ul class="list-group mb-3">
      <li class="list-group-item active" aria-current="true">Id => {{ $users->id }}</li>
      <li class="list-group-item">User Name = >{{ $users->username }}</li>
      {{-- <li class="list-group-item">User Name = >{{ $users->full_name}}</li> --}}
      <li class="list-group-item">Email = >{{ $users->email }}</li>
      <li class="list-group-item">First Name =>{{ $users->first_name }}</li>
      <li class="list-group-item">Last Name => {{ $users->last_name }}</li>
      <li class="list-group-item">User Type => {{ $users->is_admin }}</li>
      <li class="list-group-item"><a href= "{{ route('users.edit' , $users->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('users.destroy' , $users->id) }}" method="post">
            @csrf()
            @method('delete')
            <button type="submit" class="btn btn-danger mt-3">Delete</button>
        </form>
    </li>
    </ul>
</div>
@endforeach

    </div>
    </div>

    @endsection

    @section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
@endsection
