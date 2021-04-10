<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CasesMessage extends Model
{

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'cases_messages';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

}
