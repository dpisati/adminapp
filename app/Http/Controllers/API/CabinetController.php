<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Cabinet;
use App\Project;
use App\Library;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->authorize('isAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cabinet::all();
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
        $library = Library::findOrFail($request['cabinet_id']);
        $this->validate($request, [
            'id' => 'required',
            'quantity' => 'required|integer|gte:0',
            'width' => 'required|integer|gte:' . $library->min_width .'|lte:' . $library->max_width ,
            'height' => 'required|integer|gte:' . $library->min_height .'|lte:' . $library->max_height ,
            'depth' => 'required|integer|gte:' . $library->min_depth .'|lte:' . $library->max_depth ,
        ]);
        return Cabinet::create([
            'cabinet_id' => $request['id'],
            'quantity' => $request['quantity'],
            'width' => $request['width'],
            'height' => $request['height'],
            'depth' => $request['depth']
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Cabinet  $cabinet
     * @return \Illuminate\Http\Response
     */
    public function show(Cabinet $cabinet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cabinet  $cabinet
     * @return \Illuminate\Http\Response
     */
    public function edit(Cabinet $cabinet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cabinet = Cabinet::findOrFail($id);
        $library = Library::findOrFail($request['cabinet_id']);
        $this->validate($request, [
            'id' => 'required',
            'quantity' => 'required|integer|gte:0',
            'width' => 'required|integer|gte:' . $library->min_width .'|lte:' . $library->max_width ,
            'height' => 'required|integer|gte:' . $library->min_height .'|lte:' . $library->max_height ,
            'depth' => 'required|integer|gte:' . $library->min_depth .'|lte:' . $library->max_depth ,
        ]);
        $cabinet->update($request->all());
        return ['message' => 'Cabinet updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cabinet  $cabinet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cabinet = Cabinet::findOrFail($id);
        $cabinet->delete();

        return ['message' => 'cabinet Deleted'];
    }
}
