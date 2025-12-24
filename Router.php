<?php


class Router {
       
      private $url ;

      private $routes = [

    
    '/' => 'Controllers/home.php',
    
    '/about' => 'Controllers/about.php',
    '/contact' => 'Controllers/contact.php',
    '/services' => 'Controllers/services.php',
    '/login' => 'Controllers/login.php',
    '/signup' => 'Controllers/signup.php',
    '/profile' => 'Controllers/profile.php',
    '/logout' => 'Controllers/logout.php'
     ];
      
      public function __construct($url){
       
       $this->url = parse_url($url , PHP_URL_PATH) ;
       
      }

      public function GetRoute(){

       if(array_key_exists($this->url , $this->routes)){
            require  $this->routes[$this->url];
       }else {

            require  "Views/404.view.php";
      };
      
     

      }    

}

$route = new Router($_SERVER["REQUEST_URI"]);

$route->GetRoute();