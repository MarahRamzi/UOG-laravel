@extends('cms.master')

@section('title' , 'Edit Vendor')

@section('styles')
@endsection

@section('mainTitle','Edit Vendor')

@section('subTitle','edit vendor')

@section('content')

    <div class="container ">
    <form action="{{ route('vendors.update' ,$vendor->id) }}" method="post" >
        @csrf
        @method('put')

          <div class="form-floating mb-3">
            <label for="email">email</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('email')]) id="email" name ="email" value="{{ $vendor->email }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="first_name">First Name</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('first_name')]) id="first_name" name ="first_name" value="{{ $vendor->first_name }}">
            @error('first_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="last_name">Last Name</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('last_name')]) id="last_name" name ="last_name" value="{{ $vendor->last_name }}">
            @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div  @class(['form-control','mt-4','is-invalid' => $errors->has('is_active')]) >
          <label for="is_active"> vendor Status </label>
          <select class="form-select" aria-label="Default select example" name="is_active" id="is_active">
            <option selected disabled> select status</option>
            <option value="1" {{ $vendor->is_active ? 'selected="selected"' : '' }}>Active</option>
            <option value="0" {{ !$vendor->is_active ? 'selected="selected"' : '' }}>Inactive</option>
          </select>
          @error('is_active')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="phone"> Phone </label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('phone')]) id="phone" name ="phone" value="{{ $vendor->phone }}">
            @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <button type="submit" class="btn btn-primary ">update Vendor</button>
    </form>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
@endsection
