<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beca;
use App\Postulados;

class BecaController extends Controller
{
    public function registrarBeca(Request $data)
    {

        try {
            $beca = Beca::where('nombre', $data->nombre)->first();

            if ($beca) {
                $respuesta = [
                    'estatus' => 'error',
                    'mensaje' => 'La beca ya existe'
                ];
                return response()->json($respuesta, 200);
            }

            $beca = new Beca();
            $beca->nombre = $data->nombre;
            $beca->descripcion = $data->descripcion;
            $beca->requerimientos = $data->requerimientos;
            $beca->documentos = $data->documentos;
            $beca->receptor = $data->receptor;
            $beca->monto = $data->monto;
            $beca->save();

            $respuesta = [
                'estatus' => 'exito',
                'mensaje' => 'Se agrego la beca correctamente'
            ];

            return response()->json($respuesta, 200);
        } catch (\Exception $e) {

            $respuesta = [
                'estatus' => 'error',
                'mensaje' => 'Ocurrio un error al agregar beca'
            ];
            return response()->json($respuesta, 500);
        }
    }

    public function postular(Request $data)
    {
        try {
            $postulado = new Postulados();
            $postulado->idbeca = $data->idbeca;
            $postulado->matricula = $data->matricula;
            $postulado->save();

            $respuesta = [
                'estatus' => 'exito',
                'mensaje' => 'Se postulo a la beca correctamente'
            ];

            return response()->json($respuesta, 200);
        } catch (\Exception $e) {
            $respuesta = [
                'estatus' => 'error',
                'mensaje' => 'no se pudo postular a la beca'
            ];
            return response()->json($respuesta, 500);
        }
    }

    public function eliminarBeca(Request $data)
    {
        try {
            $beca = Beca::find($data->nombre);
            $beca->delete();

            $respuesta = [
                'estatus' => 'exito',
                'mensaje' => 'Se elimino la beca'
            ];
            return response()->json($respuesta, 200);
        } catch (\Exception $e) {
            $respuesta = [
                'estatus' => 'error',
                'mensaje' => 'no se pudo eliminar la beca'
            ];
            return response()->json($respuesta, 500);
        }
    }

    public function editarbeca(Request $data)
    {
        try {
            $beca = Beca::find($data->nombre);
            $beca->nombre = $data->nombre;
            $beca->descripcion = $data->descripcion;
            $beca->requerimientos = $data->requerimientos;
            $beca->documentos = $data->documentos;
            $beca->receptor = $data->receptor;
            $beca->monto = $data->monto;
            $beca->save();

            $respuesta = [
                'estatus' => 'exito',
                'mensaje' => 'Se actualizo la beca'
            ];
            return response()->json($respuesta, 200);
        } catch (\Exception $e) {
            $respuesta = [
                'estatus' => 'error',
                'mensaje' => 'no se pudo editar la beca'
            ];
            return response()->json($respuesta, 500);
        }
    }

    public function consultarBeca(Request $data){
        try {
            $beca = Beca::where('receptor',$data->receptor)->get();
           // $beca = Beca::find($data->receptor);
            $respuesta = [
                'nombre' => $beca->nomobre,
                'descripcion' => $beca->descripcion,
                'requerimientos' => $beca->requerimeintos,
                'documentos' => $beca -> documentos,
                'receptor' => $beca -> receptor,
                'monto' => $beca -> monto
            ];
            return response()->json($respuesta, 200);
        } catch (\Exception $e) {
            $respuesta = [
                'estatus' => 'error',
                'mensaje' => 'no se pudo consultar las becas'
            ];
            return response()->json($respuesta, 500);
        }
    }
}
