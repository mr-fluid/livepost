<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Exceptions\PostException;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{

    private $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $pages = $request->pages ?? 10;
        $posts = Post::query()->paginate($pages);
        return  PostResource::collection($posts);
    }


    public function store(StorePostRequest $request)
    {
        $created = $this->repository->create($request->only([
            'title', 'body'
        ]));
        
        return new PostResource($created);
    }


    public function show(Post $post)
    {
        return new PostResource($post);
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        $updated = $this->repository->update($post, $request->only([
            'title', 'body'
        ]));
        return new PostResource($updated);
    }


    public function destroy(Post $post)
    {
        $deleted = $this->repository->forceDelete($post);
        return new JsonResponse([
            'data' => $deleted
        ]);
    }
}
