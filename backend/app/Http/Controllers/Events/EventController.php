<?php

namespace App\Http\Controllers\Events;

use App\Models\Event;
use App\Models\EventMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Traits\CrudOperationsTrait;
use App\Traits\HandleFile;

class EventController extends Controller
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
        // Retrieve all events with related media
        $events = $this->getAllWithRelation(Event::class, 'media', 'id', 'title', 'description', 'date');

        $transformedEvents = $events->map(function ($event) {
            $images = $event->media->where('type', 'image')->pluck('file')->toArray();
            $videos = $event->media->where('type', 'video')->pluck('file')->toArray();

            return [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'date' => $event->date,
                'images' => $images,
                'videos' => $videos,
            ];
        });

        return response()->json(['events' => $transformedEvents], 200);
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
            'description' => 'required|string',
            'date' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
            'file' => 'required|file',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $eventData = $request->only(['title', 'description', 'date', 'user_id']);
        $event = $this->createRecord(Event::class, $eventData);

        if ($event) {
            $fileType = GetTypeFile($request->file('file'));
            $mediaData = ['event_id' => $event->id, 'file' => $this->UploadFiles($request->file('file'), $request->title, 'file'), 'type' => $fileType];
            $media = $this->createRecord(EventMedia::class, $mediaData);

            return response()->json(['event' => $event, 'media' => $media, 'message' => 'Event created successfully'], 201);
        }

        return response()->json(['error' => 'Failed to create event'], 500);
    }

    /*
    |--------------------------------------------------------------------------
    | Show Function
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        // Retrieve events with related media
        $event = $this->findWithRelation(Event::class, 'media', $id);

        $images = $event->media->where('type', 'image')->pluck('file')->toArray();
        $videos = $event->media->where('type', 'video')->pluck('file')->toArray();

        $transformedEvent = [
            'id' => $event->id,
            'title' => $event->title,
            'description' => $event->description,
            'date' => $event->date,
            'images' => $images,
            'videos' => $videos,
        ];

        return response()->json(['event' => $transformedEvent], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Function
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
            'file' => 'required|file',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $eventData = $request->only(['title', 'description', 'date', 'user_id']);
        $updatedEvent = $this->updateRecord(Event::class, $event->id, $eventData);

        if ($updatedEvent) {
            $fileType = GetTypeFile($request->file('file'));
            $mediaData = ['event_id' => $updatedEvent->id, 'file' => $this->UploadFiles($request->file('file'), $request->title, 'file'), 'type' => $fileType];
            $media = $this->updateRecord(EventMedia::class, $updatedEvent->id, $mediaData);

            return response()->json(['event' => $updatedEvent, 'media' => $media, 'message' => 'Event updated successfully'], 200);
        }

        return response()->json(['error' => 'Failed to update event'], 500);
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy Function
    |--------------------------------------------------------------------------
    */
    public function destroy(Event $event)
    {
        return $this->deleteRecord($event);
    }
}
