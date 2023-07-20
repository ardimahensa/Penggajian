<?php

class Slip_Gaji extends CI_Controller
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
        $data['title'] = "Slip Gaji Pegawai";
        $data['pegawai'] = $this->ModelPenggajian->get_data('users')->result();
        $data['pegawai'] = $this->ModelPenggajian->userProfileList('user_profiles')->result();
        $data['pegawai'] = $this->db->select('users.id,
        users.position_id,
        users.employe_status,
        user_profiles.id,
        user_profiles.user_id,
        user_profiles.full_name,
        user_profiles.nik,
        user_profiles.tanggal_masuk,
        user_profiles.gender,
        user_profiles.foto,
        positions.id,
        positions.name,
        positions.basic_salary,
        positions.t_jabatan,
        positions.t_transport,
        positions.uang_makan,
        positions.uang_lembur,
        presences.id,
        presences.user_id,
        presences.month_year,
        presences.hadir,
        presences.lembur,
        (positions.uang_makan * presences.hadir) AS um,
        (positions.uang_lembur * presences.hadir) AS ul,
        (positions.t_transport * presences.hadir) AS ts,
        ROUND(positions.basic_salary + positions.t_jabatan + (positions.uang_makan * presences.hadir) + (positions.uang_lembur * presences.hadir) + (positions.t_transport * presences.hadir),2) AS total')
            ->from('users')
            ->join('user_profiles', 'user_profiles.user_id=users.id')
            ->join('presences', 'presences.user_id=users.id')
            ->join('positions', 'positions.id=users.position_id')
            ->get()->result();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/gaji/slip_gaji', $data);
        $this->load->view('template_admin/footer');
    }

    public function cetak_slip_gaji()
    {
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }

        $data['title'] = "Cetak Laporan Absensi Pegawai";
        $nama = $this->input->post('pegawai');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $bulantahun = $bulan . $tahun;

        $data['print_slip'] = $this->db->select('users.id,
        users.position_id,
        users.employe_status,
        user_profiles.id,
        user_profiles.user_id,
        user_profiles.full_name,
        user_profiles.nik,
        user_profiles.tanggal_masuk,
        user_profiles.gender,
        user_profiles.foto,
        positions.id,
        positions.name,
        positions.basic_salary,
        positions.t_jabatan,
        positions.t_transport,
        positions.uang_makan,
        positions.uang_lembur,
        presences.id,
        presences.user_id,
        presences.month_year,
        presences.hadir,
        presences.lembur,
        presences.um_lembur,
        presences.ts_lembur,
        (positions.uang_makan * presences.hadir) AS um,
        (positions.uang_lembur * presences.hadir) AS ul,
        (positions.t_transport * presences.hadir) AS ts,
        ROUND(positions.basic_salary + positions.t_jabatan + (positions.uang_makan * presences.hadir) + (positions.uang_lembur * presences.hadir) + (positions.t_transport * presences.hadir),2) AS total')
            ->from('users')
            ->join('user_profiles', 'user_profiles.user_id=users.id')
            ->join('presences', 'presences.user_id=users.id')
            ->join('positions', 'positions.id=users.position_id')
            ->where('month_year ', $bulantahun)
            ->where('user_profiles.user_id', $nama)
            ->get()->result();
        $this->load->view('template_admin/header', $data);
        $this->load->view('admin/gaji/cetak_slip_gaji', $data);
    }
}
