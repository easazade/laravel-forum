<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase {
    use CreatesApplication;

    function signIn(User $user = null) {
        $user = $user ?: create(User::class);
        $this->be($user);
        return $this;
    }

}
