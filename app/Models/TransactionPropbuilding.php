<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionPropbuilding extends Model
{
  protected $table = 'transaction_propbuildings';
  protected $primarykey = 'id';
  protected $fillable = array('asset_categories_id','trans_gol_id','trans_investors_id','trans_forbuilding_id',
                              'trans_statusbuilding_id','index','mdsap','name','index_tanah','lat','lang',
                              'building_ha','amount','date_amount','floors','doc_building','description');
  protected $hidden = ['id', 'created_at', 'updated_at'];


  public function AssetCategory()
  {
    return $this->belongsTo('App\Models\AssetCategory');
  }

  public function TransGol()
  {
    return $this->belongsTo('App\Models\TransGol');
  }

  public function TransInvestor()
  {
    return $this->belongsTo('App\Models\TransInvestor');
  }

  public function TransForBulding()
  {
    return $this->belongsTo('App\Models\TransForBulding');
  }

  public function TransStatusBuilding()
  {
    return $this->belongsTo('App\Models\TransStatusBuilding');
  }
}
