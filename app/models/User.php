<?php
	class User {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		// Register ser
		public function register($data) {
			$this->db->query('INSERT INTO users (name, email, password)  VALUES(:name, :email, :password)');
			$this->db->bind(':name', $data['name']);
			$this->db->bind(':email', $data['email']);
			$this->db->bind(':password', $data['password']);

			// Execute
			if ($this->db->execute()) {
				return true;
			}else {
				return false;
			}
		}

		// Find user email
		public function findUserByEmail($email) {
			$this->db->query('SELECT * FROM users WHERE email = :email');
			$this->db->bind(':email', $email);

			$row = $this->db->single();

			// Check if row exist
			if ($this->db->getRowCount() > 0) {
				return true;
			} else {
				return false;
			}

		}
	}