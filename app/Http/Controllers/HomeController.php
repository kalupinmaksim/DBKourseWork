<?php

namespace App\Http\Controllers;

use App\Model;
use Illuminate\Http\Request;
//gzip
use App\Http\Requests;
use App\Mark;
use App\CarModel;
use App\Generation;
use App\Serie;
use App\Modification;
use App\Characteristic;
use App\Characteristic_value;
class HomeController extends Controller
{
    function get(Request $data){
        //TODO: заменить на свич
        if($data->name=='mark'){
            $model = Mark::all()->toJson();
        }
        if($data->name=='model'){
            $model = CarModel::where('id_mark','=',$data->mark)->get()->toJson();
        }
        if($data->name=='generation'){
            $model = Generation::where('id_model','=',$data->model)->get()->toJson();
        }
        if($data->name=='serie'){
            $model = Serie::where('id_model','=',$data->model)->where('id_generation','=',$data->generation)->get()->toJson();
        }
        if($data->name=='modification'){
            $model = Modification::where('id_model','=',$data->model)->where('id_series','=',$data->serie)->get()->toJson();
        }
        if($data->name=='characteristic'){
            $model1 = Characteristic::all();
            $char = Characteristic_value::where('id_modification','=',$data->modification)->get();
            $model = array('characteristik'=>$model1,'value'=>$char);
            return json_encode($model);
        }


        return $model;
    }
    function start(){
        return view('start');
    }
    //Открытие панели админа
    function start_admin_panel(){
        return view('admin_panel');
    }
    // добавление данных в БД
    function addDB_admin(Request $data){
        if($data->mark!=""){
            $mark = new Mark;
            $mark->name = $data->mark;
            $mark->save();
            $id_mark = $mark->id;
            if($data->model!=""){
                $model = new CarModel;
                $model->id_mark = $id_mark;
                $model->name = $data->model;
                $model->save();
                $id_model = $model->id;
                if($data->generation!=""){
                    $generation = new Generation;
                    $generation->id_model = $id_model;
                    $generation->year_start = $data->year_start;
                    $generation->year_end = $data->year_end;
                    $generation->name = $data->generation;
                    $generation->save();
                    $id_generation = $generation->id;
                    if($data->serie!=""){
                        $serie = new Serie;
                        $serie->id_model = $id_model ;
                        $serie->id_generation = $id_generation;
                        $serie->name = $data->serie;
                        $serie->save();
                        $id_serie = $serie->id;
                        if($data->modification!=""){
                            $modification = new Modification;
                            $modification->id_model = $id_model ;
                            $modification->id_series = $id_serie;
                            $modification->year_start_production = $data->year_start_production;
                            $modification->year_end_production = $data->year_end_production;
                            $modification->name = $data->modification;
                            $modification->save();
                        }

                    }
                }

            }
            return redirect('/');
        }
    }
}
