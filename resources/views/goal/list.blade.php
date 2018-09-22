
    <div class="card-body" style="overflow-y: scroll ; max-height: 500px" >
        <table class="table table-hover" id="goal_table" >
        @foreach($goals as $goal)

                <tr >
                    <td class="goal " id="goal_{{ $goal->id }}" draggable="true" ondragstart="dragStart(event)"  data-toggle="modal" data-target="#goalModal" data-whatever='{{ $goal }}' style="width:100%"><input type="checkbox" > {{ $goal->content }}</td>
                    <td class="visible-xs-block" ><i class="icon-2x icon-trash pull-right trash-xs " data-content="goal_{{ $goal->id }}" onclick="trash_xs(this )"></i></td>
                </tr>
            @endforeach

        </table>

    </div>
    <div  class="card-footer">
        <form method="POST" action="{{ route('goal') }}" id="goal">
            @csrf
            <div class="row">
                <input type="text" name="goal_content" id="goal_content"  placeholder="Add a goal.." style="width: 80%">
                <button class="btn" type="button" style="width: 20%" id="add_goal">Add</button>

            </div>
        </form>

    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            function goalUp(data){
                return '<tr>'+
                        '<td  class="goal" id="goal_'+data.id +'" draggable="true" ondragstart="dragStart(event)"  data-toggle="modal" data-target="#goalModal" data-whatever=\''+JSON.stringify(data)+'\' style="width:100%"><input type="checkbox" > '+data.content +'</td>'+
                        ' <td class="visible-xs-block"><i class="icon-2x icon-trash pull-right trash-xs " data-content="goal_'+data.id +'" onclick="trash_xs(this)" ></i></td>'+
                        '</tr>' ;
            }
            $('#add_goal').click(function(){
                $.ajax({
                    type:'POST',
                    url:"{{ route('goal')}}",
                    data:{content:$("#goal_content").val()},
                    dataType:'json',
                    success : function(data){
                        var goal = goalUp(data);console.log(goal);
                        $('#goal_table').append(goal);
                        $('#goal_content').val('');

                        showMsg({code: 1,msg: "Added!"});
                    },
                    error: function () {
                        showMsg({code: 601,msg: "Fail!"});
                    }
                });
            });
            $('#goal_content').keydown(function(e){
                if(e.keyCode==13){
                    e.preventDefault();
                    $('#add_goal').click();
                }
            });
            $('table').delegate('tr',"click",function () {
                var top=$(this).offset().top+$(this).height();
                var left=$(this).offset().left;
                $('#goal_add').css({
                    'margin-top': top,
                    'margin-left':left
                });
                $('#goalModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) ;
                    var recipient = button.data('whatever');
                    var modal = $(this);
                    modal.find('[id="gid"]').val( recipient.id);
                    modal.find('[id="content"]').val( recipient.content);
                    modal.find('[id="sequence"]').val( recipient.sequence);
                });
            });

            $('#gsave').click(function(){
                var id=$('#gid').val();
                $.ajax({
                    type:'POST',
                    url:"/goal/update/"+id,
                    data:$('#goal_detail').serialize(),
                    dataType:'json',
                    success : function(data){
                        console.log(data);
                        $('#goalModal').modal('hide');
                        var goal = goalUp(data);
                        $('#goal_'+data.id).parent().replaceWith(goal);
                        showMsg({code: 1,msg: "Success!!"});
                    },
                    error: function () {
                        showMsg({code: 601,msg: "Fail!"});
                    }
                });
            });


        });

    </script>
