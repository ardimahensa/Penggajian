<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
  </div>
  <a class="btn btn-sm btn-success mb-3" href="<?php echo base_url('admin/data_pegawai/tambah_data') ?>"><i class="fas fa-plus"></i> Tambah Pegawai</a>
  <?php echo $this->session->flashdata('pesan') ?>
</div>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">NIK</th>
              <th class="text-center">Nama Pegawai</th>
              <th class="text-center">Jenis Kelamin</th>
              <th class="text-center">Jabatan</th>
              <th class="text-center">Tanggal Masuk</th>
              <th class="text-center">Status</th>
              <th class="text-center">Photo</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody class="flex-wrap">
            <?php $no = 1;
foreach ($pegawai as $p): ?>
              <tr align="center">
                <td><?php echo $no++ ?></td>
                <td><?php echo $p->nik ?></td>
                <td><?php echo $p->full_name ?></td>
                <td><?php echo $p->gender ?></td>
                <td><?php echo $p->name ?></td>
                <td><?php echo $p->tanggal_masuk ?></td>
                <td><?php echo ($p->employe_status == 'tetap') ? 'Karyawan Tetap' : 'Karyawan Tidak Tetap' ?></td>
                <td><img class="img-profile rounded-circle" src="<?php echo base_url() . 'photo/' . $p->foto ?>" style=" width:50px; height:50px;"></td>
                <td>
                  <center>
                    <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/data_pegawai/update_data/' . $p->id) ?>"><i class="fas fa-edit"></i></a>
                    <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/data_pegawai/delete_data/' . $p->id) ?>"><i class="fas fa-trash"></i></a>
                  </center>
                </td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>