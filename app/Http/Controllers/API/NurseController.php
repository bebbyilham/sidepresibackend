<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use App\Models\Nurse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NurseController extends Controller
{
    public function index()
    {
        $nurses = Nurse::all();
        return ResponseFormatter::success([
            'user' => $nurses
        ], 'Data ditemukan !');
    }

    public function show($id)
    {
        $nurse = Nurse::with('user')
            ->find($id);
        if (!$nurse) {
            return response()->json([
                'status' => 'error',
                'message' => 'nurse not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $nurse
        ]);
    }

    public function create(Request $request, User $user)
    {
        $rules = [
            'nama' => 'required|string',
            'user_id' => 'required|string',
            'no_ktp' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        // $user = Auth::user();
        // if (!$user) {
        //     return ResponseFormatter::error([
        //         'message' => 'Something went wrong',
        //     ], 'Authentication Failed', 500);
        // }
        $nurse = Nurse::create($data);

        return response()->json(['status' => 'success', 'data' => $nurse]);
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

        $nurse = Nurse::find($id);

        if (!$nurse) {
            return response()->json([
                'status' => 'error',
                'message' => 'nurse not found'
            ], 404);
        }

        // jika ditemukan data nurse akan diupdate
        $nurse->fill($data);

        $nurse->save();
        return response()->json([
            'status' => 'success',
            'data' => $nurse
        ]);
    }

    public function destroy($id)
    {
        $nurse = Nurse::find($id);

        if (!$nurse) {
            return response()->json([
                'status' => 'error',
                'message' => 'nurse not found'
            ], 404);
        }

        $nurse->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'nurse deleted'
        ]);
    }
}
