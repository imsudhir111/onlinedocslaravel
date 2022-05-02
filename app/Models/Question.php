<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function service11(){
    // return $this->belongsTo('services');
    	return $this->belongsTo(Service::class,'service_id','id');
    }
    public function service(){
    // return $this->belongsTo('services');
    	return $this->belongsTo(Service::class,'service_id','id');
    }
    public function options(){
        // return $this->belongsTo('services');
            // return $this->hasMany(Option::class,'ques_id','id');
            return $this->hasMany(Option::class,'ques_id','id');
        }
}
