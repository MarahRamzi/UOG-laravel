@extends('cms.master')

@section('title' , ' Item')

@section('styles')
@endsection

@section('mainTitle',' Index Item')

@section('subTitle',' item')

@section('content')

    <div class="container ">

        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
<div class="filter mb-5">
    <form action="{{ route('items.index') }}" method="GET">
        <select name="is_active" class="mr-3">
            <option value="1">Active</option>
            <option value="0">InActive</option>
        </select>

        <input type="text" class="mr-3" name="name"id="name" placeholder="name">
{{-- 
        <select name="vendor_id" class="mr-3">
            @foreach ($vendor as $vendors )
            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
            @endforeach
        </select> --}}

        <select name="brand_id" class="mr-3">
            @foreach ($brand as $brands )
            <option value="{{ $brands->id }}">{{ $brands->name }}</option>
            @endforeach
        </select>


        <button type="submit">Filter</button>
    </form>
</div>
<div class="row">

    @foreach ( $item as $items )
    <div class="col-md-3">
        <ul class="list-group mb-3">

            <li class="list-group-item active" aria-current="true">Id => {{ $items->id }}</li>
            <li class="list-group-item">
                <img src="{{asset('storage/covers/' . $items->image) }}" class="card-img-top" alt="">
      </li>
            <li class="list-group-item">Item Name = >{{ $items->name }}</li>
            <li class="list-group-item">UStatus => {{ $items->is_active }}</li>
            <li class="list-group-item">Brand => {{ $items->brand->name }}</li>

            <li class="list-group-item"><a href= "{{ route('items.edit' , $items->id) }}" class="btn btn-primary">Edit</a>
              <form action="{{ route('items.destroy' , $items->id) }}" method="post">
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
