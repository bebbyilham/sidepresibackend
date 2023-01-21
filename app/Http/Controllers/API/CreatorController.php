<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreatorController extends Controller
{
    public function index()
    {
        $creators = Creator::all();
        return response()->json([
            'status' => 'success',
            'data' => $creators
        ]);
    }

    public function show($id)
    {
        $creator = Creator::find($id);
        if (!$creator) {
            return response()->json([
                'status' => 'error',
                'message' => 'creator not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $creator
        ]);
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'profile' => 'required|url',
            'profession' => 'required|string',
            'email' => 'required|email'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $creator = Creator::create($data);

        return response()->json(['status' => 'success', 'data' => $creator]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'string',
            'profile' => 'url',
            'profession' => 'string',
            'email' => 'email'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $creator = Creator::find($id);

        if (!$creator) {
            return response()->json([
                'status' => 'error',
                'message' => 'creator not found'
            ], 404);
        }

        // jika ditemukan data creator akan diupdate
        $creator->fill($data);

        $creator->save();
        return response()->json([
            'status' => 'success',
            'data' => $creator
        ]);
    }

    public function destroy($id)
    {
        $creator = Creator::find($id);

        if (!$creator) {
            return response()->json([
                'status' => 'error',
                'message' => 'creator not found'
            ], 404);
        }

        $creator->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'creator deleted'
        ]);
    }
}
