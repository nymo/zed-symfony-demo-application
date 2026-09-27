<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AttributeRouteController
{
    #[Route('/attribute/{id}', name: 'attribute_show', methods: ['GET'])]
    public function show(int $id): Response
    {
        return new Response(sprintf('Attribute route id: %d', $id));
    }

    public function preview(): Response
    {
        return new Response('Add a Route attribute to expose this action.');
    }
}
