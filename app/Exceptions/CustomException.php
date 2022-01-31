<?php

namespace App\Exceptions;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\Exception;

class CustomException extends Exception
{

 /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->view(
                'errors.custom',
                array(
                    'exception' => $this
                )
        );
    }
}
