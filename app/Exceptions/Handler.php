<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\ResponseTrait;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    use ResponseTrait; // Usar trait encargado de las respuestas

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        // Si es un error de validación
        if ($exception instanceof ValidationException) return $this->convertValidationExceptionToResponse($exception, $request);

        // Si no existe el elemento específico
        if ($exception instanceof ModelNotFoundException)
        {
            $modelo = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("No existe ninguna instancia de {$modelo} con el id especificado", 404);
        }

        // Error de autenticación
        if ($exception instanceof AuthenticationException) return $this->unauthenticated($request, $exception);

        // Url desconocida
        if ($exception instanceof NotFoundHttpException) return $this->errorResponse('No se encontró la URL solicitada', 404);

        // Metodo no correspondiente en la ruta
        if ($exception instanceof MethodNotAllowedHttpException) return $this->errorResponse('El método especificado no es válido', 405);

        // Cualquier otra excepción Http
        if ($exception instanceof HttpException) return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());

        //  Si es un error con la base de datos
        if ($exception instanceof QueryException){
            $code = $exception->errorInfo[1]; // Se obtiene el código de error

            if ($code == 1451) return $this->errorResponse('No se puede eliminar el registro porque está relacionado con otro', 409);

            if ($code == 2002) return $this->errorResponse('No se pudo establecer una conexión con la base de datos', 409);
        }

        if ($exception instanceof TokenMismatchException){
            return redirect()->back()->withInput($request->input());
        }

        if (config('app.debug')){
            return parent::render($request, $exception);
        }

        return $this->errorResponse('Ocurrió un error inesperado.', 500);
    }

    /**
     * Devuelve los mensajes de error de validación
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return App\Traits\ApiResponser
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();

        if ($this->isFrontend($request)){
            return $request->ajax() ? response()->json($errors, 422) : redirect()
                ->back()
                ->withInput($request->input())
                ->withErrors($errors);
        }

        return $this->errorResponse($errors, 422);
    }

    /**
     * Evaluar si la petición se hizo de manera normal (no asíncrona) desde el navegador
     *
     * @param Request $request
     * @return boolean
     */
    public function isFrontend($request)
    {
        return $request->acceptsHtml() && collect($request->route()->middleware())->contains('web');
    }

    /**
     * Devolver error si el usuario no está autenticado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($this->isFrontend($request)){
            return redirect()->guest('login');
        }

        return $this->errorResponse('No autenticado.', 401);
    }
}
