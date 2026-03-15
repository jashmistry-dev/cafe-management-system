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

        $cart = session()->get('cart', []);

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
                'table_id' => $request->table_id
            ];
        }
        // dd($request->all());

        session()->put('cart', $cart);

        return back()->with('success', 'Item added to cart');
    }

    public function view()
    {
        $cart = session()->get('cart', []);

        return view('customer.cart', compact('cart'));
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);

        unset($cart[$request->index]);

        session()->put('cart', array_values($cart));

        return back()->with('success', 'Item removed from cart');
    }
}