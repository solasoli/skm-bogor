<?php


class M_auth extends CI_Model {

    var $details;

    function validate( $usr, $pwd ) 
    {
		$query = $this->db->
		query("SELECT * from users where user_login=? and password=? and is_aktif=1",array($usr, $pwd));
      	return $query;      	
    }

    function validate1( $usr, $pwd ) 
    {
		$query = $this->db->
		query("SELECT * from users where user_login=? and password=? and is_aktif=1",array($usr, $pwd));
      	return $query;      	
    }

    function koor( $id ) 
    {
		$query = $this->db->
		query("SELECT * from users where id=?",array($id));
      	return $query;      	
    }

    function pngjwb( $id ) 
    {
		$query = $this->db->
		query("SELECT * from users where id=?",array($id));
      	return $query;      	
    }
  }
