

<div class="auth-wrapper">
    <div class="container-fluid h-100">
        <div class="row flex-row h-100 bg-white">
            <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                <div class="lavalite-bg" style="background-image: url('<?= base_url('public')?>/img/auth/login-bg.jpg')">

                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                <div class="authentication-form mx-auto">
                    <div class="logo-centered">
                        <a href="#"><img src="<?= base_url('public/src/img/brand.png')?>" style="width: 100%" alt=""></a>
                    </div>
                    <?php if ($message = $this->session->flashdata('error')) : ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <strong><?= $message ?></strong>
                                    <button type="button" class="close" data-dimiss="alert" aria-label="Close">
                                        <i class="ik ik-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <h3>Seja bem-vindo(a)!</h3>
                    <p>Estamos felizes de ter você aqui!</p>
                    <form method="POST" action="<?= base_url('login/auth')?>">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" required placeholder="exemplo@email.com">
                            <i class="ik ik-user"></i>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" required placeholder="********">
                            <i class="ik ik-lock"></i>
                        </div>
                        <div class="row">
                            <div class="col text-left">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option1">
                                    <span class="custom-control-label">&nbsp;Lembre de mim</span>
                                </label>
                            </div>
                            <div class="col text-right">
                                <a href="forgot-password.html">Esqueceu sua senha?</a>
                            </div>
                        </div>
                        <div class="sign-btn text-center">
                            <button class="btn btn-theme" style="background: linear-gradient(150deg, #acf900 22%, #00bc2b 86%)">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>