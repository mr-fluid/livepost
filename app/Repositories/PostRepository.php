<?PHP 

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository{
    public function create(array $attributes)
    {
        return DB::transaction(function() use($attributes){
            $created = Post::query()->create([
                'title' => data_get($attributes,'title','Undefined'),
                'body' => data_get($attributes,'body','Undefined')
            ]);

            $created->users()->sync(1);
            return $created;
        });
    }

    public function update($post, $attributes)
    {
        return DB::transaction(function() use($post,$attributes){
            $updated = $post->update([
                'title' => data_get($attributes,'title',$post->title),
                'body' => data_get($attributes,'body',$post->body)
            ]);
            if(!$updated){

            }
            return $post;
        });
    }

    public function forceDelete($post)
    {
        return DB::transaction(function() use($post){
            $deleted = $post->forceDelete();

            if(!$deleted){
                return 'Not Deleted';
            }
            return 'Deleted';
        });
    }
}