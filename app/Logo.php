<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
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
        return $this->hasOne(User::class, 'lastChangedBy');
    }
    
    //Is this logo currently being used?
    function inUse()
    {
        $relationClassList = [
            AboutLink::class,
            Project::class,
            Tool::class,
            CV::class
        ];
        
        foreach($relationClassList as $class)
        {
            if($this->hasMany($class)->count() > 0)
            {
                return true;
            }
        }
        
        return false;
    }
}
