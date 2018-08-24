<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $table='task';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content','user_id'
    ];

}
