<?php

namespace App\Http\Controllers\API;

use App\Library;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
        return Library::all();        
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'subcategory_id' => 'required',
            'name' => 'required',
            'measure_type' => 'required'
        ]);
        return Library::create([
            'subcategory_id' => $request['subcategory'],
            'name' => $request['name'],
            'measure_type' => $request['measure_type'],
            'width' => $request['width'],
            'height' => $request['height'],
            'depth' => $request['depth']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return Library::findOrFail($library->id);
        return Library::where('sub_category_id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function edit(Library $library)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Library $library)
    {
        $library = Library::findOrFail($id);
        $this->validate($request, [
            'id' => 'required',
            'subcategory_id' => 'required',
            'name' => 'required',
            'measure_type' => 'required'
        ]); 
        $library->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        $library = Library::findOrFail($id);
        $library->delete();
    }
        /**
     * Display the specified resource.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function findCabinet($id)
    {
        // return Library::findOrFail($library->id);
        return Library::findOrFail($id);
    }
}
