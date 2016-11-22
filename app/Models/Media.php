<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Media extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media';
    public $fillable = ['source','address','type_id','user_id','displayName','locaton_id'];
}