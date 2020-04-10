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
            return Project::latest()->paginate(10);
        }
        if(\Gate::allows('isManeger')) {
            $user = auth('api')->user();
            return Project::where('franchise', $user->franchise)->latest()->paginate(10);
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
        //
    }
 
    public function user()
    {
        return auth('api')->user();  
    }
 
    public function updateProject(Request $request)
    {
        $user = auth('api')->user();
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|string|min:6'
        ]);
        if(!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $currentPhoto = $user->photo;
        if($request->photo != $currentPhoto) {
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('images/profile/').$name);
            $request->merge(['photo' => $name]);
            $user->photo = $request->photo;
            $userPhoto = public_path('images/profile/').$currentPhoto;
            if(file_exists($userPhoto)) {
                @unlink($userPhoto);
            }
        }
        $user->update($request->all());
        return ['message', 'User updated successfully' . $user->password];
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
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6',
            'type' => 'required',
            'franchise' => 'required'
        ]);
        if(!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }        
        $user->update($request->all());
        return ['message' => 'User updated', $user];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        $user->delete();

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
        if ($search = \Request::get('q')) {
            $projects = Project::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('client','LIKE',"%$search%")
                    ->orWhere('status','LIKE',"%$search%")
                    ->orWhere('code','LIKE',"%$search%");
            })->paginate(20);
        } else {
            $projects = Project::latest()->paginate(10);
        }
        return $projects;
    }
}
