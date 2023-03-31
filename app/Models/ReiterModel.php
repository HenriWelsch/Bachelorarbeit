<?php namespace App\Models;
use CodeIgniter\Model;

class ReiterModel extends Model {
    public function getData() {
        return  $this->db->
        table('reiter')->
        get()->getResultArray();
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getEntry() {
        return  $this->db->
        table('reiter')->
        where('ReiterID', ($_POST['_change'] ?? $_POST['_delete']))->
        get()->getRowArray();
    }

    public function createEntry() {
        $this->db->
        table('reiter')->
        insert(array(
            'bezeichnung'  => $_POST['bezeichnung'],
            'beschreibung' => $_POST['beschreibung'],
        ));
    }

    public function changeEntry() {
        $this->db->
        table('reiter')->
        where('ReiterID', $_POST['reiterID'])->
        update(array(
            'bezeichnung'  => $_POST['bezeichnung'],
            'beschreibung' => $_POST['beschreibung'],
        ));
    }

    public function deleteEntry() {
        $this->db->
        table('reiter')->
        where('ReiterID', $_POST['reiterID'])->
        delete();
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}