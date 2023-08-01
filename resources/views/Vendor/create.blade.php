@extends('cms.master')

@section('title' , 'Create Vendor')

@section('styles')
@endsection

@section('mainTitle','Create Vendor')

@section('subTitle','create vendor')

@section('content')

    <div class="container ">

    <form action="{{ route('vendors.store') }}" method="post" >
        @csrf
        @method('post')

          <div class="form-floating mb-3">
            <label for="email">email</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('email')])id="email" name ="email"  placeholder="enter email " value={{ old('email') }}>
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
            <label for="is_active"> status Vendor </label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('is_active')]) id="is_active" name ="is_active"  placeholder="enter status vendor" value={{ old('is_active') }}>
            @error('is_active')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <label for="phone"> Phone </label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('phone')]) id="phone" name ="phone"  placeholder="enter your phone " value={{ old('phone') }}>
            @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <button type="submit" class="btn btn-primary mb-3 ">Create Vendor</button>
    </form>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

@endsection
