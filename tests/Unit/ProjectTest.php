<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_test()
    {
        $this->assertTrue(true);
    }

    public function it_has_a_path()
    {
        // not working do named route
        $project = \App\Models\Project::factory()->create();

        $this->assertEquals('/projects/'.$project->id, $project->path());
    }
}
