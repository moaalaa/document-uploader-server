<?php

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\UploadedFile;

use function Pest\Laravel\putJson;

test('can update video with valid data', function () {
    $user = User::factory()->create();
    apiSignIn($user);

    $video = Video::factory()->create([
        'creator_id'  => $user->id,
        'title'       => 'Old Title',
        'description' => 'Old Description',
    ]);

    $file = UploadedFile::fake()->create('video.mp4', 1000, 'video/mp4');

    $response = putJson(route('videos.update', $video), [
        'title'       => 'New Title',
        'description' => 'New Description',
        'video'       => $file,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'title'       => 'New Title',
            'description' => 'New Description',
        ]);

    test()->assertDatabaseHas('videos', [
        'id'          => $video->id,
        'title'       => 'New Title',
        'description' => 'New Description',
    ]);
});

test('cannot update video belonging to another user', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    apiSignIn($user);

    $video = Video::factory()->create([
        'creator_id' => $otherUser->id,
    ]);

    $file = UploadedFile::fake()->create('video.mp4', 1000, 'video/mp4');

    $response = putJson(route('videos.update', $video), [
        'title'       => 'New Title',
        'description' => 'New Description',
        'video'       => $file,
    ]);

    $response->assertStatus(403);
});
