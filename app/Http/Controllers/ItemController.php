<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Validator;
use File;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $items = Item::where('name', 'LIKE', '%'.$q.'%')->orderBy('name')->paginate(10);
        return view('items.index', compact('items'));
        // return response()->json()
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'quantity' => 'required|integer',
            'image' => 'required|mimes:jpeg,png|max:10240'
        ]);        
        // $data = $request->only('name', 'quantity');
        $item = new Item;
        $item->name = $request->name;
        $item->quantity = $request->quantity;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = str_random(30).'.'.$image->guessClientExtension();
            $image->move('upload/', $fileName);

            $item->image = $fileName;
        }

        $item->save();
        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $this->validate($request,[
            'name' => 'required',
            'quantity' => 'required|integer',
            'image' => 'required|mimes:jpeg,png|max:10240'
        ]);
        $item->name = $request->name;
        $item->quantity = $request->quantity;

        if ($request->hasFile('image')) {

            $itemImage = public_path("upload/{$item->image}"); // get previous image from folder
            if (File::exists($itemImage)) { // unlink or remove previous image from folder
                unlink($itemImage);
            }

            $image = $request->file('image');
            $fileName = str_random(30).'.'.$image->guessClientExtension();
            $image->move('upload/', $fileName);

            $item->image = $fileName;
        }

        $item->save();
        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index');
    }


    public function search(Request $request)
    {
        $q = $request->get('q');
        $items = Item::where('name', 'LIKE', '%'.$q.'%')->orderBy('name')->paginate(10);
        return view('items.index', compact('items'));
    }
}
