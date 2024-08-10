<?php

namespace App\Traits;
use \Symfony\Component\HttpFoundation\Response;
// use Illuminate\Http\Response;

trait ResponseTrait
{
    protected $successMsg = "Acción realizada correctamente";
    protected $errorMsg = "Sucedió un error inesperado, intentelo mas tarde o pongase en contacto con el administrador del sistema";
    protected $notFoundMsg = "Recuerso no encontrado";
    protected $UnautorizedMsg = "Acceso denegado";

    protected function responseCreated($data = []){
        return response([
            'success' => true,
            'data' => $data
        ], Response::HTTP_CREATED);
    }

    protected function responseOk($data = []){
        return response([
            'success' => true,
            'data' => $data,
        ], Response::HTTP_OK);
    }

    protected function responseNotFound($message = null){
        return response([
            'success' => true,
            'message' => is_null($message) ? $this->notFoundMsg : $message,
            'data' => [],
        ], Response::HTTP_NOT_FOUND);
    }

    protected function responseUnautorized($message = null){
        return response([
            'success' => true,
            'message' => is_null($message) ? $this->UnautorizedMsg : $message,
            'data' => [],
        ], Response::HTTP_UNAUTHORIZED);
    }

    protected function responseError($error = '', $message = null, $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response([
            'success' => false,
            'message' => is_null($message) ? $this->errorMsg : $message,
            'error' => $error,
        ], $statusCode);
    }

    protected function responseSuccess($data = [], $statusCode = Response::HTTP_OK)
    {
        return response([
            'success' => true,
            'data' => $data,
        ], $statusCode);
    }
}
