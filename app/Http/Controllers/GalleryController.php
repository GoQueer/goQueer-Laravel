<?php
/**
 * Created by PhpStorm.
 * User: bamdad
 * Date: 11/19/2016
 * Time: 5:53 PM
 */

namespace App\Http\Controllers;

use App\Models\CopyrightStatus;
use App\Models\Location;
use App\Models\Gallery;
use App\Models\MediaType;
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
            $galleries = Gallery::orderBy('id', 'DESC')->paginate(5);
            return view('gallery.index', compact('galleries'))
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
            return view('gallery.create')->with('email',Auth::user()->email);
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
            ]);



            DB::table('gallery')->insert(
                ['name' => $request->name,
                    'description' => $request->description]
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
            return view('gallery.show', compact('gallery'))->with('email',Auth::user()->email);
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