<?php
	class Users extends Controller {
		public function __construct() {
			$this->userModel= $this->model('User');
		}

		public function register() {
			// Check for post
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Process the form

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'name' => trim($_POST['name']),
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'confirm_password' => trim($_POST['confirm_password']),
					'name_error' => '',
					'email_error' => '',
					'password_error' => '',
					'confirm_password_error' => ''
				];

				// Validate name
				if (empty($data['name'])) {
					echo $data['name_error'] = 'Please enter name';
				}

				// Validate email
				if (empty($data['email'])) {
					$data['email_error'] = 'Please enter email';
				} else {
					if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
						$data['email_error'] = 'Please enter a valid email';
					} else {
						if ($this->userModel->findUserByEmail($data['email'])) {
							$data['email_error'] = 'Email is already taken';
						}
					}
				}
					
				// Validate password
				if (empty($data['password'])) {
					 $data['password_error'] = 'Please enter password';
				}
				elseif (strlen($data['password']) < 6) {
					$data['password_error'] = 'Password must be at least 6 characters';
				}

					// validate confirm Password
				if (empty($data['confirm_password'])) {
					$data['confirm_password_error'] = 'Please confirm password';
				} else {
					if ($data['password'] !== $data['confirm_password']) {
						$data['confirm_password_error'] = 'Passwords do not match!';
					}
				}

				// Make sure errors are empty
				if (empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data		['confirm_password_error'])) {
					// validated 
					
					//Hash password
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

					// Register user
					if ($this->userModel->register($data)) {
						flash('register_success', 'You are register and can log in');
						redirect('users/login');
					} else {
						die('Not added');
					}
				} else {
					$this->view('users/register', $data);
				}

			}else{
				// Init data
				$data = [
					'name' => '',
					'email' => '',
					'password' => '',
					'confirm_password' => '',
					'name_error' => '',
					'email_error' => '',
					'password_error' => '',
					'confirm_password_error' => ''
				];

				// Load view
				$this->view('users/register', $data);
			}
		}

		public function login() {
			// Check for post
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Process the form

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'email_error' => '',
					'password_error' => '',
				];
				
				// Validate email
				if (empty($data['email'])) {
					$data['email_error'] = 'Please enter email';
				} else{
					if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
						$data['email_error'] = 'Please enter a valid email';
					}
				}

				// Validate password
				if (empty($data['password'])) {
					 $data['password_error'] = 'Please enter password';
				}

				// Make sure errors are empty
				if (empty($data['email_error']) && empty($data['password_error'])) {
					// validated 

				} else {
					$this->view('users/login', $data);
				}
			}else{
				// Init data
				$data = [
					'email' => '',
					'password' => '',
					'email_error' => '',
					'password_error' => '',
				];

				// Load view
				$this->view('users/login', $data);
			}
		}
	}