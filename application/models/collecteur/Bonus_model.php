<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bonus_model extends CI_Model
{
    function save($data)
    {
        return $this->db->insert('bonus', $data);
    }

    function find_all()
    {
        $query = $this->db->query('select * from Bonus');
        return $query->result_array();
    }

    function find_by_id($id)
    {
        return $this->db->get_where('bonus', array('id_bonus' => $id))->row_array();
    }

    function delete_bonus($id)
    {
        $this->db->where('id_bonus', $id);
        return $this->db->delete('bonus');
    }

    public function update_bonus($id, $data)
    {
        $this->db->where('id_bonus', $id);
        return $this->db->update('bonus', $data);
    }
}
