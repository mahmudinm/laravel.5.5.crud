<?php

namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        //     'price' => 'required|integer',
        //     'total' => 'required|integer',
        //     'ppn' => 'required|integer'
        // ]);

        // return dd($request->all());
        $name = $request->name;
        $quantity = $request->quantity;
        $price = $request->price;
        $total = $request->total;
        $ppn = $request->ppn;

        for ($i = 0; $i < count($name); $i++) {
            $books = new Books;

            $books->name = $name[$i];
            $books->quantity = $quantity[$i];
            $books->price = $price[$i];
            $books->total = $total[$i];
            $books->ppn = $ppn[$i];
            
            $books->save();

        }

        // Books::create($request->all());

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function show(Books $books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function edit(Books $books)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Books $books)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function destroy(Books $books)
    {
        //
    }
}
