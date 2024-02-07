<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\CrudOperationsTrait;
use App\Traits\HandleFile;

class DepartmentController extends Controller
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
        $departments = $this->getRecord(Department::class, 'id', 'name', 'description', 'image', 'video', 'job_opportunities', 'faculty_id', 'user_id');
        return response()->json(['departments' => $departments], 200);
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
            'description' => 'nullable|string',
            'image' => 'required|file',
            'video' => 'nullable|file',
            'job_opportunities' => 'nullable|string',
            'faculty_id' => 'required|exists:faculties,id',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only(['name', 'description', 'job_opportunities', 'faculty_id', 'user_id']);
        $data['image'] = $this->UploadFiles($request->file('image'), $request->name, 'image');
        if ($request->hasFile('video')) {
            $data['video'] = $this->UploadFiles($request->file('video'), $request->name, 'video');
        }
        $department = $this->createRecord(Department::class, $data);

        return response()->json(['department' => $department, 'message' => 'Department created successfully'], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Show Function
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $department = $this->findById(Department::class, $id);
        return response()->json(['department' => $department], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Function
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Department $department)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|file',
            'video' => 'nullable|file',
            'job_opportunities' => 'nullable|string',
            'faculty_id' => 'required|exists:faculties,id',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $data = $request->only(['name', 'description', 'video', 'job_opportunities', 'faculty_id', 'user_id']);
        if ($request->hasFile('image')) {
            $data['image'] = $this->UploadFiles($request->file('image'), $request->name, 'image');
        }
        if ($request->hasFile('video')) {
            $data['video'] = $this->UploadFiles($request->file('video'), $request->name, 'video');
        }
        $departments = $this->updateRecord(Department::class, $department->id, $data);
        return response()->json(['department' => $departments, 'message' => 'Department updated successfully'], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy Function
    |--------------------------------------------------------------------------
    */
    public function destroy(Department $department)
    {
        return $this->deleteRecord($department);
    }
}
