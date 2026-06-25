<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplatesController extends Controller
{
    public function index(Request $request)
    {
        $templates = Template::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('templates', compact('templates'));
    }
}
