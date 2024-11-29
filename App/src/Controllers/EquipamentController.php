
<?php

include '../BaseController.php';

class EquipamentController extends BaseController
{
   


    public function CreateEquipament(EquipamentStruct $EquipamentData)
    {
        $NewEquipament = new EquipamentModel();
        $NewEquipament->NewEquipament($EquipamentData);
    }
    



    public function ServiceList()
    {
        
    }
    


}

?>