<?php

namespace App\Http\Controllers;

class AlgorithmController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index()
    {
        $source = $this->getShuffledArray(100);

        $bubbled = $this->loopSort($source);

        return view('algorithms.index', [
            'source' => $source,
            'bubbled' => $bubbled,
            'nav' => $this->nav
        ]);
    }

    public function loopSort($data)
    {
        for ($i = 0; $i <= count($data); $i++) {
            for ($j = $i; $j <= count($data) - 1; $j++) {
                if ($data[$i] > $data[$j]) {
                    $tmp = $data[$i];
                    $data[$i] = $data[$j];
                    $data[$j] = $tmp;
                }
            }
        }

        return $data;
    }

    private function getShuffledArray(int $length = 10): array
    {
        $data = [];

        for ($i = 1; $i <= $length; $i++) {
            $data[] = $i;
        }

        shuffle($data);

        return $data;
    }
}
