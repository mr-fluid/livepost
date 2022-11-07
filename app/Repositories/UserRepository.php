<?PHP

namespace App\Repositories;

use App\Events\Models\User\UserCreated;
use App\Exceptions\UserException;
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

            throw_if(!$created, UserException::class, 'Exception Occured', 404);

            event(new UserCreated($created));

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

            throw_if(!$updated, UserException::class, 'Exception Occured', 404);

            return $user;
        });
    }

    public function forceDelete($user)
    {
        return DB::transaction(function () use ($user) {
            $deleted = $user->forceDelete();
            
            throw_if(!$deleted, UserException::class, 'Exception Occured', 404);

            return 'Deleted';
        });
    }
}
