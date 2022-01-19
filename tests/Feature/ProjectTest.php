<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Database\Seeders\ProjectTableSeeder;

class ProjectTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(ProjectTableSeeder::class);
    }

    public function testGetProjects()
    {
        $response = $this->get('/api/projects', ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $this->assertSame('[{"id":1,"name":"test project","created_at":null,"updated_at":null}]', $response->getContent());
    }

    public function testGetOneProject()
    {
        $response = $this->get('/api/projects/1', ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $this->assertSame('{"id":1,"name":"test project","created_at":null,"updated_at":null}', $response->getContent());
    }

    public function testCreateProject()
    {
        $projectName = 'New Project';

        $response = $this->post('/api/projects', [
            'name' => $projectName,
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);

        $project = Project::find(2);

        $this->assertSame($project->id, 2);
        $this->assertSame($project->name, $projectName);
    }

    public function testUpdateProject()
    {
        $projectId = 1;
        $projectName = 'New Project';

        $response = $this->put('/api/projects/' . $projectId, [
            'name' => $projectName,
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);

        $project = Project::find($projectId);

        $this->assertSame($project->name, $projectName);
    }
}
