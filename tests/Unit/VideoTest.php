<?php

use App\Models\User;
use App\Models\Video;

beforeEach(function () {
    $this->video = Video::factory()->create();
});

it('belongs to creator', function () {
    expect($this->video->creator)->toBeInstanceOf(User::class);
});
