<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    public function deleted(Category $category)
    {
        //删除关联的文章
        $category->posts()->delete();
        //删除单页
        $category->single()->delete();
        //删除图集
        $category->pictures()->delete();
        //删除下载
        $category->downloads()->delete();
        //删除留言
        $category->guestBooks()->delete();

    }
}
