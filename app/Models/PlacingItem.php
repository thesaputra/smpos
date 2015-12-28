<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlacingItem extends Model
{
  protected $table = 'placing_items';
  protected $primarykey = 'id';
  protected $fillable = array('placing_id','transaction_item_id','qty','status');
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function Placing()
  {
    return $this->belongsTo('App\Models\Placing');
  }
}
