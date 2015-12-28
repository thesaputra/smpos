<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Models\Office;
use App\Models\OfficeDivision;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Yajra\Datatables\Datatables;

use Carbon\Carbon;

class UserController extends Controller
{
  public function index()
  {
    return view('users.index');
  }

  public function user_data()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $users = User::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'employee_name',
      'nip',
      'address'
    ]);
    return Datatables::of($users)
    ->addColumn('action', function ($user) {
      return '<a href="./user/edit/'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
              <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./user/destroy/'.$user->id . '">Delete</button>
             ';
    })
    ->make(true);
  }

  public function create()
  {
    $roles = Role::lists('name', 'id');

    $offices = Office::select(
    \DB::raw("CONCAT(offices.code,'-',offices.name) AS full_name, id")
    )->lists('full_name', 'id');

    $division = OfficeDivision::select(
    \DB::raw("CONCAT(code,'-',name) AS full_name, id")
    )->lists('full_name', 'id');

    return view('users.create',compact('roles','offices','division'));
  }

  public function store(Request $request)
  {
    $this->store_validation_rules($request);

    $password = bcrypt($request->input('password'));
    $request->merge(array('password'=>$password));

    $user=$request->input();
    User::create($user);

    Session::flash('flash_message', 'Data berhasil ditambahkan!');

    return redirect('master/users');
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
    $user=User::find($id);

    $roles = Role::lists('name', 'id');

    $offices = Office::select(
    \DB::raw("CONCAT(offices.code,'-',offices.name) AS full_name, id")
    )->lists('full_name', 'id');

    $division = OfficeDivision::select(
    \DB::raw("CONCAT(code,'-',name) AS full_name, id")
    )->lists('full_name', 'id');

    return view('users.edit',compact('user','offices','division','roles'));
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
    $password = bcrypt($request->input('password'));
    $request->merge(array('password'=>$password));


    $userUpdate=$request->input();

    $user=User::find($id);
    $user->update($userUpdate);

    Session::flash('flash_message', 'Data berhasil diupdate!');

    return redirect('master/users');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $data = User::findOrFail($id);
    $data->delete();

    Session::flash('flash_message', 'Data berhasil dihapus');
    return redirect()->back();
  }

  private function store_validation_rules($request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|unique:users',
      'password' => 'required'
    ]);
  }
}
