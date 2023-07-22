@extends('cms.master')

@section('title' , 'Create User')

@section('styles')
@endsection

@section('mainTitle','Create User')

@section('subTitle','create user')

@section('content')

    <div class="container ">
        {{-- @if($errors->any())
            <div class="alert alert-danger">
            <ul>
                <li>All errors</li>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif --}}
    <form action="{{ route('users.store') }}" method="post" >
        @csrf
        <div class="form-floating mb-3 mt-3">
            <label for="username">User Name</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('username')]) id="username" name = "username"  placeholder="enter username"  value={{ old('username') }}>
            @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="email">email</label>
            <input type="email" @class(['form-control','is-invalid' => $errors->has('email')])id="email" name ="email"  placeholder="enter email " value={{ old('email') }}>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="first_name">First Name</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('first_name')]) id="first_name" name ="first_name"  placeholder="enter first_name " value={{ old('first_name') }}>
            @error('first_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="last_name">Last Name</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('last_name')]) id="last_name" name ="last_name" placeholder="enter last_name " value={{ old('last_name') }}>
            @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="is_admin">User Type</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('is_admin')]) id="is_admin" name ="is_admin"  placeholder="enter user type " value={{ old('is_admin') }}>
            @error('is_admin')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


          <div class="form-floating mb-3">
            <label for="is_active"> status User </label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('is_active')]) id="is_active" name ="is_active"  placeholder="enter status user " value={{ old('is_active') }}>
            @error('is_active')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="password"> password </label>
            <input type="password" @class(['form-control','is-invalid' => $errors->has('password')]) id="password" name ="password" placeholder="enter password ">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <button type="submit" class="btn btn-primary mb-3 ">Create User</button>
    </form>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

@endsection
