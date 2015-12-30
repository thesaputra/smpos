<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
  protected $table = 'transaction_items';
  protected $primarykey = 'id';
  protected $fillable = array('asset_categories_id','trans_gol_id','trans_investors_id','trans_unit_id',
                              'trans_conditions_id','index','mdsap','nsdp','name','merk','amount','date_amout',
                              'description','qty','doc_file','user_id');
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

  public function TransUnit()
  {
    return $this->belongsTo('App\Models\TransUnit');
  }

  public function TransCondition()
  {
    return $this->belongsTo('App\Models\TransCondition');
  }

  public function MutationItems()
  {
    return $this->hasMany('App\Models\MutationItem');
  }

}
