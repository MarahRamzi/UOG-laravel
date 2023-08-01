@extends('cms.master')

@section('title' , 'Edit Item')

@section('styles')
@endsection

@section('mainTitle','Edit Item')

@section('subTitle','edit item')

@section('content')

    <div class="container ">
    <form action="{{ route('items.update' ,$item->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-floating mb-3 mt-3">
            <label for="name">Item Name</label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('name')]) id="name" name = "name"  placeholder="enter item name"  value={{ old('name' , $item->name ) }}>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <label for="image">Item Image</label>
            <img src="{{asset('storage/covers/' . $item->image) }}" class="card-img-top" alt="">
            <input type="file" @class(['form-control','is-invalid' => $errors->has('image')]) id="image" name ="image" placeholder="Item Image " >
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <label for="is_active"> status  </label>
            <input type="text" @class(['form-control','is-invalid' => $errors->has('is_active')]) id="is_active" name ="is_active"  placeholder="enter status " value={{ old('is_active' , $item->is_active) }}>
            @error('is_active')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-md-3">
            <label>Brand id</label>
            <select  @class(['form-control','is-invalid' => $errors->has('brand_id')]) name="brand_id" id="brand_id"  style="width: 100%;"   value={{ old('brand_id' , $item->brand_id) }}>
             @foreach ($brand as  $brands)
             <option  value="{{  $brands->id }}">{{  $brands->id}}</option>
             @endforeach
            </select>
            @error('brand_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


          <button type="submit" class="btn btn-primary mb-3 ">Update Item</button>
    </form>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

@endsection

