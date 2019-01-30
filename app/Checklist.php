<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Checklist extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function items($sort='')
    {
        if ($sort) {
            $dir = 'asc';
            if ($sort[0] == '-') {
                $sort = substr($sort, 1);
                $dir = 'desc';
            }
            return $this->hasMany('App\ChecklistItem')->orderBy($sort, $dir);
        }
        return $this->hasMany('App\ChecklistItem');
    }
}
