<?php

namespace App\Http\Controllers\Jobs;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Traits\CrudOperationsTrait;
use App\Traits\HandleFile;

class JobController extends Controller
{
    use CrudOperationsTrait, HandleFile;

    /*
    |--------------------------------------------------------------------------
    | Index Function
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        // Retrieve all jobs with their applications
        $jobs = $this->getAllWithRelation(Job::class, 'applications', 'id', 'name', 'description', 'type');
        return response()->json(['jobs' => $jobs], 200);
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
            'description' => 'required|string',
            'type' => 'required|in:full_time,part_time',
            'email' => 'required|email',
            'phone' => 'required|string',
            'cv' => 'nullable|file',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only(['name', 'description', 'type']);
        $job = $this->createRecord(Job::class, $data);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $this->UploadFiles($request->file('cv'), $job->name, 'file');
        }

        $dataApplication = [
            'job_id' => $job->id,
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'cv' => $cvPath,
        ];

        $application = $this->createRecord(JobApplication::class, $dataApplication);

        return response()->json(['job' => $job, 'application' => $application, 'message' => 'Data has been created successfully'], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Show Function
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        // Retrieve job with its applications
        $job = $this->findWithRelation(Job::class, 'applications', $id);

        return response()->json(['job' => $job], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Function
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Job $job)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|in:full_time,part_time',
            'email' => 'required|email',
            'phone' => 'required|string',
            'cv' => 'nullable|file',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only(['name', 'description', 'type']);
        $job = $this->updateRecord(Job::class, $request->id, $data);

        if ($request->hasFile('cv')) {
            $cvPath = $this->UploadFiles($request->file('cv'), $job->id, 'file');
            $application = JobApplication::where('job_id', $job->id)->first();
            if ($application) {
                $application->update(['cv' => $cvPath]);
            }
        }

        return response()->json(['job' => $job, 'message' => 'Data has been modified successfully'], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy Function
    |--------------------------------------------------------------------------
    */
    public function destroy(Job $job)
    {
        return $this->deleteRecord($job);
    }
}
