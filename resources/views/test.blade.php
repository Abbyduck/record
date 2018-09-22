@extends('layouts.app')
{{--<script src="{{ asset('js/ckeditor-classic.js') }}" ></script>--}}

@section('content')
    <div class="container">
            <div id="schedule" >
                @if ($content)

                    {!! $content !!}
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
    <script>
        $(document).ready(function () {

            BalloonEditor
                    .create(document.querySelector('#schedule'))
                    .then(editor => {
                        theEditor = editor;
                    })
                    .catch(error => {
                        console.error(error)
                    });

            setInterval(function(){
                $.ajax({
                    type:'POST',
                    url:'/schedule' ,
                    data:{data:theEditor.getData()},
                    dataType:'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(){
                        console.log('hahah');
                    }
                });
                console.log(theEditor.getData());
            },60*1000);
        });
    </script>
@endsection
