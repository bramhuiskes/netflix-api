<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    public abstract function get(Request $request);
    public abstract function add(Request $request);

    public abstract function delete(Request $request);
    public abstract function update(Request $request);
}
