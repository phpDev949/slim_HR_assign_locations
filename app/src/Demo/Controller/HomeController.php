<?php

namespace Demo\Controller;

use Slim\Views\Twig as Twig;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function getHome(Request $request, Response $response, array $args = null) :Response
    {
        //$this->container['logger']->info("Home page action dispatched");
        $this->container->get('logger')->info("Home page action dispatched");
	//$this->container['view']->render($response, 'home.twig');
	$this->container->get('view')->render($response, 'home.twig');
	return $response;
    }

}
