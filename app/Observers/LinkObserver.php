<?php

namespace App\Observers;

use App\Models\Link;

class LinkObserver
{

    public function deleted(Link $link)
    {
        //删除关联的标签
        $link->linkItems()->delete();
    }
}
