<?php

namespace App\Http\Controllers\Ajax;

use App\Models\AreasConocimiento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    public function getOtrasAreas(Request $request){
        if ($request->ajax()){

            $data=AreasConocimiento::where('pk_id_area','>',100)->get();


            return \Response::json($data);

        }else{
            return redirect('/dashboard');
        }
    }
}
