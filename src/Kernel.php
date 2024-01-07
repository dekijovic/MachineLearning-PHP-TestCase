<?php
namespace App;

class Kernel
{

    public function render()
    {
        header('Content-Type: application/json');
        try {

            $controller = $this->findControllerByRouteCall();
            http_response_code(200);
            echo json_encode(['error' => false, 'message' => '', 'data' =>$controller]);
        }catch (\Exception $exception){

            $code = ($exception->getCode() == 0 || $exception->getCode() == null) ? 500: $exception->getCode();
            http_response_code($code);
            echo json_encode(['error' => true, 'message' => $exception->getMessage() ?? '', 'trace' => $exception->getTrace()]);
        }
    }

    /**
     * This Method would search by route which controller to initialize
     * @return \Controllers\SourceController
     */
    public function findControllerByRouteCall()
    {
       $routes =  include_once ('route.php');
        if($routes[$_SERVER['REQUEST_URI']]){
           $call = explode('@', $routes[$_SERVER['REQUEST_URI']]);
           $controller =  new $call[0];
           return $controller->$call[1]();
        }
        throw new \Exception('No Controller for this route');
    }
}