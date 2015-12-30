<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionVehicle extends Model
{
  protected $table = 'transaction_vehicles';
  protected $primarykey = 'id';
  protected $fillable = array('asset_categories_id','trans_gol_id','trans_forvehicle_id','index','mdsap',
                              'model_vechicle','name','merk','type_vechicle','no_police','no_rangka','no_machine',
                              'year_production','silinder','color_kb','color_tnkb','bahan_bakar','date_kir',
                              'date_tax','amount','date_amount','doc_bpkb','doc_stnk','description','user_id');
  protected $hidden = ['id', 'created_at', 'updated_at'];


  public function AssetCategory()
  {
    return $this->belongsTo('App\Models\AssetCategory');
  }

  public function TransGol()
  {
    return $this->belongsTo('App\Models\TransGol');
  }

  public function TransForVehicle()
  {
    return $this->belongsTo('App\Models\TransForVehicle');
  }
}
