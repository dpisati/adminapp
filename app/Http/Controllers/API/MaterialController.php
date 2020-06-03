<?php

namespace App\Http\Controllers\API;

use App\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


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
        $slug = Str::slug($request->name, '-');
        $slugFinish = Str::slug($request->finish, '-');
        $slugJPG = $slug . "-" . $slugFinish . ".jpeg";
        
        $material = new Material;
        $material->supplier_id = $request->supplier_id;
        $material->name = $request->name;
        $material->slug = $slug;
        $material->finish = $request->finish;
        $material->stock = $request->stock;
        $material->range = $request->range;
   
        if($request->picture != "") {
            // $name = time().'.' . explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];
            \Image::make($request->picture)->save(public_path('images/materials/').$slugJPG);
            $material->picture = $slugJPG;
        }
        $material->save();
        return ['message', 'Material created successfully'];
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
        $currentPicture = $material->picture;
        if($request->picture != $currentPicture) {
            $slug = Str::slug($request->name, '-');
            $slugFinish = Str::slug($request->finish, '-');
            $slugJPG = $slug . "-" . $slugFinish . ".jpeg";
            \Image::make($request->picture)->save(public_path('images/materials/').$slugJPG);
            $request->merge(['picture' => $slugJPG]);
            $material->picture = $request->picture;
            $materialPhoto = public_path('images/materials/').$currentPicture;
            if(file_exists($materialPhoto) && $materialPhoto != public_path('images/materials/no-preview.png')) {
                    @unlink($materialPhoto);
            }
        }
        $material->update($request->all());
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
        $currentPicture = $material->picture;
        $materialPhoto = public_path('images/materials/').$currentPicture;
        @unlink($materialPhoto);
        $material->delete();


        return ['message' => 'Material Deleted'];
    }
        /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function find($id)
    {
        return Material::with('supplier')->where('supplier_id', $id)->get();
    }
}
