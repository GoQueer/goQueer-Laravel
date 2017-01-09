<?php
/**
 * Created by PhpStorm.
 * User: bamdad
 * Date: 11/19/2016
 * Time: 5:53 PM
 */

namespace App\Http\Controllers;

use App\Models\GalleryMedia;
use App\Models\Gallery;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($input)
    {
        $parameters = explode("&", $input);
        $id = $parameters[1];
        $gallery_media_id = $parameters[0];
        if (Auth::check()) {

            $association =  \DB::table('gallery_media')

                ->select('gallery_media.order as order')
                ->where('gallery_media.id' , '=', $gallery_media_id)
                ->get('order');
            $order = (int)$association[0]->order+ 1;

            \DB::table('gallery_media')
                ->where('gallery_media.id', $gallery_media_id)
                ->update(['order' => $order]);
            $all_medias = Media::orderBy('id', 'DESC')->paginate(5);
            $gallery = Gallery::find($id);
            $assigned_medias =  \DB::table('media')
                ->join('gallery_media', 'media.id', '=', 'gallery_media.media_id')
                ->select('media.*','gallery_media.id AS finalId', 'gallery_media.order AS order')
                ->orderBy('gallery_media.order', 'desc')
                ->where('gallery_media.gallery_id' , '=', $id)
                ->get();
                return view('gallery.show', compact('gallery', 'all_medias','assigned_medias', 'id'))->with('email', Auth::user()->email)
                    ->with('success','Update Successful');

        } else
            return view('errors.permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($input)
    {
        $parameters = explode("&", $input);
        $id = $parameters[1];
        $gallery_media_id = $parameters[0];
        if (Auth::check()) {

            $association =  \DB::table('gallery_media')

                ->select('gallery_media.order as order')
                ->where('gallery_media.id' , '=', $gallery_media_id)
                ->get('order');
            $order = (int)$association[0]->order- 1;
            \DB::table('gallery_media')
                ->where('gallery_media.id', $gallery_media_id)
                ->update(['order' => $order]);
            $all_medias = Media::orderBy('id', 'DESC')->paginate(5);
            $gallery = Gallery::find($id);
            $assigned_medias =  \DB::table('media')
                ->join('gallery_media', 'media.id', '=', 'gallery_media.media_id')
                ->select('media.*','gallery_media.id AS finalId', 'gallery_media.order AS order')
                ->orderBy('gallery_media.order', 'desc')
                ->where('gallery_media.gallery_id' , '=', $id)
                ->get();
            return view('gallery.show', compact('gallery', 'all_medias','assigned_medias', 'id'))->with('email', Auth::user()->email)
                ->with('success','Update Successful');

        } else
            return view('errors.permission');
    }
}