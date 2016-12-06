<?php
/**
 * Created by PhpStorm.
 * User: bamdad
 * Date: 11/19/2016
 * Time: 5:53 PM
 */

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Media;
use App\Models\MediaType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class MediaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            $medias = Media::orderBy('id', 'DESC')->paginate(5);
            return view('media.index', compact('medias'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
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
//        $types = MediaType::lists('name','id');
            $locations = Location::lists('name', 'id');
            $types = MediaType::lists('name', 'id');
            return view('media.create', compact('id', 'types'));
//        $models = $->models();
//        return Response::eloquent($models->get(['id','name']));
//        return View::make('media.create')->with('locations', $locations)->with('types',$types);
//        return view('media.create')
//            ->with('locations', Location::orderBy('id', 'asc')->lists('name','id'))
//            ->with('types', MediaType::orderBy('id', 'asc')->lists('name','id'));
//        return view('media.create',compact('types','locations'));
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
                'source' => 'required',
                'address' => 'required',
                'type_id' => 'required',
                'user_id' => 'required',
            ]);

            $file = $request->file('file_name');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->getRealPath();
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file->getClientOriginalName());

            DB::table('media')->insert(
                ['source' => $request->source,
                    'address' => $request->address,
                    'filePath' => $filePath,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime(),
                    'name' => $request->name,
                    'type_id' => $request->type_id,
                    'user_id' => $request->user_id,]
            );

//        Media::create($request->all());
            return redirect()->route('media.index')
                ->with('success', 'Media added successfully');
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
            $media = Media::find($id);
            return view('media.show', compact('media'));
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
            $media = Media::find($id);
            return view('media.edit', compact('media'));
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
                'source' => 'required',
                'address' => 'required',
                'type_id' => 'required',
                'user_id' => 'required',
            ]);

            Media::find($id)->update($request->all());
            return redirect()->route('media.index')
                ->with('success', 'Media updated successfully');
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
            Media::find($id)->delete();
            return redirect()->route('media.index')
                ->with('success', 'Media deleted successfully');
        } else
            return view('errors.permission');
    }
}