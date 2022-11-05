<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    private $repository;

    public function __construct(CommentRepository $repository){
        $this->repository = $repository;
    }
    
    public function index()
    {
        $comments = Comment::query()->get();
        return CommentResource::collection($comments);
    }

    
    public function store(StoreCommentRequest $request)
    {
        $created = $this->repository->create($request->only([
            'body','user_id','post_id'
        ]));

        return new CommentResource($created);
    }

    
    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

   
    public function update(Request $request, Comment $comment)
    {
        $updated = $this->repository->update($comment,$request->only([
            'body','user_id','post_id'
        ]));

        return new CommentResource($updated);
    }

    
    public function destroy(Comment $comment)
    {
        $deleted = $this->repository->forceDelete($comment);

        return new JsonResponse($deleted);
    }
}
