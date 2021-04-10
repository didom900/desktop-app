<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the messages of all users.
     */
    public function users()
    {
        return $this->belongsTo('App\User', 'to');
    }
}
