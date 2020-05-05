<?php

namespace App\Http\Controllers\API;

use App\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Material::with('supplier')->get();
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
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'supplier_id' => 'required'
        ]);
        return Material::create([
            'supplier_id' => $request['supplier_id'],
            'name' => $request['name']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        return Material::findOrFail($material->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $material = Material::findOrFail($material->id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'supplier_id' => 'required'
        ]);
        $material->update($request->all());
        return ['message' => 'material updated', $material];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        $material = Material::findOrFail($material->id);
        $material->delete();

        return ['message' => 'Material Deleted'];
    }
}
