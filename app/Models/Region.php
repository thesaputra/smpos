<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
  protected $table = 'regions';
  protected $primarykey = 'id';
  protected $fillable = array('name','code','abbreviation','date_open');
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function regionKPRKS()
  {
    return $this->hasMany('App\Models\RegionKPRK');
  }
}
