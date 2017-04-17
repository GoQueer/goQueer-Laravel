<?php
/**
 * Created by PhpStorm.
 * User: bamdad
 * Date: 11/19/2016
 * Time: 5:53 PM
 */

namespace App\Http\Controllers;

use App\Models\Discovery;
use Illuminate\Support\Facades\DB;
use App\Models\Location;
use App\Models\Media;
use App\Models\Player;
use Illuminate\Http\Request;
class PlayerController extends Controller
{

    public function __construct()
    {

        $this->middleware('guest');

    }
    public function getMyLocations(Request $request)
    {
        $locations = Location::all();
        return $locations->toJson();
//        $myLocations = DB::table('player')->where('player.device_id','=',$request->device_id)
//            ->join('discovery', 'discovery.player_id', '=', 'player.id')
//            ->join('location', 'location.id', '=', 'discovery.location_id')
//            ->select('location.*')
//            ->get();
//        return $myLocations;
    }
    public function getAllLocations(Request $request)
    {
            $locations = Location::all();
            return $locations->toJson();

    }
    public function downloadMediaById(Request $request){
        $media = Media::find($request->media_id);
        if (sizeof($media) > 0 )
        {
            $file = public_path() . "/uploads/" . $media->fileName;

            $headers = array(
                'Content-Type: application/pdf',
            );

            return response()->download($file, $media->fileName, $headers);
        }
    }

    public function getMediaById(Request $request)
    {

        $myLocations = DB::table('player')->where('player.device_id','=',$request->device_id)
            ->join('discovery', 'discovery.player_id', '=', 'player.id')
            ->join('location', 'location.id', '=', 'discovery.location_id')
            ->join('gallery','location.gallery_id','=','gallery.id')
            ->join('gallery_media','gallery_media.gallery_id','=','gallery.id')
            ->join('gallery_media','gallery_media.media_id','=',$request->media_id)
            ->select('media.source,media.name,media.description,media.publish_date,media.display_date,media.type_id')
            ->get();
        return $myLocations;
    }


    public function getMediaByGalleryId(Request $request)
    {

        $myLocations = DB::table('gallery_media')->where('gallery_media.gallery_id','=',$request->gallery_id)
            ->join('media', 'gallery_media.media_id', '=', 'media.id')
            ->select('media.id','media.source','media.name','media.description','media.publish_date','media.display_date','media.type_id')
            ->get();
        return $myLocations;
    }


    public function getGalleryById(Request $request)
    {

        $gallery = DB::table('gallery')->where('gallery.id','=',$request->gallery_id)->get();

            return $gallery;


    }
    public function updateDiscoveryStatus(Request $request)
    {
        $player = DB::table('player')->where('device_id','=',$request->device_id)->first();
        var_dump($request->device_id);
        var_dump($player);

        $data = new Player;
        if ($player == null ) {

            $data->user_id = 1;
            $data->device_id = $request->device_id;
            $data->created_at = new \DateTime('now');
            $data->updated_at = new \DateTime('now');
            $data->save();
        } else
            $data->id = $player->id;






        $discovery = DB::table('discovery')->where('discovery.player_id', '=', $data->id)
                ->where('discovery.location_id', '=',$request->location_id)
            ->get();
        if ($discovery == null) {
            \DB::table('discovery')->insert(
                [
                    'location_id' => $request->location_id,
                    'player_id' => $data->id,
                    'created_at' => new \DateTime('now'),
                    'updated_at' => new \DateTime('now')
                ]
            );
            return 'Successful';
        }
        return 'Failed';
    }



}