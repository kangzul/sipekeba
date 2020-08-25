<section class="content-header">
    <h1> DATA PENGGUNA </h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <div class="btn-group">
                <!-- <button type="button" class="btn btn-sm btn-primary" title="Tambah Data" onclick="render_page('tambah_admin')"><i class="fa fa-plus"></i> TAMBAH ADMIN</button> -->
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-condensed table-striped table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Tempat, Tgl Lahir</th>
                        <th>Alamat</th>
                        <th>Kewarganegaraan</th>
                        <th>Pekerjaan</th>
                        <th>Agama</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($list as $key) {
                        $status = $key->status == 1 ? 'Aktif' : 'Tidak Aktif';
                        $gender = $key->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan';
                        $warga = $key->kewarganegaraan == 1 ? 'WNI' : 'WNA';
                        $agama = ['', 'Islam', 'Kristen', 'Protestan', 'Hindu', 'Budha', 'Konghucu'];
                        echo "<tr>
                            <td>$no</td>
                            <td>$key->nama_lengkap</td>
                            <td>$key->email</td>
                            <td>$gender</td>
                            <td>$key->tempat_tgl_lahir</td>
                            <td>$key->alamat</td>
                            <td>$warga</td>
                            <td>$key->pekerjaan</td>
                            <td>" . $agama[$key->agama] . "</td>
                            <td>" . date('j F Y', strtotime($key->created_at)) . "</td>
                            <td>
                                <button class='btn btn-xs btn-danger hapus' data-id='$key->id_user'> HAPUS</button>
                            </td>
                        </tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
    $('#myTable').DataTable();
    $('.hapus').click(function() {
        var id = $(this).data('id')
        Swal.fire({
            title: 'Apakah Yakin..?',
            text: "Pengguna ini akan dihapus dan tidak bisa login",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                $.post(base_url + "main/hapus_pengguna", {
                    id: id
                }, function(response) {
                    render_page('data_pengguna', response);
                })
            }
        })
    })
    $('.edit').click(function() {
        var id = $(this).data('id')
        render_page('edit_user?id=' + id)
    })
</script>