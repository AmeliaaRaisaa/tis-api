<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;
class PublicApiService
{
 public function getPosts(): array
 {
    $response = Http::withoutVerifying()
        ->timeout(10)
        ->get('https://jsonplaceholder.typicode.com/posts');

    if (!$response->ok()) {
        return [];
    }

    return collect($response->json())
        ->map(function ($post) {
            return [
                'id'     => $post['id'] ?? null,
                'title'  => $post['title'] ?? null,
                'body'   => $post['body'] ?? null,
                'userId' => $post['userId'] ?? null,
            ];
        })
        ->values()
        ->all();
 }
}
