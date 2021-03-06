@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('schedule.schedule')
            </div>
            <div class="col-md-4">

                <div class="card" >
                    <div class="card-header">To Do List <span class=" hidden-xs"><i class="icon-2x icon-trash pull-right trash"   style="right: 5%;  "></i></span></div>
                    @include('task.list')
                </div>
            </div>
        </div>
        {{--Modal--}}
        <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" >
            <div class="modal-dialog" role="document" id="task_add" style="width: 300px">
                @include('task.detail')
            </div>
        </div>


    </div>

    <div class="" id="msg_box" tabindex="-1" style=" top:0;left:44%;text-align: center; display: none;position: fixed;z-index: 1050" ><button class="btn"></button></div>


    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //trashes
            var dropList = document.getElementsByClassName('trash');//找到全部trash
            for(var j=0; j<dropList.length; j++){ //遍历img元素
                var t = dropList[j];
                t.ondragover = function(ev){
                    ev.preventDefault();//mouse gesture
                };
                t.ondrop =function (ev) {
                    ev.preventDefault();//mouse gesture
                    var type=ev.dataTransfer.getData('type_id').split('_')[0];
                    var id=ev.dataTransfer.getData('type_id').split('_')[1];
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
                };
            }

            //finish

            $('input:checkbox').change(function(){
                var type=$(this).parent().next().attr('id').split('_')[0];
                var id=$(this).parent().next().attr('id').split('_')[1];
                        console.log($(this).parent().next().attr('id'));
                if(type=='task' &&id){
                    var status=$(this).is(':checked')?2:1;
                    $.ajax({
                        type:'POST',
                        url:"/"+type+"/updateStatus/"+id+"/status/"+status,
                        success : function(data){
                            showMsg({code: 1,msg: "Finished!"});
                        },
                        error: function () {
                            showMsg({code: 601,msg: "Fail!"});
                        }
                    });
                }

            });

        });

    </script>
@endsection
