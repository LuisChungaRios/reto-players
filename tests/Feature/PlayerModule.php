<?php

namespace Tests\Feature;

use App\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayerModule extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function it_show_view_players()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSee('Listado de jugadores');
    }

    /**
     * @test
     */
    public function it_show_list_players()
    {
        $this->getJson(route('players.index'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'success','data'
            ]);
    }


   /** @test */
    public function it_creates_a_new_player()
    {
        $this->withoutExceptionHandling();
        $this->postJson(route('players.store'), [
            'name' => 'Andre Carrillo',
            'position' => 'LM',
            'goals' => 2
        ])->assertStatus(200);

        $this->assertDatabaseHas('players',[
            'name' => 'Andre Carrillo',
            'position' => 'LM'
        ]);
    }

    /**
     * @test
     */

    public function it_update_a_exists_player()
    {
        $this->withoutExceptionHandling();
        $user = factory(Player::class)->create();
        $this->putJson(route('players.update', $user->id), [
            'name' => 'Cristiano Ronaldo',
            'position' => 'CF',
            'goals' => 780
        ])->assertStatus(200);

        $this->assertDatabaseHas('players',[
            'name' => 'Cristiano Ronaldo',
            'position' => 'CF',
            'goals' => 780,
            'id' => $user->id
        ]);
    }

    /**
     * @test
     */

    public function it_not_found_player_to_update_player()
    {

        $this->putJson(route('players.update', rand(1,10)), [
            'name' => 'Cristiano Ronaldo',
            'position' => 'CF',
            'goals' => 780
        ])->assertStatus(404);

    }

    /**
     * @test
     */

    public function a_create_player_required_name()
    {

        $response = $this->postJson(route('players.store'), [
           'position' => 'LM',
           'goals' => 2
        ])->assertStatus(422);
        $response->assertJsonStructure([
            'message','errors' =>['name']
        ]);

    }

    /**
     * @test
     */

    public function a_create_player_required_position()
    {

        $response = $this->postJson(route('players.store'), [
            'name' => 'Andre Carrillo',
            'goals' => 2
        ])->assertStatus(422);
        $response->assertJsonStructure([
            'message','errors' =>['position']
        ]);

    }

    /**
     * @test
     */

    public function a_create_player_required_goals()
    {

        $response = $this->postJson(route('players.store'), [
            'position' => 'LM',
            'name' => 'Andre Carrillo'
        ])->assertStatus(422);
        $response->assertJsonStructure([
            'message','errors' =>['goals']
        ]);

    }


    /**
     * @test
     */

    public function it_a_delete_player()
    {
        $this->withoutExceptionHandling();
        $player = factory(Player::class)->create();
        $this->deleteJson(route('players.destroy', $player->id))
        ->assertJsonStructure([
            'success'
        ])->assertStatus(200);

        $this->assertDatabaseMissing('players', [
            'id' => $player->id
        ]);
    }

    /**
     * @test
     */

    public function it_failed_a_delete_player()
    {
        $this->deleteJson(route('players.destroy', rand(1,10)))
           ->assertStatus(404);
    }

    /**
     * @test
     */

    public function it_show_a_player()
    {
        $this->withoutExceptionHandling();
        $player = factory(Player::class)->create();
        $this->getJson(route('players.show', $player->id))
            ->assertJsonStructure([
                'success','data'
            ])->assertStatus(200);
    }

    /**
     * @test
     */

    public function it_failed_show_a_player()
    {
        $this->getJson(route('players.show', rand(1,10)))
            ->assertStatus(404);
    }

    /**
     * @test
     */

    public function it_increments_goals_player()
    {
        $player = factory(Player::class)->create();
        $this->putJson(route('players.goals.change_value', ['player' => $player->id, 'operation' => 'increments']))
            ->assertStatus(200);

        $this->assertDatabaseHas('players', [
            'id' => $player->id,
            'name' => $player->name,
            'goals' => (++$player->goals)
        ]);
    }

    /**
     * @test
     */

    public function it_decrements_goals_player()
    {
        $player = factory(Player::class)->create();
        $this->putJson(route('players.goals.change_value', ['player' => $player->id, 'operation' => 'decrements']))
            ->assertStatus(200);

        $this->assertDatabaseHas('players', [
            'id' => $player->id,
            'name' => $player->name,
            'goals' => --$player->goals
        ]);
    }
}
