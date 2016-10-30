<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use App\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Mark;
use App\CarModel;
use App\Generation;
use App\Serie;
use App\Modification;
use App\Characteristic;
use App\Characteristic_value;
use App\Userauto;
use App\Comment;
use App\Rate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    function start(){
        return view('start');
    }
    //Открытие панели админа
    function start_admin_panel(){
        return view('admin_panel');
    }

    function get(Request $data){
        switch ($data->name) {
            case 'mark':
                $model = Mark::all()->toJson();
                break;
            case 'model':
                $model = CarModel::where('id_mark', '=', $data->mark)->get()->toJson();
                break;
            case 'generation':
                $model = Generation::where('id_model', '=', $data->model)->get()->toJson();
                break;
            case 'serie':
                $model = Serie::where('id_model', '=', $data->model)->where('id_generation', '=', $data->generation)->get()->toJson();
                break;
            case 'modification':
                $model = Modification::where('id_model', '=', $data->model)->where('id_series', '=', $data->serie)->get()->toJson();
                break;
            case 'characteristic':
                $characteristic = Characteristic::all();
                $modificationData = Modification::find($data->modification);
                $char = Characteristic_value::where('id_modification', '=', $data->modification)->get();
                $comment = Comment::where('id_modification', '=', $data->modification)->get();

                $model = array('characteristik' => $characteristic,
                    'value' => $char,
                    'comment' => $comment,
                    'ModificationData' => $modificationData);
                return json_encode($model);
                break;
        }
        return $model;
    }

    // добавление данных в БД
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
    public function updateDB(Request $data){
        if($data->act=='update'){
            switch ($data->name) {
                case 'mark':
                    $obj = Mark::find($data->id);
                    $obj->name=$data->newName;
                    $obj->save();
                    break;
                case 'model':
                    $update = CarModel::find($data->id);
                    $update->name=$data->newName;
                    $update->save();
                    break;
                case 'generation':
                    $update = Generation::find($data->id);
                    $update->name=$data->newName;
                    $update->save();
                    break;
                case 'serie':
                    $update = Serie::find($data->id);
                    $update->name=$data->newName;
                    $update->save();
                    break;
                case 'modification':
                    $update = Modification::find($data->id);
                    $update->name=$data->newName;
                    $update->save();
                    break;
            }
        }

        if ($data->act=='delete'){
            switch ($data->name) {
                case 'mark':
                    $delete = Mark::find($data->id);
                    $delete->delete();
                    break;
                case 'model':
                    $delete = CarModel::find($data->id);
                    $delete->delete();
                    break;
                case 'generation':
                    $delete = Generation::find($data->id);
                    $delete->delete();
                    break;
                case 'serie':
                    $delete = Serie::find($data->id);
                    $delete->delete();
                    break;
                case 'modification':
                    $delete = Modification::find($data->id);
                    $delete->delete();
                    break;
            }
        }
    }

    public function rent(Request $data){
        $rent = Userauto::firstOrCreate([
            'id_user' => Auth::id(),
            'id_mark' => $data->mark,
            'id_model' => $data->model,
            'id_generation' => $data->generation,
            'id_serie' => $data->serie,
            'id_modification' => $data->modification,
        ]);
        $rent->save();
    }

    public function Del_rent(){
        $delete = Userauto::where('id_user','=', Auth::id());
        $delete->delete();
        return redirect('/');
    }

    public function getRentReport(){
        $userAuto = Userauto::where('id_user','=',Auth::id())->first();
        if (isset($userAuto)){
            $user = User::find(Auth::id());
            $userMark = Mark::find($userAuto->id_mark);
            $userModel = CarModel::find($userAuto->id_model);
            $userGeneration = Generation::find($userAuto->id_generation);
            $userSerie = Serie::find($userAuto->id_serie);
            $userModificarion = Modification::find($userAuto->id_modification);
        }
        echo '<h1>Отчет о аренде автомобиля</h1><br><table border="1"><tr><td>Имя</td><td>Марка</td><td>Модель</td><td>Поколение</td><td>Серия</td><td>Модификация</td><td>Дата Аренды</td></tr>
<tr><td>'.$user->name.'</td><td>'.$userMark->name.'</td><td>'.$userModel->name.'</td> <td>'.$userGeneration->name.'</td> <td>'.$userSerie->name.'</td> <td>'.$userModificarion->name.'</td><td>'.$userAuto->created_at.'</td></td></tr></table>';
    }

    public function ProfileContent(){
        $userAuto = Userauto::where('id_user','=',Auth::id())->first();
        if (isset($userAuto)){
            $userMark = Mark::find($userAuto->id_mark);
            $userModel = CarModel::find($userAuto->id_model);
            $userGeneration = Generation::find($userAuto->id_generation);
            $userSerie = Serie::find($userAuto->id_serie);
            $userModificarion = Modification::find($userAuto->id_modification);

            return view('profile', ['mark'=>$userMark->name,
                'model'=>$userModel->name,
                'generation'=>$userGeneration->name,
                'serie'=>$userSerie->name,
                'modification'=>$userModificarion->name,
                'id_modification'=>$userModificarion->id,
                'rentDate'=>$userAuto->created_at,
                'rate'=>($userModificarion->rate/$userModificarion->rateCount)]);
        }
        else{
            return view('profile');
        }


    }

    public function AddComment(Request $data){
        $comment = Comment::firstOrCreate([
            'id_user' => Auth::id(),
            'id_modification' => $data->modification,
            'comment' => $data-> comment
        ]);
        $comment->save();
        return redirect('/profile');
    }

    public function UpdateRate(Request $data){

        $rate = Rate::firstOrCreate([
            'id_user' => Auth::id(),
            'id_modification' => $data->modification,
            'rate' => $data->rate
        ]);
        $update = UpdateRateCar($data->modification,$data->rate);
        return $update;
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

function UpdateRateCar($modofication, $rate){
    $obj = Modification::find($modofication);
    $obj->rateCount++;
    $obj->rate+=$rate;
    $rating = ($obj->rate)/($obj->rateCount);
    $obj->save();
    return $rating;
}
