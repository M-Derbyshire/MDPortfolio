<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutLink extends Model
{
    //The table name fro the model
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
    
    public function url()
    {
        return $this->hasOne(Url::class);
    }
    
    public function logoUrl()
    {
        return $this->hasOne(Url::class, "logoUrl_id");
    }
}