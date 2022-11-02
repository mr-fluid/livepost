<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Traits\ForeignKeyCheck;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\Traits\TruncateTable;


class UserSeeder extends Seeder
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
        $this->truncate('users');
        User::factory(10)->create();
        $this->enableForeignKeyChecks();
    }
}
