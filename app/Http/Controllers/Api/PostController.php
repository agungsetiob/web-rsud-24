<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Post, User};
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        foreach ($posts as $post) {
            $post->content_preview = Str::limit($post->content, 40);
        }

        return response()->json([
            'success' => true,
            'data'    => $posts,
            'message' => 'Berhasil mengambil daftar blog'
        ], 200);
    }

    public function category($category)
    {
        $posts = Post::whereHas('category', function ($q) use ($category) {
            $q->where('name', $category);
        })->paginate(6);

        foreach ($posts as $post) {
            $post->content_preview = Str::limit($post->content, 40);
        }

        return response()->json([
            'success' => true,
            'data'    => $posts,
            'message' => "Berhasil mengambil blog dengan kategori: $category"
        ], 200);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Blog tidak ditemukan',
            ], 404);
        }

        $post->increment('view');

        $popularPosts = Post::where('id', '!=', $post->id)
                            ->orderBy('view', 'desc')
                            ->limit(3)
                            ->get();

        $relatedPosts = Post::where('category_id', $post->category_id)
                            ->where('id', '!=', $post->id)
                            ->limit(3)
                            ->get();

        return response()->json([
            'success' => true,
            'data'    => [
                'post'          => $post,
                'popular_posts' => $popularPosts,
                'related_posts' => $relatedPosts
            ],
            'message' => 'Detail blog berhasil diambil'
        ], 200);
    }

    public function postByUser($username)
    {
        $posts = Post::whereHas('user', function ($q) use ($username) {
            $q->where('username', $username);
        })->paginate(6);

        foreach ($posts as $post) {
            $post->content_preview = Str::limit($post->content, 40);
        }

        return response()->json([
            'success' => true,
            'data'    => $posts,
            'message' => "Berhasil mengambil blog dari author: $username"
        ], 200);
    }

    public function leaderboard()
    {
        $ranks = User::with('posts')
            ->withCount('posts')
            ->where('status', 'active')
            ->orderByDesc('posts_count')
            ->paginate(8);

        return response()->json([
            'success' => true,
            'data'    => $ranks,
            'message' => 'Data Leaderboard berhasil diambil'
        ], 200);
    }
}
