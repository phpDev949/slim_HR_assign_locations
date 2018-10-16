<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = 'mysql';
$config['db']['user']   = 'project';
$config['db']['pass']   = 'project';
$config['db']['dbname'] = 'project';



$app = new \Slim\App(['settings' => $config]);
////// DIC configuration //////////// 
$container = $app->getContainer();
////// Service providers /////////////
$container['pdo'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
/** @var \PDO $pdo */
$pdo = $container->get('pdo');
$pdo->prepare("SHOW GLOBAL VARIABLES LIKE '%innodb_log%'");
////// Service factories /////////////
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};
////// Register Twig View helper
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig('../src/templates/', [
        'cache' => false,
    ]);
    
    // Instantiate and add Slim specific extension
    $router = $c->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};
////// Service factory for the ORM /////
$container['db'] = function($container) {
  $capsule = new \Illuminate\Database\Capsule\Manager;
  $capsule->addConnection($container['settings']['db']);
  $capsule->setAsGlobal();
  $capsule->bootEloquent();
  return $capsule;
};
// auth routes
$app->group('/', function () {
    //$this->get('', \Demo\Controller\ExampleController::class . ':getDefault')->setName('get-default');
    $this->get('', \Demo\Controller\HomeController::class . ':getHome')->setName('home-page');
});
$app->group('/api', function () {
    //$this->get('', \Demo\Controller\HomeController::class . ':getHome')->setName('home-page');
    $this->get('/employees', \Demo\Controller\EmployeesController::class . ':getEmployees')->setName('employees-page');
    $this->get('/employee_edit/[{id}]', \Demo\Controller\EmployeeController::class . ':getEmployee')->setName('edit-employee-page');
    
});

$app->run();
