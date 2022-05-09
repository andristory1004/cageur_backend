<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = Department::getDepartment()->paginate(10);
        return response()->json($data);
        
        //  $data = Department::all();
        //  return response()->json($data);

        // $dataView = DB::table('departments')->get();
        // return view('my-page.department', ['departments' => $dataView]);
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
            'namaDepartment'  => 'required',
            'image' => 'required|file|mimes:png,jpg'
        ]);

        try {
            $fileName   = time() . $request->file('image')->getClientOriginalName();
            $path       = $request->file('image')->storeAs('Uploads/departments', $fileName);
            $validasi['image'] = $path;
            $response   = Department::create($validasi);
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

        // $validator = FacadesValidator::make($request->all(), [
        //     'nama'      => 'required',
        //     'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // //check if validation fails
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        // //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        // //create post
        // $post = Post::create([
        //     'nama'      =>$request->nama,
        //     'image'     => $image->hashName(),
        // ]);

        // //return response
        // return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $post);
    
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
            'nama'  => 'required',
            'image' => ''
        ]);

        try {
            if ($request->file('image')) {
                $fileName   = time() . $request->file('image')->getClientOriginalName();
                $path       = $request->file('image')->storeAs('Uploads/departments', $fileName);
                $validasi['image'] = $path;
            }
            $response   = Department::find($id);
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
            $department = Department::find($id);
            $department->delete();
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
