<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
//        return \inertia('home',[]); alternative

        return Inertia::render('Home', [
            'title' => 'Home',
        ]);
//            ->withViewData([
//            'title' => 'Home',
//        ]);
    }

    public function about()
    {
//        return \inertia('home',[]); alternative

        return Inertia::render('About', [
            'title' => 'About us',
        ]);
//            ->withViewData([
//            'title' => 'About us',
//        ]);
    }
}
