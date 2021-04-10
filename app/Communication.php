<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'communication';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    protected $keyType = 'string';

    protected $casts = [
        'created_at'  => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
    ];

    /**
     * Get the messages of specific case
     */
    public function cases()
    {
        return $this->belongsTo('App\Cases', 'id_case');
    }

    /**
     * Get the messages of specific case
     */
    public function user()
    {
        return $this->belongsTo('App\Users', 'from');
    }
}
