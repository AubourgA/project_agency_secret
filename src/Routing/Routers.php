<?php 

namespace App\Routing;


use ReflectionParameter;
use App\Controllers\HelpController;
use App\Controllers\HomeController;
use ReflectionMethod;

require './../vendor/autoload.php';

/**
 * Router of application
 * Simply router with only $id like dependency
 */
class Routers

{

    /**
     * main function launch router
     *
     * @param string $request
     * @return void
     */
    public function run(string $request)
    {
    
       
       $array_request = $this->getExplodeURL($request); 
    
       //controller par défaut
       if($array_request === ['']) {
          $home = new HomeController();
          $home->index();
       }

       //recupere le controler
       $controller = $this->getController($array_request);

       //recuperer la méthode
       $method = $this->getMethod($array_request);
     
       
       //correspondance entre le controller et la method si elle existe
        $this->matches_controller_method($controller, $method, $array_request);
      
       
    }


    /**
     * cut REQUEST_URI to an array 
     *
     * @param string $URI
     * @return array
     */
    public function getExplodeURL(string $URI):array
    {
        $trimURI = trim($URI, '/');
        $explodeURI = explode('/', $trimURI);

        return $explodeURI;
    }


    /**
     * extract Controller from request
     *
     * @param array $array_request
     * @return string
     */
    public function getController(array $array_request):string
    {
        $paramController = ucfirst($array_request[0]).'Controller';
      
        $controller = 'App\Controllers\\'.$paramController;
       

      

        return $controller;
    }


    /**
     * extract Method from request
     *
     * @param array $array_request
     * @return string
     */
    public function getMethod(array $array_request):string
    {
      if( isset($array_request[1]) ) {
       
            return $array_request[1];
      }
      return 'index';
    }

/**
 * Undocumented function
 *
 * @param string $controller
 * @param string $method
 * @param array $array_request
 * @return void
 * @throws RouteNotFoundException where route are not exist
 */
    public function matches_controller_method(string $controller, string $method, array $array_request)
    {
      if(class_exists($controller,true)) {
          
       
            $controllerInstance = new $controller();
            $method = $this->getMethod($array_request);
            
            if($method) {
              if( method_exists($controllerInstance, $method)) {
                    //existance ou pas d'argument de la methode dans le contoller
                    $methodInfo = new ReflectionMethod($controller. '::' . $method);
                    $methodParameter = $methodInfo->getParameters();
                    //recupere parameter dans l'uri
                    $argsRI = $this->getArgsRequest($array_request); 
                  
                  if( !empty($methodParameter)  && isset($argsRI)) {
                    call_user_func( [$controllerInstance, $method], $argsRI);
                  } else if (empty($methodParameter) && $argsRI === null) {
                        call_user_func( [$controllerInstance, $method]);
                       } else {
                        throw new RouteNotFoundException();
                  }
                    
            }
            //method pas présente dans le controller donc route n existe pas
            else {
              throw new RouteNotFoundException();
            }
          }
   
      }       
    }
   

    /**
     * to test if method has or not arguments
     *
     * @param array $array_request
     * @return boolean
     */
    public function hasArgs(array $array_request):bool
    {
        if( isset($array_request[2])) {
            return true;
        }
        return false;
    }


    /**
     * return args of method if exsits
     * only int parameter for id
     *
     * @param array $array_request
     * @return int|null
     */
    public function getArgsRequest(array $array_request)
    {
       $is_args = $this->hasArgs($array_request);
      
       if($is_args === true) {
         array_splice($array_request,0,2);
         return   $array_request[0]; 
       }

       return null;
    }

}