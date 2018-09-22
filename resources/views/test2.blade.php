<!DOCTYPE html>
<html>
<head>
    <title>Laravel Bootstrap Datepicker</title>
    <script src="{{ asset('storage/js/jquery-3.3.1.js') }}" ></script>
    <script src="{{ asset('storage/js/bootstrap-datepicker.js') }}" ></script>
    <script src="{{ asset('storage/js/ckeditor.js') }}" ></script>
    <link href="{{ asset('storage/css/bootstrap-datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>


    选择日期：<input type="text" id="datepicker"  readonly>
    <div id="schedule">siejfal<p>sdfadfadfsdf</p></div>
    <button onclick="c()">haha</button>

     <textarea  id="content2" name="content2" >ss</textarea>  


</body>
<script>
    $(document).ready(function () {
        BalloonEditor
                .create(document.querySelector('#schedule'))
                .then(editor => {
                    console.log(editor);
                    theEditor = editor;
                })
                .catch(error => {
                    console.error(error)
                });

        $(document).off('.datepicker.data-api');
        $('#datepicker').datepicker({
            format:'yyyy-mm-dd'
        }).on('changeDate', function (e) {
            console.log($("#datepicker").val());
        });
    });
    function c(data){
//        theEditor.setData('<p>sdfsd哈哈哈f</p>');
        console.log(data);

    }
</script>
</html>