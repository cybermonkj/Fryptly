<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
  protected $guarded = array();
  public $timestamps = false;

  public function from()
  {
        return $this->belongsTo('App\Models\User', 'from_user_id')->first();
    }

  public function to()
  {
        return $this->belongsTo('App\Models\User', 'to_user_id')->first();
    }

  public static function markSeen()
  {
    $this->status = 'readed';
        $this->save();
  }
}
