<?php
namespace App;

class Kernel
{

    public function render()
    {
        header('Content-Type: application/json');
        try {

            $controller = $this->findControllerByRoute();
            http_response_code(200);
            echo json_encode(['error' => false, 'message' => '', 'data' =>$this->callMethod($controller)]);
        }catch (\Exception $exception){

            $code = ($exception->getCode() == 0 || $exception->getCode() == null) ? 500: $exception->getCode();
            http_response_code($code);
            echo json_encode(['error' => true, 'message' => $exception->getMessage() ?? '', 'trace' => $exception->getTrace()]);
        }
    }

    // Next two methods are just skeleton which will represent routing to the controller and method
    // for purpose of this example its hardcoded one controller that we use

    /**
     * This Method would search by route which controller to initialize
     * @return \Controllers\SourceController
     */
    public function findControllerByRoute()
    {
        return new SourceController();
    }

    /**
     * This Method base on the route and http method recognise which method to call
     * @return \Controllers\SourceController
     */
    public function callMethod($controller){

        if($_GET['source']){
            return $controller->getBySource($_GET['source']);
        }

        return $controller->index();
    }
}