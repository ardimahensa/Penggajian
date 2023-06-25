<?php

class Data_Jabatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->library('session');

        if ($this->session->userdata('role_id') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Anda Belum Login!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = "Data Jabatan";
        $data['jabatan'] = $this->ModelPenggajian->get_data('positions')->result();
        $data['positions'] = $this->db->select('
        positions.name,
        positions.basic_salary,
        positions.t_jabatan,
        positions.t_transport,
        positions.uang_lembur,
        positions.uang_makan')
            ->from('positions')
            ->get()->result();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/jabatan/data_jabatan', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_data()
    {
        $data['title'] = "Tambah Data Jabatan";

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/jabatan/tambah_dataJabatan', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_data_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->tambah_data();
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'basic_salary' => $this->input->post('basic_salary'),
                't_jabatan' => $this->input->post('t_jabatan'),
                't_transport' => $this->input->post('t_transport'),
                'uang_makan' => $this->input->post('uang_makan'),
                'uang_lembur' => $this->input->post('uang_lembur'),
            );

            $this->ModelPenggajian->insert_data($data, 'positions');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
            redirect('admin/data_jabatan');
        }
    }

    public function update_data($id)
    {
        $where = array('positions' => $id);
        $data['jabatan'] = $this->db->query("SELECT * FROM positions WHERE id= '$id'")->result();
        $data['title'] = "Update Data Jabatan";

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/jabatan/update_dataJabatan', $data);
        $this->load->view('template_admin/footer');
    }

    public function update_data_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update_data();
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'base_salary' => $this->input->post('base_salary'),
                't_jabatan' => $this->input->post('t_jabatan'),
                't_transport' => $this->input->post('t_transport'),
                'uang_makan' => $this->input->post('uang_makan'),
                'uang_lembur' => $this->input->post('uang_lembur'),
            );

            $where = array(
                'id' => $this->input->post('id'),
            );

            $this->ModelPenggajian->update_data('id', $data, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil diupdate!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
            redirect('admin/data_jabatan');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('name', 'Nama Jabatan', 'required');
        $this->form_validation->set_rules('basic_salary', 'Gaji Pokok', 'required');
        $this->form_validation->set_rules('t_jabatan', 'Tunjangan Jabatan', 'required');
        $this->form_validation->set_rules('t_transport', 'Tunjangan Transport', 'required');
        $this->form_validation->set_rules('uang_lembur', 'Uang Lembur', 'required');
        $this->form_validation->set_rules('uang_makan', 'Uang Makan', 'required');

    }

    public function delete_data($id)
    {
        $where = array('id' => $id);
        $this->ModelPenggajian->delete_data($where, 'positions');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
        redirect('admin/data_jabatan');
    }
}
