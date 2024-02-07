<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait CrudOperationsTrait
{
    /*
    |--------------------------------------------------------------------------
    | Retrieve all records with relation
    |--------------------------------------------------------------------------
    */
    public function getAllWithRelation($model, $relation, ...$columns)
    {
        try {
            return $model::with($relation)->get($columns);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error', 'details' => 'Failed to fetch records. Please try again later.'], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Retrieve all records
    |--------------------------------------------------------------------------
    */
    public function getRecord($model, ...$columns)
    {
        try {
            return $model::get($columns);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error', 'details' => 'Failed to fetch records. Please try again later.'], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Find record with relation by ID
    |--------------------------------------------------------------------------
    */
    public function findWithRelation($model, $relation, $id)
    {
        try {
            return $model::with($relation)->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Record not found', 'details' => 'The requested record was not found.'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error', 'details' => 'Failed to fetch record. Please try again later.'], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Find record by ID
    |--------------------------------------------------------------------------
    */
    public function findById($model, $id)
    {
        try {
            return $model::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Record not found', 'details' => 'The requested record was not found.'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error', 'details' => 'Failed to fetch record. Please try again later.'], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Create a new record
    |--------------------------------------------------------------------------
    */
    public function createRecord($model, $data)
    {
        try {
            return $model::create($data);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'details' => 'Validation failed. Please check your input.'], 422);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error', 'details' => 'Failed to create record. Please try again later.'], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Update an existing record
    |--------------------------------------------------------------------------
    */
    public function updateRecord($model, $id, $data)
    {
        try {
            $record = $model::findOrFail($id);
            if (!$record) {
                return response()->json(['error' => 'Failed to update record', 'details' => 'The requested record was not found.'], 404);
            } else {
                $record->update($data);
                return $record ;
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Record not found', 'details' => 'The requested record was not found.'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'details' => 'Validation failed. Please check your input.'], 422);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Database error', 'details' => 'Failed to update record. Please try again later.'], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Delete a record
    |--------------------------------------------------------------------------
    */
    public function deleteRecord($element)
    {
        try {
            $element->delete();
            return response()->json(['message' => 'Record deleted successfully'], 200);
        } catch (HttpException $e) {
            return response()->json(['error' => 'Failed to delete record', 'details' => 'Error while deleting record. Please try again later.'], $e->getStatusCode());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete record', 'details' => 'Error while deleting record. Please try again later.'], 500);
        }
    }
}
