<?php

namespace MizterFrek\LaravelApiResponser\Tests\Unit;

use Illuminate\Support\Facades\Route;
use MizterFrek\LaravelApiResponser\Tests\TestCase;
use MizterFrek\LaravelApiResponser\Facades\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class MiscelaneousResponseTest extends TestCase
{
    function test_it_returns_no_content_response()
    {
        Route::get('no-content-response', function() {
            return ApiResponse::noContent();
        })->name('no-content-response');

        $this->get(route('no-content-response'))
            ->assertNoContent()
            ->assertStatus(Response::HTTP_NO_CONTENT)
        ;
    }

    function test_it_returns_not_found_response()
    {
        Route::get('not-found-response', function() {
            return ApiResponse::notFound();
        })->name('not-found-response');

        $this->get(route('not-found-response'))
            ->assertExactJson([
                'message' => Response::$statusTexts[404],
                'code' => Response::HTTP_NOT_FOUND,
            ])
            ->assertStatus(Response::HTTP_NOT_FOUND)
        ;
    }

    function test_it_returns_not_found_custom_response()
    {
        Route::get('not-found-custom-response', function() {
            return ApiResponse::notFound('Custom Message');
        })->name('not-found-custom-response');

        $this->get(route('not-found-custom-response'))
            ->assertExactJson([
                'message' => Response::$statusTexts[404],
                'code' => Response::HTTP_NOT_FOUND,
                'detail' => 'Custom Message'
            ])
            ->assertStatus(Response::HTTP_NOT_FOUND)
        ;
    }

    function test_it_returns_unauthorized_response()
    {
        Route::get('unauthorized-response', function() {
            return ApiResponse::unauthorized();
        })->name('unauthorized-response');

        $this->get(route('unauthorized-response'))
            ->assertExactJson([
                'message' => Response::$statusTexts[401],
                'code' => Response::HTTP_UNAUTHORIZED,
            ])
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
        ;
    }

    function test_it_returns_unauthorized_custom_response()
    {
        Route::get('unauthorized-custom-response', function() {
            return ApiResponse::unauthorized('Custom Message');
        })->name('unauthorized-custom-response');

        $this->get(route('unauthorized-custom-response'))
            ->assertExactJson([
                'message' => Response::$statusTexts[401],
                'code' => Response::HTTP_UNAUTHORIZED,
                'detail' => 'Custom Message'
            ])
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
        ;
    }
}