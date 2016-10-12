@extends('layouts.homelay')
@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-primary card-1">
                <div class="panel-heading">
                    <h3 class="panel-title">Profile</h3>
                </div>
                <div class="panel-body">
                    <p>Ваш Автомобиль: {{$mark." ".$model." ".$generation." ".$serie." ".$modification}}</p>
                    <p>Арендован: {{$rentDate}}</p>
                    <div class="row ">
                        <div class="col-sm-3 col-md-offset-3">
                            <div id="characteristic"></div>
                        </div>
                        <div class="col-sm-3">
                            <div id="charValue"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Ваш отзыв о автомобиле</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{url('/AddComment')}}">
                        {{ csrf_field() }}
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label for="comment">Введите отзыв</label>
                                <textarea name="comment" class="form-control" id="comment" cols="30" rows="10"></textarea>
                            </div>
                            <input type="text" name="modification" hidden value="{{$id_modification}}">
                            <input type="submit"  class="btn-raised btn btn-success">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            jQuery.ajax({
                type: "POST",
                url: '/test/public/',
                data: {'_token': '{{ csrf_token() }}', 'name':'characteristic','modification':{{$id_modification}}},
                success: function( msg ) {
                    var res = jQuery.parseJSON(msg);
                    $("#characteristic").empty();
                    $("#charValue").empty();
                    for(i=0;i<res.characteristik.length;i++)
                    {
                        if(typeof res.value[i].value !== "undefined"){
                            $('#charValue').append(res.value[i].value + ' ' + res.value[i].unit + '<br>');
                            $('#characteristic').append(res.characteristik[i].name + ':<br>');
                        }

                    }
                }}
            )});

        $()
    </script>
@endsection