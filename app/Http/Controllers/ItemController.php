<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nome' => 'required',
        'descricao' => 'nullable',
    ]);

    Item::create($request->only('nome', 'descricao'));

    return redirect()->route('items.index')
                     ->with('success', 'Item criado com sucesso.');
}

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable',
        ]);
    
        $item->update($request->only('nome', 'descricao'));
    
        return redirect()->route('items.index')
                         ->with('success', 'Item atualizado com sucesso.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
                         ->with('success', 'Item excluído com sucesso.');
    }
}
