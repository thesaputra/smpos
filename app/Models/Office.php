<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
  protected $table = 'offices';
  protected $primarykey = 'id';
  protected $fillable = array('name','code','abbreviation','date_open');
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function OfficeDivisions()
  {
    return $this->hasMany('App\Models\OfficeDivision');
  }
}
