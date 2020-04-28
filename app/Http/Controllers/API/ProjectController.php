<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Project;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
        // $this->authorize('isAdmin');
        if(\Gate::allows('isAdmin')) {
            return Project::latest()->paginate();
        }
        if(\Gate::allows('isManeger')) {
            $user = auth('api')->user();
            return Project::where('franchise', $user->franchise)->latest()->paginate();
        }
        if(\Gate::allows('isUser')) {
            $user = auth('api')->user();
            return Project::where('user_id', $user->id)->latest();
        }
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
            'client' => 'required|string|max:191',
            'status' => 'required'
        ]);

        return Project::create([
            'franchise' => $user->franchise,
            'name' => $request['name'],
            'client' => $request['client'],
            'code' => $user->id . $request['client'] . $request['name'],
            'status' => $request['status'],
            'quote' => 0,
            'user_id' => $user->id
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
        return Project::find($id);
        // return response()->json($project);
    }
 
    public function user()
    {
        return auth('api')->user();  
    }
 
    public function updateProject(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'client' => 'required|string|max:191',
            'status' => 'required'
        ]);

        $project->update($request->all());
        return ['message', 'Project updated successfully'];
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
        $project = Project::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'client' => 'required|string|max:191',
            'status' => 'required'
        ]);

        $project->update($request->all());
        return ['message' => 'Project updated', $project];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->authorize('isAdmin');
        $project = Project::findOrFail($id);
        $project->delete();

        return ['message' => 'User Deleted'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $user = auth('api')->user();
        if ($search = \Request::get('q')) {
            $projects = Project::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('client','LIKE',"%$search%")
                    ->orWhere('status','LIKE',"%$search%")
                    ->orWhere('user_id','LIKE',"%$search%")
                    ->orWhere('franchise','LIKE',"%$search%")
                    ->orWhere('code','LIKE',"%$search%");
            // })->where('user_id', '=', $user->id)->paginate();
            })->paginate();
        } else {
            $projects = Project::latest()->paginate();
        }
        return $projects;
    }
}
