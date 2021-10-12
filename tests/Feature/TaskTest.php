<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TaskTest extends TestCase
{
//    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_past_task()
    {
        $task = Task::factory()->create([
            'due_date' => '2021-10-11'
        ]);
        $this->assertTrue($task->isPast());
    }

    public function test_create_urgent_task()
    {
        $task = Task::factory()->create([
            'due_date' => now()->addDays(2)
        ]);
        $this->assertTrue($task->isUrgent());
    }

    public function test_access_tasks_with_no_auth()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertRedirect("/login");
    }

    public function test_access_tasks_with_auth()
    {
        $user = User::factory()->create();
//        $response = $this->post('/login', [
//            'email' => $user->email,
//            'password' => 'password',
//        ]);
        $auth = Auth::loginUsingId($user->id);
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
    }

    public function test_create_new_task()
    {
        $user = User::factory()->create([
            'role' => 'ADMIN'
        ]);
        $auth = Auth::loginUsingId($user->id);
        $response = $this->post(route('tasks.store'), [
            'title' => '......',
            'detail' => '........',
            'due_date' => now()->addDays(5)->format('Y-m-d'),
            'tags' => 'test,feature test'
        ]);
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tags', [
            'name' => 'test'
        ]);
        $this->assertDatabaseHas('tags', [
            'name' => 'feature test'
        ]);
    }

    public function test_guest_cannot_create_task()
    {
        $response = $this->post(route('tasks.store'), [
            'title' => '......',
            'detail' => '........',
            'due_date' => now()->addDays(5)->format('Y-m-d'),
            'tags' => 'test,feature test'
        ]);
        $response->assertRedirect('/login');
    }

}
