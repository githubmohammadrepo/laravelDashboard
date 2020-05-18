<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('profile',compact('roles'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

       $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'roles' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $user=Auth::user();

        //remove old image
        if(\File::exists(public_path('uploaded/'.$user->image))){

            //od image removed
            \File::delete(public_path('uploaded/'.$user->image));

          }else{

            // File does not exists.

          }
          //uplaod new image
        $imageName=null;
        if($request->file('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploaded'), $imageName);
        }


        //update information current authenticated user in database
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->image = $imageName;
        $user->save();
        $user->roles()->sync($request->roles);

        return back()
            ->with('success','You have successfully upload image.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public static function checkIsHasRole($role){
        if(in_array($role, Auth::user()->roles()->pluck('name')->toArray())){
            return true;
        }else{
            return false;
        }
    }
}
