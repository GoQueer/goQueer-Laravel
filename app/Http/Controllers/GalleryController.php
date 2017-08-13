<?php
/**
 * Created by PhpStorm.
 * User: bamdad
 * Date: 11/19/2016
 * Time: 5:53 PM
 */

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Gallery;
use App\Models\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class GalleryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
//            $galleries = Gallery::orderBy('id', 'DESC')->paginate(5);
            $galleries =  DB::table('gallery')
                ->join('sets', 'gallery.set_id', '=', 'sets.id')
                ->select('gallery.*','sets.name AS set_name')
                ->orderBy('gallery.id', 'desc')
                ->paginate();

            return view('gallery.index')->with('galleries', $galleries)
                ->with('i', ($request->input('page', 1) - 1) * 5)->with('email',Auth::user()->email);
        } else
            return view('errors.permission');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {

            $sets = Set::lists('name', 'id');
//            return view('media.create', compact('id', 'types','statuses'))->with('email',Auth::user()->email);
            return view('gallery.create', compact('sets'))->with('email',Auth::user()->email);
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
        if (Auth::check()) {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'set_id' => 'required'
            ]);



            DB::table('gallery')->insert(
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'set_id' => $request->set_id
                ]
            );
            return redirect()->route('gallery.index')
                ->with('success', 'Gallery created successfully')->with('email',Auth::user()->email);
        } else
            return view('errors.permission');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            $gallery = Gallery::find($id);
            $all_medias = Media::orderBy('id', 'DESC')->paginate(5);

            $set = Set::find($gallery->set_id);
            $set_name = $set->name;
            $assigned_medias =  DB::table('media')
                ->join('gallery_media', 'media.id', '=', 'gallery_media.media_id')
                ->select('media.*','gallery_media.id AS finalId', 'gallery_media.order AS order')
                ->orderBy('gallery_media.order', 'desc')
                ->where('gallery_media.gallery_id' , '=', $id)
                ->get();
            return view('gallery.show', compact('gallery','all_medias','assigned_medias','id','set_name'))->with('email',Auth::user()->email);
        } else
            return view('errors.permission');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $gallery = Gallery::find($id);

            return view('gallery.edit', compact('gallery'))->with('email',Auth::user()->email);
        } else
            return view('errors.permission');
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
        if (Auth::check()) {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
            ]);
            Gallery::find($id)->update($request->all());
            return redirect()->route('gallery.index')
                ->with('success', 'Gallery updated successfully')->with('email',Auth::user()->email);
        } else
            return view('errors.permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            Gallery::find($id)->delete();
            return redirect()->route('gallery.index')
                ->with('success', 'Gallery deleted successfully')->with('email',Auth::user()->email);
        } else
            return view('errors.permission');
    }
}