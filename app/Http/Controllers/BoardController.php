<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function store(Request $request){
      Board::create([
        'name' => $request->name,
        'user_id' => 1
      ])
      return response()->json(['message' => 'success'], 200);
    }
}
