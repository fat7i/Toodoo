<?php

namespace Toodoo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'participants';

    /**
     * @var array
     */
    protected $fillable = [
        'email',
    ];

    /**
     * @var array
     */
    protected $hidden = ['pivot'];

    /**
     * @var array
     */
    public static $rules = [
        'email' => 'required|unique:participants',
    ];
}