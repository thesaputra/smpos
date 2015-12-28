<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeDivision extends Model
{
  protected $table = 'office_divisions';
  protected $primarykey = 'id';
  protected $fillable = array('office_id','name','code','abbreviation','date_open','address','pkkk','phone','fax','url_photo','lat','lang');
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function office()
  {
    return $this->belongsTo('App\Models\Office');
  }

  public function officeDeparts()
  {
    return $this->hasMany('App\Models\OfficeDeparts');
  }
}
