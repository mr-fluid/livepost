<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\ForeignKeyCheck;
use Database\Factories\Helpers\FactoryHelper;

class PostSeeder extends Seeder
{
    use TruncateTable,ForeignKeyCheck;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeyChecks();
        $this->truncate('posts');
        $posts = Post::factory(300)->create();
        $posts->each(function(Post $post){
            $post->users()->sync([FactoryHelper::getRandomModelId(User::class)]);
        });
        $this->enableForeignKeyChecks();
    }
}
