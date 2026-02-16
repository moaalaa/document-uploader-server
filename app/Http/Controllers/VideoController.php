<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Video;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Video::latest()->get(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoRequest $request)
    {
        $validated = $request->validated();

        if (empty($validated['title']) || empty($validated['description'])) {
            $count = Video::where('creator_id', auth()->id())->count() + 1;
            $validated['title'] ??= "Video {$count}";
            $validated['description'] ??= "Description {$count}";
        }

        $video = Video::create([
            ...$validated,
            'video_url' => $request->file('video')->store('videos', 'public'),
            'creator_id' => auth()->id(),
        ]);

        return response()->json($video, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        // Gate::authorize('view', $video);

        return response()->json($video, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        // Gate::authorize('update', $video);

        if ($request->hasFile('video')) {
            $video->update([
                ...$request->validated(),
                'video_url' => $request->file('video')->store('videos', 'public'),
            ]);
        } else {
            $video->update($request->validated());
        }

        return response()->json($video, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        // Gate::authorize('delete', $video);

        $video->delete();

        return response()->json(null, Response::HTTP_OK);
    }
}
