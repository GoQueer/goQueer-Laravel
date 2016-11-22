<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Location extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'location';
    public $fillable = ['x','y','name','description','diameter','user_id'];
}