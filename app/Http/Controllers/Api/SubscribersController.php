<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateSubscriberRequest;
use App\Http\Requests\EditSubscriberRequest;
use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribersController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $subscribers = Subscriber::orderBy('id', 'DESC')->paginate(50);

        return response()->json([
            'subscribers' => $subscribers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubscriberRequest $request){
        $subscriber = Subscriber::create(request()->all());

        return response([
            'subscriber' => $subscriber,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber){
        return response([
            'subscriber' => $subscriber
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(EditSubscriberRequest $request, Subscriber $subscriber){
        $subscriber->update(request()->all());

        return response([
            'subscriber' => $subscriber
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber){
        $subscriber->delete();

        return response([
            'message' => 'Pretplatnik je obrisan.'
        ]);
    }
}
