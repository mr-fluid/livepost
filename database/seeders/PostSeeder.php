<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\ForeignKeyCheck;

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
        Post::factory(3)->create();
        $this->enableForeignKeyChecks();
    }
}
