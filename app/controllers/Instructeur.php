<?php

class Instructeur extends BaseController
{
    private $instructeurModel;

    public function __construct()
    {
        $this->instructeurModel = $this->model('InstructeurModel');
    }

    public function index()
    {
        $result  = $this->instructeurModel->getInstructeurs();

        $data = [
            'title' => 'Instructeurs in dienst',
            'instructeurs' => $result,
        ];

        $this->view('Instructeur/index', $data);
    }

    public function voertuigenIngebruik($id)
    {
        $instructeur  = $this->instructeurModel->getInstructeurById($id);
        $voertuigen = $this->instructeurModel->getVoertuigenByInstructeurId($id);

        $data = [
            'title' => 'Gebruikte voertuigen',
            'instructeur' => $instructeur,
            'voertuigen' => $voertuigen,
        ];

        $this->view('Instructeur/voertuigenIngebruik', $data);
    }

    public function add($id)
    {
        $instructeur  = $this->instructeurModel->getInstructeurById($id);
        $voertuigen = $this->instructeurModel->getUnassignedVehicle($id);

        $data = [
            'title' => 'Toevoegen voertuig',
            'instructeur' => $instructeur,
            'voertuigen' => $voertuigen,
        ];

        $this->view('Instructeur/add', $data);
    }

    public function adding($instructeurId, $voertuigId)
    {
        $this->instructeurModel->insertVoertuig($instructeurId, $voertuigId);

        header("Refresh: 3; url=/instructeur/voertuigenIngebruik/" . $instructeurId);
        echo "Voertuig toegevoegd.";
    }
}
