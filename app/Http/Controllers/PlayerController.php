<?php
/**
 * Created by PhpStorm.
 * User: bamdad
 * Date: 11/19/2016
 * Time: 5:53 PM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Location;
use App\Models\Media;
use Illuminate\Http\Request;
class PlayerController extends Controller
{

    public function __construct()
    {

        $this->middleware('guest');

    }
    public function getMyLocations(Request $request)
    {

        $myLocations = DB::table('player')->where('player.device_id','=',$request->device_id)
            ->join('discovery', 'discovery.player_id', '=', 'player.id')
            ->join('location', 'location.id', '=', 'discovery.location_id')
            ->select('location.*')
            ->get();
        return $myLocations;
    }
    public function getAllLocations(Request $request)
    {
        $player = DB::table('player')->where('player.device_id','=',$request->device_id)->get();
        if (sizeof($player) == 0)
            return $player;
        else {
            $locations = Location::all();
            return $locations->toJson();
        }

    }
    public function downloadMedia(Request $request){
        $media = Media::find($request->media_id);
        if (sizeof($media) > 0 )
        return response()->download($media->filePath);
    }


}