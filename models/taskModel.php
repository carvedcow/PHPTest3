<?php

class taskModel extends DB\SQL\Mapper{

	public function __construct(DB\SQL $db){
		parent::__construct($db, 'todo_tasks');
	}

	/**
	 * Fetch all the records in our table
	 * "SELECT * FROM todo_tasks"
	 * @return void
	 *
	 * @return results
	 */
	public function fetchAll(){
		$this->load();
		return $this->query;
	}

	/**
	 * Fetch task with a specific ID
	 * "SELECT * FROM todo_tasks WEHRE id = ? "
	 *
	 * @param [integer] $id	ID of the task to get
	 * @return single result of the query
	 */
	public function getById($id){
		$this->load( array( "id=?", $id ) );
		$query =  $this->query;
		return $query[0];
	}

	/**
	 * Create a new task with data from our POST superglobal
	 * @return void
	 */
	public function add(){
		$this->copyFrom("POST");
		$this->save();
	}

	/**
	 * Update existsing user using new information from POST superglobal
	 *
	 * @param [ineteger] $id	ID of task to be updated
	 * @return void
	 */
	public function edit( $id ){
		$this->load( array( "id=?", $id ) );
		$this->copyFrom("POST");
		$this->update();
	}

	/**
	 * Remove specified task from our table
	 *
	 * @param [integer] $id ID of task to be removed 
	 * @return void
	 */
	public function delete( $id ){
		$this->load( array( "id=?", $id ) );
		$this->erase();
	}

/**
	 * Encrypt password and update the database
	 *
	 * @param int 		$id			ID of user to be removed
	 * @param string	$newPw	new password to be encrupted
	 * 
	 * @return void
	 */
	public function updatePW($id, $newPw){
		$this->load( array( "id=?", $id));
		
		$this->pword = password_hash( $newPw, PASSWORD_BCRYPT );

		$this->update();

	}

}