<?PHP

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $created = Comment::query()->create([
                'body' => data_get($attributes, 'body', ''),
                'user_id' => data_get($attributes, 'user_id', 1),
                'post_id' => data_get($attributes, 'post_id', 1)
            ]);

            if (!$created) {
            }
            return $created;
        });
    }

    public function update($comment, array $attributes)
    {
        return DB::transaction(function () use ($comment, $attributes) {
            $updated = $comment->update([
                'body' => data_get($attributes, 'body', $comment->body),
                'user_id' => data_get($attributes, 'user_id', $comment->user_id),
                'post_id' => data_get($attributes, 'post_id', $comment->post_id)
            ]);

            if (!$updated) {
            }
            return $comment;
        });
    }

    public function forceDelete($comment)
    {
        return DB::transaction(function () use ($comment) {
            $deleted = $comment->forceDelete();
            if (!$deleted) {

            }
            return 'Deleted';
        });
    }
}
