@extends('cms.master')

@section('title' , 'Edit Brand')

@section('styles')
@endsection

@section('mainTitle','Edit Brand')

@section('subTitle','edit brand')

@section('content')

    <div class="container ">
    <form action="{{ route('brands.update' ,$brand->id) }}" method="post" >
        @csrf
        @method('put')

        <div class="form-floating mb-3 mt-3">
            <label for="name">Brand Name</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('name')]) id="name" name = "name"  placeholder="enter brand name"  value="{{ $brand->name }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="note">Note</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('note')])id="note" name ="note"  placeholder="enter note " value="{{ $brand->note }}">
            @error('note')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <div class="form-floating mb-3">
            <label for="icon">Icon</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('icon')]) id="icon" name ="icon"  placeholder="icon " value="{{ $brand->icon }}">
            @error('icon')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



          <button type="submit" class="btn btn-primary ">update Brand</button>
    </form>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
@endsection
