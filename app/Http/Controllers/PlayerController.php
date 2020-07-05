<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerFormRequest;
use App\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{


    public function index()
    {
        $search = request()->query('search',null);
        $filter = request()->query('filter',null);
        $players = Player::orderby('id','desc')->get();
        if (!is_null($filter))  {
            $players = Player::where($filter, 'LIKE', "%{$search}%")->orderby('id','desc')->get();
        }
        return response()->json([
            'success' => 'ok',
            'data' => $players
        ]);
    }

    public function store(PlayerFormRequest $request)
    {
        $player = new Player;
        $player->name = $request->name;
        $player->position = $request->position;
        $player->goals = $request->goals;
        $player->save();

        return response()->json([
            'message' => 'Jugador creado correctamente',
            'success' => 'ok'
        ]);
    }

    public function update(Player $player, PlayerFormRequest $request)
    {
        $player->name = $request->name;
        $player->position = $request->position;
        $player->goals = $request->goals;

        $player->save();

        return response()->json([
            'success' => 'ok',
            'message' => 'Jugador actualizado correctamente'
        ]);
    }

    public function show(Player $player)
    {
        return response()->json([
            'success' => 'ok',
            'data' => $player
        ]);
    }

    public function changeGoalsValue(Player $player , $operation)
    {
        if ($operation === 'increments') {
            $player->goals += 1;
        } else {
            $player->goals -= 1;
        }
        $player->save();

        return response()->json([
            'success' => 'ok',
            'message' => 'updated goals'
        ]);
    }

    public function destroy(Player $player)
    {

        $player->delete();
        return response()->json([
            'success' => 'ok',
            'message' => 'Jugador eliminado correctamente'
        ]);

    }

    public function getAllTeamsPlayer()
    {
        return Player::whereHas('teams')->with('teams')->get();
    }
}
