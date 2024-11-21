<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OAT;

class ApiBukuController extends Controller
{
    #[OAT\Get(path: '/api/buku', tags: ['Buku'])]
    #[OAT\Response(
        response: '200',
        description: 'Get all data buku',
        content: new OAT\JsonContent(
            type: 'array',
            items: new OAT\Items(
                type: 'object',
                properties: [
                    new OAT\Property(property: 'id', type: 'integer', example: 1),
                    new OAT\Property(property: 'judul', type: 'string', example: 'Belajar PHP'),
                    new OAT\Property(property: 'penulis', type: 'string', example: 'John Doe'),
                    new OAT\Property(property: 'harga', type: 'number', format: 'float', example: 99.99),
                    new OAT\Property(property: 'tgl_terbit', type: 'integer', example: 2021),
                    new OAT\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2021-08-01T00:00:00.000000Z'),
                    new OAT\Property(property: 'updated_at', type: 'string', format: 'date-time', example: '2021-08-01T00:00:00.000000Z'),
                    new OAT\Property(property: 'photo', type: 'string', example: 'buku.jpg')
                ]
            ),
            example: [
                [
                    "id" => 1,
                    "judul" => "Ducimus blanditiis",
                    "penulis" => "Pariatur Vel et cor",
                    "harga" => "97",
                    "tgl_terbit" => "1984-07-23",
                    "created_at" => "2024-11-20T02:35:11.000000Z",
                    "updated_at" => "2024-11-20T02:35:11.000000Z",
                    "photo" => "OFYOvtyCZW3oL3C29OurHKFRr6g0ysl0ssUuumIm.jpg"
                ]
            ]
        )
    )]
    public function index()
    {
        $data = Buku::all();
        return response()->json($data);
    }

    #[OAT\Post(path: '/api/buku', tags: ['Buku'])]
    #[OAT\RequestBody(
        required: true,
        content: new OAT\MediaType(mediaType: 'multipart/form-data', schema: new OAT\Schema(type: 'object', properties: [
            new OAT\Property(property: 'judul', type: 'string', example: 'Belajar PHP'),
            new OAT\Property(property: 'penulis', type: 'string', example: 'John Doe'),
            new OAT\Property(property: 'harga', type: 'number', format: 'float', example: 99.99),
            new OAT\Property(property: 'tgl_terbit', type: 'integer', example: 2021),
            new OAT\Property(property: 'photo', type: 'string', format: 'binary', example: 'buku.jpg')
        ]))
    )]
    #[OAT\Response(
        response: '200',
        description: 'Store data buku',
        content: new OAT\JsonContent(
            type: 'object',
            properties: [
                new OAT\Property(property: 'message', type: 'string', example: 'Data berhasil disimpan')
            ]
        )
    )]
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            Log::debug($photo->hashName());
        }

        return response()->json(['message' => 'Data berhasil disimpan']);
    }
}
