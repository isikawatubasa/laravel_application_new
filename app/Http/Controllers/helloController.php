<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        $cart_list = [
            'cart_item1' => [
                'product' => 'ノート',
                'quantity' => '2'
            ],
            'cart_item2' => [
                'product' => 'ボールペン',
                'quantity' => '3'
            ],
        ];

        dd($cart_list);
    }
}
