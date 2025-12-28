<?php


class Router {
    

    private $url;
  
    private $method;
    

    private $getRoutes = [
        '/' => 'Controllers/home.php',
        '/about' => 'Controllers/about.php',
        '/contact' => 'Controllers/contact.php',
        '/login' => 'Controllers/login.php',
        '/signup' => 'Controllers/signup.php',
        '/profile' => 'Controllers/profile.php',
        '/books' => 'Controllers/books.php',
        '/admin' => 'Controllers/admin.php',
        '/logout' => 'Controllers/logout.php'
    ];
    
  
   private $postRoutes = [
        '/login' => 'Controllers/login.php',
        '/signup' => 'Controllers/signup.php',
        '/borrow' => 'Controllers/borrow.php',
        '/return' => 'Controllers/borrow.php',
        '/admin' => 'Controllers/admin.php'
    ];

    public function __construct($url) {
       
        $this->url = parse_url($url, PHP_URL_PATH);
        
       
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
    
  
    public function getRoute() {
        
      
        if ($this->method === 'GET') {
            
           
            if (array_key_exists($this->url, $this->getRoutes)) {
           
                require $this->getRoutes[$this->url];
            } else {
            
                require "Views/404.view.php";
            }
            
        } 
       
        elseif ($this->method === 'POST') {
            
           
            if (array_key_exists($this->url, $this->postRoutes)) {
               
                require $this->postRoutes[$this->url];
            } else {
                
                require "Views/404.view.php";
            }
        }
    }
}


$route = new Router($_SERVER["REQUEST_URI"]);


$route->getRoute();