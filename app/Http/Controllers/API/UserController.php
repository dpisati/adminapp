<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
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
            return User::latest()->paginate(10);
        }
        if(\Gate::allows('isManeger')) {
            $user = auth('api')->user();
            return User::where('franchise', $user->franchise)->latest()->paginate(10);
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
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
            'type' => 'required',
            'franchise' => 'required'
        ]);

        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'franchise' => $request['franchise'],
            'password' => Hash::make($request['password']),
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
 
    public function profile()
    {
        return auth('api')->user();  
    }
 
    public function updateProfile(Request $request)
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
            $users = User::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('email','LIKE',"%$search%")
                    ->orWhere('type','LIKE',"%$search%")
                    ->orWhere('franchise','LIKE',"%$search%");
            })->paginate(20);
        } else {
            $users = User::latest()->paginate(10);
        }
        return $users;
    }
}
