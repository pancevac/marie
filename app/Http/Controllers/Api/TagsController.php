<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateTagRequest;
use App\Tag;
use App\Traits\SearchableTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    use SearchableTraits;

    /**
     * method used to return tags list
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        return response()->json([
            'tags' => Tag::select('id', 'title')->visible()->get(),
        ]);
    }

    /**
     * method used to store new tag and return
     *
     * @param CreateTagRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateTagRequest $request){
        return response()->json([
            'tag' => Tag::create(request()->all()),
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


    /**
     * method used to search tags paginate by 50
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(){
        return response()->json([
            'tags' => Tag::search()->paginate(Tag::$paginate),
        ]);
    }
}
