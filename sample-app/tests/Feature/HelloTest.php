<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Person;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloTest extends TestCase
{
    //use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testHello()
    {
        $this->assertTrue(true);

        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/hello');
        $response->assertStatus(302);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/hello?sort=name');
        $response->assertStatus(200);

        $response = $this->get('/no_route');
        $response->assertStatus(404);

        User::factory()->create([
            'name'=>'AAA',
            'email'=>'BBB@CCC.COM',
            'password'=>'ABCABC',
        ]);

        User::factory(10)->create();

        $this->assertDatabaseHas('users', [
            'name'=>'AAA',
            'email'=>'BBB@CCC.COM',
            'password'=>'ABCABC',
        ]);

        Person::factory()->create([
            'name'=>'XXX',
            'mail'=>'YYY@ZZZ.COM',
            'age'=>'123',
        ]);

        Person::factory(5)->create();

        $this->assertDatabaseHas('people', [
            'name'=>'XXX',
            'mail'=>'YYY@ZZZ.COM',
            'age'=>'123',
        ]);
    }
}
