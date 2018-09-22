<div class="card"  style="margin-bottom: 30px">
    <div class="card-header"><strong>Schedule</strong>
        <div class="input-group date col-3 pull-right" data-provide="datepicker" >
            <input type="text" id="datepicker" class="form-control" >
            <div class="input-group-addon">
                <i class="icon-calendar"></i>
            </div>
        </div>

        <span id="schedule_save"><i class="icon-2x icon-save pull-right  visible-xs-block"   style="right: 5%; margin-left: 20px "></i></span> </div>

    <div class="card-body">
        <div id="schedule"  name="schedule">
            @if ($schedule)
                {!! $schedule->content !!}
            @else
                <h4>Morning</h4>
                <ol>
                    <li><br data-cke-filler="true"></li>

                </ol>
                <br>
                <h4>Noon</h4>
                <ul>
                    <li><br></li>
                </ul>
                <br>
                <h4>Afternoon</h4>
                <ol>
                    <li><br data-cke-filler="true"></li>
                </ol>
                <br>
                <h4>Night</h4>
                <ul>
                    <li><br></li>
                </ul>
            @endif
        </div>
    </div>
</div>


<script >
    function saveSchedule(){
        var scheduleDate=$("#datepicker").val();
        $.ajax({
            type:'POST',
            url:'/schedule' ,
            data:{data:theEditor.getData(),date:scheduleDate},
            dataType:'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(){
                showMsg({code: 1,msg: "Schedule Updated"});
            }
        });
        console.log('save');

    }
    function getSchedule(){
        var scheduleDate=$("#datepicker").val();
        $.ajax({
            type:'GET',
            url:'/getSchedule' ,
            data:{date:scheduleDate},
            dataType:'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(data){
                if(data.code=1){
                    theEditor.setData(data.data);
                }else{
                    alert(data.data);
                }
                console.log(data);
            }
        });
    }

    $(document).ready(function () {
        BalloonEditor
            .create(document.querySelector('#schedule'))
            .then(editor => {
                theEditor = editor;
            })
            .catch(error => {
                console.error(error)
            });


        $('#schedule').keydown(function(e) {
//            console.log(e);
            if (e.keyCode == 83 && e.ctrlKey) {
                e.preventDefault();
                saveSchedule();
            }
        });

        $("#schedule_save").click(function(){
            saveSchedule();
        });
        //set Schedule default date :today

        var today= new Date();
        $('#datepicker').val(today.getFullYear()+'-'+('0' + (today.getMonth() + 1)).slice(-2)+'-'+('0' + today.getDate()).slice(-2));
        var dates= '<?php echo $disable_dates;?>';
        $(document).off('.datepicker.data-api');
        $('#datepicker').datepicker({
            autoclose:true,
            format:'yyyy-mm-dd',
            startDate:'-30d',
            endDate:'+1d',
            datesDisabled :JSON.parse( dates )
        }).on('changeDate', function(e){
            console.log('change');
            getSchedule();
        });

    });

</script>