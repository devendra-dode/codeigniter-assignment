<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dealer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Dealer_model','User_model']);

        if (!$this->session->userdata('user')) {
            redirect('login');
        }
    }

    public function index()
    {
        $user = $this->session->userdata('user');

        // ❌ Only employee can view dealer list
        if ($user->role !== 'employee') {
            redirect('dashboard');
        }

        $zip = $this->input->get('zip');

        $data['dealers'] = $this->Dealer_model->get_all_dealers($zip);
        $data['zip'] = $zip;

        $this->load->view('dealer/list.html', $data);
    }

    public function datatable()
    {
        $user = $this->session->userdata('user');

        // Only employee can access
        if ($user->role !== 'employee') {
            show_error('Unauthorized', 403);
        }

        $this->load->model('Dealer_model');

        // DataTables parameters
        $draw   = intval($this->input->post('draw'));
        $start  = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $search = $this->input->post('search')['value'];

        // Optional ZIP filter
        $zip = $this->input->post('zip');

        $data  = $this->Dealer_model->get_datatable_dealers($start, $length, $search, $zip);
        $total = $this->Dealer_model->count_all_dealers();
        $filtered = $this->Dealer_model->count_filtered_dealers($search, $zip);

        $rows = [];
        foreach ($data as $d) {
            $rows[] = [
                $d->first_name . ' ' . $d->last_name,
                $d->email,
                $d->city ?? 'N/A',
                $d->state ?? 'N/A',
                $d->zip ?? 'N/A',
                '<a href="'.base_url('dealer/edit/'.$d->id).'" class="btn btn-sm btn-warning">Edit</a>'
            ];
        }

        echo json_encode([
            "draw"            => $draw,
            "recordsTotal"    => $total,
            "recordsFiltered" => $filtered,
            "data"            => $rows
        ]);
    }


public function profile($dealer_user_id = null)
{

    $user = $this->session->userdata('user');

    $this->load->model('Location_model');
    $this->load->model('Dealer_model');

    // Determine which dealer user_id
    if ($user->role === 'dealer') {
        $dealer_user_id = $user->id;
    } else {
        if (empty($dealer_user_id)) {
            redirect('dashboard');
        }
    }

    // ================= AJAX SUBMIT =================
    if ($this->input->is_ajax_request()) {

        $this->form_validation->set_rules('state_id','State','required|integer');
        $this->form_validation->set_rules('city_id','City','required|integer');
        $this->form_validation->set_rules('zip','Zip','required|numeric|min_length[5]|max_length[6]');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode([
                'status' => false,
                'errors' => $this->form_validation->error_array()
            ]);
            return;
        }


        // who updated the record
        $updated_by = $user->id; // dealer OR employee

        // check existing record
        $existing = $this->Dealer_model->get_by_user_id($dealer_user_id);

        $data = [
            'state_id'   => $this->input->post('state_id'),
            'city_id'    => $this->input->post('city_id'),
            'zip'        => $this->input->post('zip'),
            'updated_by' => $updated_by,
            'updated_at' => date('Y-m-d H:i:s')
        ];


        if (
            !empty($existing) &&
            !empty($existing->state_id) &&
            !empty($existing->city_id) &&
            !empty($existing->zip)
        ) {

            // UPDATE
            $this->Dealer_model->update_dealer_details($dealer_user_id, $data);
        } else {
            // INSERT
            $data['user_id']    = $dealer_user_id;
            $data['created_at'] = date('Y-m-d H:i:s');

            $this->Dealer_model->insert_dealer_details($data);
        }

        // Update first login flag
        $this->db->where('id', $dealer_user_id)
                 ->update('users', ['is_first_login' => 0]);

        $redirect = base_url('dealer');
        
        if ($user->role === 'dealer') {
            $user->is_first_login = 0;
            $this->session->set_userdata('user', $user);
            $redirect = base_url('dashboard');
        }

        echo json_encode([
            'status'   => true,
            'redirect' => $redirect
        ]);
        return;
    }

    // ================= NORMAL LOAD =================
    $data['states'] = $this->Location_model->get_states();
    $data['dealer'] = $this->Dealer_model->get_by_user_id($dealer_user_id);

    // preload cities
    if (!empty($data['dealer']->state_id)) {
        $data['cities'] = $this->db
            ->where('state_id', $data['dealer']->state_id)
            ->get('cities')
            ->result();
    } else {
        $data['cities'] = [];
    }

    $this->load->view('dealer/profile.html', $data);
}


    public function get_cities()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->load->model('Location_model');
        $cities = $this->Location_model
                       ->get_cities_by_state(
                           $this->input->post('state_id')
                       );

        echo json_encode($cities);
    }


    public function edit($id = null)
    {
        $user = $this->session->userdata('user');

        // ACCESS CONTROL
        if ($user->role === 'dealer') {
            $dealer_user_id = $user->id;
        } else {
            $dealer_user_id = $id;
        }

        if (empty($dealer_user_id)) redirect('dashboard');

        $dealer = $this->Dealer_model->get_by_user_id($dealer_user_id);
        if (!$dealer) redirect('dashboard');

        // AJAX submit
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('state_id','State','required|numeric');
            $this->form_validation->set_rules('city_id','City','required|numeric');
            $this->form_validation->set_rules('zip','Zip','required|numeric|min_length[5]|max_length[6]');

            if ($this->form_validation->run() === FALSE) {
                echo json_encode([
                    'status' => false,
                    'errors' => $this->form_validation->error_array()
                ]);
                return;
            }

            $this->Dealer_model->update_dealer_details(
                $dealer_user_id,
                [
                    'state_id' => $this->input->post('state_id'),
                    'city_id'  => $this->input->post('city_id'),
                    'zip'      => $this->input->post('zip')
                ]
            );

            echo json_encode([
                'status' => true,
                'msg' => 'Dealer details updated successfully',
                'redirect' => base_url('dealer/edit/'.$dealer_user_id)
            ]);
            return;
        }

        // NORMAL PAGE LOAD
        $data['dealer'] = $dealer;
        $data['states'] = $this->db->get('states')->result();

        // Pre-load cities of the current state
        if (!empty($dealer->state_id)) {
            $data['cities'] = $this->db
                ->where('state_id', $dealer->state_id)
                ->get('cities')
                ->result();
        } else {
            $data['cities'] = [];
        }


        $this->load->view('dealer/edit.html', $data);
    }

    public function check_email_ajax()
    {
        $email   = $this->input->post('email');
        $user_id = $this->input->post('user_id'); // pass current user's id in JS

        $exists = $this->db
            ->where('email', $email)
            ->where('id !=', $user_id) // ignore current user
            ->get('users')
            ->row();

        if ($exists) {
            echo "false"; // must be string "false" for jQuery Validation
        } else {
            echo "true";
        }
    }


}
