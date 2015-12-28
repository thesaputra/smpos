<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetCategory extends Model
{
  protected $table = 'asset_categories';
  protected $primarykey = 'id';
  protected $fillable = array('asset_type_id','name','code','description');
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function AssetType()
  {
    return $this->belongsTo('App\Models\AssetType');
  }
}
