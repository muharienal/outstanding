<?php

namespace App\Http\Controllers;

use App\Models\library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libraries = library::all();

        return view('library.index', compact('libraries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = str()->uuid()->toString().'.'.$request->file('pdf')->extension();

        $request->file('pdf')->move(public_path('assets/libraries'), $name);

        return library::create(array_merge(
            $request->all(),
            ['pdf' => $name]
        ))
            ? back()->with('success', 'Libraries has been created successfully!')
            : back()->with('failed', 'Libraries was not created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(library $library)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(library $library)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, library $library)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(library $library)
    {
        //
    }
}
