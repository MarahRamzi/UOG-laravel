@extends('cms.master')

@section('title' , 'Create Inventory')

@section('styles')
@endsection

@section('mainTitle','Create Inventory')

@section('subTitle','create inventory')

@section('content')

    <div class="container ">
    <form action="{{ route('inventories.store') }}" method="post" >
        @csrf
        <div class="form-floating mb-3 mt-3">
            <label for="name">inventory Name</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('name')]) id="name" name ="name"  placeholder="enter inventory name"  value={{ old('name') }}>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-md-12">
            <label for="city_id">City id</label>
            <select  @class(['form-control','is-invalid' => $errors->has('city_id')]) name="city_id" id="city_id"  style="width: 100%;" >
             @foreach ($city as  $cities)
             <option  value="{{  $cities->id }}">{{  $cities->name}}</option>
             @endforeach
            </select>
            @error('city_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <label for="is_active"> Inventory status  </label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('is_active')]) id="is_active" name ="is_active"  placeholder="enter status " value={{ old('is_active') }}>
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

          <button type="submit" class="btn btn-primary mb-3 ">Create inventory</button>
    </form>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

@endsection

