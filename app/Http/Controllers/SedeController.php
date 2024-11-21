<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sede;


class SedeController extends Controller
{
    public function index()
    {
        $sedes = Sede::all();
        return view('sedes.index', compact('sedes'));
    }

    public function create()
    {
        return view('sedes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_sede' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
        ]);

        Sede::create($request->all());

        return redirect()->route('sedes.index');
    }

    public function edit($id)
    {
        $sede = Sede::findOrFail($id);
        return view('sedes.edit', compact('sede'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_sede' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
        ]);

        $sede = Sede::findOrFail($id);
        $sede->update($request->all());

        return redirect()->route('sedes.index');
    }

    public function destroy($id)
    {
        Sede::destroy($id);
        return redirect()->route('sedes.index');
    }
}

