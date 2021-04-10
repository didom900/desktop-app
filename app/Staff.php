<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'staff';

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
