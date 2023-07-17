@extends('cms.master')

@section('title' , ' User')

@section('styles')
@endsection

@section('mainTitle',' Index User')

@section('subTitle',' user')

@section('content')

    <div class="container ">
<div class="row">

@foreach ($user as $users )
   <div class="col-md-4">
    <ul class="list-group mb-3">
      <li class="list-group-item active" aria-current="true">Id => {{ $users->id }}</li>
      <li class="list-group-item">User Name = >{{ $users->username }}</li>
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
