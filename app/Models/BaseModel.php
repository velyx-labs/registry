<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use HasUlids;

    /**
     * Indicates if the model should use timestamps.
     *
     * @var bool
     */
    public $timestamps = false;
}
