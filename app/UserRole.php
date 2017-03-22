<?php

namespace App;

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
        return $this->hasMany('App\User', 'role_id');
    }



    // Cannot delete any UserRole, ok?
    public function delete() {
        return false;
    }
    static function destroy($ids) {
        return false;
    }
    public function forceDelete() {
        return false;
    }

}
