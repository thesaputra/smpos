<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

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
use App\Models\TransStatusItem;


use Yajra\Datatables\Datatables;

class TransactionSetupController extends Controller
{
  public function index()
  {
    return view('transaction_setups.index');
  }


  public function create()
  {
    return view('transaction_setups.create');
  }

  public function store(Request $request)
  {
    $this->validation_rules($request);

    $tipe = $request->input('type_master');
    $name = '';
    $data=$request->input();
    if ($tipe == '0') {
      $name = 'Master Kondisi';
      TransCondition::create($data);
    } elseif ($tipe == '1') {
      $name = 'Master Satuan';
      TransUnit::create($data);
    } elseif ($tipe == '2') {
      $name = 'Master Status Tanah';
      TransStatusLand::create($data);
    } elseif ($tipe == '3') {
      $name = 'Master Status Sertifikat';
      TransStatusCert::create($data);
    } elseif ($tipe == '4') {
      $name = 'Master Status Bangunan';
      TransStatusBuilding::create($data);
    } elseif ($tipe == '5') {
      $name = 'Master Dana Perolehan';
      TransInvestor::create($data);
    } elseif ($tipe == '6') {
      $name = 'Master Golongan';
      TransGol::create($data);
    } elseif ($tipe == '7') {
      $name = 'Master Peruntukan Kendaraan';
      TransForVehicle::create($data);
    } elseif ($tipe == '8') {
      $name = 'Master Peruntukan Tanah';
      TransForLand::create($data);
    } elseif ($tipe == '9') {
      $name = 'Master Peruntukan Bangunan';
      TransForBuilding::create($data);
    } elseif ($tipe == '10') {
      $name = 'Master Status Barang';
      TransStatusItem::create($data);
    }

    Session::flash('flash_message', 'Data '.$name.' berhasil ditambahkan!');

    return redirect('transaction/master/setup');
  }

  public function destroy($id,$tipe)
  {
    if ($tipe == 'condition') {
      $data = TransCondition::findOrFail($id);
      $data->delete();
    } elseif ($tipe == 'for_land') {
      $data = TransForLand::findOrFail($id);
      $data->delete();
    }elseif ($tipe == 'for_vehicle') {
      $data = TransForVehicle::findOrFail($id);
      $data->delete();
    }elseif ($tipe == 'for_building') {
      $data = TransForBuilding::findOrFail($id);
      $data->delete();
    }elseif ($tipe == 'status_cert') {
      $data = TransStatusCert::findOrFail($id);
      $data->delete();
    }elseif ($tipe == 'status_land') {
      $data = TransStatusLand::findOrFail($id);
      $data->delete();
    }elseif ($tipe == 'investor') {
      $data = TransInvestor::findOrFail($id);
      $data->delete();
    }elseif ($tipe == 'gol') {
      $data = TransGol::findOrFail($id);
      $data->delete();
    }elseif ($tipe == 'unit') {
      $data = TransUnit::findOrFail($id);
      $data->delete();
    }elseif ($tipe == 'status_building') {
      $data = TransStatusBuilding::findOrFail($id);
      $data->delete();
    }
    elseif ($tipe == 'status_item') {
      $data = TransStatusItem::findOrFail($id);
      $data->delete();
    }

    Session::flash('flash_message', 'Data berhasil dihapus');
    return redirect()->back();
  }


  public function trans_condition()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $trans_conditions = TransCondition::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'name'
    ]);
    return Datatables::of($trans_conditions)
    ->addColumn('action', function ($trans_condition) {
      return '
      <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy/' . $trans_condition->id .'/'.'condition'. '">Delete</button>
      ';
    })
    ->make(true);
  }

  public function trans_for_building()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $trans_for_buildings = TransForBuilding::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'name'
    ]);
    return Datatables::of($trans_for_buildings)
    ->addColumn('action', function ($trans_for_building) {
      return '
      <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy/' . $trans_for_building->id .'/'.'for_building'. '">Delete</button>

      ';
    })
    ->make(true);
  }

  public function trans_for_land()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $trans_for_lands = TransForLand::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'name'
    ]);
    return Datatables::of($trans_for_lands)
    ->addColumn('action', function ($trans_for_land) {
      return '
      <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy/' . $trans_for_land->id .'/'.'for_land'. '">Delete</button>
      ';
    })
    ->make(true);
  }

  public function trans_for_vehicle()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $trans_for_vehicles = TransForVehicle::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'name'
    ]);
    return Datatables::of($trans_for_vehicles)
    ->addColumn('action', function ($trans_for_vehicle) {
      return '
      <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy/' . $trans_for_vehicle->id .'/'.'for_vehicle'. '">Delete</button>

      ';
    })
    ->make(true);
  }

  public function trans_gol()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $trans_gols = TransGol::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'name'
    ]);
    return Datatables::of($trans_gols)
    ->addColumn('action', function ($trans_gol) {
      return '
      <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy/' . $trans_gol->id .'/'.'gol'. '">Delete</button>

      ';
    })
    ->make(true);
  }

  public function trans_investor()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $trans_investors = TransInvestor::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'name'
    ]);
    return Datatables::of($trans_investors)
    ->addColumn('action', function ($trans_investor) {
      return '
      <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy/' . $trans_investor->id .'/'.'investor'. '">Delete</button>

      ';
    })
    ->make(true);
  }

  public function trans_unit_data()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $trans_units = TransUnit::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'name'
    ]);
    return Datatables::of($trans_units)
    ->addColumn('action', function ($trans_unit) {
      return '
      <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy/' . $trans_unit->id .'/'.'unit'. '">Delete</button>

      ';
    })
    ->make(true);
  }

  public function trans_status_land()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $trans_status_lands = TransStatusLand::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'name'
    ]);
    return Datatables::of($trans_status_lands)
    ->addColumn('action', function ($trans_status_land) {
      return '
      <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy/' . $trans_status_land->id .'/'.'status_land'. '">Delete</button>

      ';
    })
    ->make(true);
  }

  public function trans_status_cert()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $trans_status_certs = TransStatusCert::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'name'
    ]);
    return Datatables::of($trans_status_certs)
    ->addColumn('action', function ($trans_status_cert) {
      return '
      <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy/' . $trans_status_cert->id .'/'.'status_cert'. '">Delete</button>

      ';
    })
    ->make(true);
  }

  public function trans_status_building()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $trans_status_buildings = TransStatusBuilding::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'name'
    ]);
    return Datatables::of($trans_status_buildings)
    ->addColumn('action', function ($trans_status_building) {
      return '
      <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy/' . $trans_status_building->id .'/'.'status_building'. '">Delete</button>

      ';
    })
    ->make(true);
  }

  public function trans_status_item()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $trans_status_items = TransStatusItem::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'name'
    ]);
    return Datatables::of($trans_status_items)
    ->addColumn('action', function ($trans_status_item) {
      return '
      <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy/' . $trans_status_item->id .'/'.'status_item'. '">Delete</button>

      ';
    })
    ->make(true);
  }

  private function validation_rules($request)
  {
    $this->validate($request, [
      'name' => 'required'
    ]);
  }
}
