{{-- <!DOCTYPE html>
<html>
<head>
    <title>View Cart</title>
</head>
<body>
    <h1>View Cart</h1>
    @if (count($cart_items) > 0)
        <ul>
            @foreach ($cart_items as $item)
                <li>{{ $item->item_name }} (Quantity: {{ $item->quantity }})</li>
            @endforeach
        </ul>
    @else
        <p>No items in the cart.</p>
    @endif
</body>
</html>
Routes:
In the routes/web.php file, define the routes to link the views with the CartController methods:
php
Copy code
use App\Http\Controllers\CartController;

Route::get('/cart', function () {
    return view('cart');
});

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

Route::get('/cart/view', [CartController::class, 'viewCart'])->name('cart.view');
Controller:
In the CartController, return the views in their respective methods:
php
Copy code
public function addToCart(Request $request)
{
    // ... (existing implementation)
    return view('cart');
}

public function viewCart(Request $request)
{
    $user_id = $request->input('user_id');
    // ... (existing implementation)
    return view('view_cart', ['cart_items' => $cart_items]);
}
Now, when you visit /cart, you'll see a form to add items to the cart. After adding items, you can visit /cart/view to view the cart items.

Of course, this is just a basic example, and you can further enhance the views with CSS, JavaScript, and additional features according to your application's requirements.




 --}}
