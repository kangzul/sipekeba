<section class="content-header">
    <h1> DATA SYARAT LAYANAN <?= $row->nama_layanan ?> </h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-primary" title="Tambah Data" onclick="render_page('tambah_syarat_layanan?id=<?= $row->id ?>')"><i class="fa fa-plus"></i> TAMBAH SYARAT LAYANAN</button>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-condensed table-striped table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Syarat</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($list as $key) {
                        $status = $key->status == 1 ? 'Aktif' : 'Tidak Aktif';
                        echo "<tr>
                            <td>$no</td>
                            <td>$key->syarat</td>
                            <td>$key->keterangan</td>
                            <td>$status</td>
                            <td>" . date('j F Y', strtotime($key->created_at)) . "</td>
                            <td>
                                <button class='btn btn-xs btn-info edit' data-id='$key->id'> EDIT</button>
                                <button class='btn btn-xs btn-danger hapus' data-id='$key->id'> HAPUS</button>
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
    var id_layanan = '<?= $row->id ?>';
    $('#myTable').DataTable();
    $('.hapus').click(function() {
        var id = $(this).data('id')
        Swal.fire({
            title: 'Apakah Yakin..?',
            text: "Data yang dipilih akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                $.post(base_url + "main/hapus_syarat_layanan", {
                    id: id
                }, function(response) {
                    render_page('data_syarat_layanan?id=' + id_layanan, response);
                })
            }
        })
    })
    $('.edit').click(function() {
        var id = $(this).data('id')
        render_page('edit_syarat_layanan?id=' + id)
    })
</script>