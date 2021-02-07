<?php namespace Kysel\Events\Models;

use Model;
use Rainlab\User\Models\User as UserModel;

/**
 * Event Model
 */
class Event extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kysel_events_events';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'name',
        'poster',
        'user_id',
        'address',
        'date_start',
        'date_end',
        'description'
    ];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'date_end' => 'after:date_start',
        'name' => 'required|unique:kysel_events_events,name',
        'address' => 'required',
        'date_start' => 'required',
        'date_end' => 'required'
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Images to be sent by API
     */
    protected $with = ['poster'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'following' => ['kysel\events\Models\following']
    ];
    public $belongsTo = [
        'user' => ['Rainlab\User\Models\User']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'poster' => 'System\Models\File'
    ];
    public $attachMany = [];

    public function getUserOptions(){
        $fields =  UserModel::lists('name','id');         
        print_r($fields);
    }
}
