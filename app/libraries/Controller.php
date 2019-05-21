<?php
	/*
	* Base Controller
	* Loads the models and view
	*/

	class Controller {
		// load model
		public function model($model) {
			require_once '../app/models/' . $model . '.php';
			// Instantiate model
			return new $model();
		}

		// Load view
		public function view($view, $data = []) {
			// Check for view
			if(file_exists('../app/views/' . $view . '.php')) {
				require_once '../app/views/' . $view . '.php';
			} else {
				// View does not exist
				die('View does not exist');
			}
		}
	}