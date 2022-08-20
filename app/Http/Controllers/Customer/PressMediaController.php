<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Media_press;
use App\Models\Media_press_release;
use App\Models\Content_media_press_release;

class PressMediaController extends Controller
{
    //
    public function press_media_release (){ 
    // $media_press=Media_press_release::All();
    
    $press_media_release = Media_press_release::select('id','caption','image','description')
    ->where('active_status', '=', '1')->latest()->take(4)->get();
 
    // return isset($press_media_release[1]->id) ? 'ui' :'io';
    $assigned_press_media=[];
    foreach ($press_media_release as $key => $release) {
    // print_r($release->id);
    $assigned_data=Content_media_press_release::select('media_press_id','url')->with('media_press:id,name,small_icon')
    ->where('media_press_release_id',$release->id)
    ->get();
        array_push($assigned_press_media,$assigned_data);
    }
    $other_press_release = Content_media_press_release::select('media_press_release_id','url')
    ->with('media_press_release:id,caption,image,created_at')
    ->whereNotIn('id', [isset($press_media_release[0]->id) ? $press_media_release[0]->id : '', isset($press_media_release[1]->id) ? $press_media_release[1]->id : '' ])
    ->latest()->take(6)
    ->get();
    $blog_list = Blog::select('id','caption','small_image','slug')
        ->where('active_status', '=', '1')
        ->where('published_at', '!=', 'Null')
        ->latest()->take(8)
        ->get();
// return $blog_list;
    // return $other_press_release;
    // return $assigned_press_media;
    // $assigned_press_media=Content_media_press_release::select('media_press_id','url')->with('media_press:id,name,small_icon')
    // ->where('media_press_release_id',$press_media_release[0]->id)
    // ->get();
    // return $assigned_press_media;
    return view('frontend.press-media-release.index', compact('press_media_release','assigned_press_media','other_press_release','blog_list'));

    }
}
