
<?php

include '../BaseController.php';

class ReportController extends BaseController
{
   


    // public function CreateService($ServiceData)
    // {
    //     $NewService = new ServiceModel();
    //     $NewService->NewService($ServiceData);
    // }
    



    public function getAllReports()
    {
        $NewReport = new ReportModel();
        $equipmentReport =  $NewReport->getEquipmentReport();
        $materialReport =  $NewReport->getMaterialReport();
        $serviceReport =  $NewReport->getServiceReport();
        return array('EquipReport' => $equipmentReport,'MaterialReport' => $materialReport, 'ServiceReport' =>$serviceReport);
    }
    


}

?>