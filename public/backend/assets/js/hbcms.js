/**
 * Created by xtn on 2018/7/5.
 */
var app = {
    token: window.hbidea.csrfToken,
    delete: function (url, id) {
        swal("", "您确定要这么做吗？", {
            icon: 'info',
            buttons: ["取消", "确定"],
            dangerMode:true,
        }).then(function (value) {
            if (value) {
                $.ajax({
                    type: "POST",
                    url: url + '/' + id,
                    async: true,
                    dataType: 'json',
                    data: {
                        _token: app.token,
                        _method: 'DELETE'
                    },
                    success: function (response) {
                        if (response.code == 1) {
                            swal({
                                text: response.msg,
                                icon: "success",
                                timer: '2000',
                                button:false
                            });
                            setTimeout(function () {
                                window.location.href = window.location.href;
                            }, 2000);
                        } else {
                            swal({
                                text: response.msg,
                                icon: "error",
                                timer: '2000',
                                button:false
                            });
                        }
                    },
                    error: function (jXHRq, textStatus, errorThrown) {
                        swal({
                            text: '服务器错误,请稍后再试!',
                            icon: "error",
                            timer: '2000',
                            button:false
                        });
                    }
                });
            }
        });
    },
    order: function (url, order, id) {
        $.ajax({
            type: "POST",
            url: url,
            async: true,
            dataType: 'json',
            data: {
                _token: app.token,
                order: order,
                id: id
            },
            success: function (response) {
                if (response.code == 1) {
                    swal({
                        text: response.msg,
                        icon: "success",
                        timer: '2000',
                        button:false
                    });
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 2000);
                } else {
                    swal({
                        text: response.msg,
                        icon: "error",
                        timer: '2000',
                        button:false
                    });
                }
            },
            error: function (jXHRq, textStatus, errorThrown) {
                swal({
                    text: '服务器错误,请稍后再试!',
                    icon: "error",
                    timer: '2000',
                    button:false
                });
            }
        });
    },
    //全选和取消全选
    choseAll: function () {
        var title = $("#toggleCkeckbox span").text();
        if (title == "全选") {
            $("#toggleCkeckbox span").text("取消");
            $(".check_opt").prop("checked", true);
            $("#check_all").prop("checked", true);
        } else {
            $("#toggleCkeckbox span").text("全选");
            $(".check_opt").prop("checked", false);
            $("#check_all").prop("checked", false);
        }
    },

    //批量删除数据
    deleteMoreObject: function (url) {
        var ids = [];
        $('input[name="ids"]:checked').each(function () {
            ids.push($(this).val());
        });
        if (ids.length != 0) {
            app.delete(url, ids);
        } else {
            $.toast({
                heading: '提示信息！',
                text: '请选择要删除的项目！',
                position: 'top-center',
                loaderBg: '#ff6849',
                icon: 'info',
                hideAfter: 3500
            });
        }
    },
    checkBoxAll: function () {
        app.choseAll();
    },
    getColor: function () {
        var color = null;
        $('#themecolors a').each(function (index, item) {
            if ($(item).hasClass('working')) {
                color = $(item).attr('theme');
            }
        });
        return color;
    }
};

$(".check_opt").change(function () {
    if ($('input[class=check_opt]:checked').length > 0) {
        $("#toggleCkeckbox span").text("取消");
        $("#check_all").prop("checked", true);
    } else {
        $("#toggleCkeckbox span").text("全选");
        $("#check_all").prop("checked", false);
    }
});

