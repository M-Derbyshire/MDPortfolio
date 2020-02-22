<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
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
    
    public function logoUrl()
    {
        return $this->hasOne(Url::class, "logoUrl_id");
    }
    
    public function githubUrl()
    {
        return $this->hasOne(Url::class, "githubUrl_id");
    }
    
    public function zipUrl()
    {
        return $this->hasOne(Url::class, "zipUrl_id");
    }
}
