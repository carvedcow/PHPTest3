<?php 

class tasksController extends mainController{
	
	private $model;

	/**
	 * Initialization of listConstructor
	 * @return void
	 */
	public function __construct(){
		parent::__construct();

		$this->model = new taskModel($this->db);
	}

	/**
	 * GET list.twig
	 *
	 * @return void
	 */
	public function list(){
		$tasks = $this->model->fetchAll();
	
		$this->twig_data["tasks"] =  $tasks;

		echo $this->f3->get('twig')->render("list.twig", $this->twig_data );
	}

	/**
	 * POST list.twig complete
	 *
	 * @return void
	 */
	public function completeDelete(){
		if ( $this->f3->get('POST.submit') == "Complete" ) {
			$this->f3->set('POST.date_completed', date('Y-m-d H:i:s'));
			$this->f3->set('POST.completed', 1);
			$this->model->edit($this->f3->get('POST.id'));
			$this->f3->reroute("/");
		}
		else if ( $this->f3->get('POST.submit') == "Delete" ) {
			$this->model->delete($this->f3->get('POST.id'));
			$this->f3->reroute("/");
		}
	}

	/**
	 * POST list.twig delete
	 *
	 * @return void
	 */
	// public function delete(){
	// 	$tasks = $this->model->fetchAll();
	
	// 	$this->twig_data["tasks"] =  $tasks;

	// 	echo $this->f3->get('twig')->render("list.twig", $this->twig_data );
	// }

	/**
	 * GET form.twig
	 * @return void
	 */
	public function add(){
		echo $this->f3->get('twig')->render("form.twig");
	}

	/**
	 * POST form.twig
	 * 
	 * @return void
	 */
	public function create(){

		if ($this->isFieldEmpty( $this->f3->get('POST.name') ) ) {
			$message = "Task name is required";
		}
		else if ( strlen($this->f3->get('POST.name')) < 10 ) {
			$message = "Task name must be at least 10 characters long.";
		}
		else {	
			$this->model->add( );
			$this->f3->reroute("/");
			die();
		}
		echo $this->f3->get('twig')->render("form.twig", array("twig_message"=>$message));
	}
	

	/**
	 * GET details.twig
	 * @return void
	 */
	public function details(){
		echo $this->f3->get('twig')->render("details.twig");
	}

}
?>