@extends('cms.master')

@section('title' , 'Edit City')

@section('styles')
@endsection

@section('mainTitle','Edit City')

@section('subTitle','edit city')

@section('content')

    <div class="container ">
    <form action="{{ route('cities.update' , $city->id) }}" method="post" >
        @csrf
        @method('put')
        <div class="form-floating mb-3 mt-3">
            <label for="name">City Name</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('name')]) id="name" name = "name"  value={{ old('name' , $city->name) }}>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-md-12">
            <label>Country id</label>
            <select  @class(['form-control','is-invalid' => $errors->has('country_id')]) name="country_id" id="country_id"  style="width: 100%;" value={{ old('country_id' , $city->country_id) }}>
             @foreach ($country as  $countries)
             <option  value="{{  $countries->id }}">{{  $countries->id}}</option>
             @endforeach
            </select>
            @error('country_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


          <button type="submit" class="btn btn-primary mb-3 ">update City</button>
    </form>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

@endsection

