<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<main class="main-content  mt-0">
  <section>
    <div class="page-header min-vh-100">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
            <div class="card card-plain">
              <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder">Masuk</h4>
                <p class="mb-0">Masukkan nama pengguna dan kata sandi anda untuk dapat masuk</p>
              </div>
              <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <form role="form" method="POST" action="<?= base_url('auth/cek_login'); ?>">
                  <div class="mb-3">
                    <input type="username" name="username" class="form-control form-control-lg" placeholder="Nama Pengguna" aria-label="Nama Pengguna" required>
                  </div>
                  <div class="mb-3">
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Kata Sandi" aria-label="Kata Sandi" minlength="8" required>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Masuk</button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">

              </div>
            </div>
          </div>
          <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url(<?= base_url('assets/assets/img/alkes.jpg'); ?>);
          background-size: cover;">
              <span class="mask bg-gradient-primary opacity-6"></span>
              <h4 class="mt-5 text-white font-weight-bolder position-relative">"Puskesmas Rawat Inap Sidomulyo"</h4>
              <p class="text-white position-relative">Menciptakan dan Memelihara Kesehatan Individu, Keluarga dan Lingkungan</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<!--   Core JS Files   -->