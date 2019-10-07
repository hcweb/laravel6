
    var mFields=@json($fields);
    for (var i=0;i<mFields.length;i++){
        switch (mFields[i].type) {
            case 'datetime':
                laydate.render({
                    elem: '#'+mFields[i].name+'_'+mFields[i].id
                    ,type: 'datetime'
                    ,value:new Date()
                });
                break;
            case 'htmltext':
                var ue = UE.getEditor(mFields[i].name+'_'+mFields[i].id,{
                    autoHeightEnabled: false,
                    initialFrameHeight:400
                });
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
                break;
            case 'img':
                upload.render({
                    elem: '#'+mFields[i].name+'_'+mFields[i].id+'_img_btn', //绑定元素
                    url: "{{route('file.upload')}}", //上传接口
                    accept:'images',
                    acceptMime:'image/*',
                    exts:"{{config('system_config.site_img_type')}}",
                    multiple:false,
                    data:{
                        "_token": "{{csrf_token()}}",
                        'f_type':'img'
                    },
                    done: function(res,index,){
                        //上传完毕回调
                        $("#"+$(this.item).data('id')).val(res.data.path);
                    },
                    error: function(index, upload){
                        //请求异常回调
                        layer.msg("上传失败！", {icon: 5});
                    }
                });
                break;
            case 'imgs':
                upload.render({
                    elem: '#'+mFields[i].name+'_'+mFields[i].id+'_img_btn', //绑定元素
                    url: "{{route('file.upload')}}", //上传接口
                    accept:'images',
                    number:5,
                    acceptMime:'image/*',
                    exts:"{{config('system_config.site_img_type')}}",
                    multiple:true,
                    data:{
                        "_token": "{{csrf_token()}}",
                        'f_type':'img'
                    },
                    before: function(obj){
                        console.log(obj);
                        return;
                    },
                    done: function(res,index){
                        //上传完毕回调
                        if (res.success == true){
                            var html='<div class="imgs_item_box">'+
                                '<i class="fa fa-close app-file-delete" data-path="'+res.data.path+'" data-id="'+$(this.item).data('id')+'" data-name="'+$(this.item).data('name')+'"></i>'+
                                '<img src="'+res.data.path+'" alt="">'+
                                '<input type="hidden" value="'+res.data.path+'" name="'+$(this.item).data('name')+'[]">'+
                                '</div>';
                            $("#"+$(this.item).data('id')+'_imgb_box').append(html);
                            deleteFile();
                        }else {
                            layer.msg("上传失败！", {icon: 5});
                        }
                    },
                    error: function(index, upload){
                        //请求异常回调
                        layer.msg("上传失败！", {icon: 5});
                    }
                });
                break;
            case 'files':
                upload.render({
                    elem: '#'+mFields[i].name+'_'+mFields[i].id+'_img_btn', //绑定元素
                    url: "{{route('file.upload')}}", //上传接口
                    accept:'file',
                    {{--exts:"{{config('system_config.site_img_type')}}",--}}
                    data:{
                        "_token": "{{csrf_token()}}",
                        'f_type':'file'
                    },
                    before: function(obj){
                        console.log(obj);
                        return;
                    },
                    done: function(res,index){
                        //上传完毕回调
                        if (res.success == true){
                            var html='<div class="imgs_item_box" style="border:none;width:auto;height: auto;padding:10px;">'+
                                '<i class="fa fa-close app-file-delete" data-path="'+res.data.path+'" data-id="'+$(this.item).data('id')+'" data-name="'+$(this.item).data('name')+'"></i>'+
                                '<p><a href="javascript:;" data-src="'+res.data.path+'">'+res.data.name+'</a></p>'+
                                '<input type="hidden" value="'+res.data.path+'" name="'+$(this.item).data('name')+'[]">'+
                                '</div>';
                            $("#"+$(this.item).data('id')+'_imgb_box').append(html);
                            deleteFile();
                        }else {
                            layer.msg("上传失败！", {icon: 5});
                        }
                    },
                    error: function(index, upload){
                        //请求异常回调
                        layer.msg("上传失败！", {icon: 5});
                    }
                });
                break;
            case 'switch':
                form.on('switch('+mFields[i].name+'_'+mFields[i].id+')', function(data){
                    console.log(data.elem.checked); //开关是否开启，true或者false
                    if (data.elem.checked == true){
                        $(data.elem).val(1);
                    }else{
                        $(data.elem).val(0);
                    }
                });
                break;
            case 'color':
                colorpicker.render({
                    elem: '#'+mFields[i].name+'_'+mFields[i].id+'color' //绑定元素
                    ,predefine:true
                    ,color:$('#'+mFields[i].name+'_'+mFields[i].id).val()
                    ,change: function(color){ //颜色改变的回调
                        layer.tips('选择了：'+ color, this.elem, {
                            tips: 1
                        });
                        $('#'+$(this.elem).data('id')).val(color);
                    }
                });
                break;
        }
    }

    deleteFile();
    function deleteFile(){
        $('.app-file-delete').click(function () {
            var path=$(this).data('path');
            var pId=$(this).data('id');
            var pName=$(this).data('name');
            //删除本地文件
            $.post("{{route('file.remove')}}",{
                'path':path,
                '_token':"{{csrf_token()}}"
            },function (response) {
                if (response.success == true){

                }
            });

            $('#'+pId+'_imgb_box').find('img').each(function (index,element) {
                if ($(this).attr('src') == path){
                    $(this).parent().remove();
                }
            });

            $('#'+pId+'_imgb_box').find('a').each(function (index,element) {
                if ($(this).attr('data-src') == path){
                    $(this).parent().parent().remove();
                }
            });

            if ($('#'+pId+'_imgb_box').find('.imgs_item_box').length == 0){
                $('#'+pId+'_imgb_box').append('<input type="hidden" value="" name="'+pName+'">');
            }
        });
    }

