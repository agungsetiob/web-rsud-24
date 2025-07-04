<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::latest()->paginate(6);

        // Format data: limit content & ambil field penting saja
        $data = $posts->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'excerpt' => Str::limit($post->content, 40),
                'created_at' => $post->created_at->toDateTimeString(),
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'List of blog posts',
            'data' => $data,
            'meta' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ],
        ]);
    }
}
