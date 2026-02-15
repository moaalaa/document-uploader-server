<?php

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\UploadedFile;

use function Pest\Laravel\postJson;

test('can create video with provided title and description', function () {
    $user = User::factory()->create();
    apiSignIn($user);

    $file = UploadedFile::fake()->create('video.mp4', 1000, 'video/mp4');

    $response = postJson(route('videos.store'), [
        'title'       => 'My Video',
        'description' => 'My Description',
        'video'       => $file,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'title'       => 'My Video',
            'description' => 'My Description',
        ]);
});

test('can create video with default title and description', function () {
    $user = User::factory()->create();
    apiSignIn($user);

    $file = UploadedFile::fake()->create('video.mp4', 1000, 'video/mp4');

    $response = postJson(route('videos.store'), [
        'video' => $file,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'title'       => 'Video 1',
            'description' => 'Description 1',
        ]);
});

test('can create second video with incremented default title and description', function () {
    $user = User::factory()->create();
    apiSignIn($user);

    Video::factory()->create([
        'creator_id'  => $user->id,
        'title'       => 'Video 1',
        'description' => 'Description 1',
    ]);

    $file = UploadedFile::fake()->create('video.mp4', 1000, 'video/mp4');

    $response = postJson(route('videos.store'), [
        'video' => $file,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'title'       => 'Video 2',
            'description' => 'Description 2',
        ]);
});
