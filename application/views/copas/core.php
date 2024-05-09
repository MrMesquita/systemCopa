<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">

    <?php $this->load->view('layout/sidebar'); ?>

    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-6">
                        <div class="page-header-title">
                            <i class="<?= $icon_view ?>"></i>
                            <div class="d-inline">
                                <h5><?= $titulo ?></h5>
                                <span><?= $sub_titulo ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a title='Home' href="<?= base_url('/'); ?>"><i class="ik ik-home"></i></a> 
                                </li>
                                <li class="breadcrumb-item">
                                    <a title="Listar <?= $this->router->fetch_class(); ?>" href="<?= base_url($this->router->fetch_class()) ?>">
                                        <?= ucfirst($this->router->fetch_class()) ?>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"><?= $titulo; ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <?= isset($copa) ? 'Última atualização: '.formata_data_banco_com_hora($copa->data_registro) : 'Preencha os campos com os dados do usuário';?>
                        </div>
                        <div class="card-body">
                            <form class="forms-sample" method="POST">
                                <div class="form-group row">
                                    <div class="col-md-6 mb-10">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" name='copa_name' value="<?= isset($copa) ? $copa->copa_name : set_value('copa_name');?>" placeholder="Nome">
                                        <?= form_error('copa_name', '<div class="text-danger">','</div>') ?>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label>Ativo</label>
                                        
                                        <select class="form-control" name="active"> 

                                            <?php if(isset($copa)):?>
                                                <option value="1" <?= $copa->active == 1 ?'selected' : ''?>>Sim</option>
                                                <option value="0" <?= $copa->active == 0 ?'selected' : ''?>>Não</option>
                                            <?php else: ?>
                                                <option value="0">Não</option>
                                                <option value="1">Sim</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <?php if(isset($copa)): ?>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control" name='copa_id' value="<?= $copa->id ?>">
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary mr-2">Salvar</button>
                                <a href="<?= base_url("/copas")?>" class="btn btn-light">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="footer">
        <div class="w-100 clearfix">
            <span class="text-center text-sm-left d-md-inline-block">Copyright © <?= date('Y'); ?> ThemeKit v2.0. All Rights Reserved.</span>
            <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Customizado por <a href="javascript:void()" class="text-dark">Marcelo Mesquita</a> <i class="fas fa-code text-dark"></i></span>
        </div>
    </footer>

</div>