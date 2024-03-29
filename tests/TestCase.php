<?php

namespace Tests;

use App\Exceptions\Handler;
use App\User;
use Exception;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase {
    use CreatesApplication;

    protected function disableExceptionHandling() {
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {
            }

            public function report(Exception $exception) {
            }

            public function render($request, Exception $exception) {
                throw $exception;
            }
        });
    }

    function signIn(User $user = null) {
        $user = $user ?: create(User::class);
        $this->be($user);
        return $this;
    }

}
