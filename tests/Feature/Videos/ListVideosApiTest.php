<?php

use App\Models\User;
use App\Models\Video;

use function Pest\Laravel\getJson;

test('can list all videos', function () {
    $user = User::factory()->create();
    apiSignIn($user);

    $videos = Video::factory(3)->create();

    $response = getJson(route('videos.index'));

    $response->assertStatus(200)
        ->assertJsonCount(3);
});
