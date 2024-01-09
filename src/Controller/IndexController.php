<?php

namespace App\Controller;

use Phpml\Classification\KNearestNeighbors;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    #[Route(
        path: '/',
        name: 'index',
        methods: [Request::METHOD_GET]
    )]
    public function index()
    {
        $samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
        $labels = ['a', 'a', 'a', 'b', 'b', 'b'];

        $classifier = new KNearestNeighbors();
        $classifier->train($samples, $labels);

        $result = $classifier->predict([3, 2]);
        return new Response($result);
    }

}
