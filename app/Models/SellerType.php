<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class SellerType extends Model
{
    use NodeTrait;
    protected $table = 'seller_type';

    protected $fillable = ['name', 'icon','is_show','order_num','_lft','_rgt','parent_id','tid'];

}
