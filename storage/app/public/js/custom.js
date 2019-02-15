function showMsgbackup(ele,msg){
    var box=$('#msg_box');
    var offset = $(ele).height()?(0):(-48);
    var top=$(ele).offset().top+offset;
    var left=$(ele).offset().left + $(ele).width() + 20;
    box.css({
        'margin-top': top,
        'margin-left':left
    });
    if(msg.code==1){
        box.children().addClass('btn-success');
        box.children().html(msg.msg);
        box.fadeIn(2000);
        box.fadeOut(1000);
    }else if(msg.code==601){
        console.log(msg.msg);
        box.children().addClass('btn-danger');
        box.children().html(msg.msg);
        box.fadeIn(2000);
        box.fadeOut(1000);
    }
}function showMsg(msg){
    var box=$('#msg_box');
    if(msg.code==1){
        box.children().addClass('btn-success');
        box.children().html(msg.msg);
        box.fadeIn(2000);
        box.fadeOut(1000);
    }else if(msg.code==601){
        console.log(msg.msg);
        box.children().addClass('btn-danger');
        box.children().html(msg.msg);
        box.fadeIn(2000);
        box.fadeOut(1000);
    }
}

function trash_xs(which){
    var type=$(which).data('content').split('_')[0];
    var id=$(which).data('content').split('_')[1];
    $.ajax({
        type:'get',
        url:"/"+type+"/delete/"+id,
        success : function(data){
            showMsg(data);
            $('#'+type+'_'+id).parent().remove();
        },
        error: function (data) {
            console.log(data);
        }
    });
}
function dragStart(event){
    event.dataTransfer.setData("type_id",event.target.id);//保存数据--该img元素的id
}
function allowDrop(ev)
{
    ev.preventDefault();
}


function drop(ev)
{
    ev.preventDefault();
    var data=ev.dataTransfer.getData("Text");
    ev.target.appendChild(document.getElementById(data));
}
function task_click(data){

}