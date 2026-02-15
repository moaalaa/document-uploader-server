<?php

namespace Database\Factories;

use App\Enums\VideoStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'       => fake()->sentence(3),
            'thumbnail'   => fake()->imageUrl(640, 480),
            'video_url'   => fake()->url(),
            'file_size'   => fake()->randomNumber(5),
            'duration'    => fake()->randomNumber(5),
            'status'      => VideoStatus::Processing->value,
            'is_new'      => true,
            'format'      => fake()->randomElement(['mp4', 'avi', 'mov', 'wmv', 'flv']),
            'upload_at'   => fake()->dateTimeBetween('-1 year', 'now'),
            'views'       => fake()->randomNumber(5),
            'resolution'  => fake()->randomElement(['1080p', '720p', '480p']),
            'description' => fake()->text(),
            'creator_id'  => User::factory(),
        ];
    }
}
