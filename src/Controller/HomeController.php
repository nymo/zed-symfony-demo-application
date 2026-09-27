<?php

namespace App\Controller;

use App\HelloWorld\Generator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class HomeController
{
    public function __construct(private readonly Generator $generator)
    {
    }

    public function index(Environment $twig, UrlGeneratorInterface $urls): Response
    {
        $hello = $this->generator->generate();
        $helloUrl = $urls->generate('hello_world', ['name' => 'Zed']);

        return new Response($twig->render('home/index.html.twig', [
            'hello' => $hello,
            'helloUrl' => $helloUrl,
        ]));
    }

    public function hello(string $name, Environment $twig): Response
    {
        return new Response($twig->render('home/hello.html.twig', [
            'name' => $name,
            'hello' => $this->generator->generate(),
        ]));
    }
}
