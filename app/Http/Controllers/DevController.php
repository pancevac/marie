<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DevController extends Controller {
  public function render($view='home') {
    return view('themes.' . env('APP_THEME') . '.pages.'.$view);
  }
}
