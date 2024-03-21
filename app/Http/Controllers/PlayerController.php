<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Player::all();
        return response()->json($players);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $player = Player::create($request->all());
        $player->save();
    }

    /**
     * Display the specified resource.
     */
    public function show($playerid)
    {
        $player = Player::find($playerid);
        if (!empty($player)) {
            return response()->json($player);
        } else {
            return response()->json([
                "message" => "Not found"
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        $player->update($request->all());
        return response()->json([
            "message" => "Updated"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        $player->delete();
        return response()->json([
            "message" => "Deleted"
        ], 200);
    }
}
