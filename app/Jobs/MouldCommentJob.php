<?php

namespace App\Jobs;

use App\Models\Mould;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MouldCommentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //修改评论模型关联信息
        //获取所有模型名称
        $mouldNames=Mould::pluck('table_name');
        $setMouldName='setMouldName';

        $result_c_html='';
        foreach ($mouldNames as $v){
            $c_html=<<<EOF
public function $v(){
        return \$this->belongsTo({$setMouldName($v)}::class);
    }
EOF;
            $result_c_html.=$c_html;
        }

        $comment_content=<<<EOF
<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected \$table='comment';
    protected \$fillable=['title','ip','content','visitor','city','state','member_id','mould_id','document_id','_lft','_rgt','parent_id'];

   {$result_c_html}
}
EOF;
        \File::put(app_path('Models/Comment.php'),$comment_content);



        //修改标签模型
        $result_t_html='';
        foreach ($mouldNames as $v){
            $t_html=<<<EOF
public function $v()
{
    return \$this->belongsToMany({$setMouldName($v)}::class, 'model_tag');
}
EOF;
            $result_t_html.=$t_html;
        }

        $tag_content=<<<EOF
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected \$table = 'tags';
    protected \$fillable = ['name'];
    
    {$result_t_html}
}
EOF;
        \File::put(app_path('Models/Tag.php'),$tag_content);

    }
}
