<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Spesialis;
use Illuminate\Http\Request;

class SpesialisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Spesialis::getSpesialis()->paginate(10);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'namaSpesialis'  => 'required',
            'image' => 'required|file|mimes:png,jpg'
        ]);

        try {
            $fileName   = time() . $request->file('image')->getClientOriginalName();
            $path       = $request->file('image')->storeAs('Uploads/spesialis', $fileName);
            $validasi['image'] = $path;
            $response   = Spesialis::create($validasi);
            return response()->json([
                'success'   => true,
                'message'   => 'Success',
                'data'      => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Error',
                'errors'    => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $validasi = $request->validate([
            'namaSpesialis'  => 'required',
            'image' => ''
        ]);

        try {
            if ($request->file('image')) {
                $fileName   = time() . $request->file('image')->getClientOriginalName();
                $path       = $request->file('image')->storeAs('Uploads/spesialis', $fileName);
                $validasi['image'] = $path;
            }
            $response   = Spesialis::find($id);
            $response->update($validasi);
            return response()->json([
                'success'   => true,
                'message'   => 'Success',
                'data'      => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Error',
                'errors'    => $e->getMessage()
            ]);
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
        try {
            $spesialis = Spesialis::find($id);
            $spesialis->delete();
            return response()->json([
                'success'   => true,
                'message'   => 'Success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Error',
                'errors'    => $e->getMessage()
            ]);
        }
    }
}
