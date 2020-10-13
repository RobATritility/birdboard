<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_project()
    {

        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_user_can_view_a_project()
    {

        $this->withoutExceptionHandling();

        $project = \App\Models\Project::factory()->create();

        //maybe make named route
        $this->get('/projects/'.$project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function a_project_requires_a_title()
    {

        // from video but needed change
        // $attributes = factory('App\Models\Project')->raw(['title' => '']);

        $attributes = \App\Models\Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }


    /** @test */
    public function a_project_requires_a_description()
    {
        $attributes = \App\Models\Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');

//        $this->assertTrue(true);

    }

    /** @test */
    public function a_project_requires_an_owner()
    {
//        $this->withoutExceptionHandling();

        $attributes = \App\Models\Project::factory()->raw(['owner_id' => null]);

//        $this->post('/projects', $attributes)->assertSessionHasErrors(['name' => 'The name field is required.']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('owner_id');

//        $this->post('/projects', $attributes)->assertRedirect('login');

//        $this->assertTrue(true);
    }
}
