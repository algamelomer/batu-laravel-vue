<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\CrudOperationsTrait;
use App\Traits\HandleFile;

class PostController extends Controller
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
        $posts = $this->getRecord(Post::class, 'id', 'title', 'description', 'file', 'file_type', 'type', 'user_id');
        return response()->json($posts, 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Store Function
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'file' => 'required|file',
            'type' => 'required|in:article,news,letter,data_show',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $fileType = GetTypeFile($request->file('file'));
        $data = $request->only(['title', 'description', 'type', 'user_id']);
        $data['file_type'] = $fileType;
        $data['file'] = $this->UploadFiles($request->file('file'), $request->title, $fileType);

        $post = $this->createRecord(Post::class, $data);

        return response()->json(['post' => $post, 'message' => 'Post created successfully'], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | Show Function
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $post = $this->findById(Post::class, $id);

        return response()->json($post, 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Function
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'file' => 'required|file',
            'type' => 'required|in:article,news,letter,data_show',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only(['title', 'description', 'type', 'user_id']);
        $fileType = GetTypeFile($request->file('file'));

        if ($request->hasFile('file')) {
            $data['file_type'] = $fileType;
            $data['file'] = $this->UploadFiles($request->file('file'), $request->title, $fileType);
        }

        $post = $this->updateRecord(Post::class, $post->id, $data);

        return response()->json(['post' => $post, 'message' => 'Post updated successfully'], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy Function
    |--------------------------------------------------------------------------
    */
    public function destroy(Post $post)
    {
        return $this->deleteRecord($post);
    }
}
