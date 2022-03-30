<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Faker\Generator as Faker;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $tag_names = ['Backend', 'CMS', 'UI/UX', 'Frontend', 'Design', 'FullStack'];
        foreach ($tag_names as $name) {
            $newTag = new Tag();
            $newTag->label = $name;
            $newTag->color = $faker->hexColor();
            $newTag->save();
        }
    }
}
