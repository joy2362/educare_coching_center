<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(){

        return view('admin.pages.section.index');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
        ]);

    }
}
