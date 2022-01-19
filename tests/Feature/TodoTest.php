<?php

namespace Tests\Feature;

use App\Models\Todo;
use Database\Seeders\TodoTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Database\Seeders\ProjectTableSeeder;

class TodoTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(UsersTableSeeder::class);
        $this->seed(ProjectTableSeeder::class);
        $this->seed(TodoTableSeeder::class);
    }

    public function testGetTodos()
    {
        $response = $this->get('/api/todos', ['Accept' => 'application/json']);

        $response->assertStatus(200);
    }

    public function testGetOneTodo()
    {
        $response = $this->get('/api/todos/1', ['Accept' => 'application/json']);

        $response->assertStatus(200);
    }

    public function testCreateTodo()
    {
        $description = 'New Todo';

        $user = \App\Models\User::find(1);

        $response = $this->actingAs($user, 'api')->post('/api/todos', [
            'description' => $description,
            'project_id' => 1
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);

        $todo = Todo::find(2);

        $this->assertSame($todo->id, 2);
        $this->assertSame($todo->description, $description);
        $this->assertSame($todo->state, 'Todo');
    }

    public function testUpdateTodo()
    {
        $todoId = 1;
        $description = 'Updated Todo';

        $response = $this->put('/api/todos/' . $todoId, [
            'description' => $description,
            'mark_done' => true
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);

        $todo = Todo::find($todoId);

        $this->assertSame($todo->description, $description);
        $this->assertSame($todo->state, 'Done');
    }

    public function testDeleteTodo()
    {
        $todoId = 1;

        $response = $this->delete('/api/todos/' . $todoId, ['Accept' => 'application/json']);

        $response->assertStatus(204);

        $todo = Todo::find($todoId);

        $this->assertNull($todo);
    }
}
