<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Session;
use App\Http\Controllers\Controller;
use App\Models\Placing;
use App\Models\PlacingItem;

use App\Models\Office;
use App\Models\OfficeDivision;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Auth;

class PlacingController extends Controller
{
  public function index()
  {
    return view('placings.index');
  }

  public function placing_data()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $datas = Placing::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'no_penempatan',
      'date_penempatan',
      'status'
    ]);
    return Datatables::of($datas)
    ->addColumn('action', function ($data) {
      return '
      <a href="./edit/'.$data->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
      <a href="./placing_detail/'.$data->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Detail Barang Penempatan</a>
      ';
    })
    ->editColumn('date_penempatan', function ($data) {
                  return $data->date_penempatan ? with(new Carbon($data->date_penempatan))->format('d/m/Y') : '';
            })
    ->make(true);
  }


  public function index_sent()
  {
    return view('mutations.index_sent');
  }

  public function sent_mutation_data()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $datas = Mutation::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'no_mutasi',
      'date_mutation',
      'status'
    ]);
    return Datatables::of($datas)
    ->addColumn('action', function ($data) {
      return '
      <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./update_sent_mutation/' . $data->id . '">Konfirmasi</button>
      ';
    })
    ->editColumn('date_mutation', function ($data) {
                  return $data->date_mutation ? with(new Carbon($data->date_mutation))->format('d/m/Y') : '';
            })
    ->where('status','=','dikirim')
    ->make(true);
  }

  public function create()
  {
    $current_office_id = Auth::user()->office_region_id;
    $current_division_id = Auth::user()->division_kprk_id;

    $valid_office = Office::where('id', $current_office_id)->first()->name;
    $valid_division = OfficeDivision::where('id', $current_division_id)->first()->name;

    return view('placings.create',compact('valid_office','valid_division'));
  }

  public function store(Request $request)
  {
    $this->store_validation_rules($request);
    $date_penempatan = $this->saved_date_format($request->input('date_penempatan'));
    $request->merge(array('date_penempatan'=>$date_penempatan));

    $data=$request->input();
    Placing::create($data);

    Session::flash('flash_message', 'Data berhasil ditambahkan!');

    return redirect('placing/index');
  }


  public function edit($id)
  {
    $current_office_id = Auth::user()->office_id;
    $current_division_id = Auth::user()->division;

    $valid_office = Office::where('id', $current_office_id)->first()->name;
    $valid_division = OfficeDivision::where('id', $current_division_id)->first()->name;


    $placing=Placing::find($id);
    return view('placings.edit',compact('placing','valid_office','valid_division'));
  }


  public function update(Request $request, $id)
  {
    $this->update_validation_rules($request);

    $date_penempatan = $this->saved_date_format($request->input('date_penempatan'));
    $request->merge(array('date_penempatan'=>$date_penempatan));

    $data_update=$request->input();
    $data=Placing::find($id);
    $data->update($data_update);

    Session::flash('flash_message', 'Data berhasil diupdate!');

    return redirect('placing/index');
  }

  public function update_sent_mutation(Request $request, $id)
  {
    $request->merge(array('status'=>'diterima'));

    $data_update=$request->input();
    $data=Placing::find($id);
    $data->update($data_update);

    Session::flash('flash_message', 'Data berhasil diupdate!');

    return redirect('mutation/index');
  }


  public function destroy($id)
  {
    //
  }

  public function placing_detail($id)
  {
    $placing = Placing::where('placings.id', '=', $id)
    ->select('placings.id','placings.no_penempatan','placings.office_sender','placings.division_sender','placings.office_destination','placings.division_destination','placings.date_penempatan','placings.status')
    ->firstOrFail();

    return view('placings.placing_detail',compact('placing'));
  }

  public function placing_detail_data($id)
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $datas = PlacingItem::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'placing_items.id',
      'transaction_items.name as item_name',
      'placing_items.qty'
    ]);
    return Datatables::of($datas)
    ->addColumn('action', function ($data) {
      return '
      <a href="./edit_placing_detail/'.$data->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
      ';
    })
    ->join('transaction_items','placing_items.transaction_item_id','=','transaction_items.id')
    ->make(true);
  }

  public function store_detail_placing(Request $request)
  {

    $data=$request->input();
    PlacingItem::create($data);

    Session::flash('flash_message', 'Data berhasil ditambahkan!');

    return redirect()->back();
  }

  private function store_validation_rules($request)
  {
    $this->validate($request, [
      'no_penempatan' => 'required'
    ]);
  }

  private function update_validation_rules($request)
  {
    $this->validate($request, [
      'no_penempatan' => 'required'
    ]);
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
}
