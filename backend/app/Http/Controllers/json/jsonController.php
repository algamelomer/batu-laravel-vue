<?php

namespace App\Http\Controllers\Json;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Traits\HandleFileJson;

class JsonController extends Controller
{
    use HandleFileJson;

    /*
    |--------------------------------------------------------------------------
    | JSON File Path
    |--------------------------------------------------------------------------
    */
    private $jsonFilePath = '/dataInterface/dataInterface.json';

    /*
    |--------------------------------------------------------------------------
    | Index Function
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return $this->getAllJsonData($this->jsonFilePath);
    }

    /*
    |--------------------------------------------------------------------------
    | Store Function
    |--------------------------------------------------------------------------
    */
    public function store(Request $request, string $category)
    {
        $newItem = $this->createJsonItem($this->jsonFilePath, $request, $category);
        return response()->json($newItem, 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Show Function
    |--------------------------------------------------------------------------
    */
    public function show(string $category, string $title)
    {
        $item = $this->findJsonItem($this->jsonFilePath, $category, $title);
        if ($item) {
            return response()->json($item);
        }
        return response()->json(['error' => 'Item not found'], 404);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Function
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, string $category, string $title)
    {
        $item = $this->updateJsonItem($this->jsonFilePath, $request, $category, $title);
        if ($item) {
            return response()->json($item);
        }
        return response()->json(['error' => 'Item not found'], 404);
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy Function
    |--------------------------------------------------------------------------
    */
    public function destroy(string $category, string $title)
    {
        $item = $this->deleteJsonItem($this->jsonFilePath, $category,  $title);
        if ($item) {
            return response()->json(['message' => 'Item deleted successfully']);
        }
        return response()->json(['error' => 'Item not found'], 404);
    }
}
