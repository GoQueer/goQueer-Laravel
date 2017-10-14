<?php
/**
 * Created by PhpStorm.
 * User: bamdad
 * Date: 11/19/2016
 * Time: 5:53 PM
 */

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Location;
use App\Models\Profile;
use App\Models\Hint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {

        $locations = Location::orderBy('id','DESC')->paginate(500);
        return view('location.index',compact('locations'))
            ->with('i', ($request->input('page', 1) - 1) * 500)->with('email',Auth::user()->email);
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
            $galleries = Gallery::lists('name', 'id');
            $profiles = Profile::lists('name', 'id');
            return view('location.create',compact('galleries','profiles'))->with('email',Auth::user()->email);
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
                'coordinates' => 'required',
                'address' => 'required',
                'name' => 'required',
                'gallery_id' => 'required',
                'profile_id' => 'required'
            ]);

            \DB::table('location')->insert(
                [
                    'coordinate' => $request->coordinates,
                    'address' => $request->address,
                    'name' => $request->name,
                    'description' => $request->description,
                    'user_id' => Auth::id(),
                    'gallery_id' => $request->gallery_id,
                    'created_at' => new \DateTime('now'),
                    'updated_at' => new \DateTime('now'),
                    'profile_id' => $request->profile_id
                ]
            );
            return redirect()->route('location.index')
                ->with('success', 'Location added successfully')->with('email',Auth::user()->email);
        }else
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
            $hints = Hint::orderBy('id','DESC')->where('location_id',$id)->get();
//            $location = Location::find($id);
            $location =  \DB::table('location')
                ->join('profile', 'profile.id', '=', 'location.profile_id')
                ->select('location.*','profile.name AS profile_name')
                ->where('location.id' , '=', $id)
                ->first();

            return view('location.show', compact('location','hints'))->with('email',Auth::user()->email);
        }
        else
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
            $locations = Location::find($id);
            $galleries = Gallery::lists('name', 'id');
            return view('location.edit', compact('locations'))->with('galleries',$galleries)->with('email',Auth::user()->email);
        }else
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
                'address' => 'required',

            ]);

          $location =   Location::find($id);


//            dd($new_location);
            $location->fill(['id' => $id , 'description' => $request->description, 'address' => $request->address , 'name' => $request->name, 'gallery_id' => $request->gallery_id])->save();
            return redirect()->route('location.index')
                ->with('success', 'location updated successfully')->with('email',Auth::user()->email);
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
            Location::find($id)->delete();
            return redirect()->route('location.index')
                ->with('success', 'Location deleted successfully')->with('email',Auth::user()->email);
        } else
            return view('errors.permission');
    }
}