<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {

	protected $guarded = array();
	public $timestamps = false;

	public function user() {
        return $this->belongsTo('App\Models\User')->first();
    }

	public function updates(){
		return $this->belongsTo('App\Models\Updates')->first();
	}

}
