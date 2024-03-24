<?php

namespace Tests\Feature\Livewire\Tasks;

use App\Livewire\Tasks\Tasks;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_dashboard_renders_task()
    {
        $this->withoutExceptionHandling();

        Livewire::actingAs(User::factory()->create());

        $this->get('/dashboard')
            ->assertStatus(200);
    }

    /** @test */
    public function test_profile_renders_task()
    {
        $this->withoutExceptionHandling();

        Livewire::actingAs(User::factory()->create());

        $this->get('/profile')
            ->assertStatus(200);
    }

    /** @test */
    public function test_can_create_task()
    {
        Livewire::test(Tasks::class)
            ->set('title', 'My Title')
            ->set('description', 'My awesome task description!')
            ->call('save')
            ->assertRedirect()
            ->assertHasNoErrors();
    }

    /** @test */
    public function test_can_update_task()
    {
        $task = Task::factory()->create([
            'title' => 'My title',
            'description' => 'My awesome description!'
        ]);

        Livewire::test(Tasks::class)
            ->set('selectedTitle', $task->title)
            ->set('selectedDescription', $task->description)
            ->call('update', 1)
            ->assertRedirect()
            ->assertHasNoErrors();
    }

    /** @test */
    public function test_can_complete_task()
    {
        $task = Task::factory()->create([
            'title' => 'My title',
            'description' => 'My awesome description!'
        ]);

        Livewire::test(Tasks::class)
            ->set('task', $task)
            ->set('task->status', 'complete')
            ->call('complete', 1)
            ->assertRedirect()
            ->assertHasNoErrors();
    }
}
