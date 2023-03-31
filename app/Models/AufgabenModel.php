<?php namespace App\Models;
use CodeIgniter\Model;

class AufgabenModel extends Model {

    public function getMembers() {
        return $this->db->table('aufgabe')->
            select('aufgabe.*, group_concat("<li>", mitglied.Benutzername,"</li>" separator "") as Mitglieder')->
            join('zugewiesen', 'zugewiesen.AufgabeID = aufgabe.AufgabeID', 'left')->
            join('mitglied', 'zugewiesen.MitgliedID = mitglied.MitgliedID', 'left')->
            groupBy('AufgabeID')->
            get()->getResultArray();
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getEntry() {
        return $this->db->
        table('aufgabe')->
        where('AufgabeID ', ($_POST['_change'] ?? $_POST['_delete']))->
        get()->getRowArray();
    }

    public function createEntry() {
        $this->db->
        table('aufgabe')->
        insert(array(
            'Bezeichnung'       => $_POST['bezeichnung'],
            'Beschreibung'      => $_POST['beschreibung'],
            'Erstellungsdatum'  => $_POST['erstellungsdatum'],
            'Faelligkeitsdatum' => $_POST['faelligkeitsdatum']
        ));

        $lastID = $this->db->insertID(); $currArr = array();
        foreach ($_POST['InputZustaendig'] as $item)
            $currArr[] = array('MitgliedID' => $item, 'AufgabeID'   => $lastID);

        $this->db->
        table('zugewiesen')->
        insertBatch($currArr);
    }

    public function changeEntry() {
        $this->db->
        table('aufgabe')->
        where('AufgabeID', $_POST['aufgabeID'])->
        update(array(
            'Bezeichnung'       => $_POST['bezeichnung'],
            'Beschreibung'      => $_POST['beschreibung'],
            'erstellungsdatum'  => $_POST['beschreibung'],
            'faelligkeitsdatum' => $_POST['beschreibung']
        ));

        $this->db->
        table('zugewiesen')->
        where('AufgabeID', $_POST['aufgabeID'])->
        delete();

        foreach ($_POST['InputZustaendig'] as $item) {
            $this->db->
            table('zugewiesen')->
            insert(array('MitgliedID'=> $item, 'AufgabeID'=>$_POST['aufgabeID']));
        }
    }

    public function deleteEntry() {
        $this->db->
        table('aufgabe')->
        where('AufgabeID', $_POST['aufgabeID'])->
        delete();
    }

    public function getArr() {
        return $this->db->table('aufgabe')->
        select('mitglied.Benutzername')->
        join('zugewiesen', 'zugewiesen.AufgabeID = '.($_POST['_change'] ?? $_POST['_delete']), 'left')->
        join('mitglied', 'zugewiesen.MitgliedID = mitglied.MitgliedID', 'left')->
        get()->getResultArray();
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}