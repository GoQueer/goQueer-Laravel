<?php
/**
 * Created by PhpStorm.
 * User: bamdad
 * Date: 11/19/2016
 * Time: 5:53 PM
 */

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryMedia;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryMediaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medias = GalleryMedia::orderBy('id','DESC')->paginate(5);
        return view('media.index',compact('medias'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Auth::check()) {
            $this->validate($request, [
                'gallery_id' => 'required',
                'media_id' => 'required',
            ]);
            \DB::table('gallery_media')->insert(
                ['gallery_id' => $request->gallery_id,
                    'media_id' => $request->media_id,
                ]
            );

            $id = $request->gallery_id;
            $gallery = Gallery::find($id);
            $all_medias = Media::orderBy('id', 'DESC')->paginate(5);
            $assigned_medias =  \DB::table('media')
                ->join('gallery_media', 'media.id', '=', 'gallery_media.media_id')
                ->select('media.*','gallery_media.id AS finalId')
                ->where('gallery_media.gallery_id' , '=', $id)
                ->get();
            return view('gallery.show', compact('gallery', 'all_medias','assigned_medias', 'id'))->with('email', Auth::user()->email);
        } else
            return view('errors.permission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        var_dump($request);
//        var_dump($id1);
        $this->validate($request, [
            'gallery_id' => 'required',
            'media_id' => 'required',
        ]);
        \DB::table('gallery_media')->insert(
            ['gallery_id' => $request->gallery_id,
                'media_id' => $request->media_id,
                ]
        );
        return redirect()->route('gallery_media.show',[$request->location_id])
            ->with('success','Media Assigned successfully');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $media = LocationMedia::find($id);
        return view('media.edit',compact('media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'source' => 'required',
            'address' => 'required',
            'type_id' => 'required',
            'user_id' => 'required',
        ]);
        Media::find($id)->update($request->all());
        return redirect()->route('media.index')
            ->with('success','Media updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$gallery_id)
    {
        GalleryMedia::find($id)->delete();
//        var_dump($id);
//        return;
        return redirect()->route('gallery.show',$gallery_id)
            ->with('success','Association deleted successfully');
    }
}