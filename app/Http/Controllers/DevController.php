<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DevController extends Controller {
  public function render($view) {
    return view('site.pages.'.$view);
  }
}
