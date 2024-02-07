<?php

namespace App\Http\Controllers\Faculty;

use App\Models\FacultyMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Traits\CrudOperationsTrait;
use App\Traits\HandleFile;

class FacultyMemberController extends Controller
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
        $facultyMembers = $this->getRecord(FacultyMember::class, 'id', 'department_id', 'faculty_id', 'user_id', 'name', 'image', 'title', 'sub_title', 'career', 'experience', 'scientific_interests');
        return response()->json(['data' => $facultyMembers]);
    }

    /*
    |--------------------------------------------------------------------------
    | Store Function
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_id' => 'nullable|exists:departments,id',
            'user_id' => 'required|exists:users,id',
            'faculty_id' => 'nullable|exists:faculties,id',
            'name' => 'required|string',
            'image' => 'required|file',
            'title' => 'required|string',
            'sub_title' => 'nullable|string',
            'career' => 'nullable|string',
            'experience' => 'nullable|string',
            'scientific_interests' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only(['department_id', 'faculty_id', 'user_id', 'name', 'title', 'sub_title', 'career', 'experience', 'scientific_interests']);
        $data['image'] = $this->UploadFiles($request->file('image'), $request->name, 'image');

        $facultyMember = $this->createRecord(FacultyMember::class, $data);
        return response()->json(['data' => $facultyMember, 'message' => 'Faculty member created successfully'], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Show Function
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $facultyMember = $this->findById(FacultyMember::class, $id);
        return response()->json(['data' => $facultyMember], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Function
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, FacultyMember $facultyMember)
    {
        $validator = Validator::make($request->all(), [
            'department_id' => 'nullable|exists:departments,id',
            'user_id' => 'required|exists:users,id',
            'faculty_id' => 'nullable|exists:faculties,id',
            'name' => 'required|string',
            'image' => 'nullable|file',
            'title' => 'required|string',
            'sub_title' => 'nullable|string',
            'career' => 'nullable|string',
            'experience' => 'nullable|string',
            'scientific_interests' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only(['department_id', 'faculty_id', 'user_id', 'name', 'title', 'sub_title', 'career', 'experience', 'scientific_interests']);
        if ($request->hasFile('image')) {
            $data['image'] = $this->UploadFiles($request->file('image'), $request->name, 'image');
        }

        $facultyMember = $this->updateRecord(FacultyMember::class, $facultyMember->id, $data);
        return response()->json(['data' => $facultyMember, 'message' => 'Faculty member updated successfully'], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy Function
    |--------------------------------------------------------------------------
    */
    public function destroy(FacultyMember $facultyMember)
    {
        return $this->deleteRecord($facultyMember);
    }
}
