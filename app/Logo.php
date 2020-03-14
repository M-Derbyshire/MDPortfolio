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
    
    function aboutLinks()
    {
        return $this->hasMany(AboutLink::class);
    }
    
    function projects()
    {
        return $this->hasMany(Project::class);
    }
    
    function tools()
    {
        return $this->hasMany(Tool::class);
    }
    
    function lastChangedBy()
    {
        return $this->hasOne(User::class, 'lastChangedBy');
    }
    
    //Is this logo currently being used?
    function inUse()
    {
        if(
            $this->aboutLinks()->count() > 0 ||
            $this->projects()->count() > 0 ||
            $this->tools()->count() > 0
        )
        {
            return true;
        }
        
        return false;
    }
}
