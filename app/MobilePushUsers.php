<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobilePushUsers extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'mobile_push_users';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    protected $casts = [
        'created_at'  => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
    ];
}
