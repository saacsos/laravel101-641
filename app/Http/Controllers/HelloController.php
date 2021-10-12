<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        return "Hello Laravel";
    }

    public function array()
    {
        return [
            'message' => 'Hello Laravel',
            'success' => true,
            'error' => false,
            'number' => 10
        ];
    }

    public function posts($id = null)
    {
        if ($id === null) {
            return "All Posts";
        }
        return "Post ID: " . $id;
    }

    public function about()
    {
        return view('about', [
            'name' => 'Your Name',
            'info' => [
                'address' => '<b>Kasetsart</b> University',
                'email' => 'contact@ku.th<script>alert("Attack Code")</script>'
            ]
        ]);
    }
}
