<?php

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;

require_once 'vendor/autoload.php';

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $category_ids = Category::pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            $post = new Post();
            $post->title = $faker->text(50);
            $post->category_id = $category_ids[rand(0, (count($category_ids) - 1))];
            $post->user_id = 1;
            $post->content = $faker->paragraph(2, false);
            $post->image = $faker->imageUrl(50, 50);
            $post->slug = Str::slug($post->title, '-');
            $post->save();
        }
    }
}
