<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Session;
use App\Http\Controllers\Controller;
use App\Models\AssetType;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class AssetTypeController extends Controller
{
  public function index()
  {
    return view('asset_types.index');
  }

  public function asset_type_data()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $asset_types = AssetType::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'code',
      'name'
    ]);
    return Datatables::of($asset_types)
    ->addColumn('action', function ($asset_type) {
      return '
              <a href="./asset_type/edit/'.$asset_type->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
              ';
    })
    ->make(true);
  }

    public function create()
    {
        return view('asset_types.create');
    }

    public function store(Request $request)
    {
      $this->store_validation_rules($request);

      $asset_type=$request->input();
      AssetType::create($asset_type);

      Session::flash('flash_message', 'Data berhasil ditambahkan!');

      return redirect('master/asset_type');
    }


    public function edit($id)
    {
      $asset_type=AssetType::find($id);
      return view('asset_types.edit',compact('asset_type'));
    }


    public function update(Request $request, $id)
    {
      $this->update_validation_rules($request);

      $asset_typeUpdate=$request->input();

      $asset_type=AssetType::find($id);
      $asset_type->update($asset_typeUpdate);

      Session::flash('flash_message', 'Data berhasil diupdate!');

      return redirect('master/asset_type');
    }


    public function destroy($id)
    {
        //
    }

    private function store_validation_rules($request)
    {
      $this->validate($request, [
        'name' => 'required',
        'code' => 'required|unique:asset_types'
      ]);
    }

    private function update_validation_rules($request)
    {
      $this->validate($request, [
        'name' => 'required',
        'code' => 'required'
      ]);
    }
}
