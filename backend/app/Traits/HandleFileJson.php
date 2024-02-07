<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

trait HandleFileJson
{
    use HandleFile;

    /*
    |--------------------------------------------------------------------------
    | Json File Path
    |--------------------------------------------------------------------------
    */
    private $jsonFilePath = '/dataInterface/dataInterface.json';
    // private $DomainName = 'http://127.0.0.1:8000';
    /*
    |--------------------------------------------------------------------------
    | Function For Getting Data From JSON file
    |--------------------------------------------------------------------------
    */
    // Retrieve all data from a JSON file and return as a JSON response
    public function getAllJsonData($jsonFilePath)
    {
        $data = $this->readJsonFile($jsonFilePath);
        return response()->json($data);
    }

    // Read JSON contents from the file system and decode them into an array
    private function readJsonFile($jsonFilePath)
    {
        $jsonContents = Storage::get($jsonFilePath);
        return json_decode($jsonContents, true) ?: [];
    }

    /*
    |--------------------------------------------------------------------------
    | Function To Show JSON Data
    |--------------------------------------------------------------------------
    */
    // Show a specific item from JSON data based on category and title
    public function show(string $category, string $title)
    {
        $item = $this->findJsonItem($this->jsonFilePath, $category, $title);
        if ($item) {
            return response()->json($item);
        }
        return response()->json(['error' => 'Item not found'], 404);
    }

    // Find and retrieve a specific item from JSON data based on category and title
    private function findJsonItem($jsonFilePath, $category, $title)
    {
        $data = $this->readJsonFile($jsonFilePath);
        if ($this->itemExists($data, $category, $title)) {
            $item = $this->findItemByTitle($data, $category, $title);
            return $item;
        }
        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Function To Create JSON Item
    |--------------------------------------------------------------------------
    */
    public function createJsonItem($jsonFilePath, Request $request, $category)
    {
        $this->validateRequest($request);
        $data = $this->readJsonFile($jsonFilePath);
        $newItem = $request->all();

        if ($request->hasFile('image')) {
            $newItem['image'] = $this->UploadFiles($request->file('image'), $request->input('title'), 'image');
        }

        $this->initializeCategoryIfNotExists($data, $category);
        $data[$category][] = $newItem;
        $this->writeToJsonFile($data);

        return response()->json($newItem, 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Function To Update JSON Item
    |--------------------------------------------------------------------------
    */

    // Update an existing JSON item based on request data and item title
    public function updateJsonItem($jsonFilePath, Request $request, $category, $title)
    {
        $this->validateRequest($request);

        $data = $this->readJsonFile($jsonFilePath);
        if ($this->itemExists($data, $category, $title)) {
            $item = $this->findItemByTitle($data, $category, $title);
            $updatedItem = array_merge($item, $request->all());

            if ($request->hasFile('image')) {
                $updatedItem['image'] = $this->UploadFiles($request->file('image'), $request->input('title'), 'image');
            }

            $index = array_search($item, $data[$category], true);
            $data[$category][$index] = $updatedItem;
            $this->writeToJsonFile($data);
            return $updatedItem;
        }
        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Function To Delete JSON Item
    |--------------------------------------------------------------------------
    */

    // Delete a JSON item based on its category and title
    public function destroy(string $category, string $title)
    {
        $item = $this->deleteJsonItem($this->jsonFilePath, $category, $title);
        if ($item) {
            return response()->json(['message' => 'Item deleted successfully']);
        }
        return response()->json(['error' => 'Item not found'], 404);
    }

    // Find and delete a specific item from JSON data based on category and title
    private function deleteJsonItem($jsonFilePath, $category, $title)
    {
        $data = $this->readJsonFile($jsonFilePath);
        if ($this->itemExists($data, $category, $title)) {
            $item = $this->findItemByTitle($data, $category, $title);
            $index = array_search($item, $data[$category], true);
            array_splice($data[$category], $index, 1);
            $this->writeToJsonFile($data);
            return $item;
        }
        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Functions
    |--------------------------------------------------------------------------
    */

    // Helper function to validate request data
    private function validateRequest(Request $request)
    {
        return $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|file',
            'counter_number' => 'nullable|integer',
        ]);
    }

    // Helper function to initialize a category if it does not exist in JSON data
    private function initializeCategoryIfNotExists(&$data, $category)
    {
        if (!isset($data[$category])) {
            $data[$category] = [];
        }
    }

    // Helper function to check if a specific item exists in JSON data
    private function itemExists($data, $category, $title)
    {
        return isset($data[$category]) && $this->findItemByTitle($data, $category, $title) !== null;
    }

    // Helper function to find a specific item by its title in JSON data
    private function findItemByTitle($data, $category, $title)
    {
        foreach ($data[$category] as $item) {
            if ($item['title'] === $title) {
                return $item;
            }
        }
        return null;
    }

    // Helper function to write JSON data back to the file system
    private function writeToJsonFile($data)
    {
        Storage::put($this->jsonFilePath, json_encode($data, JSON_PRETTY_PRINT));
    }
}
