<?php
/**
 * Created by PhpStorm.
 * User: bamdad
 * Date: 11/19/2016
 * Time: 5:53 PM
 */

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationMedia;
use App\Models\Media;
use App\Models\MediaType;
use Illuminate\Http\Request;

class LocationMediaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medias = LocationMedia::orderBy('id','DESC')->paginate(5);
        return view('media.index',compact('medias'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $types = MediaType::lists('name','id');
        $medias = Media::lists('name','id');
        $types = MediaType::lists('name', 'id');

        return view('location_media.create', compact('id', 'medias','location_id'));
//        $models = $->models();
//        return Response::eloquent($models->get(['id','name']));
//        return View::make('media.create')->with('locations', $locations)->with('types',$types);
//        return view('media.create')
//            ->with('locations', Location::orderBy('id', 'asc')->lists('name','id'))
//            ->with('types', MediaType::orderBy('id', 'asc')->lists('name','id'));
//        return view('media.create',compact('types','locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'location_id' => 'required',
            'media_id' => 'required',
        ]);


        \DB::table('location_media')->insert(
            ['location_id' => $request->location_id,
                'media_id' => $request->media_id,
                ]
        );
        return redirect()->route('location.index')
            ->with('success','Media Assigned successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medias = Media::lists('name','id');
        $locationNames = \DB::table('location')
            ->where('id', '=', $id)
            ->get();
        $locationMedias = \DB::table('location_media')
            ->where('location_id', '=', $id)
            ->get();
        return view('location_media.create', compact('id', 'medias','locationMedias','locationNames'));
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
    public function destroy($id)
    {
        LocationMedia::find($id)->delete();

        return redirect()->route('location.index')
            ->with('success','Media deleted successfully');
    }
}