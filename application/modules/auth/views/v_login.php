<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h2 class="text-center">Login Page</h2>
        </div>
    </div>
    <?php if ($this->session->flashdata('success')) : ?>
    <div class="success"></div>
    <?php endif ?>
    <?php if ($this->session->flashdata('error')) : ?>
    <div class="error"></div>
    <?php endif ?>
    <div class="row mt-3">
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('auth/login') ?>" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        Belum Memiliki akun? <a href="<?= base_url('auth/registration') ?>"
                            class="text-decoration-none">Registrasi</a>
                        <button type="submit" class="btn btn-primary mt-3 d-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    var success = $('.success').html()
    var error = $('.error').html()
    if (success != null) {
        toastr.success("<?= $this->session->flashdata('success') ?>")
    }
    if (error != null) {
        toastr.error("<?= $this->session->flashdata('error') ?>")
    }
})
</script>