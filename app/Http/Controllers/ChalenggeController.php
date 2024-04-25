<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chalengge;
use Illuminate\Support\Facades\Auth;



class ChalenggeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user()->id;

        $chalengges = Chalengge::where('user_id', $users)->get();

        return response()->json(['message' => 'Successfully fetched chalengges', 'data' => $chalengges], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Chalenge_now()
    {
        $users = Auth::user()->id;

        $chalengges = Chalengge::where('user_id', $users)->whereDate('tanggal_mulai', '<=', date('Y-m-d'))->whereDate('tanggal_berakhir', '>=', date('Y-m-d'))->get();

        return response()->json(['message' => 'Successfully fetched chalengges', 'data' => $chalengges], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chalengge = new Chalengge();

        $chalengge->nama_tantangan = $request->nama_tantangan;
        $chalengge->deskripsi = $request->deskripsi;
        $chalengge->tanggal_mulai = $request->tanggal_mulai;
        $chalengge->tanggal_berakhir = $request->tanggal_berakhir;
        $chalengge->user_id = Auth::user()->id;

        $chalengge->save();

        return response()->json(['message' => 'Successfully added chalengge', 'data' => $chalengge], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chalengge = Chalengge::find($id);

        if ($chalengge) {
            return response()->json(['message' => 'Successfully fetched chalengge', 'data' => $chalengge], 200);
        } else {
            return response()->json(['message' => 'Chalengge not found'], 404);
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
        $chalengge = Chalengge::find($id);

        // validate
        $request->validate([
            'nama_tantangan' => 'required|string',
            'deskripsi' => 'required|string',
            'tanggal_mulai'=> 'required',
            'tanggal_berakhir'=> 'nullable'
        ]);

        if ($chalengge) {
            $chalengge->nama_tantangan = $request->nama_tantangan;
            $chalengge->deskripsi = $request->deskripsi;
            $chalengge->tanggal_mulai = $request->tanggal_mulai;
            $chalengge->tanggal_berakhir = $request->tanggal_berakhir;

            $chalengge->save();

            return response()->json(['message' => 'Successfully updated chalengge', 'data' => $chalengge], 200);
        } else {
            return response()->json(['message' => 'Chalengge not found'], 404);
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
        $chalengge = Chalengge::find($id);

        if ($chalengge) {
            $chalengge->delete();

            return response()->json(['message' => 'Successfully deleted chalengge'], 200);
        } else {
            return response()->json(['message' => 'Chalengge not found'], 404);
        }
    }
}
