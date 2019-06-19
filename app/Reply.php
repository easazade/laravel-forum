<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {
//    public $owner;
    protected $guarded = [];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
//        $this->owner = $this->hasOne(User::class);
    }

    public function owner(){
        return  $this->belongsTo(User::class,'user_id');
    }

}
