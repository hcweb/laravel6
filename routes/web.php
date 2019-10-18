<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Frontend'],function (){


    Route::get('/','HomeController@index')->name('home.index');

    Route::get('page/{alias}.html','HomeController@page')->name('home.page');
    Route::get('tool.html','HomeController@tool')->name('home.tool');
    Route::get('tool/down/{file}','HomeController@toolDown')->name('home.tool.down');

    Route::any('member/login.html','MemberController@login')->name('home.member.login');
    Route::any('member/register.html','MemberController@register')->name('home.member.register');

    //需要登录才可以访问
    Route::middleware(['member.login'])->group(function (){
        Route::get('message.html','MessageController@create')->name('home.message');
        Route::post('message/form.html','MessageController@store')->name('home.message.form');
        Route::any('member/logout.html','MemberController@logout')->name('home.member.logout');
        Route::get('{mould}/list/{alias}/{mid}/{id}/{number}/{order}.html','HomeController@getContentList')->name('home.content');
        Route::get('{mould}/detail/{alias}/{cid}/{id}.html','HomeController@getContentDetail')->name('home.content.detail');
        Route::any('search.html', 'HomeController@search')->name('home.search');
        Route::any('{mould}/file/{type}/{id}.html', 'HomeController@getFile')->name('home.file');
        Route::get('browser.html', 'BrowserController@index')->name('home.browser.list');
    });


    Route::get('/test/one','HomeController@test');
});

Route::group(['namespace' => 'Backend', 'prefix' => 'admin','middleware'=>'auth.log'], function () {
    //用户相关操作

    Route::get('/login', 'UserController@login')->name('backend.login');
    Route::post('/loginForm', 'UserController@loginForm')->name('backend.login.form');

    Route::middleware(['admin.login'])->group(function () {
        //后台首页
//        Route::get('/','HomeController@main')->name('backend.app');
        Route::get('/', 'HomeController@index')->name('backend.home');
        Route::get('/home', 'HomeController@index')->name('backend.home');
        Route::get('/test', 'HomeController@test')->name('backend.test');
        Route::get('/layout', 'UserController@layout')->name('backend.layout');
        Route::get('/clear', 'HomeController@clearCache')->name('clear.cache');
        //后台皮肤设置
        //Route::post('skin/createSkin', 'SkinController@createSkin')->name('skin.create.skin');

        //统计管理
        //VisitStats::routes();

//        Route::middleware(['auth.permission'])->group(function () {
//            //单页管理
//            Route::resource('single', 'PageController')->except('show','index','destroy');
//
//            //留言管理
//            Route::resource('guestbook', 'GuestBookController')->only('index','destroy');
//        });

        Route::middleware(['auth.permission','breadcrumb'])->group(function () {
            //权限管理
            Route::resource('permission', 'PermissionController');
            //角色管理
            Route::resource('role', 'RoleController');
            //用户管理
            Route::resource('user', 'UserController');
            //会员管理
            Route::resource('member', 'MemberController');
            //后台菜单
            Route::resource('menu', 'MenuController')->except('show');
            Route::post('menu/order', 'MenuController@order')->name('menu.order');

            //前台菜单管理
            Route::resource('category', 'CategoryController');
            Route::post('category/order', 'CategoryController@order')->name('category.order');
            Route::post('category/import', 'CategoryController@importCate')->name('category.import');

            //系统配置
            Route::post('system/updateAll', 'SystemController@updateAll')->name('system.update.all');
            Route::resource('system', 'SystemController');


            //主题管理
//            Route::get('theme', 'ThemeController@index')->name('theme.index');
//            Route::get('theme/switch', 'ThemeController@switchTheme')->name('theme.switch');



            //文章管理
//            Route::get('post/iframe', 'PostController@getIframe')->name('post.iframe');
//            Route::post('post/search', 'PostController@search')->name('post.search');
//            Route::post('post/order', 'PostController@order')->name('post.order');
//            Route::post('post/tjType', 'PostController@updateTuijianType')->name('post.tuijian.type');
//            Route::resource('post', 'PostController');

            // 文件管理
//            Route::get('fileManger', 'HomeController@fileManger')->name('file_manger.index');

            //资料管理
            Route::resource('block', 'BlockController');
            //友情链接
            Route::resource('link', 'LinkController');
            Route::post('link/cate/save', 'LinkController@createAndUpdateLinkCate')->name('link.cate.save');
            Route::delete('link/cate/delete/{id}', 'LinkController@deleteCate')->name('link.cate.delete');
            Route::post('link/order', 'LinkController@order')->name('link.order');
            //标签管理
            Route::resource('tag', 'TagController');
            //数据库管理
            Route::get('database', 'DatabaseController@index')->name('database.index');
            Route::get('database/down/{file}', 'DatabaseController@down')->name('database.down');
            Route::get('database/backup', 'DatabaseController@backup')->name('database.backup');
            Route::get('database/restore/{file}', 'DatabaseController@restore')->name('database.restore');
            Route::get('database/delete/{file}', 'DatabaseController@deleteDatabase')->name('database.delete');

            Route::get('content','ContentController@index')->name('content.index');

            //评论管理
            //Route::resource('comment','CommentController');

            //模型管理
            Route::get('get_mould_name/{id}','MouldController@getMouldNameById')->name('mould.get_mould_name');
            Route::resource('mould','MouldController');

            //字段管理
            //Route::get('field/m/{id}','FieldController@create')->name('field.m');
            Route::resource('field','FieldController');
            //Route::get('text','ContentController@text')->name('b.text');

            //模板管理
            Route::get('template/{path?}/{dir?}','TemplateController@index')->name('template.index');
            Route::post('template/info','TemplateController@getFileContent')->name('template.info');
            Route::post('template/save_content','TemplateController@saveContent')->name('template.save_content');

            //管理员日志
            Route::get('log','LogController@index')->name('log.index');

            //工具软件
            Route::get('tool','ToolController@index')->name('tool.index');
            Route::get('tool/down/{file}', 'ToolController@down')->name('tool.down');

            Route::get('page/help','PageController@help')->name('page.help');
            Route::get('page/contact_us','PageController@contactUs')->name('page.contact_us');
            Route::resource('page','PageController')->only('create','edit','update','store');

            //图书索引管理
            Route::any('record','RecordController@index')->name('record.index');

            //意见建议
            Route::resource('message','MessageController')->only('index','edit','update','destroy');


            //商家管理
            Route::resource('seller', 'SellerController');
            //商家類別管理
            Route::resource('sellertype', 'SellerTypeController');
            Route::post('sellertype/order', 'SellerTypeController@order')->name('sellertype.order');
            //载入自定义的模型控制器
            include __DIR__.'/admin_route.php';

        });
    });
});
Route::get('translate/{title}', 'Common\TranslateController@translate')->name('translate');
Route::group(['prefix' => 'file'], function () {
    Route::post('upload', 'Common\UploadController@upload')->name('file.upload');
    Route::post('remove', 'Common\UploadController@remove')->name('file.remove');
});



Route::get('student/index','StudentController@index');
