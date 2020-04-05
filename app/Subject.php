<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'lastChangedBy'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'lastChangedBy'
    ];
    
    function lastChangedBy()
    {
        return $this->hasOne(User::class, 'user.id', 'lastChangedBy');
    }
}
