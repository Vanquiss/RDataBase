
<?php

include '../BaseController.php';

class ServiceController extends BaseController
{
   


    public function CreateService(ServiceStruct $ServiceData)
    {
        $NewService = new ServiceModel();
        $NewService->NewService($ServiceData);
    }
    



    public function ServiceList()
    {
        
    }
    


}

?>