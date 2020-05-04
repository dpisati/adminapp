<?php

namespace App\Http\Controllers\API;

use App\Finish;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FinishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Finish::all();
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
        return Finish::create([
            'supplier_id' => $request['supplier_id'],
            'name' => $request['name']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Finish  $finish
     * @return \Illuminate\Http\Response
     */
    public function show(Finish $finish)
    {
        return Finish::findOrFail($finish->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Finish  $finish
     * @return \Illuminate\Http\Response
     */
    public function edit(Finish $finish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Finish  $finish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finish $finish)
    {
        $finish = Finish::findOrFail($finish->id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'supplier_id' => 'required'
        ]);
        $finish->update($request->all());
        return ['message' => 'Finish updated', $finish];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Finish  $finish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finish $finish)
    {
        $finish = Finish::findOrFail($finish->id);
        $finish->delete();

        return ['message' => 'Finish Deleted'];
    }
}
