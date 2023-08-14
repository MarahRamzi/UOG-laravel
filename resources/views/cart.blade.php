@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Your Cart</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                {{-- <th>Status</th> --}}
                <th>Subtotal</th>
                <th>Time</th>
                <th>Action</th>
                <th>purchase</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    @php
                        $subtotal = $details['price'] * $details['quantity'];
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>
                            {{ $details['item_name'] }}
                        </td>
                        <td>${{ $details['price'] }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        {{-- <td>{{ $details['status'] }}</td> --}}
                        <td>${{ $subtotal }}</td>
                        <td>{{ now() }}</td>
                        <td class="actions" data-th="">
                           <form action="{{ route('remove.from.cart') }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                        </form>
                        </td>
                        <td>
                            <a href="{{ route('test_quantity') }}" class="btn btn-success">Buy</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right"><strong>Total:</strong></td>
                <td colspan="2">${{ $total }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="text-right">
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Continue Shopping</a>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

    $(".update-cart").change(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    // $(".remove-from-cart").click(function (e) {
    //     e.preventDefault();

    //     var ele = $(this);

    //     if(confirm("Are you sure want to remove?")) {
    //         $.ajax({
    //             url: '{{ route('remove.from.cart') }}',
    //             method: "DELETE",
    //             data: {
    //                 _token: '{{ csrf_token() }}',
    //                 id: ele.parents("tr").attr("data-id")
    //             },
    //             success: function (response) {
    //                 window.location.reload();
    //             }
    //         });
    //     }
    // });

</script>
@endsection
