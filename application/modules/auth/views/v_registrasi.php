<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h2 class="text-center">Registrasi Page</h2>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('auth/process_regis') ?>" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        Sudah Memiliki akun? <a href="<?= base_url('auth') ?>" class="text-decoration-none">Login</a>
                        <button type="submit" class="btn btn-primary mt-3 d-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>