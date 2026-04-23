<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\MenuItem;

use App\Models\Category;

class MenuController extends Controller
{
    public function showMenu($table)
    {
        $table = Table::findOrFail($table);

        if ($table->status === 0) {
            return back()->with('error', 'This table is deactivated');

        } else {

            $table_ID = $table->id;


            session(['table_id' => $table_ID]);


            $categories = Category::with([
                'menuItems' => function ($q) {
                    $q->where('is_available', 1);
                }
            ])->get();

            return view('customer.menu', compact('categories', 'table'));
        }
    }
}