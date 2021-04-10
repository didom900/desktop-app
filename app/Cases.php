<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'cases';

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
    public function communication()
    {
        return $this->hasMany('App\Communication', 'cases_id', 'id_case');
    }
}
