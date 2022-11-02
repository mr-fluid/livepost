<?PHP 
namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait ForeignKeyCheck{

    protected function disableForeignKeyChecks(){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }

    protected function enableForeignKeyChecks(){
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}