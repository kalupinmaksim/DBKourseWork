@extends('layouts.homelay')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 card card-1">
            <div class="textbox h2">Insert</div>
            <form action="AddData" method="post">
                {{ csrf_field() }}

                <div class="form-group is-empty">
                    <label for="inputEmail" class="col-md-2 control-label">Марка</label>
                    <div class="col-md-10">
                        <input class="form-control" id="mark" type="text" name="mark" placeholder="Mark">
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="model" class="col-md-2 control-label">Модель</label>
                    <div class="col-md-10">
                        <input class="form-control" id="model" name="model" placeholder="Model">
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="generation" class="col-md-2 control-label">Поколение</label>
                    <div class="col-md-4">
                        <input class="form-control" id="generation" name="generation" placeholder="Generation">
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" name="year_start" placeholder="year_start">
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" name="year_end" placeholder="year_end">
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="serie" class="col-md-2 control-label">Серия</label>
                    <div class="col-md-10">
                        <input class="form-control" id="serie" name="serie" placeholder="Serie">
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="modification" class="col-md-2 control-label">Модификация</label>
                    <div class="col-md-4">
                        <input class="form-control" id="modification" name="modification" placeholder="Модификация">
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" name="year_start_production" placeholder="year_start_production">
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" name="year_end_production" placeholder="year_end_production">
                    </div>
                </div>
                <br>
                <div class="form-group is-empty">
                    <div class="form-group label-floating  col-md-2">
                        <label class="control-label" for="enginepower">Мощность Двигателя</label>
                        <input class="form-control" id="enginepower" name="enginepower" type="text">
                    </div>

                    <div class="form-group label-floating col-md-2">
                        <label class="control-label" for="focusedInput2">КПП</label>
                        <input class="form-control" id="focusedInput2" name="charct2" type="text">
                    </div>

                    <div class="form-group label-floating col-md-2">
                        <label class="control-label" for="focusedInput2">Топливо</label>
                        <input class="form-control" id="focusedInput2" name="charct3" type="text">
                    </div>

                    <div class="form-group label-floating col-md-2">
                        <label class="control-label" for="maximumSpeed">Макс. скорость</label>
                        <input class="form-control" id="maximumSpeed" name="charct4" type="text">
                    </div>

                    <div class="form-group label-floating col-md-2">
                        <label class="control-label" for="focusedInput2">Разгон до 100 км/ч</label>
                        <input class="form-control" id="focusedInput2" name="charct5" type="text">
                    </div>

                    <div class="form-group label-floating col-md-2">
                        <label class="control-label" for="focusedInput2">Объем двигателя</label>
                        <input class="form-control" id="focusedInput2" name="charct6" type="text">
                    </div>
                </div>
                <br>
                <input class="btn btn-raised btn-primary" type="submit">
            </form>
            <br>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12 card card-1">
            <div class="textbox h2">Update/Delete</div>

            <div class="col-sm-12 table-list">
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
                        <select class="form-control" style="display:none" name="carModificationEquipment"
                                id="carModificationEquipment">
                            <option value="">-</option>
                        </select>
                    </div>
                </div>

                <form method="post" action="UpdateData">

                    <div class="form-group label-floating col-md-12">
                        <label id="labelname" class="control-label" for="NewName">Новое имя поля</label>
                        <input class="form-control" id="NewName" name="newName" type="text">
                    </div>

                    <div class="col-md-12">
                        <input id="updateBtn" class="btn btn-raised btn-primary" value="Update" type="button">
                        <input type="button" id="deleteBtn" class="btn btn-raised btn-danger" value="delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var UpdateName;
    var UpdateID;
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
        UpdateName = 'mark';
        UpdateID = $("select#carMark").val();
        request('model', 'carModel', 'Модель', $("select#carMark").val());
    });

    jQuery('body').on('change', '#carModel', function () {
        UpdateName = 'model';
        UpdateID = $("select#carModel").val();
        request('generation', 'carGeneration', 'Поколение', undefined, $("select#carModel").val());
    });

    jQuery('body').on('change', '#carGeneration', function () {
        UpdateName = 'generation';
        UpdateID = $("select#carGeneration").val();
        request('serie', 'carSerie', 'Серию', undefined, $("select#carModel").val(), $("select#carGeneration").val());
    });

    jQuery('body').on('change', '#carSerie', function () {
        UpdateName = 'serie';
        UpdateID = $("select#carSerie").val();
        request('modification', 'carModification', 'Модификацию', undefined, $("select#carModel").val(), undefined, $("select#carSerie").val());
    });
    //-------------------------ВЫВОД ХАРАКТЕРИСТИК---------
    jQuery('body').on('change', '#carModification', function () {
        UpdateName = 'modification';
        UpdateID = $("select#carModification").val();
    });
    //----------------------------------------UPDATE/DELETE-------------
    function UpdDel(act){
        jQuery.ajax({
                    type: "POST",
                    url: '/test/public/UpdateData',
                    data: {'_token': '{{ csrf_token() }}','act': act, 'name': UpdateName, 'id': UpdateID, 'newName': $('#NewName').val()},
                    success: function () {
                        location.reload();
                    }
                }
        )
    }

    jQuery('body').on('click', '#updateBtn', function () {
        UpdDel('update')
    });

    jQuery('body').on('click', '#deleteBtn', function () {
        UpdDel('delete')
    });


</script>
@endsection