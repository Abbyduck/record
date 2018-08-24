
    <div class="card-body">
        <table class="table table-hover table-condensed">
            @foreach($tasks as $task)
                <tr class="task " id="task_{{ $task->id }}" draggable="true">

                    <td><input type="checkbox"> {{ $task->content }}</td>

                </tr>
            @endforeach
        </table>
        <div class="trash" ><i class="icon-2x icon-trash pull-right" id="task_trash_icon"></i></div>


        <div id="debug"></div>
    </div>
    <div  class="card-footer">
        <form method="POST" action="{{ route('task') }}" id="task">
            @csrf
            <div class="row">
                <input type="text" name="task_content" id="task_content"  placeholder="Add a task.." style="width: 80%">
                <button class="btn" type="button" style="width: 20%" id="add_task">Add</button>
            </div>
        </form>

    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#add_task').click(function(){
                $.ajax({
                    type:'POST',
                    url:"{{ route('task')}}",
                    data:{content:$("#task_content").val()},
                    dataType:'json',
                    success : function(data){
                        console.log(data);
                        alert(data);
                    },
                    error: function (data) {
                        console.log(data);
                        alert(data);
                    }
                });
            });



//            $('#task_trash').ondragover=function (ev) {
//                $('#task_trash_icon').addClass('icon-4x');
//                console.log(1);
//            };
//            $('#task_trash').ondrop = function (ev) {
//                ev.preventDefault();
//                var id = ev.dataTransfer.getData('Text');
//                var elem = document.getElementById(id); //当前拖动的元素
//                var toElem = ev.toElement.id; //放置位置
//                if (toElem == 'right') {
//                    //如果为container,元素放置在末尾
//                    this.appendChild(elem);
//                } else {
//                    //如果为container里的元素，则插入该元素之前
//                    this.insertBefore(elem, document.getElementById(toElem));
//                }
//            }

        });

    </script>
