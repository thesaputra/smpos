<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeDepart extends Model
{
  protected $table = 'office_departs';
  protected $primarykey = 'id';
  protected $fillable = array('office_division_id','name','code','abbreviation','date_open','address','pkkk','phone','fax','url_photo','lat','lang');
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function officeDivision()
  {
    return $this->belongsTo('App\Models\OfficeDivision');
  }
}
