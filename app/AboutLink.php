<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutLink extends Model
{
    //The table name for the model
    protected $table = 'aboutLinks';
    
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
    
    public function logo()
    {
        return $this->hasOne(Logo::class, 'id', 'logo_id');
    }
    
    function lastChangedBy()
    {
        return $this->hasOne(User::class, 'user.id', 'lastChangedBy');
    }
}