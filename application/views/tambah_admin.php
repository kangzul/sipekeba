<section class="content-header">
    <h1> TAMBAH ADMIN </h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <button type="button" onclick="render_page('data_admin')" class="btn btn-sm bg-maroon" title="Kembali"><i class="fa fa-arrow-left"></i> <span class="hidden-xs">Kembali</span></button>
        </div>
        <form class="form-horizontal" id="addUser">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Full Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="fullname" class="form-control" placeholder="Full Name" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" placeholder="Email admin" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button class="btn btn-success pull-right" type="submit"><i class="fa fa-check"></i> Simpan</button>
            </div>
        </form>
    </div>
</section>
<script>
    $("#addUser").submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize()
        $.post(base_url+"main/tambah_data_admin", data, function (result) {
            if (result.icon == 'success') {
                $("#addUser").trigger('reset');
            }
            Swal.fire(result);
        })
    })
</script>