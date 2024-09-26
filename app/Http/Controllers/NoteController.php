<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::query() -> orderBy('created_at','desc') -> paginate(10);
        //dd($notes);
        
        return view('note.index',['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $new_note = $request -> validate(['note' => ['required', 'string']]);
        
        $new_note['user_id'] = 1;
        $note = Note::create($new_note);

        return to_route('note.show',$note) -> with('message', 'Note is created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return view('note.show',['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('note.edit',['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $new_note = $request -> validate(['note' => ['required', 'string']]);
        
        
        $note -> update($new_note);

        return to_route('note.show',$note) -> with('message', 'Note is created');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        
        $note -> delete();
        return to_route('note.index') -> with('message', 'Note is deleted');
    }
}
