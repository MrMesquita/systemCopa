
<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">

    <?php $this->load->view('layout/sidebar'); ?>

        <div class="main-content">
            <?php if ($message = $this->session->flashdata('success')) : ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible fade show">
                                <strong><?= $message ?></strong>
                                <button type="button" class="close" data-dimiss="alert" aria-label="Close">
                                    <i class="ik ik-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
            <?php endif; ?>
        </div>


        <footer class="footer">
            <div class="w-100 clearfix">
                <span class="text-center text-sm-left d-md-inline-block">Copyright © <?= date('Y');?> ThemeKit v2.0. All Rights Reserved.</span>
                <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Customizado por <a href="javascript:void()" class="text-dark">Marcelo Mesquita</a> <i class="fas fa-code text-dark"></i></span>
            </div>
        </footer>
        
    </div>
