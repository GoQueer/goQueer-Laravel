<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LocationMedia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'location_media';
    public $fillable = ['location_id','media_id'];
}