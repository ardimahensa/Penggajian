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
        $data['jabatan'] = $this->db->select('
        positions.id,
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
        $data['title'] = "Update Data Jabatan";
        $data['jabatan'] = $this->db->select('positions.id,
        positions.name,
        positions.basic_salary,
        positions.t_jabatan,
        positions.t_transport,
        positions.uang_makan,
        positions.uang_lembur')
            ->from('positions')
            ->where('positions.id', $id)
            ->get()->result();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/jabatan/update_dataJabatan', $data);
        $this->load->view('template_admin/footer');
    }

    public function update_data_aksi()
    {
        $this->_rules();
        $id = $this->input->post('id_jabatan');
        if ($this->form_validation->run() == false) {
            $this->update_data($id);
        } else {
            $data = [
                'name' => $this->input->post('nama_jabatan'),
                'basic_salary' => $this->input->post('gaji_pokok'),
                't_jabatan' => $this->input->post('tj_jabatan'),
                't_transport' => $this->input->post('tj_transport'),
                'uang_makan' => $this->input->post('uang_makan'),
                'uang_lembur' => $this->input->post('uang_lembur'),
            ];
            $where = array(
                'id' => $id,
            );

            $this->ModelPenggajian->update_data('positions', $data, $where);
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
        $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');
        $this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required');
        $this->form_validation->set_rules('tj_jabatan', 'Tunjangan Jabatan', 'required');
        $this->form_validation->set_rules('tj_transport', 'Tunjangan Transport', 'required');
        $this->form_validation->set_rules('uang_makan', 'Uang Makan', 'required');
        $this->form_validation->set_rules('uang_lembur', 'Uang Lembur', 'required');

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
