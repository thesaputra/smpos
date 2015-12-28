<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionKPRK extends Model
{
  protected $table = 'region_kprks';
  protected $primarykey = 'id';
  protected $fillable = array('region_id','name','code','abbreviation','date_open','address','pkkk','phone','fax','url_photo','lat','lang');
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function region()
  {
    return $this->belongsTo('App\Models\Region');
  }

  public function regionKPCS()
  {
    return $this->hasMany('App\Models\regionKPC');
  }
}
