<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\Dashboard\UpdateAdminRequest;
use App\Http\Requests\Dashboard\CreateAdminRequest;


class UserController extends Controller
{
    protected $mainRedirect = 'dashboard.users.';

    public function index()
    {
        //
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
        //
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
        $user = User::findOrFail($id);

        return view($this->mainRedirect . 'edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, $id)
    {
         $data=$request->all();
        if($data['password']){
            $data['password'] =  bcrypt($data['password']);
        }
        $data['confirmed'] = 1;
        $user=User::findOrFail($id);
        $user->update($data);

        return redirect('dashboard/admins');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function adminAll()
    {
        $users = User::whereHas('roles',function ($query)  {
            $query->where('name','admin');
        })->paginate(10);

        return view($this->mainRedirect . 'admins')->with('users', $users);

    }

     public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();
       return redirect('dashboard/admins');
    }

    public function deactivate(Request $request)
    {
        $user = User::where('id',$request->input('id'))->update([
            'activated'=>0,
        ]);

        return redirect('dashboard/admins');
    }
     public function activate(Request $request)
    {
        $user = User::where('id',$request->input('id'))->update([
            'activated'=>1,
        ]);

        return redirect('dashboard/admins');
    }
    public function makeAdmin(Request $request)
    {
        $id = $request->input('id');
        $user = User::findOrFail($id);
        $role = Role::where('name', 'admin')->first();
        $user->attachRole($role);

        return redirect()->back();
    }

    public function removeAdmin(Request $request)
    {
        $id = $request->input('id');
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back();

    }

     public function createAdmin()
    {
        return view('dashboard.users.createAdmin');
    }

     public function storeAdmin(CreateAdminRequest $request)
    {
        $data=$request->all();
        $data['password'] =  bcrypt($data['password']);
        $data['confirmed'] = 1;

        $user=User::create($data);

        $role = Role::where('name', 'admin')->first();
        $user->attachRole($role);

        return redirect('dashboard/admins');
    }
}
