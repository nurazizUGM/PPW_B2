<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OpenApi\Attributes as OAT;

class ApiPostController extends Controller
{
    #[OAT\Get(path: '/api/gallery', description: 'Get all posts with picture', tags: ['Gallery'])]
    #[OAT\Response(response: '200', description: 'Success', content: new OAT\JsonContent(
        type: 'array',
        items: new OAT\Items(
            type: 'object',
            properties: [
                new OAT\Property(property: 'id', type: 'integer', example: 1),
                new OAT\Property(property: 'title', type: 'string', example: "Impedit omnis vitae"),
                new OAT\Property(property: 'content', type: 'string', example: "Nemo est velit sapie"),
                new OAT\Property(property: 'picture', type: 'string', example: "posts/FZN9JEP3UYagtjMluLK8y74bMy0jWzNVzZb5Cz3i.jpg"),
                new OAT\Property(property: 'created_at', type: 'string', example: "2024-11-05T19:07:54.000000Z"),
                new OAT\Property(property: 'updated_at', type: 'string', example: "2024-11-05T19:07:54.000000Z"),
            ]
        )
    ))]
    public function getAll()
    {
        $posts  = Post::whereNotNull('picture')->get();
        return response()->json($posts);
    }

    #[OAT\Post('/api/gallery', description: 'Create new Post', tags: ['Gallery'], requestBody: new OAT\RequestBody(
        required: true,
        content: new OAT\MediaType(
            mediaType: 'multipart/form-data',
            schema: new OAT\Schema(
                type: 'object',
                properties: [
                    new OAT\Property(property: 'title', type: 'string', example: ''),
                    new OAT\Property(property: 'content', type: 'string', example: ''),
                    new OAT\Property(property: 'picture', type: 'string', format: 'binary'),
                ]
            )
        )
    ))]
    #[OAT\Response(response: '200', description: 'Success', content: new OAT\JsonContent(
        type: 'object',
        properties: [
            new OAT\Property(property: 'success', type: 'string', example: 'Post created successfully.')
        ]
    ))]
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'picture' => 'required,image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $img = $request->file('picture');
            $data['picture'] = $img->storeAs('posts', $img->hashName(), 'public');
        }

        Post::create($data);
        return response()->json(['success' => 'Post created successfully.']);
    }

    #[OAT\Delete(path: '/api/gallery/{id}', description: 'Delete Post by ID', tags: ['Gallery'])]
    #[OAT\Parameter(name: 'id', in: 'path', required: true, description: 'Post ID', example: 1, schema: new OAT\Schema(type: 'integer'))]
    #[OAT\Response(response: '200', description: 'Success', content: new OAT\JsonContent(
        type: 'object',
        properties: [
            new OAT\Property(property: 'success', type: 'string', example: 'Post deleted successfully.')
        ]
    ))]
    public function delete(string $id)
    {
        $post = Post::findOrFail($id);
        if ($post->picture && Storage::disk('public')->exists('posts/' . $post->picture)) {
            Storage::disk('public')->delete('posts/' . $post->picture);
        }

        $post->delete();
        return response()->json(['success' => 'Post deleted successfully.']);
    }
}
