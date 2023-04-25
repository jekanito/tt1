<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\DataMail;
use Illuminate\Http\Request;
use App\Models\{
    Car,
    Car_model
};
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function main()
    {
        $cars = Car::all(['id', 'name']);

        return view('main', compact('cars'));
    }

    public function getModels(Request $request)
    {
        $car_id = $request->input('car_id');
        $models = Car_model::where('car_id', $car_id)->get();

        return response()->json([
            'data' => $models
        ]);
    }

    public function sendData(Request $request)
    {
        $car_id = $request->input('car_id');
        $model_id = $request->input('car_model');

        /*
         * знаю міг в моделях прописати відношення, але зроблено на скору руку і з економією часу
         */
        $car = Car::where('id', $car_id)->first();
        $model = Car_model::where('id', $model_id)->first();

        $data = new \stdClass();
        $data->car = $car->name;
        $data->model = $model->name;

        Mail::to('jekaezil@gmail.com')->send(new DataMail($data));

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
