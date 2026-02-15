<?php

use App\Models\User;
use App\Models\Video;

use function Pest\Laravel\deleteJson;

test('can delete video', function () {
    $user = User::factory()->create();
    apiSignIn($user);

    $video = Video::factory()->create([
        'creator_id' => $user->id,
    ]);

    $response = deleteJson(route('videos.destroy', $video));

    $response->assertStatus(200);

    test()->assertDatabaseMissing('videos', [
        'id' => $video->id,
    ]);
});

test('cannot delete video belonging to another user', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    apiSignIn($user);

    $video = Video::factory()->create([
        'creator_id' => $otherUser->id,
    ]);

    $response = deleteJson(route('videos.destroy', $video));

    $response->assertStatus(403);
});
