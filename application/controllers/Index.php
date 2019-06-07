<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Index extends CI_Controller {

	public function __construct() {
        parent::__construct();    
        $this->load->model('Common_model');   
        $this->user_session = $this->session->userdata();
    }

	public function index() {
		is_not_login();
		$post = $this->input->post();
		if(!empty($post)) {
			if(isset($post['email']) && isset($post['password'])) {
				pr($post, 0);
				$verify = $this->Common_model->selectData('user','id,first_name,last_name',array('email'=>$post['email'],'password'=>md5($post['password'])));
				pr($verify,0);
				if(count($verify) == 1) {
					$session = array('user_id'=>$verify[0]->id,'name'=>$verify[0]->first_name.' '.$verify[0]->last_name);
					pr($session,0);
					$this->session->set_userdata($session);
					$session_data = $this->session->userdata();
					pr($session_data,0);
					$this->session->set_flashdata(array('message'=>'Sign In Successfull!','message_type'=>'success'));
					redirect('dashboard');
				} else {
					$this->session->set_flashdata(array('message'=>'Invalid Credentials! Please Enter Valid Credentials','message_type'=>'error'));
					redirect(base_url());
				}
			}
		}
		$data['title'] = 'Login';
		$this->load->view('index/login.php',$data);
	}

	public function register() {
		is_not_login();
		$post = $this->input->post();
		if(!empty($post)) {
			$data = array(
						'first_name'=>$post['fname'],
						'last_name' =>$post['lname'],
						'email'     =>$post['email'],
						'dob'       =>date('Y-m-d',strtotime(str_replace('/', '-', $post['dob']))),
						'mobile'    =>$post['mobile'],
						'gender'    =>$post['gender'],
						'address'   =>$post['address'],
						'state'     =>$post['state'],
						'city'      =>$post['city'],
						'password'  =>md5($post['password']),
						'createdat' =>date('Y-m-d'),
					);

			$insert = $this->Common_model->insertData('user',$data);
			if($insert) {
				$this->session->set_flashdata(array('message'=>'Sign Up Successfull!','message_type'=>'success'));
				redirect(base_url());
			}
		}
		$data['title'] = 'Register';
		$data['states'] = $this->Common_model->selectData('cities','city_state as state','','city_state','ASC','1');
		$data['city'] = $this->Common_model->selectData('cities','city_name as city',array('city_state'=>$data['states'][0]->state),'city_name','ASC','1');
 		$this->load->view('index/register.php',$data);	
	}

	public function dashboard() {
		is_login();
		$data['title'] = 'Dashboard';
		$data['users'] = $this->Common_model->selectData('user','*');
		$this->load->view('index/dashboard',$data);
	}

	public function editUser() {
		is_login();
		$get = $this->input->get();
		if(!empty($get)) {
			$data['user'] = $this->Common_model->selectData('user','*',array('id'=>$get['id'])); 
			pr($data['user'],0);
		}
		$data['title'] = 'Edit User';
		$data['states'] = $this->Common_model->selectData('cities','city_state as state','','city_state','ASC','1');
		$data['city'] = $this->Common_model->selectData('cities','city_name as city',array('city_state'=>$data['user'][0]->state),'city_name','ASC','1');
		$this->load->view('user/edit.php',$data);
	}

	public function fetchUserFilter() {
		is_login();
		$post = $this->input->post();
		pr($post,0);
		$field_pos = array("id"=>"0","first_name"=>"1","email"=>"2","mobile"=>"3","gender"=>"4","status"=>"7","createdat"=>"8");
		$sort_field = array_search($post['order'][0]['column'], $field_pos);
		if($post['order'][0]['dir']=='desc') {
			$order_type = "DESC";
		} else {
			$order_type = "ASC";
		}
		$data['users'] = $this->Common_model->fetchUserFilter($post['search']['value'],$sort_field,$order_type);
		pr($data['users'],0);
		$return['data'] = array();
		foreach ($data['users'] as $key => $value) {
			if($value->status == 'Active') {
				$status = '<btn class="btn btn-success" onclick="changeUserStatus('.$value->id.');" >'.$value->status.'</btn>';
			} else {
				$status = '<btn class="btn btn-danger" onclick="changeUserStatus('.$value->id.');" >'.$value->status.'</btn>';
			}
			$action = '<a style="cursor:pointer;text-decoration:none;" href="'.base_url().'edituser?id='.$value->id.'"><i class="far fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
						<btn style="cursor:pointer;" onclick="deleteUser('.$value->id.');"><i class="fas fa-trash-alt"></i></btn>';
			
			$return['data'][] = array(
									$value->id,
									$value->first_name.' '.$value->last_name,
									date('d/m/Y',strtotime($value->dob)),
									"E:<a href='mailto:".$value->email."'>".$value->email."</a><br>M:<a href='tel:$value->mobile'>".$value->mobile.'</a>',
									$value->gender,
									$value->address.', '.$value->city.', '.$value->state.', India',
									$status,
									date('d/m/Y',strtotime($value->createdat)),
									$action
								);
		}	
		$return['recordsTotal'] = count($data['users']);
		$return['recordsFiltered'] = count($data['users']);
		echo json_encode($return);

	}

	public function signout() {
		$this->session->sess_destroy();
		$this->session->set_flashdata(array('message'=>'Sign Out Successfull!','message_type'=>'success'));
		redirect(base_url());
	}

	public function getCities() {
		$post = $this->input->post();
		if(!empty($post)) {
			$data['cities'] = $this->Common_model->selectData('cities','city_name',array('city_state'=>$post['state']),'city_name','ASC','1');
			$options="";
			foreach ($data['cities'] as $key => $value) {
				$options .= "<option value='".$value->city_name."'>".$value->city_name."</option>";
			}
			echo $options;
		}	
	}

	public function changeStatus() {
		$post = $this->input->post();
		if($post) {
			$status = $this->Common_model->selectData('user','status',array('id'=>$post['user_id']));
			if(!empty($status)) {
				if($status[0]->status == 'Active') {
					$update = $this->Common_model->updateData('user',array('status'=>'Inactive'),array('id'=>$post['user_id']));
					if($update) {
						echo 'success';
					} else {
						echo "failure";
					}
				} else {
					$update = $this->Common_model->updateData('user',array('status'=>'Active'),array('id'=>$post['user_id']));
					if($update) {
						echo 'success';
					} else {
						echo "failure";
					}
				}
			}
		} else {
			echo "failure";
		}
	}

	public function deleteUser() {
		$post = $this->input->post();
		pr($post,0);
		if(!empty($post)) {
			$delete = $this->Common_model->deleteData('user',array('id'=>$post['user_id']));
			if($delete) {
				echo "success";
			} else {
				echo "failure";
			}
		} else {
			echo "failure";
		}
	}

}