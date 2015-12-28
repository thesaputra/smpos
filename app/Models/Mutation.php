<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutation extends Model
{
  protected $table = 'mutations';
  protected $primarykey = 'id';
  protected $fillable = array('no_mutasi','office_sender','division_sender','office_destination','division_destination','date_mutation','status','description');
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function MutationItems()
  {
    return $this->hasMany('App\Models\MutationItem');
  }
}
