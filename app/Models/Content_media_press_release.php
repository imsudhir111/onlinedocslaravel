<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content_media_press_release extends Model
{
    use HasFactory;
    public function media_press(){
        // return $this->belongsTo('services');
            return $this->belongsTo(media_press::class,'media_press_id','id');
        }
}
