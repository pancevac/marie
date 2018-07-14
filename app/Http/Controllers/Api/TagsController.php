<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateTagRequest;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    /**
     * method used to show tags paginate by 50
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $tags = Tag::latest()->paginate(50);

        return response()->json([
            'tags' => $tags,
        ]);
    }

    /**
     * method used to store new tag and return
     *
     * @param CreateTagRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateTagRequest $request){
        $tag = Tag::create(request()->all());

        return response()->json([
            'tag' => $tag,
        ]);
    }

    /**
     * method used to return tag
     *
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Tag $tag){
        return response()->json([
            'tag' => $tag,
        ]);
    }

    /**
     * method used to update tag and return
     *
     * @param CreateTagRequest $request
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateTagRequest $request, Tag $tag){
        $tag->update(request()->all());

        return response()->json([
            'tag' => $tag,
        ]);
    }

    /**
     * method used to destroy tag
     *
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Tag $tag){
        $tag->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }
}
