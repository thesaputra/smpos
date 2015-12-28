<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Placing extends Model
{
  protected $table = 'placings';
  protected $primarykey = 'id';
  protected $fillable = array('no_penempatan','office_sender','division_sender','office_destination','division_destination','date_penempatan','status','description','room','floor');
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function PlacingItems()
  {
    return $this->hasMany('App\Models\PlacingItem');
  }
}
