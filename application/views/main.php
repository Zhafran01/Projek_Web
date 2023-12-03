    <?php if ($pilih < 1) : ?>
      <?php if ($passdefault) : ?>
        <div class="col-sm-12">
          <div class="tengah">
            <div class="col-sm-5">
              <div class="box box-danger box-solid">
                <div class="box-header">
                  <h4 class="box-title"><i class="fa fa-lock"></i> Ubah Password</h4>
                </div>
                <div class="box-body">
                  <p class="text-center text-muted">Harap ubah password untuk melanjutkan</p>
                  <form id="formUbahPasswd">
                    <div class="form-group">
                      <label for="PasswordLama">Password Lama :</label>
                      <input type="password" name="passwdlama" class="form-control" placeholder="Klik Password Lama">
                    </div>
                    <div class="form-group">
                      <label for="PasswordBaru">Password Baru :</label>
                      <input type="password" name="passwdbaru" class="form-control" placeholder="Klik Password Baru">
                    </div>
                    <button class="btn btn-danger btn-flat">Simpan</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php else : ?>
        <div class="col-sm-12">
          <div class="box ">
            <div class="box-body">
              <h1 class="text-center no-margin"><?= $voting->nama_voting ?></h1>
              <hr>
              <div class="tengah">
                <?php foreach ($kandidat as $k) : ?>
                  <div class="col-sm-4">
                    <div class="box">
                      <div class="box-body box-profile">
                        <img src="<?= base_url('assets/img/kandidat/' . $k->foto); ?>" alt="" class="profile-user-img img-kandidat img-responsive img-circle">
                        <h3 class="profile-username text-center"><?= $k->nama_kandidat ?></h3>
                        <p class="text-center text-muted"><?= $k->keterangan ?></p>
                        <button class="btn btn-danger btn-flat btn-block pilih" data="<?= $k->id_kandidat ?>" data-voting="<?= $voting->id_voting ?>" data-nama="<?= $k->nama_kandidat ?>">Pilih</button>
                      </div>
                    </div>
                  </div>
                <?php endforeach ?>
              </div>
              <h4 class="text-muted text-center">*Silakan pilih kandidat untuk melanjutkan</h4>
            </div>
          </div>
        </div>
      <?php endif ?>
    <?php else : ?>
      <div class="col-sm-12">
        <div class="box box-solid">
          <div class="box-body">
            <h2 class="text-center">Terima Kasih Atas Partisipasi Anda!</h2>
            <h4 class="text-center">Kami berharap dapat bertemu Anda lagi.</h4>
            <hr>
            <div class="tengah">
              <button class="btn btn-danger btn-flat logout text-center">LOGOUT NOW</button>
            </div>
          </div>
        </div>
      </div>
    <?php endif ?>

    <script>
      $('#formUbahPasswd').on('submit', function(e) {
        e.preventDefault();
        var id = <?= $this->session->id ?>;
        var passLama = $('[name="passwdlama"]').val(),
          passBaru = $('[name="passwdbaru"]').val();
        if (passLama != '' || passBaru != '') {
          $.ajax({
            type: 'POST',
            url: '<?= base_url("user/set_pass_id/") ?>' + id,
            data: {
              passwdLama: passLama,
              passwdBaru: passBaru
            },
            success: function(data) {
              if (data == 1) {
                $('#formUbahPasswd').trigger('reset');
                Swal.fire('Sukses', 'Anda akan diarahkan dalam 5 detik', 'success');
                setTimeout(function() {
                  window.location.reload()
                }, 5000);
              } else {
                $('#formUbahPasswd').trigger('reset');
                Swal.fire('Gagal', 'password lama salah !', 'error');
              }
            }
          })
        } else {
          Swal.fire('Gagal', 'Formulir harus diisi !', 'error');
          return false;
        }
      })
      //pilih
      $('.pilih').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('data');
        var voting = $(this).attr('data-voting');
        var nama = $(this).attr('data-nama');
        Swal.fire({
          type: 'question',
          title: 'Pilih ' + nama,
          text: 'Apakah Anda yakin akan memilih kandidat ini ?',
          showCancelButton: true,
          confirmButtonText: 'Pilih'
        }).then((result) => {
          if (result.value) {
            //aksi
            $.ajax({
              type: 'POST',
              url: '<?= base_url("user/pilih/") ?>' + voting + '/' + id,
              success: function(data) {
                if (data == 1) {
                  Swal.fire({
                    type: 'success',
                    title: 'Sukses',
                    text: 'Anda telah memilih ' + nama,
                  }).then((result) => {
                    if (result.value) {
                      window.location.reload()
                    }
                  })
                }
              }
            })
          }
        })
      })
      //logout
      $('.logout').on('click', function(e) {
        e.preventDefault()
        window.location.assign('<?= base_url("user/logout") ?>')
      })
    </script>

    <?php if ($pilih > 0) : ?>
      <script>
        setTimeout(function() {
          window.location.assign('<?= base_url("user/logout") ?>');
        }, 120000)
      </script>
    <?php endif ?>