<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\CrudOperationsTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use CrudOperationsTrait;

    /*
    |--------------------------------------------------------------------------
    | Index Function
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return $this->getRecord(User::class, 'id', 'name', 'email', 'role');
    }

    /*
    |--------------------------------------------------------------------------
    | Show Function
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        return $this->findById(User::class, $id);
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
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,superAdmin,publisher,editor',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Check if user has permission to create a user
        $currentUser = auth()->user();
        if ($currentUser->role !== 'superAdmin' && $currentUser->role !== 'admin') {
            return response(['message' => "You don't have permission to perform this action."], 403);
        }

        // Check if user is trying to create a superAdmin
        if ($request->input('role') === 'superAdmin' && $currentUser->role !== 'superAdmin') {
            return response()->json(['error' => 'You do not have the permission to add a superAdmin.'], 403);
        }

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ];

        return $this->createRecord(User::class, $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Function
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'string|min:8',
            'role' => 'in:admin,publisher,editor',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Check user has permission to update a user
        $currentUser = auth()->user();
        $userToUpdate = $this->findById(User::class, $id);

        if ($currentUser->role !== 'superAdmin' && ($currentUser->role !== 'admin' || $userToUpdate->role === 'superAdmin')) {
            return response()->json(['error' => 'You do not have the permission to perform this action.'], 403);
        }

        // Check if user permission superAdmin and permission is't superAdmin
        if ($request->input('role') === 'superAdmin' && $currentUser->role !== 'superAdmin') {
            return response()->json(['error' => 'You do not have the permission to perform this action.'], 403);
        }

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->filled('password') ? Hash::make($request->input('password')) : null,
            'role' => $request->input('role'),
        ];

        return $this->updateRecord(User::class, $id, $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy Function
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $user = $this->findById(User::class, $id);

        // Check permission of user
        $currentUser = auth()->user();
        if ($currentUser->role !== 'superAdmin' && $currentUser->role !== 'admin') {
            return response()->json(['error' => 'You do not have the permission to delete this user.'], 403);
        }

        // Check if trying to delete a superAdmin
        if ($user->role === 'superAdmin') {
            return response()->json(['error' => 'You do not have the permission to delete the superAdmin.'], 403);
        }

        return $this->deleteRecord($user);
    }
}
