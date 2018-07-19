<?php

namespace App\Http\Controllers\Api;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * method used to return Setting model
     *
     * @param Setting $setting
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Setting $setting){
        return response()->json([
            'setting' => $setting,
        ]);
    }

    /**
     * method used to update Setting model
     *
     * @param Request $request
     * @param Setting $setting
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Setting $setting){
        $setting->update(request()->all());

        return response()->json([
            'setting' => $setting,
        ]);
    }
}
