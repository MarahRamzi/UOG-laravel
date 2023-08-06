<!-- <?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'item_id' => 'required',
            'item_name' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $user_id = $data['user_id'];
        $item_id = $data['item_id'];
        $item_name = $data['item_name'];
        $quantity = $data['quantity'];

        $order = PurchaseOrder::where('user_id', $user_id)->where('status', 'in progress')->first();

        if (!$order) {
            $order = PurchaseOrder::create(['user_id' => $user_id , 'item_id' => $item_id]);
        }

        $cart_item = CartItem::create([
            'user_id' => $user_id,
            'order_id' => $order->id,
            'item_name' => $item_name,
            'quantity' => $quantity,
        ]);

        // return response()->json(['message' => 'Item added to cart', 'purchase_order_id' => $order->id]);
        return view('cart')
        ->with(['success' , 'Item added to cart' , 'purchase_order_id' => $order->id ]);

    }

    public function viewCart(Request $request)
    {
        $user_id = $request->input('user_id');

        $order = PurchaseOrder::where('user_id', $user_id)->where('status', 'in progress')->first();

        if (!$order) {
            return response()->json(['message' => 'No items in the cart']);
        }

        $cart_items = $order->cartItems;

        return view('view_cart', ['cart_items' => $cart_items]);

    }

    public function updateCartItem(Request $request, $item_id)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $data['quantity'];

        $cart_item = CartItem::findOrFail($item_id);
        $cart_item->update(['quantity' => $quantity]);

        return response()->json(['message' => 'Cart item updated']);
    }

    public function removeFromCart($item_id)
    {
        $cart_item = CartItem::findOrFail($item_id);
        $cart_item->delete();

        return response()->json(['message' => 'Item removed from cart']);
    }

    public function clearCart(Request $request)
    {
        $user_id = $request->input('user_id');

        $order = PurchaseOrder::where('user_id', $user_id)->where('status', 'in progress')->first();

        if (!$order) {
            return response()->json(['message' => 'Cart is already empty']);
        }

        CartItem::where('order_id', $order->id)->delete();

        return response()->json(['message' => 'Cart cleared']);
    }

    public function checkout(Request $request)
    {
        $user_id = $request->input('user_id');

        $order = PurchaseOrder::where('user_id', $user_id)->where('status', 'in progress')->first();

        if (!$order) {
            return response()->json(['message' => 'No items in the cart']);
        }

        // Implement additional logic for checkout, e.g., calculating total price, updating order status, etc.

        return response()->json(['message' => 'Checkout completed']);
    }
}