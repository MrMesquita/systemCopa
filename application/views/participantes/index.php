<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">

    <?php $this->load->view('layout/sidebar'); ?>
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="<?= $icon_view ?>"></i>
                            <div class="d-inline">
                                <h5><?= $titulo ?></h5>
                                <span><?= $sub_titulo ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a title='Home' href="<?= base_url('/') ?>"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"><?= $titulo ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            
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
            <?php elseif ($message = $this->session->flashdata('error')) : ?>
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
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a title="Cadastrar participante" data-toggle="tooltip" data-placement="bottom" href="<?= base_url('participantes/core/') ?>"><button class="btn btn-success">Novo +</button></a>
                        </div>
                        <div class="card-body">
                            <table class="table data_table">
                                <thead>
                                    <tr>
                                        <th class="pl-4">#</th>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>telefone</th>
                                        <th class="nosort text-right pr-25">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($participantes as $participante) : ?>
                                        <tr>
                                            <td class="px-4"><?= $participante->id; ?></td>
                                            <td><?= $participante->nome; ?></td>
                                            <td><?= $participante->email; ?></td>
                                            <td>
                                                <?php 
                                                    $tel = (int) $participante->telefone;
                                                    echo $tel
                                                    ?>
                                            </td>
                                            <td class="px-4">
                                                <div class="table-actions">
                                                    <a title="Editar" data-toggle="tooltip" data-placement="bottom" class="btn btn-icon btn-primary" href="<?= base_url('/participantes/edit/' . $participante->id) ?>"><i class="ik ik-edit-2"></i></a>
                                                    <span data-toggle="tooltip" data-placement="bottom" title="Excluir"><button class="btn btn-icon btn-danger" data-toggle="modal" data-target="#participante-<?= $participante->id ?>"><i class="ik ik-trash-2"></i></button></span>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <div class="modal fade" id="participante-<?= $participante->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterLabel"><i class="fas fa-exclamation-triangle text-danger"></i> Tem certeza que deseja Excluir?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não, cancelar</button>
                                                        <a href="<?= base_url($this->router->fetch_class() . '/del/' . $participante->id)?>"><button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">Sim, excluir</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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