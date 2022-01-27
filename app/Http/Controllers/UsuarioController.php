<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beca;
//use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    
public function inicioSesionUsuario(Request $data){
    return $data->all();
}

public function registrarBeca(Request $data){

//DB::beginTransaction();
try{
    $beca = Beca::where('nombre', $data->nombre)->first();

    if($beca){
        $respuesta=[
            'estatus'=>'error',
            'mensaje'=>'La beca ya existe'
        ];
        return response()->json($respuesta,200);
    }

    $beca = new Beca();
    $beca->nombre = $data->nombre;
    $beca->descripcion = $data->descripcion;
    $beca->requerimientos = $data->requerimientos;
    $beca->documentos = $data->documentos;
    $beca->receptor = $data->receptor;
    $beca->monto = $data->monto;
    $beca->save();

    $respuesta=[
'estatus'=>'exito',
'mensajes'=>'Se agrego la beca correctamente'
    ];

   // DB::commit();
    return response()->json($respuesta,200);
}catch(\Exception $e){
//DB::rollback();
$respuesta=[
'estatus'=>'error',
'mensaje'=>'Ocurrio un error al agregar beca'
];
return response()->json($respuesta, 500);
}


}

}
