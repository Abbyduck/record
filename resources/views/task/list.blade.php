
    <div class="card-body" style="overflow-y: scroll ; max-height: 500px" >
        <table class="table table-hover" id="task_table" >
        @foreach($tasks as $task)

                <tr >
                    <td><input type="checkbox"{{$task->status}}> </td>
                    <td class="task " id="task_{{ $task->id }}" draggable="true" ondragstart="dragStart(event)"  data-toggle="modal" data-target="#taskModal" data-whatever='{{ $task }}' style="color:{{ $task->color }};width:100%"> {{ $task->content }}</td>
                    <td class="visible-xs-block" ><i class="icon-2x icon-trash pull-right trash-xs " data-content="task_{{ $task->id }}" onclick="trash_xs(this )"></i></td>
                </tr>
            @endforeach

        </table>

    </div>
    <div  class="card-footer">
        <form method="POST" action="#" id="task">
            @csrf
            <div class="row">
                <input type="text" name="task_content" id="task_content"  placeholder="Add a task.." style="width: 80%">
                <button class="btn" type="button" style="width: 20%" id="add_task">Add</button>

            </div>
        </form>

    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            function taskUp(data){
                return '<tr>'+
                        '<td><input type="checkbox" '+data.status +'> </td>'+
                        '<td  class="task" id="task_'+data.id +'" draggable="true" ondragstart="dragStart(event)"  data-toggle="modal" data-target="#taskModal" data-whatever=\''+JSON.stringify(data)+'\' style="color:'+data.color +';width:100%"><input type="checkbox" > '+data.content +'</td>'+
                        ' <td class="visible-xs-block"><i class="icon-2x icon-trash pull-right trash-xs " data-content="task_'+data.id +'" onclick="trash_xs(this)" ></i></td>'+
                        '</tr>' ;
            }

            $('#add_task').click(function(){
                $.ajax({
                    type:'POST',
                    url:"{{ route('task')}}",
                    data:{content:$("#task_content").val()},
                    dataType:'json',
                    success : function(data){
                        var task = taskUp(data);console.log(task);
                        $('#task_table').append(task);
                        $('#task_content').val('');

                        showMsg({code: 1,msg: "Added!"});
                    },
                    error: function () {
                        showMsg({code: 601,msg: "Fail!"});
                    }
                });
            });
            $('#task_content').keydown(function(e){
               if(e.keyCode==13){
                   e.preventDefault();
                   $('#add_task').click();
               }
            });
            $('#task_table').delegate('tr',"click",function () {
                var top=$(this).offset().top+$(this).height();
                var left=$(this).offset().left;
                $('#task_add').css({
                    'margin-top': top,
                    'margin-left':left
                });

                $('#taskModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) ;
                    var recipient = button.data('whatever');
                    var modal = $(this);
                    modal.find('[id="id"]').val( recipient.id);
                    modal.find('[id="content"]').val( recipient.content);
                    modal.find('[id="color"]').val( recipient.color);
                    modal.find('[id="sequence"]').val( recipient.sequence);
                    modal.find('[id="deadline"]').val( recipient.deadline);
                });
            });

            $('#tsave').click(function(){
                var id=$('#id').val();
                $.ajax({
                    type:'POST',
                    url:"/task/update/"+id,
                    data:$('#task_detail').serialize(),
                    dataType:'json',
                    success : function(data){
                        console.log(data);
                        $('#taskModal').modal('hide');
                        var task = taskUp(data);
                        $('#task_'+data.id).parent().replaceWith(task);
                        showMsg({code: 1,msg: "Success!!"});
                    },
                    error: function () {
                        showMsg({code: 601,msg: "Fail!"});
                    }
                });
            });

            $(document).off('.datepicker.data-api');
            $('#deadline').datepicker({
                format:'yyyy-mm-dd'
            }).on('changeDate', function(e){
                console.log(1);
            });
        });

    </script>
