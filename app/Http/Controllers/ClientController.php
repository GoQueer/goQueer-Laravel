<?php
/**
 * Created by PhpStorm.
 * User: bamdad
 * Date: 11/19/2016
 * Time: 5:53 PM
 */

namespace App\Http\Controllers;

use App\Models\Location;

class ClientController extends Controller
{

    public function __construct()
    {

        $this->middleware('guest');

    }
    public function getLocations()
    {

            $locations = Location::all();
            return $locations->toJson();

    }


}