<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionKPC extends Model
{
  protected $table = 'region_kpcs';
  protected $primarykey = 'id';
  protected $fillable = array('region_kprk_id','name','code','abbreviation','date_open','address','pkkk','phone','fax','url_photo','lat','lang');
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function regionKPRK()
  {
    return $this->belongsTo('App\Models\RegionKPRK');
  }

}
