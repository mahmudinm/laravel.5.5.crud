<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::all();
        return view('tables.index', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'quantity' => 'required|integer',
        //     'weight' => 'required|integer'
        // ]);

        $name = $request->name;
        $quantity = $request->quantity;
        $weight = $request->weight;

        for ($i = 0; $i < count($name) ; $i++) {
            $table = new Table ;
            $table->name = $name[$i];
            $table->quantity = $quantity[$i];
            $table->weight = $weight[$i];
            $table->save();
        }

        return redirect()->route('tables.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        // $validator = Validator::make(Input::all(), $this->rules);
        $this->validate($request, [
            'name' => 'required',
            'quantity' => 'required',
            'weight' => 'required'
        ]);

        // $table->id 
        $table->name = $request->name;
        $table->quantity = $request->quantity;
        $table->weight = $request->weight;
        $table->save();

        return response()->json($table);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        //
    }
}
