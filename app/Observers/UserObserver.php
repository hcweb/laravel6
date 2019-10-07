<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    public function creating(User $user){
        if (empty($user->avatar)){
            $user->avatar='/backend/images/default.jpg';
        }
    }

    public function deleted(User $user)
    {
        //删除用户同时删除图像
        if (!empty($user->avatar)&&file_exists(public_path().$user->avatar)){
           unlink(public_path().$user->avatar);
        }
    }

    public function created(User $user)
    {

    }

    public function updated(User $user)
    {

    }
}
