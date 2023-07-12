<main class="main-content  mt-0">
  <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url(<?= base_url('assets/assets/img/kesehatan.jpg'); ?>); background-position: top;">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 text-center mx-auto">
          <h1 class="text-white mb-2 mt-5">Selamat Datang</h1>
          <p class="text-lead text-white">di Portal Puskesmas Rawat Inap Sidomulyo</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
      <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
        <div class="card z-index-0">
          <div class="card-header text-center pt-4">
            <h5>Daftarkan Akun</h5>
          </div>
          <div class="card-body">
            <form role="form" method="POST" action="">
              <div class="mb-3">
                <input type="text" name="nama" class="form-control" placeholder="Name" aria-label="Name">
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <!-- <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email">
                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
              </div> -->
              <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password">
                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="mb-3">
                <input type="password" name="confirm_password" class="form-control" placeholder="Password" aria-label="Password">
                <?= form_error('confirm_password', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="text-center">
                <button type="button" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
              </div>
              <p class="text-sm text-center mt-3 mb-0">Already have an account? <a href="javascript:;" class="text-dark font-weight-bolder">Sign in</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>