<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class TableController extends Controller
{

    public function index()
    {
        $tables = Table::all();

        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.tables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|unique:tables'
        ]);

        Table::create([
            'table_number' => $request->table_number
        ]);

        return redirect()->route('tables.index');
    }

    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    public function update(Request $request, Table $table)
    {
        $table->update([
            'table_number' => $request->table_number
        ]);

        return redirect()->route('tables.index');
    }

    public function destroy(Table $table)
    {
        $table->delete();

        return back();
    }


    public function downloadQR($id)
    {
        $table = Table::findOrFail($id);

        $qr = QrCode::format('svg')
            ->size(300)
            ->generate(url('/table/' . $table->table_number));

        return response($qr)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="table-' . $table->table_number . '.svg"');
    }

    public function toggle($id)
    {
        $table = Table::findOrFail($id);

        // toggle logic 🔥
        $table->status = $table->status ? 0 : 1;

        $table->save();

        return back();
    }

}