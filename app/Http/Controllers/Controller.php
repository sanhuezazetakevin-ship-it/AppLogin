<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Respuesta JSON estandarizada para operaciones exitosas (Ideal para APIs/Postman).
     *
     * @param mixed $data Datos que se enviarán al cliente.
     * @param string $message Mensaje de confirmación opcional.
     * @param int $code Código de estado HTTP (por defecto 200 OK).
     * @return JsonResponse
     */
    protected function sendSuccess($data, string $message = 'Operación exitosa', int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    /**
     * Respuesta JSON estandarizada para manejo de errores (Ideal para APIs/Postman).
     *
     * @param string $error Mensaje de error principal.
     * @param array $errorMessages Detalles adicionales del error (ej. fallas de validación).
     * @param int $code Código de estado HTTP (por defecto 404 Not Found u otros).
     * @return JsonResponse
     */
    protected function sendError(string $error, array $errorMessages = [], int $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
};