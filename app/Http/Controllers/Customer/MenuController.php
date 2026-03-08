<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\MenuItem;

class MenuController extends Controller
{
    public function showMenu($table)
    {
        $table = Table::findOrFail($table);

        $menuItems = MenuItem::where('is_available', 1)->get();

        return view('customer.menu', compact('menuItems', 'table'));
    }
}