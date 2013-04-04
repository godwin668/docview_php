<?php
class User extends CI_Controller {
	
	function index() {
		
		$data['error'] = '';
		$this->load->view('user/doc_list_view', $data);
		
	}
	
	/**
	 * Load signup page
	 */
	function signup() {
		$this->load->view('user/signup');
	}
	
	/**
	 * Real signup action
	 */
	function do_signup() {
		$data = $this->input->post();
		$app_info = $this->rc->getAppInfo();
		$data['app_id'] = $app_info['app_id'];
		
		// 1. check existed user
		$this->load->model('User_model');
		$existed_user_info = $this->User_model->getByUser($data['username']);
		if ($existed_user_info) {
			echo json_encode(array('error' => 'Username exist, please choose another one!'));
			return;
		}
		
		// 2. save user info to database
		$data['app_uid'] = '';
		$this->User_model->add($data);
		
		// 3. generate sid
		$this->load->model('User_model');
		$user_info = $this->User_model->getByUser($data['username']);
		$uid = $user_info['user_id'];
		$sid = $this->rc->genSid($uid);
		
		// 4. save sid
		$this->User_model->updateSid($uid, $sid);
		
		// 5. return sid
		echo json_encode(array('sid' => $sid));
	}
	
	/**
	 * Login by username or email
	 * 
	 * @param unknown $user
	 * @param unknown $password
	 * @return number
	 */
	function do_login() {
		$user = $this->input->get_post('user', TRUE);
		$password = $this->input->get_post('password', TRUE);
		$this->load->model('User_model');
		$user_info = $this->User_model->getByUser($user);
		$data = array();
		// user NOT found
		if (! $user_info) {
			$data['error'] = 'User does NOT exist!';
		} else if ($user_info['password'] !== $password) {
			// password error
			$data['error'] = 'Password error!';
		} else {
			$sid = $this->rc->genSid($user_info['user_id']);
			$data['sid'] = $sid;
			echo "Setting cookie..." . $_SERVER['HTTP_HOST'];
			$cookie = array(
					'name'   => 'IDOCVSID',
					'value'  => $sid,
					'expire' => '2592000',
					'domain' => $_SERVER['HTTP_HOST'],
					'path'   => '/',
			);
			$this->input->set_cookie($cookie);
		}
		echo json_encode($data);
	}
	
	function logout() {
		delete_cookie("IDOCVSID", $_SERVER['HTTP_HOST'], '/');
		echo json_encode(array('msg' => 'success'));
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */