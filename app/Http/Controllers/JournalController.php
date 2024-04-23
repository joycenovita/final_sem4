<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addJournal(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);

        $journal = new Journal();
        $journal->title = $request->title;
        $journal->date = $request->date;
        $journal->content = $request->content;
        $journal->user_id = $request->user_id;
        $journal->save();

        return response()->json(['message' => 'Journal entry added successfully', 'data' => $journal], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         // Find the user by id
        $user= User::find($id);
        return response()-> json(['message' => 'Successfully fetched Journal', 'data' => $journal], 200);
    }


    /**
     * Update an existing journal entry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateJournal(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);

        $journal = Journal::findOrFail($id);
        $journal->title = $request->title;
        $journal->date = $request->date;
        $journal->content = $request->content;
        $journal->user_id = $request->user_id;
        $journal->save();

        return response()->json(['message' => 'Journal entry updated successfully', 'data' => $journal ], 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the user by id and delete it
        $journal = User::find($id);
        $journal->delete();

        // Redirect to the users index page with success message
        return response()->json(['message' => 'Successfully delete Journal', 'data' => $journal], 200);
    }
}
