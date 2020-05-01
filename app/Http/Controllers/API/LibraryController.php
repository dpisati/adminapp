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
        return Library::with(['subcategory', 'subcategory.category'])->get();
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
            'picture' => $request['picture'],
            'measure_type' => $request['measure_type'],
            'min_width' => $request['min_width'],
            'max_width' => $request['max_width'],
            'min_height' => $request['min_height'],
            'max_height' => $request['max_height'],
            'min_depth' => $request['min_depth'],
            'max_depth' => $request['max_depth']
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
        // return Library::findOrFail($id);
        // return Library::where('sub_category_id', $id)->get();
        return Library::with(['subcategory', 'subcategory.category'])->findOrFail($id);
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
        /**
     * Display the specified resource.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function findCabinetBySubCategory($id)
    {
        return Library::where('sub_category_id', $id)->get();
    }
    public function updateCabinet(Request $request)
    {
        $cabinet = Library::findOrFail($id);
        $currentPicture = $cabinet->picture;
        if($request->picture != $currentPicture) {
            $name = time().'.' . explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];
            \Image::make($request->picture)->save(public_path('images/cabinets/').$name);
            $request->merge(['picture' => $name]);
            $cabinet->picture = $request->picture;
            $cabinetPhoto = public_path('images/cabinets/').$currentPicture;
            if(file_exists($cabinetPhoto) && $cabinetPhoto != public_path('images/cabinets/no-preview.png')) {
                    @unlink($cabinetPhoto);
            }
        }
        $cabinet->update($request->all());
        return ['message', 'Cabinet updated successfully'];
    }
}
