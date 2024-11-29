<?php

include '../BaseController.php';

class MaterialController extends BaseController
{
   


    public function CreateMaterial(MaterialStruct $MaterialData)
    {
        $NewMaterial= new MaterialModel();
        $NewMaterial->NewMaterial($MaterialData);
    }
    



    public function MaterialList()
    {
        
    }
    


}

?>