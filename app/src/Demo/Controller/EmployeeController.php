<?php

namespace Demo\Controller;

use Slim\Views\Twig as Twig;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class EmployeeController
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
    public function getEmployee(Request $request, Response $response, array $args) :Response
    {
	$id=$args['id'];
        ////// get employees table from project ////// 
	$sql = $this->container->get('pdo')->prepare("SELECT em.id, first_name, last_name, email, jo.job_title, lo.location_name FROM employees AS em INNER JOIN job_titles AS jo ON em.job_title_id = jo.id INNER JOIN locations AS lo ON em.location_id = lo.id WHERE em.id=$id");
	$sql->execute();
	$data = $sql->fetch();
	$sql_j = $this->container->get('pdo')->prepare("SELECT * FROM job_titles");
	$sql_l = $this->container->get('pdo')->prepare("SELECT * FROM locations");
	$sql_j->execute();
	$sql_l->execute();
	$j_titles = $sql_j->fetchAll();
	$locs = $sql_l->fetchAll();
        //$this->container['logger']->info("Home page action dispatched");
        $this->container->get('logger')->info("Employee edit page action dispatched");
	//$this->container['view']->render($response, 'home.twig');
	//$this->container->get('view')->render($response, 'employee_edit.html');
	$this->container->get('view')->render($response, 'employee_edit.html', array('data[0]' => $data, 'data[1]' => $j_titles, 'data[2]' => $locs));
	return $response;
    }

    public function addEmployee(Request $request, Response $response, array $args = null) :Response
    {
        /////// create new employee 
	//$sql = $this->container->get('pdo')->prepare("SELECT * FROM employees;");

        return $response;
    }
    
}
