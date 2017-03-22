<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Many users have the same role.
     * @return void
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
