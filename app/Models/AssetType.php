<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
  protected $table = 'asset_types';
  protected $primarykey = 'id';
  protected $fillable = array('name','code');
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function AssetCategories()
  {
    return $this->hasMany('App\Models\AssetCategory');
  }
}
