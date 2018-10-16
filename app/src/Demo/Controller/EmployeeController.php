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
	//$sql = $this->container->get('pdo')->prepare("SELECT * FROM employees;");
	$sql = $this->container->get('pdo')->prepare("SELECT em.id, first_name, last_name, email, jo.job_title FROM employees AS em INNER JOIN job_titles AS jo ON em.job_title_id = jo.id WHERE em.id=$id");
	//$sql->bindParam("id", $args['id']);
        //var_dump($sql);
	$sql->execute();
	$em = $sql->fetch();
        $sql_job = $this->container->get('pdo')->prepare("SELECT * FROM job_titles");
        $sql_job->execute();
        $job_ids = $sql_job->fetchAll();
        $sql_loc = $this->container->get('pdo')->prepare("SELECT * FROM locations");
        $sql_loc->execute();
        $loc_ids = $sql_loc->fetchAll();
        $msql_loc = $this->container->get('pdo')->prepare("SELECT * FROM assigned_locations");
        $msql_loc->execute();
        $ml_ids = $msql_loc->fetchAll();
        //print_r($res_loc);
        $results = array('em' => $em, 'job_ids' => $job_ids, 'loc_ids' => $loc_ids, 'ml_ids' => $ml_ids);
        $this->container->get('logger')->info("Employee edit page action dispatched");
	//$this->container['view']->render($response, 'home.twig');
	//$this->container->get('view')->render($response, 'employee_edit.html');
	$this->container->get('view')->render($response, 'employee_edit.html', array('results' => $results));
	return $response;
    }

    public function editEmployee(Request $request, Response $response, array $args = null) :Response
    {
	$data = $request->getParams();
	$d_id = $data['id'];
	$d_fn = $data['first_name'];
	$d_ln = $data['last_name'];
	$d_e = $data['email'];
	$dj = $data['job_title'];
	$nj = $data['new_location'];
        /////// edit existing employee by checking if any changes from the DB /////	
	$e_sql = $this->container->get('pdo')->prepare("SELECT * FROM employees WHERE id = $d_id;");
	$e_sql->execute();
	$e_res = $e_sql->fetchAll();
	//var_dump($e_res);
        /////// first check if any change in job_title or locations (ids) from database)
	$job_change1 = $this->container->get('pdo')->prepare("SELECT id FROM job_titles WHERE job_title = '$dj'");
	$job_change1->execute();
	$j_ch = $job_change1->fetch();
	//var_dump($j_ch);
	$j_c = $j_ch['id'];
	if($j_c != $e_res[0]['job_title_id']) {
		if($e_res[0]['job_title_id'] == NULL) {
			$response->getBody()->write('No such job title exist.../n');
		} else {
		  try {		
			$q = $this->container->get('pdo')->prepare("UPDATE employees SET job_title_id = $j_c WHERE id = $d_id");
			$q->execute();
			$response->getBody()->write('Job title updated.../n');
		  } catch(Exception $e) {
			$response->getBody()->write('Bad SQL inside job_title_id.../n');
 		  }
		  return $response->withRedirect('/api/employees');
		}
	} 
	$a_loc1 = $this->container->get('pdo')->prepare("SELECT * FROM assigned_locations WHERE employee_id = '$d_id'");
	$a_loc1->execute();
	$a_ch = $a_loc1->fetchAll();
	$a_cnt = count($a_ch);
	$a_list = array();
	//print_r($a_ch);
	for ($i=0;$i<$a_cnt;$i++) {
		$aa = 'assigned_loc_' . $a_ch[$i]['id'];
		array_push($a_list,$aa);
		if ($data[$aa] != NULL) {
			echo 'XXXX = ' . $data[$aa];
		}
	}
	/////// update assigned_locations //////////
	//for ($i=0;$i<$a_ch;$i++) {
	//	$ab = $a_list[$i];
	//	if ($data['$ab'] == NULL) {
	//		echo 'NULL   AAAAA';
 	//	} else {
	//		echo 'NOTNULL    BBBBB';
	//	}
	//}	
	print_r($a_list);
	//if($l_ch != $e_res[0]['location_id']) {
	//	if($e_res[0]['location_id'] == NULL) {
	//		$response->getBody()->write('No such location exist.../n');
	//	} else {
	//		$q = $this->container->get('pdo')->prepare("UPDATE employees SET location_id = $l_ch WHERE id = $d_id");
	//		$q->execute();
	//		$response->getBody()->write('Location name updated.../n');
	//	}
	//}
	if($d_fn != $e_res[0]['first_name']) {
		if($d_fn == NULL) {
			$response->getBody()->write('No first name has been provided.../n');
		} else {
			$q = $this->container->get('pdo')->prepare("UPDATE employees SET first_name = '$d_fn' WHERE id = $d_id");
			$q->execute();
			$response->getBody()->write('First name updated.../n');
		}
	}
	if($d_ln != $e_res[0]['last_name']) {
		if($d_ln == NULL) {
			$response->getBody()->write('No last name has been provided.../n');
		} else {
			$q = $this->container->get('pdo')->prepare("UPDATE employees SET last_name = '$d_ln' WHERE id = $d_id");
			$q->execute();
			$response->getBody()->write('Last name updated.../n');
		}
	}
	if($d_e != $e_res[0]['email']) {
		if($d_e == NULL) {
			$response->getBody()->write('No email has been provided.../n');
		} else {
			$q = $this->container->get('pdo')->prepare("UPDATE employees SET email = '$d_e' WHERE id = $d_id");
			$q->execute();
			$response->getBody()->write('Email updated.../n');
		}
	}
	//// insert new assigned location ////////
	if ($nj != NULL) {
		$q = $this->container->get('pdo')->prepare("INSERT INTO assigned_locations(id,employee_id,location_name) VALUES (NULL,$d_id,'$nj')");
		$q->execute();
		$response->getBody()->write('New location has been added.../n');
	}
	return $response;
	//return $response->withRedirect('/api/employees');
    }

    public function addEmployee(Request $request, Response $response, array $args = null) :Response
    {
	$data = $request->getParams();
	$action = $args['action'];
	//var_dump($action);
	$d_fn = $data['first_name'];
	$d_ln = $data['last_name'];
	$d_e = $data['email'];
	$dj = $data['job_title'];
	//$lj = $data['location_name'];
	//print_r($data);
        /////// insert into DB //////////
	if ( $d_fn != NULL && $d_ln != NULL && $d_e != NULL) { 
			//$q = $this->container->get('pdo')->prepare("INSERT INTO employees (id,first_name,last_name,email,job_title_id,location_id) VALUES (NULL, '$d_fn', '$d_ln', '$d_e', $dj, $lj);");
			$q = $this->container->get('pdo')->prepare("INSERT INTO employees (id,first_name,last_name,email,job_title_id) VALUES (NULL, '$d_fn', '$d_ln', '$d_e', $dj);");
			$q->execute();
			$response->getBody()->write('New employee inserted.../n');

	}	  
        $this->container->get('logger')->info("Employee add page action dispatched");
	//$this->container['view']->render($response, 'home.twig');
	//$this->container->get('view')->render($response, 'employee_edit.html');
	$this->container->get('view')->render($response, 'employee_add.html', array('results' => $results));
	return $response->withRedirect('/api/employees');
    }

   public function getJ_Lids(Request $request, Response $response, array $args = null) : Response 
   {
	$action=$args['action'];
        /////// first get job_title or locations (ids) from database)
	$job_ids = $this->container->get('pdo')->prepare("SELECT * FROM job_titles");
	$job_ids->execute();
	$j_ids = $job_ids->fetchAll();
	$loc_ids = $this->container->get('pdo')->prepare("SELECT * FROM locations");
	$loc_ids->execute();
	$l_ids = $loc_ids->fetchAll();
	$results = array('job_ids' => $j_ids,'loc_ids' => $l_ids);
	//var_dump($results);
        $this->container->get('logger')->info("Employee add page action dispatched");
	//$this->container['view']->render($response, 'home.twig');
	//$this->container->get('view')->render($response, 'employee_edit.html');
	$this->container->get('view')->render($response, 'employee_add.html', array('results' => $results));

	return $response;
   }
    
    public function deleteEmployee(Request $request, Response $response, array $args = null) :Response
   {
	$id=$args['id'];
        /////// delete from DB //////////
	if ( $id != NULL) { 
			$q = $this->container->get('pdo')->prepare("DELETE FROM employees WHERE id = $id");
			$q->execute();
			$response->getBody()->write('Employee deleted inserted.../n');
			$q = $this->container->get('pdo')->prepare("DELETE FROM assigned_locations WHERE employee_id = $id");
			$q->execute();
			$response->getBody()->write('Assigned Locations Employee deleted inserted.../n');
	}	  
        $this->container->get('logger')->info("Employee deleted page action dispatched");
	//$this->container['view']->render($response, 'home.twig');
	//$this->container->get('view')->render($response, 'employee_edit.html');
	return $response->withRedirect('/api/employees');
    }

}
