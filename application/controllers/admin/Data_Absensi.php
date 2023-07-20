<?php

class Data_Absensi extends CI_Controller
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
        $data['title'] = "Data Absensi Pegawai";

        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }

        $data['presences'] = $this->db->select('presences.month_year,
        presences.hadir,
        presences.lembur,
        presences.um_lembur,
        presences.ts_lembur,
        users.id,
        user_profiles.full_name,
        user_profiles.user_id,
        user_profiles.gender,
        user_profiles.nik,
        positions.name,')
            ->from('presences')
            ->join('users', 'users.id=presences.user_id')
            ->join('positions', 'users.position_id=positions.id')
            ->join('user_profiles', 'users.id=user_profiles.user_id')
            ->where('presences.month_year', $bulantahun)
            ->where('users.role_id !=', 1)
            ->order_by('user_profiles.user_id')
            ->get()->result();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/absensi/data_absensi', $data);
        $this->load->view('template_admin/footer');
    }

    public function input_absensi()
    {
        if ($this->input->post('submit', true) == 'submit') {
            $post = $this->input->post();

            foreach ($post['bulan'] as $key => $value) {
                if ($post['bulan'][$key] != '') {

                    $simpan[] = array(
                        'user_id' => $post['user_id'][$key],
                        'month_year' => $post['bulan'][$key],
                        'hadir' => $post['hadir'][$key],
                        'lembur' => $post['lembur'][$key],
                        'um_lembur' => $post['umLembur'][$key],
                        'ts_lembur' => $post['tsLembur'][$key],
                    );
                }
            }
            $this->ModelPenggajian->insert_batch('presences', $simpan);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
            redirect('admin/data_absensi');

        }

        $data['title'] = "Form Input Absensi";

        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
        $data['input_absensi'] = $this->db->select('users.*,
        user_profiles.*,
        positions.*')
            ->from('users')
            ->join('positions', 'users.position_id=positions.id')
            ->join('user_profiles', 'users.id=user_profiles.user_id')
            ->where_not_in('SELECT * FROM presences WHERE bulan="$bulantahun"')
            ->where('users.role_id !=', 1)
            ->order_by('user_profiles.full_name', 'ASC')
            ->get()->result();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/absensi/tambah_dataAbsensi', $data);
        $this->load->view('template_admin/footer');
    }
}
