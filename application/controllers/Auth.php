<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');

        if ($this->session->userdata('user') && $this->router->fetch_method() !== 'logout') {
            redirect('dashboard');
        }

    }

    // 🔹 REGISTER (Employee + Dealer)
    public function register()
    {
        if ($this->input->is_ajax_request()) {

            // ✅ Server-side validation (PDF requirement)
            $this->form_validation->set_rules(
                'first_name','First Name','required|alpha'
            );
            $this->form_validation->set_rules(
                'last_name','Last Name','required|alpha'
            );
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|valid_email|is_unique[users.email]',
                [
                    'is_unique' => 'This email is already registered with us'
                ]
            );
            $this->form_validation->set_rules(
                'password','Password','required|min_length[6]'
            );
            $this->form_validation->set_rules(
                'role','Role','required|in_list[employee,dealer]'
            );

            if ($this->form_validation->run() === FALSE) {
                echo json_encode([
                    'status' => false,
                    'errors' => $this->form_validation->error_array()
                ]);
                return;
            }

            // ✅ Insert user
            $insertData = [
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'email'      => $this->input->post('email'),
                'password'   => password_hash(
                                    $this->input->post('password'),
                                    PASSWORD_BCRYPT
                                ),
                'role'       => $this->input->post('role'),
                'is_first_login' => 1
            ];

            $this->User_model->insert_user($insertData);

            echo json_encode([
                'status' => true,
                'msg'    => 'Registration successful. Please login.'
            ]);
            return;
        }

        // Normal page load
        $this->load->view('auth/register.html');
    }

    // 🔹 LOGIN (Employee + Dealer)
    public function login()
    {
        if ($this->input->is_ajax_request()) {

            // ✅ Server-side validation
            $this->form_validation->set_rules(
                'email','Email','required|valid_email'
            );
            $this->form_validation->set_rules(
                'password','Password','required'
            );

            if ($this->form_validation->run() === FALSE) {
                echo json_encode([
                    'status' => false,
                    'errors' => $this->form_validation->error_array()
                ]);
                return;
            }

            $user = $this->User_model
                         ->get_user_by_email($this->input->post('email'));

            // ❌ Invalid login
            if (!$user || !password_verify(
                $this->input->post('password'),
                $user->password
            )) {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Invalid email or password'
                ]);
                return;
            }

            // ✅ Login success → session
            $this->session->set_userdata('user', $user);

            // 🔥 ROLE BASED REDIRECT (PDF CORE)
            if ($user->role === 'dealer' && $user->is_first_login == 1) {
                $redirect = base_url('dealer/profile');
            } else {
                $redirect = base_url('dashboard');
            }

            echo json_encode([
                'msg'    => 'You have successfully logged in.',
                'status'   => true,
                'redirect' => $redirect
            ]);
            return;
        }

        // Normal page load
        $this->load->view('auth/login.html');
    }

    // 🔹 LOGOUT
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/login');
    }

    public function check_email()
    {
        $email = $this->input->post('email');

        $exists = $this->User_model->email_exists($email);

        // jQuery validate expects TRUE / FALSE
        echo json_encode(!$exists);
    }

}
