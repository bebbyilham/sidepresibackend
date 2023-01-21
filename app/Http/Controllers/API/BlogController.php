<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::query();

        $q = $request->query('q');
        $status = $request->query('status');

        //search /filter
        $blogs->when($q, function ($query) use ($q) {
            return $query->whereRaw("name LIKE '%" . strtolower($q) . "%'");
        });

        $blogs->when($status, function ($query) use ($status) {
            return $query->orderByRaw('id DESC')->where('status', '=', $status);
        });

        return response()->json([
            'status' => 'success',
            'data' => $blogs->paginate(10)
        ]);
    }

    //endpoint utk menampilkan detail blog
    public function show($id)
    {
        $blog = Blog::with('creator')
            ->with('images')
            ->find($id);

        if (!$blog) {
            return response()->json([
                'status' => 'error',
                'message' => 'blog not found'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $blog
        ]);
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'thumbnail' => 'string|url',
            'category' => 'required|in:berita,artikel,info komkep',
            'status' => 'required|in:draft,published',
            'creator_id' => 'required|integer',
            'description' => 'string'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $creatorId = $request->input('creator_id');
        $creator = Creator::find($creatorId);
        if (!$creator) {
            return response()->json([
                'status' => 'error',
                'message' => 'creator not found'
            ], 404);
        }

        $blog = Blog::create($data);
        return response()->json([
            'status' => 'success',
            'data' => $blog
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'string',
            'thumbnail' => 'string|url',
            'category' => 'in:berita,artikel,info komkep',
            'status' => 'in:draft,published',
            'creator_id' => 'integer',
            'description' => 'string'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $blog = Blog::find($id);
        //cek blog id
        if (!$blog) {
            return response()->json([
                'status' => 'error',
                'message' => 'blog not found'
            ], 404);
        }

        //cek creator id
        $creatorId = $request->input('creator_id');
        if ($creatorId) {
            $creator = Creator::find($creatorId);
            if (!$creator) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'creator not found'
                ], 404);
            }
        }

        //jika validasi sukses dan blog id ditemukan
        //maka data blog update

        $blog->fill($data);
        $blog->save();

        return response()->json([
            'status' => 'success',
            'data' => $blog
        ]);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'status' => 'error',
                'message' => 'blog not found'
            ], 404);
        }

        $blog->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'blog deleted'
        ]);
    }
}
