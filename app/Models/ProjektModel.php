<?php namespace App\Models;
use CodeIgniter\Model;

class ProjektModel extends Model {
    public function getData() {
        $result = $this->db->query('Select * from projekt');
        return $result->getResultArray();
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getEntry() {
        return  $this->db->
        table('projekt')->
        where('ProjektID', $_POST['option'])->
        get()->getRowArray();
    }

    public function createEntry() {
        $this->db->
        table('projekt')->
        insert(array(
            'Bezeichnung'   => $_POST['bezeichnung'],
            'Beschreibung'  => $_POST['beschreibung']
        ));
    }

    public function changeEntry() {
        $this->db->
        table('projekt')->
        where('ProjektID', $_POST['projektID'])->
        update(array(
            'Bezeichnung'   => $_POST['bezeichnung'],
            'Beschreibung'  => $_POST['beschreibung']
        ));
    }

    public function deleteEntry() {
        $this->session = \Config\Services::session();
        if ($this->session->get('ProjektID') === $_POST['projektID']) {
            $this->session->remove('ProjektID');
        }

        $this->db->
        table('projekt')->
        where('ProjektID', $_POST['projektID'])->
        delete();
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}