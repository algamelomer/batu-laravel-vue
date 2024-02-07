<?php

namespace App\Http\Controllers\Faculty;

use App\Models\StudyPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Traits\CrudOperationsTrait;

class StudyPlanController extends Controller
{
    use CrudOperationsTrait;

    /*
    |--------------------------------------------------------------------------
    | Index Function
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $studyPlans = $this->getRecord(StudyPlan::class, 'id', 'name', 'description', 'lecturer', 'academic_year', 'semester', 'credits', 'user_id', 'department_id');
        return response()->json(['data' => $studyPlans], 200);
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
            'lecturer' => 'nullable|string',
            'academic_year' => 'required|string',
            'semester' => 'required|string',
            'credits' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only(['name', 'description', 'lecturer', 'academic_year', 'semester', 'credits', 'user_id', 'department_id']);
        $studyPlan = $this->createRecord(StudyPlan::class, $data);

        return response()->json(['data' => $studyPlan, 'message' => 'Study plan created successfully'], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Show Function
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $studyPlan = $this->findById(StudyPlan::class, $id);
        return response()->json(['data' => $studyPlan], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Function
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, StudyPlan $studyPlan)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'lecturer' => 'nullable|string',
            'academic_year' => 'required|string',
            'semester' => 'required|string',
            'credits' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only(['name', 'description', 'lecturer', 'academic_year', 'semester', 'credits', 'user_id', 'department_id']);
        $studyPlan = $this->updateRecord(StudyPlan::class, $studyPlan->id, $data);

        return response()->json(['data' => $studyPlan, 'message' => 'Study plan updated successfully'], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy Function
    |--------------------------------------------------------------------------
    */
    public function destroy(StudyPlan $studyPlan)
    {
        return $this->deleteRecord($studyPlan);
    }
}
