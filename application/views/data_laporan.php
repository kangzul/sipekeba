<section class="content-header">
    <h1> DATA LAPORAN </h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <div class="btn-group">
                <!-- <button type="button" class="btn btn-sm btn-primary" title="Tambah Data" onclick="render_page('tambah_layanan')"><i class="fa fa-plus"></i> TAMBAH LAYANAN</button> -->
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-condensed table-striped table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelapor</th>
                        <th>Jenis</th>
                        <th>Alasan</th>
                        <th>File Pendukung</th>
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
                            <td>$key->nama_lengkap</td>
                            <td>$key->nama_layanan</td>
                            <td>$key->alasan</td>
                            <td>";
                        foreach ($key->file as $file) {
                            echo "<span class='sp' data-name='" . $file->photo . "'>" . $file->photo . "</span>";
                        }
                        echo "</td>
                            <td>" . date('j F Y', strtotime($key->created_at)) . "</td>
                            <td>";
                        if ($key->status == 1) {
                            echo "<button class='btn btn-xs bg-primary validasi' data-id='$key->id_laporan'> VALIDASI</button>";
                        } else if ($key->status == 2) {
                            echo "<button class='btn btn-xs btn-info edit' data-id='$key->id_laporan'> CETAK</button>";
                        }
                        echo "</td>
                        </tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">FILE PENDUKUNG</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $('span.sp').click(function() {
        var path = $(this).data('name')
        var img = "<img src='" + base_url + "uploads/" + path + "' style='width:100%'/>"
        $(".modal-body").html(img);
        $("#modal-default").modal('show');
    })
    $('#myTable').DataTable({
        stateSave: true,
    });
    $('.validasi').click(function() {
        var id = $(this).data('id')
        Swal.fire({
            title: 'Apakah Yakin..?',
            text: "Validasi data laporan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Validasi!'
        }).then((result) => {
            if (result.value) {
                $.post(base_url + "main/validasi_laporan", {
                    id: id
                }, function(response) {
                    render_page('data_laporan', response);
                })
            }
        })
    })
    $('.edit').click(function() {
        var id = $(this).data('id')
        // render_page('edit_layanan?id=' + id)
    })
</script>