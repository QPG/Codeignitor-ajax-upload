<?php

class Items extends CI_Model {

    public function insert_item($data) {

        if ($this->db->insert('item', $data)) {
            return $this->db->insert_id();
        } else {

            return false;
        }
    }

}
