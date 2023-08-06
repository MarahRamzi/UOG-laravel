@extends('cms.master')

@section('title' , ' Largest Inventory')

@section('styles')
@endsection

@section('content')

<h2>Inventory with Largest Quantity Of {{ $item->name }}</h2>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">icon</th>
      </tr>
    </thead>
    <tbody>
        {{-- $largeInventory as $inventory
            $item->inventories as $inventory
            --}}
       @if($largeInventory)

      <tr>
        <th scope="row">{{ $largeInventory->id }}</th>
        <td>{{ $largeInventory->name }}</td>
        <td>{{ $largeInventory->pivot->quantity }}</td>
        <td><a href = {{route('items.index')}}><i class="fa fa-reply-all" aria-hidden="true"></i>
        </a></td>
    </tr>

    @endif

    </tbody>
  </table>
@endsection
