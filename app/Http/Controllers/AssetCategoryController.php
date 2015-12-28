<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Session;
use App\Http\Controllers\Controller;
use App\Models\AssetType;
use App\Models\AssetCategory;


use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class AssetCategoryController extends Controller
{
  public function index()
  {
    return view('asset_categories.index');
  }

  public function asset_category_data()
  {
    \DB::statement(\DB::raw('set @rownum=0'));

    $asset_categories = \DB::table('asset_categories')
    ->join('asset_types', 'asset_types.id', '=', 'asset_categories.asset_type_id')
    ->select([\DB::raw('@rownum  := @rownum  + 1 AS rownum'),
              'asset_categories.id as ac_id',
              'asset_categories.name as ac_name',
              'asset_categories.code as ac_code',
              \DB::raw("CONCAT(asset_types.code,'-',asset_types.name) as at_b")
            ]);

    return Datatables::of($asset_categories)
    ->addColumn('action', function ($asset_category) {
    return '<a href="./asset_category/edit/'.$asset_category->ac_id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
    ';
  })
  ->make(true);
}

public function create()
{
  $asset_types = AssetType::select(
  \DB::raw("CONCAT(asset_types.code,'-',asset_types.name) AS full_name, id")
  )->lists('full_name', 'id');

  return view('asset_categories.create',compact('asset_types'));
}

public function store(Request $request)
{
  $this->store_validation_rules($request);

  $asset_category=$request->input();
  AssetCategory::create($asset_category);

  Session::flash('flash_message', 'Data berhasil ditambahkan!');

  return redirect('master/asset_category');
}


public function edit($id)
{
  $asset_types = AssetType::select(
  \DB::raw("CONCAT(asset_types.code,'-',asset_types.name) AS full_name, id")
  )->lists('full_name', 'id');

  $asset_category=AssetCategory::find($id);
  return view('asset_categories.edit',compact('asset_category','asset_types'));
}


public function update(Request $request, $id)
{
  $this->update_validation_rules($request);

  $asset_categoryUpdate=$request->input();

  $asset_category=AssetCategory::find($id);
  $asset_category->update($asset_categoryUpdate);

  Session::flash('flash_message', 'Data berhasil diupdate!');

  return redirect('master/asset_category');
}


public function destroy($id)
{
  //
}

private function store_validation_rules($request)
{
  $this->validate($request, [
    'name' => 'required',
    'code' => 'required|unique:asset_categories'
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
