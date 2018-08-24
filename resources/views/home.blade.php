@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card"  style="margin-bottom: 30px">
                    <div class="card-header">Schedule</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <button class="btn btn-primary" id="add">添加任务</button>

                    </div>
                </div>
            </div>
            <div class="col-md-4">

                    <div class="card" style="margin-bottom: 30px">
                        <div class="card-header">To Do List</div>

                        @include('task.list')

                    </div>

                <div class="card">
                    <div class="card-header">Today Top Goals</div>
                    <div class="card-body">

                    </div>
                    <div  class="card-footer">
                        <div class="row">
                            <input type="text" name="task_content"  placeholder="Add a goal.." style="width: 80%">
                            <button class="btn"  style="width: 20%">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--Modal--}}
        <div class="modal fade" id="taskModal" tabindex="-1" role="dialog">

            <div class="modal-dialog" role="document" id="task_add">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="task-title">Edit</h4>

                        <button type="button" class="close" data-dismiss="modal"><span >&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form id="task">
                            <div class="form-group">
                                <label for="tname" class="control-label">Name:</label>
                                <input id="tname" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label for="tcontent" class="control-label">Content:</label>
                                <textarea class="form-control" id="tcontent"></textarea>
                            </div>
                            {!! csrf_field() !!}
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="tsave" class="btn btn-primary" value="update">提交</button>
                        <input type="hidden" id="tid" name="tid" value="-1">
                    </div>
                </div>
            </div>
        </div>
        <div class="" id="msg_box" style="display: none"><button class="btn"></button></div>
        <div class="modal fade" id="error_msg"><button class="btn btn-danger error_box"></button></div>

    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('tr').click(function () {
                $('#task-title').text('添加任务');
                $('#tsave').val('add');
                console.log($(this).offset().top);
                var top=$(this).offset().top+$(this).height();
                var left=$(this).offset().left;
                $('#task_add').css({
                    'margin-top': top,
                    'margin-left':left
                });
                $('#taskModal').modal('show');
            });
            //draggable elements
            var dragList = document.querySelectorAll('tr');//找到全部tr元素
            for(var i=0; i<dragList.length; i++){ //遍历img元素
                var p = dragList[i];
                p.ondragstart = function(ev){ //开始拖动源对象
                    ev.dataTransfer.setData('type_id',this.id);//保存数据--该img元素的id
                };
            }
            
            //trashes
            var dropList = document.getElementsByClassName('trash');//找到全部trash
            for(var j=0; j<dropList.length; j++){ //遍历img元素
                var t = dropList[j];
                t.ondragover = function(ev){
                    ev.preventDefault();//mouse gesture
                    $(this).children().addClass('icon-4x');
                    $('#success_msg').show();

                };
                t.ondragleave =function (ev) {
                    ev.preventDefault();//mouse gesture
                    $(this).children().removeClass('icon-4x');
                };
                t.ondrop =function (ev) {
                    ev.preventDefault();//mouse gesture
                    var type=ev.dataTransfer.getData('type_id').split('_')[0];
                    var id=ev.dataTransfer.getData('type_id').split('_')[1];

                    $.ajax({
                        type:'get',
                        url:"/"+type+"/delete/"+id,
                        success : function(data){
//                            if(data.code==1){
                            showMsg(1,data);
                            $('#'+type+'_'+id).remove();

//                            }
                            console.log(data);
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });


                    $(this).children().removeClass('icon-4x');

                };
            }
            function showMsg(ele,msg){
                console.log(msg.code);
                if(msg.code==601){
                    var box=$('#msg_box');
                    box.children().addClass('btn-success');
                    box.children().html(msg.msg);
                    box.fadeIn(2000);
                    box.fadeOut(2000);
                }
            }

        });

    </script>
@endsection
