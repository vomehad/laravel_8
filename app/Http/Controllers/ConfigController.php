<?php

namespace App\Http\Controllers;

class ConfigController extends Controller
{
    public function getAll()
    {
        $config = config();
        foreach (reset($config) as $one) {
            dump($one);
        }

        return view('general.config', $config);
    }

    public function getByKey($key)
    {
        dd(config($key));
    }
}
