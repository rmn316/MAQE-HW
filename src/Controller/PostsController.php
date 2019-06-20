<?php

namespace App\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PostsController extends AbstractController
{
    public function index()
    {
        $client = new Client(['base_uri' => 'http://maqe.github.io/json/']);
        $promises = [
            'authors' => $client->getAsync('authors.json'),
            'posts' => $client->getAsync('posts.json'),
        ];

        $responses = Promise\settle($promises)->wait(true);

        $posts = json_decode($responses['posts']['value']->getBody(), true);
        $authors = json_decode($responses['authors']['value']->getBody(), true);

        foreach ($posts as &$post) {
            $authorId = array_search($post['author_id'], array_column($authors, 'id'));
            $post['author'] = $authors[$authorId];
        }

        return $this->render('posts/index.html.twig', ['posts' => $posts]);
    }
}