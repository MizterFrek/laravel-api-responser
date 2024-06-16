<?php

namespace MizterFrek\LaravelApiResponser\Tests\Unit;

use Illuminate\Support\Facades\Route;
use MizterFrek\LaravelApiResponser\Tests\TestCase;
use MizterFrek\LaravelApiResponser\Facades\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class SuccessResponseTest extends TestCase
{
    function test_it_returns_success_collection_response()
    {
        Route::get('collect-data-response', function() {
            $data = [
                [ 'id' => 1, 'name' => 'custom 1'],
                [ 'id' => 2, 'name' => 'custom 2'],
                [ 'id' => 3, 'name' => 'custom 3'],
            ];

            return ApiResponse::success($data);
        })->name('collect-data-response');

        $this->get(route('collect-data-response'))
            ->assertExactJson([
                'message' => 'OK',
                'code' => Response::HTTP_OK,
                'data' => [
                    [ 'id' => 1, 'name' => 'custom 1'],
                    [ 'id' => 2, 'name' => 'custom 2'],
                    [ 'id' => 3, 'name' => 'custom 3'],
                ]
            ])
            ->assertStatus(Response::HTTP_OK)
        ;
    }

    function test_it_returns_success_array_response_with_custom_params()
    {
        Route::get('custom-message-data-response', function() {
            $data = 'Hello World!';
            return ApiResponse::success($data, Response::HTTP_ACCEPTED, 'Custom Message');
        })->name('custom-message-data-response');

        $this->get(route('custom-message-data-response'))
            ->assertExactJson([
                'message' => 'Custom Message',
                'code' => Response::HTTP_ACCEPTED,
                'data' => 'Hello World!'
            ])
            ->assertStatus(Response::HTTP_ACCEPTED)
        ;
    }
}