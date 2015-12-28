<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutationItem extends Model
{
  protected $table = 'mutation_items';
  protected $primarykey = 'id';
  protected $fillable = array('mutation_id','transaction_item_id','qty','status');
  protected $hidden = ['id', 'created_at', 'updated_at'];

  public function Mutation()
  {
    return $this->belongsTo('App\Models\Mutation');
  }

  public function TransactionItem()
  {
    return $this->belongsTo('App\Models\TransactionItem');
  }
}
