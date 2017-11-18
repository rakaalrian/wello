<?php

namespace App\Http\Controllers;

use App\Board;
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

    public function index(){
      return Board::all();
    }

    public function show($id){
      $board = Board::findOrFail($id);
      return $board;
    }

    public function store(Request $request){
      Board::create([
        'name' => $request->name,
        'user_id' => $request->user_id
      ]);
      return response()->json(['message'=>'success'], 200);
    }

    public function update(Request $request, $id){
      $board = Board::findOrFail($id);

      if ($board->update($request->all())) {
        return response()->json(['message'=>'success', 'board'=>$board], 200);
      }

      return response()->json(['status'=>'error', 'message'=>'Something Goes Wrong']);
    }

    public function destroy($id){
      if (Board::destroy($id)) {
        return response()->json(['status'=>'success', 'message'=>'Board Deleted Successfully']);
      }

      return response()->json(['status'=>'error', 'message'=>'Something Goes Wrong']);
    }
}
