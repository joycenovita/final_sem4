<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
// auth
use Illuminate\Support\Facades\Auth;
// carbon
use Carbon\Carbon;

class JournalController extends Controller
{

    public function index()
    {
        $users = Auth::user()->id;
        $journals = Journal::where('user_id', $users)->get();
        return response()->json(['message' => 'Successfully fetched all Journal', 'data' => $journals], 200);
    }

    public function journal_now()
    {
        $users = Auth::user()->id;
        $journals = Journal::where('user_id', $users)->whereDate('date', Carbon::today())->get();
        return response()->json(['message' => 'Successfully fetched all Journal', 'data' => $journals], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addJournal(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $users = Auth::user()->id;

        $journal = new Journal();
        $journal->title = $request->title;
        $journal->date = Carbon::now();
        $journal->content = $request->content;
        $journal->user_id = $users;
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
        $journal= Journal::find($id);
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
            'content' => 'required|string',
        ]);

        $journal = Journal::findOrFail($id);
        $journal->title = $request->title;
        $journal->content = $request->content;
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
        $journal = Journal::find($id);
        $journal->delete();

        // Redirect to the users index page with success message
        return response()->json(['message' => 'Successfully delete Journal', 'data' => $journal], 200);
    }
}
