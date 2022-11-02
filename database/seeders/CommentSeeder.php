<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\ForeignKeyCheck;

class CommentSeeder extends Seeder
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
        $this->truncate('comments');
        Comment::factory(3)->create();
        $this->enableForeignKeyChecks();
    }
}
