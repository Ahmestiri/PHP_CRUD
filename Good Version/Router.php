<?php
namespace app;
class Router{
    //Declaration of get & post arrays
    public array $getRoutes =[];
    public array $postRoutes =[];
    //Instance of database
    public Database $db;
    public function __construct(){
        $this->db = new Database();
    }
    //Declaration of get,post and resolve functions used in Public/index.php
    public function get($url, $fn){
        $this->getRoutes[$url] = $fn;
    }
    public function post($url, $fn){
        $this->postRoutes[$url] = $fn;
    }
    public function resolve(){
        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET')
            $fn = $this->getRoutes[$currentUrl] ?? null;
        else
            $fn = $this->postRoutes[$currentUrl] ?? null;
        if ($fn) 
            call_user_func($fn, $this);
        else
            echo ("page not found");
    }
    //Render the View from views
    public function renderView($view, $params =[]){
        foreach ($params as $key => $value){
            $$key = $value;
        }
        ob_start();
        include_once __DIR__."/views/$view.php"; 
        $content = ob_get_clean();
        include_once __DIR__."/views/_layout.php";
    }
}
