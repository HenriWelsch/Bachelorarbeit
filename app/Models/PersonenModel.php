<?php namespace App\Models;
use CodeIgniter\Model;

class PersonenModel extends Model {

    public function getData() {
        $result = $this->db->query('Select * from mitglied');
        return $result->getResultArray();
    }

    public function getTest($id) {
        return $this->db->
        table('mitglied')->
        where('MitgliedID', $id)->
        get()->getRowArray();
    }


    // Used by login process
    public function getUser() {
        return $this->db->
        table('mitglied')->
        where('Benutzername', $_POST['username'])->
        get()->getRowArray();
    }

    public function getPersons() {
        return $this->db->
            table('mitglied')->
            get()->getResultArray();
    }



    public function login() {
        return $this->db->
            table('mitglied')->
            select('passwort')->
            where('mitglied.benutzername', $_POST['username'])->
            get()->getRowArray();
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getEntry() {
        return $this->db->table('mitglied')->
        where('MitgliedID ', ($_POST['_change'] ?? $_POST['_delete']))->
        get()->getRowArray();
    }

    public function changeEntry() {
        $data = array(
            'Benutzername'  => $_POST['person_username'],
            'EMail'         => $_POST['person_e_mail']
        );

        if (isset($_POST['person_password']) and $_POST['person_password'] != "") {
            $data['Passwort'] = password_hash($_POST['person_password'], PASSWORD_DEFAULT, ["cost"=>10]);
        }

        $this->db->
        table('mitglied')->
        where('MitgliedID', $_POST['mitgliedID'])->
        update($data);
    }


    public function createEntry() {
        $this->db->
        table('mitglied')->
        insert(array(
            'Benutzername'  => $_POST['person_username'],
            'EMail'         => $_POST['person_e_mail'],
            'Passwort'      => password_hash($_POST['person_password'], PASSWORD_DEFAULT, ["cost"=>10])
        ));
    }


    public function deleteEntry() {
        $this->db->
        table('mitglied')->
        where('MitgliedID', $_POST['mitgliedID'])->
        delete();
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}