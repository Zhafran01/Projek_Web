<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?= base_url('assets/adminlte/bower_components/fastclick/lib/fastclick.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/adminlte/dist/js/adminlte.min.js'); ?>"></script>
<?= ($this->session->flashdata('login_gagal')) ? '<script>Swal.fire("Gagal", "Username/Password Salah !", "error")</script>' : '' ?>
<?= ($this->session->flashdata('novoting')) ? '<script>Swal.fire("Gagal", "Tidak voting !", "error")</script>' : '' ?>