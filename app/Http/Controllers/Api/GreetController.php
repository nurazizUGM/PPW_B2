<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use OpenApi\Attributes as OAT;

class GreetController extends Controller
{
    #[OAT\Get(path: '/api/greet', tags: ['Greet'], summary: 'Greet a user')]
    #[OAT\Parameter(name: 'first_name', in: 'query', description: 'First name', required: true, schema: new OAT\Schema(type: 'string', enum: ['John', 'Jane']))]
    #[OAT\Parameter(name: 'last_name', in: 'query', description: 'Last name', required: true, schema: new OAT\Schema(type: 'string'))]
    #[OAT\Response(response: '200', description: 'Successful operation')]
    public function greet(Request $request)
    {
        $firstName = $request->get('first_name');
        $lastName = $request->get('last_name');

        return response()->json([
            'message' => "Hello, $firstName $lastName!"
        ]);
    }
}
