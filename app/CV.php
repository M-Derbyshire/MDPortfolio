<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CV extends Model
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
    
    
    protected $table = 'cvs';
    
    
    
    public function logo()
    {
        return $this->hasOne(Logo::class);
    }
    
    function lastChangedBy()
    {
        return $this->hasOne(User::class, 'lastChangedBy');
    }
}
