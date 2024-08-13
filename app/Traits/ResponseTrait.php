<?php

namespace App\Traits;
use \Symfony\Component\HttpFoundation\Response;

trait ResponseTrait
{
    private $successMsg = "Acción realizada correctamente";
    private $errorMsg = "Sucedió un error inesperado, intentelo mas tarde o pongase en contacto con el administrador del sistema";
    private $notFoundMsg = "Recuerso no encontrado";
    private $UnautorizedMsg = "Acceso denegado";

    private function responseCreated($data = []){
        return response([
            'success' => true,
            'data' => $data
        ], Response::HTTP_CREATED);
    }

    private function responseOk($data = []){
        return response([
            'success' => true,
            'data' => $data,
        ], Response::HTTP_OK);
    }

    private function responseNotFound($message = null){
        return response([
            'success' => true,
            'message' => is_null($message) ? $this->notFoundMsg : $message,
            'data' => [],
        ], Response::HTTP_NOT_FOUND);
    }

    private function responseUnautorized($message = null){
        return response([
            'success' => true,
            'message' => is_null($message) ? $this->UnautorizedMsg : $message,
            'data' => [],
        ], Response::HTTP_UNAUTHORIZED);
    }

    private function responseError($error = '', $message = null, $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response([
            'success' => false,
            'message' => is_null($message) ? $this->errorMsg : $message,
            'error' => $error,
        ], $statusCode);
    }

    private function responseSuccess($data = [], $statusCode = Response::HTTP_OK)
    {
        return response([
            'success' => true,
            'data' => $data,
        ], $statusCode);
    }

    private function catchError($user_id, $error, $controller, $method){

        $env = config('app.env');

        // Send error to error_logs table
        $ErrorLog = new \App\Models\ErrorLog();
        $ErrorLog->saveErrorLog($user_id, $controller, $method, $error);

        // Validate if send error to end user or not
        return $env == 'local' 
            ? $this->responseError($error->getMessage()) 
            : $this->responseError();
    }
}
