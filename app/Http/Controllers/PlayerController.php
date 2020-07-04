<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerFormRequest;
use App\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{


    public function index()
    {
        return response()->json([
            'success' => 'ok',
            'data' => Player::orderby('id','desc')->get()
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
            'message' => 'Created player',
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
            'message' => 'Player updated'
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
            'message' => 'Player deleted'
        ]);

    }
}
