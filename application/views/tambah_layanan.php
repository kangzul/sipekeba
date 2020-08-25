<section class="content-header">
    <h1> TAMBAH LAYANAN </h1>
</section>
<section class="content">
    <div class="box">
        <form class="form-horizontal" id="addLayanan">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Layanan</label>
                            <div class="col-sm-4">
                                <input type="text" name="nama_layanan" class="form-control" placeholder="Nama Layanan" autocomplete="off" required>
                            </div>
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-4">
                                <select name="status" id="status" class="form-control">
                                    <option value="" disabled selected> Pilih Status</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button class="btn btn-sm bg-maroon pull-left" type="button" onclick="render_page('data_layanan')"  title="Kembali"><i class="fa fa-arrow-left"></i> <span class="hidden-xs">Kembali</span></button>
                <button class="btn btn-sm btn-success pull-right" type="submit"><i class="fa fa-check"></i> Simpan</button>
            </div>
        </form>
    </div>
</section>
<script>
    $("#addLayanan").submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize()
        $.post(base_url + "main/tambah_data_layanan", data, function(result) {
            if (result.icon == 'success') {
                $("#addLayanan").trigger('reset');
            }
            Swal.fire(result);
        })
    })
</script>