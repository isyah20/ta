<!-- form update profile -->
<br><br>
<div class="container">
    <div class="card-body">
        <form action="<?= base_url('profile/ubah') ?>" method="post">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $pengguna['nama']; ?>">
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $pengguna['email']; ?>">
                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="no_telp">No Hp</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $pengguna['no_telp']; ?>">
                <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="npwp">NPWP</label>
                <input type="text" class="form-control" id="npwp" name="npwp" value="<?= $pengguna['npwp']; ?>">
                <?= form_error('npwp', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $pengguna['alamat']; ?>">
                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="password2">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password2" name="password2">
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Ubah</button>
        </form>
    </div>
</div>