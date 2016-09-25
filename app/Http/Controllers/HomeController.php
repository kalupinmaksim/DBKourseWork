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
    //вспомогательна ф-я для добавления в таблицу char_value

    function addDB_admin(Request $data){
        if($data->mark!=""){
            $mark = Mark::firstOrCreate(['name' => $data->mark]);
            $mark->save();
            $id_mark = $mark->id;

            if($data->model!=""){
                $model = CarModel::firstOrCreate([
                    'name' => $data->model,
                    'id_mark' => $id_mark
                ]);
                $model->save();
                $id_model = $model->id;

                if($data->generation!=""){
                    $generation = Generation::firstOrCreate([
                        'name' => $data->generation,
                        'year_start' => $data->year_start,
                        'year_end' => $data->year_end,
                        'id_model' => $id_model
                    ]);
                    $generation->save();
                    $id_generation = $generation->id;

                    if($data->serie!=""){
                        $serie = Serie::firstOrCreate([
                            'name' => $data->serie,
                            'id_model' =>  $id_model,
                            'id_generation' => $id_generation
                        ]);
                        $serie->save();
                        $id_serie = $serie->id;

                        if($data->modification!=""){
                            $modification = Modification::firstOrCreate([
                                'name' => $data->modification,
                                'id_model' => $id_model,
                                'id_series' => $id_serie,
                                'year_start_production' => $data->year_start_production,
                                'year_end_production' => $data->year_end_production
                            ]);
                            $modification->save();
                            $id_modification = $modification->id;

                            if($data->enginepower!=""){
                                addChar_value('1',$id_modification,$data->enginepower);
                            }
                            if($data->charct2!=""){
                                addChar_value('2',$id_modification,$data->charct2);
                            }
                            if($data->charct3!=""){
                                addChar_value('3',$id_modification,$data->charct3);
                            }
                            if($data->charct4!=""){
                                addChar_value('4',$id_modification,$data->charct4);
                            }
                            if($data->charct5!=""){
                                addChar_value('5',$id_modification,$data->charct5);
                            }
                            if($data->charct6!=""){
                                addChar_value('6',$id_modification,$data->charct6);
                            }
                        }

                    }
                }

            }
            return redirect('/');
        }
    }


}
function addChar_value($id_characteristic,$id_modification,$value){
    $char = Characteristic_value::firstOrCreate([
        'id_characteristic' => $id_characteristic,
        'id_modification' => $id_modification,
        'value' => $value
    ]);
    $char->save();
}