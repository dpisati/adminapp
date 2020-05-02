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
            'sub_category_id' => 'required',
            'name' => 'required',
            'measure_type' => 'required',
            'type' => 'required'
        ]);

        $cabinet = new Library;
        $cabinet->sub_category_id = $request->sub_category_id;
        $cabinet->name = $request->name;
        $cabinet->measure_type = $request->measure_type;
        $cabinet->type = $request->type;
        $cabinet->min_width = $request->min_width;
        $cabinet->max_width = $request->max_width;
        $cabinet->min_height = $request->min_height;
        $cabinet->max_height = $request->max_width;
        $cabinet->min_depth = $request->min_depth;
        $cabinet->max_depth = $request->max_depth;

        if($request->picture != "") {
            $name = time().'.' . explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];
            \Image::make($request->picture)->save(public_path('images/cabinets/').$name);
            $cabinet->picture = $name;
        }

        $cabinet->save();

        return ['message', 'User updated successfully'];
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
        $cabinet = Library::findOrFail($library->id);
        $this->validate($request, [
            'sub_category_id' => 'required',
            'name' => 'required',
            'measure_type' => 'required'
        ]); 
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        $cabinet = Library::findOrFail($library->id);
        $currentPicture = $cabinet->picture;
        $cabinetPhoto = public_path('images/cabinets/').$currentPicture;
        @unlink($cabinetPhoto);
        
        $cabinet->delete();
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
        $cabinet = Library::findOrFail($request->id);
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
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        if ($search = \Request::get('q')) {
            $cabinet = Library::with(['subcategory', 'subcategory.category'])->where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('type','LIKE',"%$search%")
                    ->orWhere('measure_type','LIKE',"%$search%");
                })->paginate();
        } else {
            $cabinet = Library::with(['subcategory', 'subcategory.category'])->latest()->paginate();
        }
        return $cabinet;
    }
}
