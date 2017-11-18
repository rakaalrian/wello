<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      return Auth::user()->boards;
    }

    public function show($id){
      $board = Board::findOrFail($id);

      if (Auth::user()->id !== $board->user_id) {
        return response()->json(['status'=>'error', 'message'=>'unauthorized'], 401);
      }

      return $board;
    }

    public function store(Request $request){
      Auth::user()->boards()->create([
        'name' => $request->name
      ]);
      return response()->json(['message'=>'success'], 200);
    }

    public function update(Request $request, $id){
      $board = Board::findOrFail($id);

      if (Auth::user()->id !== $board->user_id) {
        return response()->json(['status'=>'error', 'message'=>'unauthorized'], 401);
      }

      $board->name = $request->name;
      if ($board->save()) {
        return response()->json(['message'=>'success', 'board'=>$board], 200);
      }

      return response()->json(['status'=>'error', 'message'=>'Something Goes Wrong']);
    }

    public function destroy($id){
      $board = Board::findOrFail($id);

      if (Auth::user()->id !== $board->user_id) {
        return response()->json(['status'=>'error', 'message'=>'unauthorized'], 401);
      }

      if (Board::destroy($id)) {
        return response()->json(['status'=>'success', 'message'=>'Board Deleted Successfully']);
      }

      return response()->json(['status'=>'error', 'message'=>'Something Goes Wrong']);
    }
}
