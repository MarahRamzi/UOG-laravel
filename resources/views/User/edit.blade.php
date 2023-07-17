@extends('cms.master')

@section('title' , 'Edit User')

@section('styles')
@endsection

@section('mainTitle','Edit User')

@section('subTitle','edit user')

@section('content')

    <div class="container ">
    <form action="{{ route('users.update',$user->id) }}" method="post" >
        @csrf
        @method('put')
        <div class="form-floating mb-3 mt-3">
            <label for="username">User Name</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('username')]) id="username" name = "username" value="{{ $user->username }}">
            @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="email">email</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('email')]) id="email" name ="email" value="{{ $user->email }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="first_name">First Name</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('first_name')]) id="first_name" name ="first_name" value="{{ $user->first_name }}">
            @error('first_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="last_name">Last Name</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('last_name')]) id="last_name" name ="last_name" value="{{ $user->last_name }}">
            @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div  @class(['form-control','mt-4','is-invalid' => $errors->has('is_admin')]) >
            <label for="is_admin"> user Type</label>
            <select class="form-select" aria-label="Default select example" name="is_admin" id="is_admin">
            <option disabled> select Type</option>
              <option value="0" {{ !$user->is_admin ? 'selected="selected"' : '' }}>User</option>
              <option value="1" {{ $user->is_admin ? 'selected="selected"' : '' }}>Admin</option>
            </select>
            @error('is_admin')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div  @class(['form-control','mt-4','is-invalid' => $errors->has('is_active')]) >
          <label for="is_active"> user Status </label>
          <select class="form-select" aria-label="Default select example" name="is_active" id="is_active">
            <option selected disabled> select status</option>
            <option value="1" {{ $user->is_active ? 'selected="selected"' : '' }}>Active</option>
            <option value="0" {{ !$user->is_active ? 'selected="selected"' : '' }}>Inactive</option>
          </select>
          @error('is_active')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="password"> password </label>
            <input type="password" @class(['form-control','is-invalid' => $errors->has('')]) id="password" name ="password" value="">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <button type="submit" class="btn btn-primary ">update User</button>
    </form>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
@endsection
