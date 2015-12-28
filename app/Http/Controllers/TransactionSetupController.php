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

use Yajra\Datatables\Datatables;

class TransactionSetupController extends Controller
{
  public function index()
  {
    return view('transaction_setups.index');
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
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
      <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
      ';
    })
    ->make(true);
  }
}
