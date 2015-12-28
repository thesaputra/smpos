<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Response;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Models\Office;
use App\Models\Region;
use App\Models\RegionKPRK;


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

  public function getOfficeOrRegion(Request $request)
  {

    if ($request->input('id') == 'reg') {

      $office_region = Region::select(
      \DB::raw("CONCAT(code,'-',name) AS full_name, id")
      )->lists('full_name', 'id');

    } else {

      $office_region = Office::select(
      \DB::raw("CONCAT(code,'-',name) AS full_name, id")
      )->lists('full_name', 'id');

    }

  return Response::json($office_region);
  }

  public function getDivisiOrKprk(Request $request)
  {
    if ($request->input('type') == 'reg') {

      $office_region = RegionKPRK::select(
      \DB::raw("CONCAT(code,'-',name) AS full_name, id")
      )
      ->where('region_id','=',$request->input('id'))
      ->lists('full_name', 'id');

    } else {

      $office_region = OfficeDivision::select(
      \DB::raw("CONCAT(code,'-',name) AS full_name, id")
      )
      ->where('office_id','=',$request->input('id'))
      ->lists('full_name', 'id');
    }

  return Response::json($office_region);
  }


  public function create()
  {
    $roles = Role::lists('name', 'id');

    $office_region = Office::select(
    \DB::raw("CONCAT(offices.code,'-',offices.name) AS full_name, id")
    )->lists('full_name', 'id');

    $division_kprk = OfficeDivision::select(
    \DB::raw("CONCAT(code,'-',name) AS full_name, id")
    )->lists('full_name', 'id');

    return view('users.create',compact('roles','office_region','division_kprk'));
  }

  public function store(Request $request)
  {
    $this->validation_rules($request);

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

    $office_region = Office::select(
    \DB::raw("CONCAT(offices.code,'-',offices.name) AS full_name, id")
    )->lists('full_name', 'id');

    $division_kprk = OfficeDivision::select(
    \DB::raw("CONCAT(code,'-',name) AS full_name, id")
    )->lists('full_name', 'id');

    return view('users.edit',compact('user','roles','office_region','division_kprk'));
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
    $this->validation_rules($request);

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

  private function validation_rules($request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|unique:users',
      'password' => 'required'
    ]);
  }
}
