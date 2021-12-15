<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lang;

class LocationController extends Controller
{
   
    public function index(Request $request)
    {
        
        return view('admin.map', [
            'page_title_lang' => Lang::get('admin_pages.map'),
            'controller' => $this
        ]);
    }
}
