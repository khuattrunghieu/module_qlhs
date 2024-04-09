<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Account;
use App\Models\RoleUser;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Modules\Classes\Entities\Classes;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'phone', 'address', 'birthday', 'account_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function teacherClass()
    {
        return $this->belongsToMany(Classes::class, 'teacher_classes', 'teacher_id', 'class_id');
    }
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function checkRole($role_id)
    {   
        $user = Auth::user();
        $roles = RoleUser::where('user_id',$user->id)->where('role_id', $role_id);
        if($roles->exists())
        {
            return true;
        }
        return false;
    }
}
