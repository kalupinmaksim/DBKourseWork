<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-material-design.css">
    <link href="css/ripples.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-12 ">
            <br>
            <div class="col-sm-10 table-list card card-1">
                <div class="form-group is-empty">
                    <label for="carType" class="col-md-2 control-label">Вид транспорта</label>
                    <div class="col-md-10">
                        <select class="form-control" name="carType" id="carType">
                            <option value="">Укажите вид транспорта</option>
                            <option value="1">легковые</option>
                        </select>
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="carMark" class="col-md-2 control-label">Марка</label>
                    <div class="col-md-10">
                        <select class="form-control" name="carMark" id="carMark">
                            <option value="">-</option>
                        </select>
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="carModel" class="col-md-2 control-label">Модель</label>
                    <div class="col-md-10">
                        <select class="form-control" name="carModel" id="carModel">
                            <option value="">-</option>
                        </select>
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="carGeneration" class="col-md-2 control-label">Поколение</label>
                    <div class="col-md-10">
                        <select class="form-control" name="carGeneration" id="carGeneration">
                            <option value="">-</option>
                        </select>
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="carSerie" class="col-md-2 control-label">Серия</label>
                    <div class="col-md-10">
                        <select class="form-control" name="carSerie" id="carSerie">
                            <option value="">-</option>
                        </select>
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="carModification" class="col-md-2 control-label">Модификация</label>
                    <div class="col-md-10">
                        <select class="form-control" name="carModification" id="carModification">
                            <option value="">-</option>
                        </select>
                        <select class="form-control" style="display:none" name="carModificationEquipment" id="carModificationEquipment">
                            <option value="">-</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div id="characteristic">

                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div id="charValue">

                        </div>
                    </div>
                </div>
            </div>
            <a href="admin" class="btn btn-raised btn-primary">Admin Panel</a>
        </div>
    </div>
</div>

    <script src="js/jquery.js"></script>
    <script src="js/material.js"></script>
    <script>
        $.material.init();
    </script>
<script type="text/javascript">
    jQuery('body').on('change','#carType',function(){
        jQuery.ajax({
            type: "POST",
            url: '/test/public/',
            data: {'_token': '{{ csrf_token() }}', 'name':'mark' },
            success: function( msg ) {
                $('#carMark').empty().prepend( $('<option value="0">Выберите Марку</option>'));
                var res = jQuery.parseJSON(msg);
                for(i=0;i<res.length;i++){
                    $('#carMark').append('<option value="' + res[i].id_mark + '">' + res[i].name + '</option>');
                }
            }}
        )});

    jQuery('body').on('change','#carMark',function(){
        jQuery.ajax({
            type: "POST",
            url: '/test/public/',
            data: {'_token': '{{ csrf_token() }}', 'name':'model','mark': $("select#carMark").val()},
            success: function( msg ) {
                $('#carModel').empty().prepend( $('<option value="0">Выберите Модель</option>'));
                var res = jQuery.parseJSON(msg);
                for(i=0;i<res.length;i++){
                    $('#carModel').append('<option value="' + res[i].id_model + '">' + res[i].name + '</option>');
                }
            }}
        )});

    jQuery('body').on('change','#carModel',function(){
        jQuery.ajax({
            type: "POST",
            url: '/test/public/',
            data: {'_token': '{{ csrf_token() }}', 'name':'generation','model': $("select#carModel").val()},
            success: function( msg ) {
                $('#carGeneration').empty().prepend( $('<option value="0">Выберите Поколение</option>'));
                var res = jQuery.parseJSON(msg);
                for(i=0;i<res.length;i++){
                    $('#carGeneration').append('<option value="' + res[i].id_generation + '">' + res[i].name + '</option>');
                }
            }}
        )});

    jQuery('body').on('change','#carGeneration',function(){
        jQuery.ajax({
            type: "POST",
            url: '/test/public/',
            data: {'_token': '{{ csrf_token() }}', 'name':'serie','model': $("select#carModel").val(),'generation': $("select#carGeneration").val()},
            success: function( msg ) {
                $('#carSerie').empty().prepend( $('<option value="0">Выберите Серию</option>'));
                var res = jQuery.parseJSON(msg);
                //console.log(res);
                for(i=0;i<res.length;i++){
                    $('#carSerie').append('<option value="' + res[i].id_series + '">' + res[i].name + '</option>');
                }
            }}
        )});

    jQuery('body').on('change','#carSerie',function(){
        jQuery.ajax({
            type: "POST",
            url: '/test/public/',
            data: {'_token': '{{ csrf_token() }}', 'name':'modification','model': $("select#carModel").val(),'serie': $("select#carSerie").val()},
            success: function( msg ) {
                $('#carModification').empty().prepend( $('<option value="0">Выберите Модификацию</option>'));
                var res = jQuery.parseJSON(msg);
                for(i=0;i<res.length;i++){
                    $('#carModification').append('<option value="' + res[i].id_modification + '">' + res[i].name + '</option>');
                }
            }}
        )});
//-------------------------ВЫВОД ХАРАКТЕРИСТИК---------
    jQuery('body').on('change','#carModification',function(){
        jQuery.ajax({
            type: "POST",
            url: '/test/public/',
            data: {'_token': '{{ csrf_token() }}', 'name':'characteristic','modification': $("select#carModification").val()},
            success: function( msg ) {
                var res = jQuery.parseJSON(msg);
                for(i=0;i<res.characteristik.length;i++)
                {
                    if(typeof res.value[i].value !== "undefined"){
                        $('#charValue').append(res.value[i].value + ' ' + res.value[i].unit + '<br>');
                        $('#characteristic').append(res.characteristik[i].name + '<br>');
                    }

                }
            }}
        )});


</script>
</body>
</html>