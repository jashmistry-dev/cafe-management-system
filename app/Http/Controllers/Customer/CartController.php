<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $menuItem = MenuItem::findOrFail($request->menu_item_id);

        $tableId = session('table_id');

        $cart = session()->get('cart_' . $tableId, []);

        $cartKey = 'cart_' . $tableId;



        $found = false;

        foreach ($cart as &$item) {

            if ($item['id'] == $menuItem->id) {
                $item['quantity']++;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'price' => $menuItem->price,
                'image' => $menuItem->image,
                'quantity' => 1,
                'table_id' => $tableId
            ];
        }

        session()->put($cartKey, $cart);

        return back()->with('success', 'Item added to cart');
    }

    public function view(Request $request)
    {
        $tableId = session('table_id');

        $cart = session()->get('cart_' . $tableId, []);

        return view('customer.cart', compact('cart'));
    }


    public function increase(Request $request)
    {
        $tableId = session('table_id');
        $cartKey = 'cart_' . $tableId;

        $cart = session()->get($cartKey, []);

        $cart[$request->index]['quantity']++;

        session()->put($cartKey, $cart);

        return back();
    }

    public function decrease(Request $request)
    {
        $tableId = session('table_id');
        $cartKey = 'cart_' . $tableId;

        $cart = session()->get($cartKey, []);

        if ($cart[$request->index]['quantity'] > 1) {
            $cart[$request->index]['quantity']--;
        } else {
            unset($cart[$request->index]); 
            $cart = array_values($cart);
        }

        session()->put($cartKey, $cart);

        return back();
    }

    public function remove(Request $request)
    {
        $tableId = session('table_id');

        $cartKey = 'cart_' . $tableId;

        $cart = session()->get($cartKey, []);

        unset($cart[$request->index]);

        session()->put($cartKey, array_values($cart));

        return back()->with('success', 'Item removed');
    }
}