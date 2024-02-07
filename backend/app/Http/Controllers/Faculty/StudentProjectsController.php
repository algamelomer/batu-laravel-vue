<?php

namespace App\Http\Controllers\Faculty;

use App\Models\StudentProjects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Traits\CrudOperationsTrait;
use App\Traits\HandleFile;

class StudentProjectsController extends Controller
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
        $studentProjects = $this->getRecord(StudentProjects::class, 'id', 'name', 'description', 'file', 'image', 'team_name', 'department_id');
        return response()->json(['data' => $studentProjects]);
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
            'file' => 'nullable|file',
            'team_name' => 'required|string',
            'department_id' => 'required|exists:departments,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only(['name', 'description', 'team_name', 'department_id']);
        $data['image'] = $this->UploadFiles($request->file('image'), $request->name, 'image');

        if ($request->hasFile('file')) {
            $data['file'] = $this->UploadFiles($request->file('file'), $request->name, 'file');
        }

        $studentProject = $this->createRecord(StudentProjects::class, $data);

        return response()->json(['data' => $studentProject, 'message' => 'Student Project created successfully'], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Show Function
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $studentProject = $this->findById(StudentProjects::class, $id);
        return response()->json(['data' => $studentProject]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Function
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, StudentProjects $studentProject)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'required|file',
            'file' => 'nullable|file',
            'team_name' => 'required|string',
            'department_id' => 'required|exists:departments,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only(['name', 'description', 'team_name', 'department_id']);
        $data['image'] = $this->UploadFiles($request->file('image'), $request->name, 'image');

        if ($request->hasFile('file')) {
            $data['file'] = $this->UploadFiles($request->file('file'), $request->name, 'file');
        }

        $studentProject = $this->updateRecord(StudentProjects::class, $studentProject->id, $data);

        return response()->json(['data' => $studentProject, 'message' => 'Student Project updated successfully'], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy Function
    |--------------------------------------------------------------------------
    */
    public function destroy(StudentProjects $studentProject)
    {
        return $this->deleteRecord($studentProject);
    }
}
