<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // 
        });
        // API/* => JSON Not html
        // Handler.php : change exception laravel  default response to json format 
        // colback : function 
        
        $this->renderable(function (NotFoundHttpException $notFoundHttpException,Request $request){
            if($request->is('api/*')){
                return response([
                    'message'=>'Not Found!',
                    'error'=>404
                ],404);
            }
        });
    }
}
