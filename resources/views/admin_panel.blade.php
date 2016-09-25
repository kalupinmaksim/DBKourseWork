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
        <div class="col-sm-12 card card-1">
            <div class="row">
                <div class="textbox h2">Insert</div>
                <div class="col-sm-12">
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
                                <input class="form-control" id="generation"  name="generation" placeholder="Generation">
                            </div>
                            <div class="col-md-3">
                                <input class="form-control"  name="year_start" placeholder="year_start">
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
                                <input class="form-control" id="modification"  name="modification" placeholder="Модификация">
                            </div>
                            <div class="col-md-3">
                                <input class="form-control"  name="year_start_production" placeholder="year_start_production">
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" name="year_end_production" placeholder="year_end_production">
                            </div>
                        </div>
                        <br>
                        <input class="btn btn-raised btn-primary" type="submit">
                    </form>
                    <br>
                </div>

            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12 card card-1">
            <div class="textbox h2">Update</div>

        </div>
    </div>
</div>

<script src="js/jquery.js"></script>
<script src="js/material.js"></script>
<script>
    $.material.init();
</script>
</body>
</html>