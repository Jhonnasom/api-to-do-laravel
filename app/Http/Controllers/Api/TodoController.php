<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Todo::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
             'title' => 'required|string|max:255',
         ]);

         return Todo::create([
             'title' => $request->input('title'),
             'completed' => true,
         ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'completed' => 'required|boolean',
        ]);

        $todo = Todo::findOrfail($id);

        $todo->completed = $request->input('completed');
        $todo->save();
        return $todo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $todo = Todo::findOrfail($id);
        $todo->delete();
        return response([
            'message' => 'Todo deleted successfully',
        ]);
    }
}
