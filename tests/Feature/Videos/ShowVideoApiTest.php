<?php

use App\Models\User;
use App\Models\Video;

use function Pest\Laravel\getJson;

test('can show video', function () {
    $user = User::factory()->create();
    apiSignIn($user);

    $video = Video::factory()->create([
        'creator_id' => $user->id,
    ]);

    $response = getJson(route('videos.show', $video));

    $response->assertStatus(200)
        ->assertJson([
            'id'    => $video->id,
            'title' => $video->title,
        ]);
});

test('returns 404 for non-existent video', function () {
    $user = User::factory()->create();
    apiSignIn($user);

    $response = getJson(route('videos.show', 'non-existent-id'));

    $response->assertStatus(404);
});
