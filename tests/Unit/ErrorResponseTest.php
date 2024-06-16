<?php

namespace MizterFrek\LaravelApiResponser\Tests\Unit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use MizterFrek\LaravelApiResponser\Tests\TestCase;
use MizterFrek\LaravelApiResponser\Facades\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponseTest extends TestCase
{
    function test_it_returns_default_error_response()
    {
        Route::get('error-response', function() {
            return ApiResponse::error();
        })->name('error-response');

        $this->get(route('error-response'))
            ->assertExactJson([
                'message' => Response::$statusTexts[500],
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ])
            ->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
        ;
    }

    function test_it_returns_custom_error_response()
    {
        Route::get('custom-error-response', function() {
            return ApiResponse::error(Response::HTTP_CONFLICT, 'Custom message error');
        })->name('custom-error-response');

        $this->get(route('custom-error-response'))
            ->assertExactJson([
                'message' => Response::$statusTexts[409],
                'code' => Response::HTTP_CONFLICT,
                'detail' => 'Custom message error'
            ])
            ->assertStatus(Response::HTTP_CONFLICT)
        ;
    }

    function test_it_returns_validated_error_response()
    {
        Route::post('validated-response', function(Request $request) {
            $validator = Validator::make($request->only('name'), [
                'name' => 'required'
            ]);
            if ($validator->fails()) {
                return ApiResponse::error(
                    Response::HTTP_UNPROCESSABLE_ENTITY, 
                    'Custom message error', 
                    $validator->errors()->toArray()
                );
            }
        })->name('validated-response');

        $this->post(route('validated-response'))
            ->assertExactJson([
                'message' => Response::$statusTexts[422],
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'detail' => 'Custom message error',
                'errors' => [
                    'name' => ['The name field is required.']
                ]
            ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ;
    }
}