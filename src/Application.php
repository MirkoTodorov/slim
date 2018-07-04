<?php

namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Services\UserService;

class Application extends \Slim\App{

    public function __construct(){
        $c = new \Slim\Container;
        parent::__construct($c);
        $this->configureTwig();
        $this->configureDatabase();
        $this->configureServices();
    }

    public function configureTwig(){
        $c = $this->getContainer();

        $loader = new \Twig_Loader_Filesystem(__DIR__.'/Views');
        $c['twig'] = new \Twig_Environment($loader, array(
            // 'cache' => __DIR__.'/Views'
        ));
    }

    public function configureDatabase(){

        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'slim',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        $capsule->bootEloquent();
    }

    public function configureServices(){
        $c = $this->getContainer();

        $c['userService'] = new UserService();
    }
    
}

