<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Resource;
// auth
use Illuminate\Support\Facades\Auth;

// carbon
use Carbon\Carbon;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user();

        $resources = Resource::where('user_id', $users->id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $resources
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Resource_today()
    {
        $users = Auth::user();

        $resources = Resource::where('user_id', $users->id)->whereDate('tanggal', Carbon::today())->get();

        return response()->json([
            'status' => 'success',
            'data' => $resources
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
        $users = Auth::user()->id;

        // validate
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tautan' => 'required',
            'kategori' => 'required'
        ]);

        $resources = Resource::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tautan' => $request->tautan,
            'kategori' => $request->kategori,
            'user_id' => $users,
            'tanggal' => Carbon::now()
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $resources
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resources = Resource::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $resources
        ], 200);
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
        $resources = Resource::find($id);


        // validate
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tautan' => 'required',
            'kategori' => 'required'
        ]);

        $resources->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tautan' => $request->tautan,
            'kategori' => $request->kategori,
            'tanggal' => Carbon::now()
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $resources
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Resource::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
