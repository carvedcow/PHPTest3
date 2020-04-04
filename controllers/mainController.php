<?php 

class mainController{
	// Parent class for all my controllers

    // values
	protected $f3;
	protected $db;
	public $twig_data;


    //constructor
	public function __construct(){
		$c_f3 = Base::instance();

		$c_db = new DB\SQL( $c_f3->get('dbHost'), $c_f3->get('dbUser'), $c_f3->get('dbPass'));

		$this->f3 = $c_f3;
		$this->db = $c_db;

		$this->twig_data = array("messages"=>$_SESSION['messages']);
		unset($_SESSION['messages']);
	}


    // functions 
	/**
	 * Validate if a given variable is empty
	 *
	 * @param [string] $field
	 * @return boolean
	 */
	public function isFieldEmpty( $field ){
		return ( !isset( $field ) || trim( $field ) == "" );
	}
	
}

?>