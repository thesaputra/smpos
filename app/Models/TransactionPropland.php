<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionPropland extends Model
{
  protected $table = 'transaction_proplands';
  protected $primarykey = 'id';
  protected $fillable = array('asset_categories_id','trans_gol_id','trans_investors_id','trans_forland_id',
                              'trans_statuscert_id','trans_statusland_id','index','mdsap','name','no_cert','date_cert','date_expired_cert',
                              'name_owner','amount','date_amount','land_ha','lat','lang','doc_land','description');
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

  public function TransForLand()
  {
    return $this->belongsTo('App\Models\TransForLand');
  }

  public function TransStatusCert()
  {
    return $this->belongsTo('App\Models\TransStatusCert');
  }

  public function TransStatusLand()
  {
    return $this->belongsTo('App\Models\TransStatusLand');
  }
}
