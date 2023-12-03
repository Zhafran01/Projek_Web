        <div class="tengah">
          <div class="col-sm-5">
            <div class="box box-success box-solid">

              <div class="box-body">
                <h4 class="text-center text-muted">Silahkan Login</h4>
                <form action="<?= base_url('Auth/actlogin') ?>" method="POST">
                  <div class="form-group">
                    <label for="Username">Username :</label>
                    <input type="text" name="username" class="form-control" placeholder="Klik Username">
                  </div>
                  <div class="form-group">
                    <label for="Password">Password :</label>
                    <input type="password" name="password" class="form-control" placeholder="Klik Password">
                  </div>
                  <button class="btn btn-success btn-flat btn-block"><i class="fa fa-sign-in"></i> Login</button>
                </form>
              </div>
            </div>
          </div>
        </div>