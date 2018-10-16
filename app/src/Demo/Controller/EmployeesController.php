<?php

namespace Demo\Controller;

use Slim\Views\Twig as Twig;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class EmployeesController
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
    public function getEmployees(Request $request, Response $response, array $args = null) :Response
    {
        ////// get employees table from project ////// 
	//$sql = $this->container->get('pdo')->prepare("SELECT * FROM employees;");
	//$sql = $this->container->get('pdo')->prepare("SELECT em.id, first_name, last_name, email, jo.job_title, lo.location_name FROM employees AS em INNER JOIN job_titles AS jo ON em.job_title_id = jo.id INNER JOIN locations AS lo ON em.location_id = lo.id");
	$sql = $this->container->get('pdo')->prepare("SELECT em.id, first_name, last_name, email, jo.job_title FROM employees AS em INNER JOIN job_titles AS jo ON em.job_title_id = jo.id");
	$sql->execute();
	$data = $sql->fetchAll();
	//print_r($data);
        //$this->container['logger']->info("Home page action dispatched");
        $this->container->get('logger')->info("Employees Listing page action dispatched");
	//$this->container['view']->render($response, 'home.twig');
	$this->container->get('view')->render($response, 'employees.html', array('data' => $data));
	return $response;
    }

}
