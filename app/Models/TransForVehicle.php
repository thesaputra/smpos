<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransForVehicle extends Model
{
  protected $table = 'trans_forvehicles';
  protected $primarykey = 'id';
  protected $fillable = array('name');
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function TransactionItems()
  {
    return $this->hasMany('App\Models\TransactionItem');
  }

  public function TransactionPropbuildings()
  {
    return $this->hasMany('App\Models\TransactionPropbuilding');
  }

  public function TransactionProplands()
  {
    return $this->hasMany('App\Models\TransactionPropland');
  }

  public function TransactionVehicles()
  {
    return $this->hasMany('App\Models\TransactionVehicle');
  }
}
