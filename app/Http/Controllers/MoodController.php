<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// auth
use Illuminate\Support\Facades\Auth;

use App\Models\Mood;

// validator suport facades

// carbon
use Carbon\Carbon;


class MoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user();

        $moods = Mood::where('user_id', $users->id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $moods
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mood_today()
    {
        $users = Auth::user();

        $moods = Mood::where('user_id', $users->id)
                    ->whereDate('created_at', Carbon::today())
                    ->get();

        return response()->json([
            'status' => 'success',
            'data' => $moods
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = Auth::user();

        $request->validate([
            'nama_mood' => 'required|string',
            'keterangan' => 'required|string',
            'warna' => 'required|string'
        ]);


        $mood = new Mood();
        $mood->nama_mood = $request->nama_mood;
        $mood->keterangan = $request->keterangan;
        $mood->warna = $request->warna;
        $mood->user_id = $users->id;
        $mood->save();

        return response()->json([
            'status' => 'success',
            'data' => $mood
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $mood = Mood::find($id);

        if($mood){
            return response()->json([
                'status' => 'success',
                'data' => $mood
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mood = Mood::find($id);

        // validate request
        $request->validate([
            'nama_mood' => 'required|string',
            'keterangan' => 'required|string',
            'warna' => 'required|string'
        ]);

        if($mood){
            $mood->nama_mood = $request->nama_mood;
            $mood->keterangan = $request->keterangan;
            $mood->warna = $request->warna;
            $mood->save();

            return response()->json([
                'status' => 'success',
                'data' => $mood
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mood = Mood::find($id);

        if($mood){
            $mood->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data deleted'
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found'
            ], 404);
        }
    }
}
