<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Session;
use App\User;
use App\Models\AssetType;
use App\Models\AssetCategory;

use App\Models\TransUnit;
use App\Models\TransStatusLand;
use App\Models\TransStatusCert;
use App\Models\TransStatusBuilding;
use App\Models\TransInvestor;
use App\Models\TransGol;
use App\Models\TransForVehicle;
use App\Models\TransForLand;
use App\Models\TransForBuilding;
use App\Models\TransCondition;

use App\Models\TransactionItem;
use App\Models\TransactionVehicle;
use App\Models\TransactionPropland;
use App\Models\TransactionPropbuilding;


use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class TransactionAssetController extends Controller
{
  public function manage_assets()
  {
    return view('transaction_assets.index');
  }

  public function ma_asset_vehicles()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $datas = TransactionVehicle::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'index',
      'name'
    ]);
    return Datatables::of($datas)
    ->addColumn('action', function ($data) {
      return '
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
      <a href="#" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i> View</a>
      ';
    })
    ->make(true);
  }

  public function ma_asset_proplands()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $datas = TransactionPropland::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'index',
      'name'
    ]);
    return Datatables::of($datas)
    ->addColumn('action', function ($data) {
      return '
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
      <a href="#" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i> View</a>
      ';
    })
    ->make(true);
  }

  public function ma_asset_propbuildings()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $datas = TransactionPropbuilding::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'index',
      'name'
    ]);
    return Datatables::of($datas)
    ->addColumn('action', function ($data) {
      return '
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
      <a href="#" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i> View</a>
      ';
    })
    ->make(true);
  }

  public function ma_asset_items()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $datas = TransactionItem::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'index',
      'name'
    ]);
    return Datatables::of($datas)
    ->addColumn('action', function ($data) {
      return '
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
      <a href="#" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i> View</a>
      ';
    })
    ->make(true);
  }


  public function index()
  {
    return view('transaction_assets.new');
  }

  public function process(Request $request)
  {
    $cat_asset = $request->input('code_cat_asset');

    $valid_asset = AssetCategory::where('asset_categories.code', $cat_asset)
    ->join('asset_types','asset_types.id','=','asset_categories.asset_type_id')
    ->select('asset_categories.id as ac_id','asset_types.code as at_code','asset_categories.code as ac_code')
    ->first();

    if ($valid_asset) {
      if ($valid_asset->at_code == 100 || ($valid_asset->at_code >= 400))
      {
        return redirect()->route('transaction.create_item',$valid_asset->ac_id);
      }
      if ($valid_asset->at_code == 200)
      {
        return redirect()->route('transaction.create_vehicle',$valid_asset->ac_id);
      }
      if ($valid_asset->at_code == 300)
      {
        if ($valid_asset->ac_code == 301)
        {
          return redirect()->route('transaction.create_propland',$valid_asset->ac_id);
        }
        elseif ($valid_asset->ac_code == 302) {
          $tipe = 'Gedung';
          $code = $valid_asset->ac_code;
          return redirect()->route('transaction.create_propbuilding',compact('code','tipe'));
        } else {
          $tipe = 'Rumah Dinas';
            $code = $valid_asset->ac_code;
          return redirect()->route('transaction.create_propbuilding',compact('code','tipe'));
        }
      }
    }
    else
    {
      Session::flash('flash_message', 'Kategori asset: '.$cat_asset.' tidak ditemukan. Periksa referensi asset');
      return redirect()->back();
    }


  }

  public function create_item($ac_id)
  {
    $conditions = TransCondition::lists('name', 'id');
    $golongan = TransGol::lists('name', 'id');
    $investors = TransInvestor::lists('name', 'id');
    $units = TransUnit::lists('name', 'id');

    return view('transaction_assets.create_item',compact('ac_id','conditions','golongan','investors','units'));
  }

  public function create_vehicle($ac_id)
  {
    $vehicles = TransForVehicle::lists('name', 'id');
    $golongan = TransGol::lists('name', 'id');
    $investors = TransInvestor::lists('name', 'id');
    $units = TransUnit::lists('name', 'id');

    return view('transaction_assets.create_vehicle',compact('ac_id','vehicles','golongan','investors','units'));
  }

  public function create_propland($ac_id)
  {
    $golongan = TransGol::lists('name', 'id');
    $investors = TransInvestor::lists('name', 'id');
    $status_sertifikat = TransStatusCert::lists('name', 'id');
    $forlands = TransForLand::lists('name', 'id');
    $statuslands = TransStatusLand::lists('name', 'id');

    return view('transaction_assets.create_propland',compact('ac_id','golongan','investors','status_sertifikat','forlands','statuslands'));
  }

  public function create_propbuilding($ac_id,$tipe)
  {
    $golongan = TransGol::lists('name', 'id');
    $investors = TransInvestor::lists('name', 'id');
    $status_sertifikat = TransStatusCert::lists('name', 'id');
    $forbuildings = TransForBuilding::lists('name', 'id');
    $statusbuildings = TransStatusBuilding::lists('name', 'id');
    $index_tanah = TransactionPropland::lists('index','index');
    return view('transaction_assets.create_propbuilding',compact('tipe','ac_id','golongan','investors','forbuildings','statusbuildings','index_tanah'));
  }

  public function store_item(Request $request)
  {
    $date_amount = $this->saved_date_format($request->input('date_amount'));
    $param_ac_id = $request->input('asset_categories_id');

    $valid_asset = AssetCategory::where('asset_categories.id', $param_ac_id)
    ->join('asset_types','asset_types.id','=','asset_categories.asset_type_id')
    ->select('asset_categories.id as ac_id','asset_types.code as at_code','asset_categories.code as ac_code')
    ->first();

    $kode_kategori = $valid_asset->ac_code;
    $kode_pengelompokan =  $request->input('trans_gol_id');
    $tahun = Carbon::now()->toDateTimeString();
    $format = Carbon::parse($tahun)->format('y');
    $no_urut = TransactionItem::where('asset_categories_id', $param_ac_id)->get()->count();

    $before_urut = '000';
    if ($no_urut > 9) {
      $before_urut = '000';
    } elseif ($no_urut > 99) {
      $before_urut = '00';
    } elseif ($no_urut > 999) {
      $before_urut = '0';
    }

    $new_index = $kode_kategori.$kode_pengelompokan.$format.$before_urut.$no_urut+1;
    $request->merge(array('date_amount'=>$date_amount, 'index' => $new_index));

    $transaction_item=$request->input();
    $save_trans = TransactionItem::create($transaction_item);

    Session::flash('flash_message', 'Data asset berhasil ditambahkan');

    return redirect()->back();
  }

  public function store_vehicle(Request $request)
  {
    $date_amount = $this->saved_date_format($request->input('date_amount'));
    $date_kir = $this->saved_date_format($request->input('date_kir'));
    $date_tax = $this->saved_date_format($request->input('date_tax'));

    $param_ac_id = $request->input('asset_categories_id');

    $valid_asset = AssetCategory::where('asset_categories.id', $param_ac_id)
    ->join('asset_types','asset_types.id','=','asset_categories.asset_type_id')
    ->select('asset_categories.id as ac_id','asset_types.code as at_code','asset_categories.code as ac_code')
    ->first();

    $kode_kategori = $valid_asset->ac_code;
    $kode_pengelompokan =  $request->input('trans_gol_id');
    $tahun = Carbon::now()->toDateTimeString();
    $format = Carbon::parse($tahun)->format('y');
    $no_urut = TransactionVehicle::where('asset_categories_id', $param_ac_id)->get()->count();

    $before_urut = '000';
    if ($no_urut > 9) {
      $before_urut = '000';
    } elseif ($no_urut > 99) {
      $before_urut = '00';
    } elseif ($no_urut > 999) {
      $before_urut = '0';
    }

    $new_index = $kode_kategori.$kode_pengelompokan.$format.$before_urut.$no_urut+1;

    $request->merge(array('date_amount'=>$date_amount,'date_kir'=>$date_kir,'date_tax'=>$date_tax, 'index' => $new_index));

    $transaction_vehicle=$request->input();
    $save_trans = TransactionVehicle::create($transaction_vehicle);

    Session::flash('flash_message', 'Data asset berhasil ditambahkan');

    return redirect()->back();
  }

  public function store_propland(Request $request)
  {
    $date_amount = $this->saved_date_format($request->input('date_amount'));
    $date_cert = $this->saved_date_format($request->input('date_cert'));
    $date_expired_cert = $this->saved_date_format($request->input('date_expired_cert'));

    $param_ac_id = $request->input('asset_categories_id');

    $valid_asset = AssetCategory::where('asset_categories.id', $param_ac_id)
    ->join('asset_types','asset_types.id','=','asset_categories.asset_type_id')
    ->select('asset_categories.id as ac_id','asset_types.code as at_code','asset_categories.code as ac_code')
    ->first();

    $kode_kategori = $valid_asset->ac_code;
    $kode_pengelompokan =  $request->input('trans_gol_id');
    $tahun = Carbon::now()->toDateTimeString();
    $format = Carbon::parse($tahun)->format('y');
    $no_urut = TransactionPropland::where('asset_categories_id', $param_ac_id)->get()->count();

    $before_urut = '000';
    if ($no_urut > 9) {
      $before_urut = '000';
    } elseif ($no_urut > 99) {
      $before_urut = '00';
    } elseif ($no_urut > 999) {
      $before_urut = '0';
    }

    $new_index = $kode_kategori.$kode_pengelompokan.$format.$before_urut.$no_urut+1;
    $request->merge(array('date_amount'=>$date_amount,'date_cert'=>$date_cert,'date_expired_cert'=>$date_expired_cert, 'index' => $new_index));

    $transaction_propland=$request->input();
    $save_trans = TransactionPropland::create($transaction_propland);

    Session::flash('flash_message', 'Data asset berhasil ditambahkan');

    return redirect()->back();
  }

  public function store_propbuilding(Request $request)
  {
    $date_amount = $this->saved_date_format($request->input('date_amount'));

    $param_ac_id = $request->input('asset_categories_id');

    $valid_asset = AssetCategory::where('asset_categories.id', $param_ac_id)
    ->join('asset_types','asset_types.id','=','asset_categories.asset_type_id')
    ->select('asset_categories.id as ac_id','asset_types.code as at_code','asset_categories.code as ac_code')
    ->first();

    $kode_kategori = $valid_asset->ac_code;
    $kode_pengelompokan =  $request->input('trans_gol_id');
    $tahun = Carbon::now()->toDateTimeString();
    $format = Carbon::parse($tahun)->format('y');
    $no_urut = TransactionPropbuilding::where('asset_categories_id', $param_ac_id)->get()->count();

    $before_urut = '000';
    if ($no_urut > 9) {
      $before_urut = '000';
    } elseif ($no_urut > 99) {
      $before_urut = '00';
    } elseif ($no_urut > 999) {
      $before_urut = '0';
    }

    $new_index = $kode_kategori.$kode_pengelompokan.$format.$before_urut.$no_urut+1;
    $request->merge(array('date_amount'=>$date_amount, 'index' => $new_index));

    $transaction_building=$request->input();
    $save_trans = TransactionPropbuilding::create($transaction_building);

    Session::flash('flash_message', 'Data asset berhasil ditambahkan');

    return redirect()->back();
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
    //
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
