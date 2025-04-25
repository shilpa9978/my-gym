<?php

namespace Tests\Feature;

// use Tests\TestCase;
// use App\Models\User;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\ClassType;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\ClassTypeSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InstructoreTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_instructor_is_redirect_to_instructor_dashboard():void
    // {
    //     $user = User::factory()->create([
    //         'role' => 'instructor',
    //     ]);

    //     $response = $this->actingAs($user)
    //     ->get('/dashboard');

    //     $response->assertRedirectToRoute('instructor.dashboard');

    //     $this->followRedirects($response)->assertSeeText("Hey Instructor");
    // }

    public function test_instructor_is_redirected_to_instructor_dashboard() {
        $user = User::factory()->create([
            'role' => 'instructor'
        ]);

        $response = $this->actingAs($user)
        ->get('/dashboard');

        $response->assertRedirectToRoute('instructor.dashboard');

        $this->followRedirects($response)->assertSeeText("Hey Instructor");
    }

    public function test_instructor_can_schedule_a_class() {
        //Given
        $user = User::factory()->create([
            'role' => 'instructor'
        ]);
        $this->seed(ClassTypeSeeder::class);

        //When
        $response = $this->actingAs($user)
            ->post('instructor/schedule', [
            'instructor_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => '2025-04-30 05:00:00',
        ]);

        //Then 
        $response->assertRedirectToRoute('schedule.index');
    }
}
