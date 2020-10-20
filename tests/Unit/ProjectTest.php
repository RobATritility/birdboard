<?php

namespace Tests\Unit;

use Tests\TestCase;
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

    /** @test */
    public function it_has_a_path()
    {
        // using named route
        $project = \App\Models\Project::factory()->create();

        $this->assertEquals('/projects/'.$project->id, $project->path());
    }

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $project = \App\Models\Project::factory()->create();

        $this->assertInstanceOf('App\Models\User', $project->owner);

    }
}
