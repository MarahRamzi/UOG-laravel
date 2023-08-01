@extends('cms.master')

@section('title' , ' Index City')

@section('styles')
@endsection

@section('mainTitle',' Index City')

@section('subTitle',' index city')

@section('content')

    <div class="container ">

        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
<div class="filter mb-5">
    <form action="{{ route('cities.index') }}" method="GET">

        <input type="text" class="mr-3" name="name"id="name" placeholder="name">

        <button type="submit">Filter</button>
    </form>
</div>
<div class="row">

    @foreach($city as $cities)
    <div class="col-md-3">
        <ul class="list-group mb-3">

            <li class="list-group-item active" aria-current="true">Id => {{ $cities->id }}</li>
            <li class="list-group-item">City Name = >{{ $cities->name }}</li>
            <li class="list-group-item">Country_id => {{ $cities->country_id }}</li>

            <li class="list-group-item"><a href= "{{ route('cities.edit' , $cities->id) }}" class="btn btn-primary">Edit</a>
              <form action="{{ route('cities.destroy', $cities->id) }}" method="post">
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
