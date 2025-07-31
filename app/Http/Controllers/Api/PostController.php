<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with(['user', 'category'])->latest()->paginate(6);

        $data = $posts->map(function ($post) {
            return [
                'id' => $post->id,
                'date' => $post->created_at->toIso8601String(),
                'date_gmt' => $post->created_at->setTimezone('UTC')->toIso8601String(),
                'modified' => $post->updated_at->toIso8601String(),
                'modified_gmt' => $post->updated_at->setTimezone('UTC')->toIso8601String(),
                'slug' => $post->slug,
                'status' => 'publish',
                'type' => 'post',
                'link' => url("/blog/{$post->slug}"),
                'title' => [
                    'rendered' => $post->title,
                ],
                'content' => [
                    'rendered' => $post->content,
                    'protected' => false
                ],
                'excerpt' => [
                    'rendered' => Str::limit(strip_tags($post->content), 100),
                    'protected' => false
                ],
                'author' => $post->user->id ?? null,
                'author_name' => $post->user->name ?? null,          // 🔥 Ditambahkan
                'featured_media' => $post->image ?? null,
                'comment_status' => 'open',
                'ping_status' => 'closed',
                'sticky' => false,
                'template' => '',
                'format' => 'standard',
                'meta' => [
                    'view' => $post->view ?? 0,
                ],
                'categories' => [$post->category_id],
                'category_name' => $post->category->name ?? null      // 🔥 Ditambahkan
            ];
        });

        return response()->json([
            'success' => true,
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
