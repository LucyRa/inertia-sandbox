<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class XrateController extends Controller
{
    public function index ()
    {
        return Inertia::render('Xrate/Index');
    }
}
