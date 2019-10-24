<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Download extends Model
{

    use Searchable;
    protected $table='download';
    protected $guarded = array();


    public function category(){
        return $this->belongsTo(Category::class);
    }

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

    protected static function boot()
    {
        parent::boot();
        static::deleted(function ($m_data){
            //删除标签
            $m_data->tags()->detach();
            //删除图片及文件
            $m_attributes=$m_data->attributesToArray();
            foreach ($m_attributes as $v){
                if (!is_null($v) && Str::contains($v,config('system_config.site_file_path'))){
                    foreach (explode(',',$v) as $c){
                        \File::delete(public_path($c));
                    }
                }
            }
        });
    }
}
