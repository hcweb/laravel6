<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Record extends Model
{
    //
    use Searchable;

    protected $table='record';

    public $timestamps = false;

    protected $fillable=['b_name','b_auther','b_house','b_push_time','b_isbn','b_theme_word','b_page_number','b_cate_number','b_series_name','b_price','b_summary'];
}
