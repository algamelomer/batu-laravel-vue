<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Traits\CrudOperationsTrait;
use App\Traits\HandleFile;

class FacultyController extends Controller
{
    use CrudOperationsTrait;
    use HandleFile;

    /*
    |--------------------------------------------------------------------------
    | Index Function
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $faculties = $this->getRecord(Faculty::class, 'id', 'name', 'image', 'video', 'description', 'vision', 'mission', 'user_id');
        return response()->json(['data' => $faculties], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Show Function
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $faculty = $this->findById(Faculty::class, $id);
        return response()->json(['data' => $faculty], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Store Function
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|file',
            'video' => 'nullable|file',
            'description' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only(['name', 'description', 'vision', 'mission', 'user_id']);
        $data['image'] = $this->UploadFiles($request->file('image'), $request->name, 'image');
        if ($request->hasFile('video')) {
            $data['video'] = $this->UploadFiles($request->file('video'), $request->name, 'video');
        }

        $faculty = $this->createRecord(Faculty::class, $data);
        return response()->json(['data' => $faculty, 'message' => 'Faculty created successfully'], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Function
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Faculty $faculty)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|file',
            'video' => 'nullable|file',
            'description' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed', 'details' => $validator->errors()], 400);
        }

        $data = $request->only(['name', 'description', 'vision', 'mission', 'user_id']);
        $data['image'] = $this->UploadFiles($request->file('image'), $request->name, 'image');
        if ($request->hasFile('video')) {
            $data['video'] = $this->UploadFiles($request->file('video'), $request->name, 'video');
        }

        $faculty = $this->updateRecord(Faculty::class, $faculty->id, $data);
        return response()->json(['data' => $faculty, 'message' => 'Faculty updated successfully'], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy Function
    |--------------------------------------------------------------------------
    */
    public function destroy(Faculty $faculty)
    {
        return $this->deleteRecord($faculty);
    }
}
