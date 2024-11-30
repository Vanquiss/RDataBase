
<?php

include '../BaseController.php';

class ServiceController extends BaseController
{
   


    public function CreateService($ServiceData)
    {
        $NewService = new ServiceModel();
        $NewService->NewService($ServiceData);
    }
    



    public function getServices()
    {
        $NewService = new ServiceModel();
        return $NewService->getServices();
    }
    


}

?>