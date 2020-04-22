<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Project;
use App\Room;
use App\Cabinet;
use App\Library;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RoomController extends Controller
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
    public function index($id)
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
        $user = auth('api')->user();        
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'project_id' => 'required'
        ]);
        return Room::create([
            'name' => $request['name'],
            'project_id' => $request['project_id']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {       
        return Room::where('project_id', $id)->with('cabinets')->get();
    }
 
    public function user()
    {
        return auth('api')->user();  
    }
 
    public function updateRoom(Request $request)
    {
        $user = auth('api')->user();
        $room = Room::findOrFail($id);
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|string|max:191'
        ]);
        $room->update($request->all());
        return ['message', 'Room updated successfully'];
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
        $room = Room::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191'
        ]);
        $room->update($request->all());
        return ['message' => 'Room updated', $room];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return ['message' => 'Room Deleted'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addCabinet(Request $request)
    {     
        $room = Room::findOrFail($request['room_id']);
        $cabinet = Cabinet::create([
            'cabinet_id' => $request['id'],
            'room_id' => $request['room_id'],
            'quantity' => $request['quantity'],
            'name' => $request['name'],
            'width' => $request['width'],
            'height' => $request['height'],
            'depth' => $request['depth'],
            'comment' => $request['comment'],
            'type' => $request['type']
        ]);
        $room->cabinets()->attach($cabinet);


        return ['message' => 'Room Controller'];
    }
        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCabinets($id)
    {
        return Room::with('cabinets')->get();
    }
}
