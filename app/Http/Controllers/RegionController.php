<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Session;
use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\RegionKPRK;
use App\Models\RegionKPC;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class RegionController extends Controller
{

  public function index()
  {
    return view('regions.index');
  }

  public function region_data()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $regions = Region::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'code',
      'name',
      'abbreviation',
      'date_open'
    ]);
    return Datatables::of($regions)
    ->addColumn('action', function ($region) {
      return '
              <a href="./region/detail_kprk/'.$region->id.'" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-plus"></i> KPRK</a>
              <a href="./region/edit/'.$region->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
              ';
    })
    ->editColumn('date_open', function ($region) {
                  return $region->date_open ? with(new Carbon($region->date_open))->format('d/m/Y') : '';
            })
    ->make(true);
  }

  public function get_kprk_data()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $kprks = RegionKPRK::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'region_id',
      'code',
      'name',
      'abbreviation',
      'date_open'
    ]);
    return Datatables::of($kprks)
    ->addColumn('action', function ($kprk) {
      return '
              <a href="./detail_kpc/'.$kprk->id.'" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-plus"></i> KPC</a>
              <a href="./edit/'.$kprk->region_id.'/'.$kprk->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
              <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy_kprk/' . $kprk->id . '">Delete</button>
              ';
    })
    ->editColumn('date_open', function ($kprk) {
                  return $kprk->date_open ? with(new Carbon($kprk->date_open))->format('d/m/Y') : '';
            })
    ->make(true);
  }

  public function get_kpc_data()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $kpcs = RegionKPC::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'region_kprk_id',
      'code',
      'name',
      'abbreviation',
      'date_open'
    ]);
    return Datatables::of($kpcs)
    ->addColumn('action', function ($kpc) {
      return '
              <a href="./edit/'.$kpc->region_kprk_id.'/'.$kpc->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
              <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy_kpc/' . $kpc->id . '">Delete</button>
              ';
    })
    ->editColumn('date_open', function ($kpc) {
                  return $kpc->date_open ? with(new Carbon($kpc->date_open))->format('d/m/Y') : '';
            })
    ->make(true);
  }

  public function detail_kprk($id)
  {
    $region = Region::where('regions.id', '=', $id)
    ->select('regions.id','regions.name','regions.code','regions.abbreviation','regions.date_open')
    ->firstOrFail();


    $kprks = RegionKPRK::where('region_kprks.region_id','=', $id)
    ->select('region_kprks.id','region_kprks.name','region_kprks.code','region_kprks.abbreviation','region_kprks.date_open')
    ->get();


    $data_kprk = array(
      'region'  => $region,
      'kprk' => $kprks
    );

    return view('regions.detail_kprk',compact('data_kprk'));

  }

  public function detail_kpc($id)
  {
    $regionKPRK = RegionKPRK::where('region_kprks.id', '=', $id)
    ->select('region_kprks.id','region_kprks.name','region_kprks.code','region_kprks.abbreviation','region_kprks.date_open')
    ->firstOrFail();


    $kpcs = RegionKPC::where('region_kpcs.region_kprk_id','=', $id)
    ->select('region_kpcs.id','region_kpcs.name','region_kpcs.code','region_kpcs.abbreviation','region_kpcs.date_open')
    ->get();


    $data_kpc = array(
      'regionKPRK'  => $regionKPRK,
      'kpc' => $kpcs
    );

    return view('regions.detail_kpc',compact('data_kpc'));

  }

  public function kprk_data($id)
  {
    return view('regions.detail_kprk');
  }

  public function kpc_data($id)
  {
    return view('regions.detail_kpc');
  }

  public function create()
  {
    return view('regions.create');
  }

  public function store(Request $request)
  {
    $this->store_validation_rules($request);

    $date_open = $this->saved_date_format($request->input('date_open'));
    $request->merge(array('date_open'=>$date_open));

    $region=$request->input();
    Region::create($region);

    Session::flash('flash_message', 'Data berhasil ditambahkan!');

    return redirect('master/regions');
  }

  public function store_kprk(Request $request)
  {
    $this->store_validation_rules($request);

    $date_open = $this->saved_date_format($request->input('date_open'));
    $request->merge(array('date_open'=>$date_open));

    $kprk=$request->input();
    $save_kprk = RegionKPRK::create($kprk);

    $imageName = $save_kprk->id . '-kprk.' .
    $request->file('url_photo')->getClientOriginalExtension();

     $request->file('url_photo')->move(
         base_path() . '/public/images/kprks/', $imageName
     );

    // return Redirect::to(URL::previous() . "#kprks-table");
    Session::flash("flash_message", "Data tersimpan!");

    return redirect()->back();
  }

  public function store_kpc(Request $request)
  {
    $this->store_validation_rules($request);

    $date_open = $this->saved_date_format($request->input('date_open'));
    $request->merge(array('date_open'=>$date_open));

    $kpc=$request->input();
    $save_kpc = RegionKPC::create($kpc);

    $imageName = $save_kpc->id . '-kpc.' .
    $request->file('url_photo')->getClientOriginalExtension();

     $request->file('url_photo')->move(
         base_path() . '/public/images/kpcs/', $imageName
     );

    Session::flash("flash_message", "Data tersimpan!");

    return redirect()->back();
  }

  public function edit($id)
  {
    $region=Region::find($id);
    return view('regions.edit',compact('region'));
  }

  public function edit_kprk($id, $id_kprk)
  {
    $region = Region::where('regions.id', $id)->first();
    $regionKPRK = RegionKPRK::find($id_kprk);

    return view('regions.edit_kprk',compact('regionKPRK','region'));
  }

  public function update_kprk(Request $request, $id)
  {
    $id_kprk = $request->input('region_id');
    $this->update_validation_rules($request);

    $date_open = $this->saved_date_format($request->input('date_open'));
    $request->merge(array('date_open'=>$date_open));

    $regKPRKUpdate=$request->input();

    $regionKPRK=RegionKPRK::find($id);
    $regionKPRK->update($regKPRKUpdate);

    $imageName = $regionKPRK->id . '-kprk.' .
    $request->file('url_photo')->getClientOriginalExtension();

     $request->file('url_photo')->move(
         base_path() . '/public/images/kprks/', $imageName
     );

    Session::flash('flash_message', 'Data berhasil diupdate!');

    return redirect('master/region/detail_kprk/'.$id_kprk);
  }

  public function destroy_kprk($id)
  {
      $data = RegionKPRK::findOrFail($id);
      $data->delete();

      Session::flash('flash_message', 'Data berhasil dihapus');
      return redirect()->back();
  }

  //end_ kprk

  public function edit_kpc($id, $id_kpc)
  {
    $regionKPRK = RegionKPRK::where('region_kprks.id', $id)->first();
    $regionKPC = RegionKPC::find($id_kpc);

    return view('regions.edit_kpc',compact('regionKPRK','regionKPC'));
  }

  public function update_kpc(Request $request, $id)
  {
    $id_kpc = $request->input('region_kprk_id');
    $this->update_validation_rules($request);

    $date_open = $this->saved_date_format($request->input('date_open'));
    $request->merge(array('date_open'=>$date_open));

    $regKPCUpdate=$request->input();

    $regionKPC=RegionKPC::find($id);
    $regionKPC->update($regKPCUpdate);

    $imageName = $regionKPC->id . '-kprc.' .
    $request->file('url_photo')->getClientOriginalExtension();

     $request->file('url_photo')->move(
         base_path() . '/public/images/kpcs/', $imageName
     );

    Session::flash('flash_message', 'Data berhasil diupdate!');

    return redirect('master/region/detail_kprk/detail_kpc/'.$id_kpc);
  }

  public function destroy_kpc($id)
  {
      $data = RegionKPC::findOrFail($id);
      $data->delete();

      Session::flash('flash_message', 'Data berhasil dihapus');
      return redirect()->back();
  }
  //end kpc

  public function update(Request $request, $id)
  {
    $this->update_validation_rules($request);

    $date_open = $this->saved_date_format($request->input('date_open'));
    $request->merge(array('date_open'=>$date_open));

    $regUpdate=$request->input();

    $region=Region::find($id);
    $region->update($regUpdate);

    Session::flash('flash_message', 'Data berhasil diupdate!');

    return redirect('master/regions');
  }


  public function destroy($id)
  {
    //
  }

  private function saved_date_format($date)
  {
    $date_split = explode('/',$date);

    $year = $date_split[2];
    $month = $date_split[1];
    $day = $date_split[0];

    $format = $year.'-'.$month.'-'.$day;

    return $format;
  }

  private function store_validation_rules($request)
  {
    $this->validate($request, [
      'name' => 'required',
      'code' => 'required|unique:regions',
      'abbreviation' => 'required',
      'date_open' => 'required'
    ]);
  }

  private function update_validation_rules($request)
  {
    $this->validate($request, [
      'name' => 'required',
      'abbreviation' => 'required',
      'date_open' => 'required'
    ]);
  }
}
