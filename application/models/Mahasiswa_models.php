<?php
class Mahasiswa_models extends CI_MODEL {

  public function get_data($id = null){
    if ($id == null) {
      return $this ->db ->get('mahasiswa') ->result_array();

    } else {
      return $this ->db ->get_where('mahasiswa', ['id' => $id]) ->result_array();

    }   
  }

  
  public function delete_data($id){
    $this ->db ->delete('mahasiswa', ['id' => $id]);

    return $this ->db ->affected_rows();
  }

  public function insert_data($data)
  {
    $this ->db ->insert('mahasiswa', $data);
    
    return $this ->db ->affected_rows();
  }
  
  public function update_data($id, $data)
  {
    $this ->db ->update('mahasiswa', $data, ['id' => $id]);
    
    return $this ->db ->affected_rows();
  }
    
}