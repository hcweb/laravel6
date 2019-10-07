<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MTest extends Model
{
    protected $table='m_test';
    protected $guarded = array();
    

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'model_tag');
    }


    public function comments(){
        return $this->hasMany(Comment::class);
    }

    /**
     * @param $tags
     */
    public function syncTags($tags)
    {
        //先删除所关联的标签
        $this->tags()->detach();
        if ($tags != null && is_array($tags) && count($tags) > 0) {
            if (count($tags) > 0) {
                $this->tags()->sync(
                    Tag::whereIn('id', $tags)->pluck('id')
                );
                return;
            }
        }

    }
}