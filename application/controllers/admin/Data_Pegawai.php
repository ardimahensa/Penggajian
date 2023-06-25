<?php

class Data_Pegawai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

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
        $data['title'] = "Data Pegawai";
        $data['pegawai'] = $this->ModelPenggajian->get_data('users')->result();
        $data['pegawai'] = $this->db->select('user_profiles.nik,
        user_profiles.full_name,
        users.username,
        users.password,
        user_profiles.gender,
        positions.id,
        positions.name,
        users.id,
        users.position_id,
        user_profiles.tanggal_masuk,
        users.employe_status,
        user_profiles.foto')
            ->from('users')
            ->join('positions', 'users.position_id=positions.id')
            ->join('user_profiles', 'users.id=user_profiles.user_id')
            ->order_by('user_profiles.full_name', 'ASC')
            ->where('users.role_id != 1')
            ->get()->result();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/pegawai/data_pegawai', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_data()
    {
        $data['title'] = "Tambah Data Pegawai";
        $data['posisi'] = $this->ModelPenggajian->positionslist('positions');
        $data['jabatan'] = $this->ModelPenggajian->get_data('users')->result();
        $data['jabatan'] = $this->db->select('user_profiles.nik,
        user_profiles.full_name,
        users.username,
        users.password,
        user_profiles.gender,
        positions.id,
        positions.name,
        users.id,
        users.position_id,
        user_profiles.tanggal_masuk,
        users.employe_status,
        user_profiles.foto')
            ->from('users')
            ->join('positions', 'users.id=positions.id')
            ->join('user_profiles', 'users.id=user_profiles.id')
            ->order_by('user_profiles.full_name', 'ASC')
            ->get()->result();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/pegawai/tambah_dataPegawai', $data);
        $this->load->view('template_admin/footer');
    }
    public function tambah_data_aksi()
    {
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->tambah_data();
        } else {
            $photo = $_FILES['foto']['name'];

            if ($photo) {
                $config['upload_path'] = './photo';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $config['max_size'] = 2048;
                $config['file_name'] = 'pegawai-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $photo = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $dataProfile = [
                'nik' => $this->input->post('nik'),
                'full_name' => $this->input->post('full_name'),
                'gender' => $this->input->post('gender'),
                'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                'foto' => $photo,
            ];
            $dataUser = [
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'position_id' => $this->input->post('jabatan'),
                'employe_status' => $this->input->post('employe_status'),
                'role_id' => 2,
            ];

            $this->ModelPenggajian->insert_data($dataUser, 'users');

            $userId = $this->db->insert_id();
            if ($userId) {
                $dataProfile['user_id'] = $userId;
            }

            $this->db->insert('user_profiles', $dataProfile);

            $this->db->trans_complete();

            if (!$this->db->trans_status()) {
                // Jika ada kesalahan dalam transaksi, rollback perubahan
                $this->db->trans_rollback();
            } else {
                // Jika transaksi berhasil, commit perubahan
                $this->db->trans_commit();
            }
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
            redirect('admin/data_pegawai');
        }
    }

    public function update_data($id)
    {
        $data['title'] = "Update Data Pegawai";
        $data['jabatan'] = $this->ModelPenggajian->get_data('users')->result();
        $data['posisi'] = $this->ModelPenggajian->positionslist('positions');
        $data['pegawai'] = $this->db->select('user_profiles.nik,
        user_profiles.full_name,
        user_profiles.gender,
        user_profiles.foto,
        user_profiles.tanggal_masuk,
        users.employe_status,
        users.username,
        users.password,
        users.id,
        users.position_id,
        positions.id,
        positions.name')
            ->from('users')
            ->join('user_profiles', 'users.id=user_profiles.id')
            ->join('positions', 'users.id=positions.id')
            ->where('users.id', $id)
            ->order_by('user_profiles.full_name', 'ASC')
            ->get()->result();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/pegawai/update_dataPegawai', $data);
        $this->load->view('template_admin/footer');
    }

    public function update_data_aksi()
    {
        $this->_rules();
        $id = $this->input->post('id_pegawai');

        if ($this->form_validation->run() == false) {
            $this->update_data($id);
        } else {

            $photo = $_FILES['foto']['name'];
            if ($photo) {
                $config['upload_path'] = './photo';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $config['max_size'] = 2048;
                $config['file_name'] = 'pegawai-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $photo = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $dataProfile = array(
                'nik' => $this->input->post('nik'),
                'full_name' => $this->input->post('full_name'),
                'gender' => $this->input->post('gender'),
                'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                'foto' => $photo,
            );

            $dataUser = [
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'position_id' => $this->input->post('jabatan'),
                'employe_status' => $this->input->post('employe_status'),
            ];

            $where = array(
                'id' => $id,
            );

            $this->db->trans_start();

            $this->ModelPenggajian->update_data('users', $dataUser, $where);
            $this->db->update('user_profiles', $dataProfile, ['user_id' => $id]);

            $this->db->trans_complete();

            if (!$this->db->trans_status()) {
                // Jika ada kesalahan dalam transaksi, rollback perubahan
                $this->db->trans_rollback();
            } else {
                // Jika transaksi berhasil, commit perubahan
                $this->db->trans_commit();
            }

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil diupdate!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/data_pegawai');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('full_name', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('employe_status', 'Employe Status', 'required');
    }

    public function delete_data($id)
    {
        $where = array('id' => $id);
        $this->ModelPenggajian->delete_data($where, 'users');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
        redirect('admin/data_pegawai');
    }
}
