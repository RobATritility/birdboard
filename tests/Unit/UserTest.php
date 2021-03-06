<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    public function a_user_has_projects()
    {
        $user = \App\Models\User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }
}
