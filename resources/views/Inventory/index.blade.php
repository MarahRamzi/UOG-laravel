@extends('cms.master')

@section('title' , ' Index Inventory')

@section('styles')
@endsection

@section('mainTitle',' Index Inventory')

@section('subTitle',' index inventory')

@section('content')

    <div class="container ">

        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
<div class="filter mb-5">
    <form action="{{ route('inventories.index') }}" method="GET">

        <input type="text" class="mr-3" name="name"id="name" placeholder="name">

        <button type="submit">Filter</button>
    </form>
</div>
<div class="row">

    @foreach($inventory as $inventories)
    <div class="col-md-3">
        <ul class="list-group mb-3">

            <li class="list-group-item active" aria-current="true">Id => {{ $inventories->id }}</li>
            <li class="list-group-item">inventory Name = >{{ $inventories->name }}</li>
            <li class="list-group-item">City => {{ $inventories->city->name }}</li>
            <li class="list-group-item">Phone  => {{ $inventories->phone }}</li>
            <li class="list-group-item">inventory Status => {{ $inventories->is_active }}</li>

            <li class="list-group-item"><a href= "{{ route('inventories.edit' , $inventories->id) }}" class="btn btn-primary">Edit</a>
              <form action="{{ route('inventories.destroy', $inventories->id) }}" method="post">
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
