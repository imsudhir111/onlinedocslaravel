<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media_press;
use App\Models\Media_press_release;
use App\Models\Content_media_press_release;

class PressMediaController extends Controller
{
    //
    public function media_press_release(){ 
    // $media_press=Media_press_release::All();
    
    $media_press['media_press_release'] = Media_press_release::select('id','caption','image','description')
    ->where('active_status', '=', '1')->latest()->take(4)->get();
    $media_press['media_press_release1']=Content_media_press_release::with('media_press:id,name')->select('id','media_press_id')
         ->get();
    return $media_press;
    }
}
