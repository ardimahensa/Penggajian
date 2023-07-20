<?php

class Laporan_Absensi extends CI_Controller
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
        $data['title'] = "Laporan Absensi Pegawai";

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/absensi/laporan_absensi');
        $this->load->view('template_admin/footer');
    }

    public function cetak_laporan_absensi()
    {

        $data['title'] = "Cetak Laporan Absensi Pegawai";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
        $data['lap_kehadiran'] = $this->db->select('users.id,
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
            ->order_by('user_profiles.full_name', 'ASC')
            ->get()->result();
        $this->load->view('template_admin/header', $data);
        $this->load->view('admin/absensi/cetak_absensi', $data);
    }
}
