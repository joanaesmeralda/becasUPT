<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumnos;

use App\Administrador;
//use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    
public function inicioSesionUsuario(Request $data){
    //$alumno=Alumnos::where('matricula',$data->matricula && 'correo',$data->correo)->first();
    
    try{
        $alumno=Alumnos::where('nombre',$data->nombre)->first();
        $respuesta=[
            'matricula'=>$alumno->matricula,
            'nombre'=>$alumno->nombre,
            'apellidos'=>$alumno->apellidos,
            'correo'=>$alumno->correo,
            'cuatrimestre'=>$alumno->cuatrimestre,
            'carrera'=>$alumno->carrera,
            'modalidad'=>$alumno->modalidad
    
        ];
        return response()->json($respuesta,200);

    }catch(\Exception $e){

        $respuesta=[
            'estatus'=>'error',
            'mensaje'=>'No se pudo iniciar sesion'
        ];
        return response()->json($respuesta,500);
    }
    
}

public function iniciarSesionAdmin(Request $data){
try{
$admin=Administrador::where('usuario',$data->usuario)->first();
$respuesta=[
    'nombre'=>$admin->nombre,
    'apellidos'=>$admin->apellidos,

];
return response()->json($respuesta,200);
}catch(\Exception $e){
$respuesta=[
            'estatus'=>'error',
            'mensaje'=>'No se pudo iniciar sesion administrador'
        ];
        return response()->json($respuesta,500);
}
}

public function registrarAlumno(Request $data){
    try{
$alumno = Alumnos::where('nombre',$data->nombre)->first();

if($alumno){
    $respuesta=[
        'estatus'=>'error',
        'mensaje'=>'el alumno ya esta registrado'
    ];
    return response()->json($respuesta,200);
}

$alumno = new Alumnos();
$alumno -> matricula = $data->matricula;
$alumno->nombre = $data->nombre;
$alumno->apellidos = $data -> apellidos;
$alumno->correo = $data ->correo;
$alumno->cuatrimestre = $data -> cuatirmestre;
$alumno->carrera=$data->carrera;
$alumno->modalidad=$data->modalidad;
$alumno->save();

$respuesta=[
    'estatus'=>'exito',
    'mensaje'=>'Se agrego el alumno correctamente'
        ];

        return response()->json($respuesta,200);
    }catch(\Exception $e){
        $respuesta=[
            'estatus'=>'error',
            'mensaje'=>'Ocurrio un error al agregar alumno'
            ];
            return response()->json($respuesta, 500);
    }
}
}
