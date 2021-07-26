<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Mahasiswa extends REST_Controller {
  
  public function __construct(){
    parent::__construct();
    $this ->load ->model('Mahasiswa_models','mahasiswa');

    $this->methods['index_get']['limit'] = 5;
    $this->methods['index_post']['limit'] = 5;

  }
  
  public function index_get() {
   
    $id = $this -> get('id');
    
    if ($id == null) {
      $data = $this ->mahasiswa ->get_data();
    
    } else {
      $data = $this ->mahasiswa ->get_data($id);
    
      
    }
    
    if ($data) {
      $this->response([
        'status' => true,
        'data' => $data
      ], REST_Controller::HTTP_OK);
      
    }else {
      $this->response([
        'status' => false,
        'message' => 'Id not found!'
      ], REST_Controller::HTTP_NOT_FOUND);
      
    }
    
  }


  public function index_delete(){
    $id = $this -> delete('id');

    if ($id == null) {
      $this->response([
        'status' => false,
        'message' => 'Provide an id!'
      ], REST_Controller::HTTP_BAD_REQUEST);
      
    } else {

      $delete = $this ->mahasiswa ->delete_data($id);

      if ($delete > 0) {
        $this->response([
          'status' => true,
          'message' => 'Data success deleted.'
        ], REST_Controller::HTTP_OK);
      
      } else {
        $this->response([
          'status' => false,
          'message' => 'id not found!'
        ], REST_Controller::HTTP_NOT_FOUND);
        
      }
    
    }
    
  }
  
  public function index_post()
  {
    $data = [
      'nrp' => $this ->post('nrp'),
      'nama' => $this ->post('nama'),
      'email' => $this ->post('email'),    
      'jurusan' => $this ->post('jurusan')
    ];

    $insert = $this ->mahasiswa ->insert_data($data);

    if ($insert > 0) {
      $this->response([
        'status' => true,
        'message' => 'Data success inserted.'
      ], REST_Controller::HTTP_CREATED);
       
      # code...
    }else {
      $this->response([
        'status' => false,
        'message' => 'Insert data failed!'
      ], REST_Controller::HTTP_BAD_REQUEST);
      
    }
  }


  public function index_put()
  {
    $id = $this ->put('id');

    $data = [
      'nrp' => $this ->put('nrp'),
      'nama' => $this ->put('nama'),
      'email' => $this ->put('email'),    
      'jurusan' => $this ->put('jurusan')
    ];

    $update = $this ->mahasiswa ->update_data($id, $data);

    if ($update > 0) {
      $this->response([
        'status' => true,
        'message' => 'Data success updated.'
      ], REST_Controller::HTTP_OK);
       
    }else {
      $this->response([
        'status' => false,
        'message' => 'Update data failed!'
      ], REST_Controller::HTTP_BAD_REQUEST);
      
    }
  }
}