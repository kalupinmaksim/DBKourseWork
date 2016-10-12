@extends('layouts.homelay')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 ">
            <br>
            <div class="table-list card-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Выберите Автомобиль</h3>
                    </div>
                    <div class="panel-body">
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
                        <div class="row HiddenInputs">
                            <div id="CommentContainer" class="col-md-10 col-md-offset-1">
                               <table id="commentBox" class="table table-striped table-hover ">
                                   <thead>
                                        <tr >
                                            <td>Комментарии</td>
                                        </tr>
                                   </thead>
                               </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input id="arendBtn" style="visibility: hidden;" type="submit" class="btn btn-raised btn-primary" value="Арендовать">
        </div>
    </div>
</div>

    <script src="js/jquery.js"></script>
    <script src="js/material.js"></script>
    <script>
        $.material.init();
    </script>
<script type="text/javascript">
    var mark;
    var model;
    var generation;
    var serie;
    var modification;
    function request(name, sel, optName, mark, model, generation, serie) {
        jQuery.ajax({
            type: "POST",
            url: '/test/public/',
            data: {
                '_token': '{{ csrf_token() }}',
                'name': name,
                'mark': mark,
                'model': model,
                'generation': generation,
                'serie': serie
            },
            success: function (msg) {
                $('#' + sel).empty().prepend($('<option value="0">Выберите' + optName + '</option>'));
                var res = jQuery.parseJSON(msg);
                for (i = 0; i < res.length; i++) {
                    $('#' + sel).append('<option value="' + res[i].id + '">' + res[i].name + '</option>');
                }

            }
        })
    }
    jQuery('body').on('change', '#carType', function () {
        request('mark', 'carMark', 'Марку');
    });

    jQuery('body').on('change', '#carMark', function () {
        mark = $("select#carMark").val();
        request('model', 'carModel', 'Модель', $("select#carMark").val());
    });

    jQuery('body').on('change', '#carModel', function () {
        model = $("select#carModel").val();
        request('generation', 'carGeneration', 'Поколение', undefined, $("select#carModel").val());
    });

    jQuery('body').on('change', '#carGeneration', function () {
        generation = $("select#carGeneration").val();
        request('serie', 'carSerie', 'Серию', undefined, $("select#carModel").val(), $("select#carGeneration").val());
    });

    jQuery('body').on('change', '#carSerie', function () {
        serie = $("select#carSerie").val();
        request('modification', 'carModification', 'Модификацию', undefined, $("select#carModel").val(), undefined, $("select#carSerie").val());
    });
//-------------------------ВЫВОД ХАРАКТЕРИСТИК---------
    jQuery('body').on('change','#carModification',function(){
        modification = $("select#carModification").val();
        jQuery.ajax({
            type: "POST",
            url: '/test/public/',
            data: {'_token': '{{ csrf_token() }}', 'name':'characteristic','modification': $("select#carModification").val()},
            success: function( msg ) {
                document.getElementById('CommentContainer').style.visibility='visible';
                document.getElementById('arendBtn').style.visibility='visible';
                var res = jQuery.parseJSON(msg);
                $("#characteristic").empty();
                $("#charValue").empty();
                for(i=0;i<res.characteristik.length;i++)
                {
                    if(typeof res.value[i].value !== "undefined"){
                        $('#charValue').append(res.value[i].value + ' ' + res.value[i].unit + '<br>');
                        $('#characteristic').append(res.characteristik[i].name + '<br>');
                    }

                }
                for(i=0;i<res.comment.length;i++){
                    $('#commentBox').append('<tr class="info"><td>'+res.comment[i].comment+'</td></tr>');
                }
            }}
        )});
//-------------------АРЕНДА--------
    jQuery('body').on('click','#arendBtn',function(){
        jQuery.ajax({
            type: "POST",
            url: '/test/public/arend',
            data: {'_token': '{{ csrf_token() }}',
                'mark': mark,
                'model': model,
                'generation': generation,
                'serie': serie,
                'modification': modification
            },
            success: function( msg ) {
                location.reload();
            }}
        )});

</script>
@endsection