@extends('cms.master')

@section('title' , 'Create Country')

@section('styles')
@endsection

@section('mainTitle','Create Country')

@section('subTitle','create country')

@section('content')

    <div class="container ">
    <form action="{{ route('countries.store') }}" method="post" >
        @csrf
        <div class="form-floating mb-3 mt-3">
            <label for="name">Country Name</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('name')]) id="name" name = "name"  placeholder="enter country name"  value={{ old('name') }}>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

          <button type="submit" class="btn btn-primary mb-3 ">Create Country</button>
    </form>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

@endsection

