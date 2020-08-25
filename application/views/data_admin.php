<section class="content-header">
    <h1> Data Admin </h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-primary" title="Tambah Data" onclick="render_page('tambah_admin')"><i class="fa fa-plus"></i> TAMBAH ADMIN</button>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-condensed table-striped table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Email</th>
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
                            <td>$key->username</td>
                            <td>$key->real_name</td>
                            <td>$key->email</td>
                            <td>$status</td>
                            <td>".date('j F Y', strtotime($key->created_at))."</td>
                            <td>
                                <button class='btn btn-xs btn-info edit' data-id='$key->id_admin'> EDIT</button>
                                <button class='btn btn-xs btn-danger hapus' data-id='$key->id_admin'> HAPUS</button>
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
    $('.hapus').click(function () {
        var id = $(this).data('id')
    })
    $('.edit').click(function () {
        var id = $(this).data('id')
        render_page('edit_admin?id='+id)
    })
</script>