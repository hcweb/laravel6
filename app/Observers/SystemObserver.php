<?php

namespace App\Observers;

use App\Models\System;

class SystemObserver
{
    public function deleted(System $system){
        //删除用户同时删除图像
        if (!empty($system->content)&&file_exists(public_path().$system->content)){
            unlink(public_path().$system->content);
        }
    }
}
