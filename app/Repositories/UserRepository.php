<?PHP

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $created = User::query()->create([
                'name' => data_get($attributes, 'name', ''),
                'email' => data_get($attributes, 'email', ''),
                'password' => bcrypt(data_get($attributes, 'password', 'Admin@123'))
            ]);

            if (!$created) {
            }
            return $created;
        });
    }

    public function update($user, array $attributes)
    {
        return DB::transaction(function () use ($user, $attributes) {
            $updated = $user->update([
                'name' => data_get($attributes, 'name', $user->name),
                'email' => data_get($attributes, 'email', $user->email)
            ]);

            if (!$updated) {
            }
            return $user;
        });
    }

    public function forceDelete($user)
    {
        return DB::transaction(function () use ($user) {
            $deleted = $user->forceDelete();
            if (!$deleted) {
            }
            return 'Deleted';
        });
    }
}
