<?php

//include '../BaseController.php';

Class JobsController extends BaseController
{
    //recibe un array
    public function CreateJob($JobsData)
    {
        $NewJob = new JobsModels();
        $NewJob->NewJob($JobsData);

    }

    public function updateJob($JobsData)
    {
        $NewJob = new JobsModels();
        $NewJob->updateJob($JobsData);

    }

    public function deleteJob($JobsData)
    {
        $NewJob = new JobsModels();
        $NewJob->deleteJob($JobsData);

    }

    public function getJobs($JobsData)
    {
        $NewJob = new JobsModels();
        return $NewJob->getJobs($JobsData);

    }



    public function handleJsonMessage($jsonMessage)
    {
        $message = json_decode($jsonMessage, true);

        // Verificar la acción
        match ($message['action']) {
            'create_job' => $this->CreateJob($message['data']),
            'update_job' => $this->updateJob($message['data']),
            'delete_job' => $this->deleteJob($message['data']),
            
            //default => $this->sendErrorResponse("Acción no reconocida")
        };
    }
}


?>