<?php

namespace Tests\Feature;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase, Authenticatable;

    /** @test */
    public function guests_cannot_create_projects()
    {
        $attributes = \App\Models\Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_projects()
    {

        $this->get('/projects')->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_a_single_project()
    {

        $project = \App\Models\Project::factory()->create();

        $this->get($project->path())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {

        $user = \App\Models\User::factory()->create();

        $this->withoutExceptionHandling();

        $this->actingAs(\App\Models\User::factory()->create());


        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->be(\App\Models\User::factory()->create());

        $this->withoutExceptionHandling();

        $project = \App\Models\Project::factory()->create(['owner_id' => auth()->id()]);

        //maybe make named route
        $this->get('/projects/'.$project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->actingAs(\App\Models\User::factory()->create());

        $attributes = \App\Models\Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }


    /** @test */
    public function a_project_requires_a_description()
    {
        $this->actingAs(\App\Models\User::factory()->create());

        $attributes = \App\Models\Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @testR */
    public function a_project_requires_an_owner()
    {
        $attributes = \App\Models\Project::factory()->raw(['owner_id' => null]);

        $this->post('/projects', $attributes)->assertSessionHasErrors('owner_id');
    }



}
