<?php

class Ganti_Password extends CI_Controller
{

    public function index()
    {
        $data['title'] = "Form Ganti Password";

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('ganti_password', $data);
        $this->load->view('template_admin/footer');
    }

    public function ganti_password_aksi()
    {
        $passBaru = $this->input->post('passBaru');
        $ulangPass = $this->input->post('ulangPass');

        $this->form_validation->set_rules('passBaru', 'password baru', 'required|min_length[3]');
        $this->form_validation->set_rules('ulangPass', 'confirm password', 'required|matches[passBaru]');

        if ($this->form_validation->run() != false) {

            $data = array('password' => md5($passBaru));
            $id = array('id' => $this->session->userdata('id'));
            $this->ModelPenggajian->update_data('users', $data, $id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Password berhasil diganti!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
            redirect('login');
        } else {
            $data['title'] = "Form Ganti Password";

            $this->load->view('template_admin/header', $data);
            $this->load->view('template_admin/sidebar');
            $this->load->view('ganti_password', $data);
            $this->load->view('template_admin/footer');
        }
    }
}
