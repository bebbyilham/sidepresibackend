<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use App\Models\DataPekerjaan;
use App\Models\DataPelatihan;
use App\Models\Nurse;
use App\Models\IdentitasProfesi;
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
        // $nurse = Nurse::with('user')
        //     ->find($id);
        $nurse = Nurse::where([
            ["user_id", $id]
        ])->first();
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

    public function create(Request $request)
    {
        $rules = [
            'nama' => 'required|string',
            'user_id' => 'required|string',
            'no_ktp' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat_lengkap' => 'required|string',
            'no_hp' => 'required|numeric',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        $user_id = $request->input('user_id');
        $cekdata =
            Nurse::where([
                ["user_id", $user_id]
            ])->first();
        if (!$cekdata) {
            $nurse = Nurse::create($data);
            $message = 'created';
        } else {
            $nurse = Nurse::where([
                ["user_id", $user_id]
            ])->first();
            $nurse->fill($data);
            $nurse->save();
            $message = 'updated';
        }

        return response()->json(['status' => 'success', 'message' => $message, 'data' => $nurse]);
    }

    public function createidentitasprofesi(Request $request)
    {
        $rules = [
            'user_id' => 'required|string',
            'ijazah_terakhir' => 'required|string',
            'no_ijazah_terakhir' => 'required|string',
            'tahun_ijazah_terakhir' => 'required|string',
            'nama_institusi' => 'required|string',
            'jenis_profesi' => 'required|string',
            'jenjang_profesi' => 'required|string',
            'no_kta' => 'required|string',
            'tgl_daftar_anggota' => 'required|string',
            'no_str' => 'required|string',
            'str_berlaku' => 'required|string',
            'no_sikp' => 'required|string',
            'sikp_berlaku' => 'required|string',
            'no_penugasan' => 'required|string',
            'no_penugasan_berlaku' => 'required|string',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        $user_id = $request->input('user_id');
        $cekdata =
            IdentitasProfesi::where([
                ["user_id", $user_id]
            ])->first();
        if (!$cekdata) {
            $nurse = IdentitasProfesi::create($data);
            $message = 'created';
        } else {
            $nurse = IdentitasProfesi::where([
                ["user_id", $user_id]
            ])->first();
            $nurse->fill($data);
            $nurse->save();
            $message = 'updated';
        }

        return response()->json(['status' => 'success', 'message' => $message, 'data' => $nurse]);
    }

    public function showidentitasprofesi($id)
    {
        // $nurse = Nurse::with('user')
        //     ->find($id);
        $nurse = IdentitasProfesi::where([
            ["user_id", $id]
        ])->first();
        if (!$nurse) {
            return response()->json([
                'status' => 'error',
                'message' => 'identitas profesi not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $nurse
        ]);
    }

    public function createdatapekerjaan(Request $request)
    {
        $rules = [
            'user_id' => 'required|string',
            'status_kepegawaian' => 'required|string',
            'nip' => 'required|string',
            'no_sk_pengangkatan' => 'required|string',
            'ruang_kerja' => 'required|string',
            'ruang_kerja_lain' => 'required|string',
            'jabatan' => 'required|string',
            'total_masa_kerja' => 'required|string',
            'tmt' => 'required|string',
            'riwayat_penempatan' => 'required|string',
            'kesesuaian' => 'required|string',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        $user_id = $request->input('user_id');
        $cekdata =
            DataPekerjaan::where([
                ["user_id", $user_id]
            ])->first();
        if (!$cekdata) {
            $nurse = DataPekerjaan::create($data);
            $message = 'created';
        } else {
            $nurse = DataPekerjaan::where([
                ["user_id", $user_id]
            ])->first();
            $nurse->fill($data);
            $nurse->save();
            $message = 'updated';
        }

        return response()->json(['status' => 'success', 'message' => $message, 'data' => $nurse]);
    }

    public function showdatapekerjaan($id)
    {
        $nurse = DataPekerjaan::where([
            ["user_id", $id]
        ])->first();
        if (!$nurse) {
            return response()->json([
                'status' => 'error',
                'message' => 'identitas profesi not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $nurse
        ]);
    }

    public function createdatapelatuhan(Request $request)
    {
        $rules = [
            'user_id' => 'required|string',
            'jenis_pelatihan' => 'required|string',
            'nama_pelatihan' => 'required|string',
            'tahun_pelaksanaan' => 'required|string',
            'jumlah_ipl' => 'required|string',
            'jumlah_skp' => 'required|string',
            'berlaku' => 'required|string',
            'status_pelatihan' => 'required|string'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        $user_id = $request->input('user_id');
        $cekdata =
            DataPelatihan::where([
                ["user_id", $user_id]
            ])->first();
        // if (!$cekdata) {
        $nurse = DataPelatihan::create($data);
        $message = 'created';
        // } else {
        //     $nurse = DataPelatihan::where([
        //         ["user_id", $user_id]
        //     ])->first();
        //     $nurse->fill($data);
        //     $nurse->save();
        //     $message = 'updated';
        // }

        return response()->json(['status' => 'success', 'message' => $message, 'data' => $nurse]);
    }

    public function updatedatapelatihan(Request $request, $id)
    {
        $rules = [
            'user_id' => 'required|string',
            'jenis_pelatihan' => 'required|string',
            'nama_pelatihan' => 'required|string',
            'tahun_pelaksanaan' => 'required|string',
            'jumlah_ipl' => 'required|string',
            'jumlah_skp' => 'required|string',
            'berlaku' => 'required|string',
            'status_pelatihan' => 'required|string'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $datapelatihan = DataPelatihan::find($id);

        if (!$datapelatihan) {
            return response()->json([
                'status' => 'error',
                'message' => 'datapelatihan not found'
            ], 404);
        }

        // jika ditemukan data datapelatihan akan diupdate
        $datapelatihan->fill($data);

        $datapelatihan->save();
        return response()->json([
            'status' => 'success',
            'data' => $datapelatihan
        ]);
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
