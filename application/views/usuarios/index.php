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

            <?php if (isset($_SESSION['success'])) : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong><?= $_SESSION['success'] ?></strong>
                            <button type="button" class="close" data-dimiss="alert" aria-label="Close">
                                <i class="ik ik-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php unset($_SESSION['success'])?>
            <?php elseif (isset($_SESSION['error'])) : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong><?= $_SESSION['error'] ?></strong>
                            <button type="button" class="close" data-dimiss="alert" aria-label="Close">
                                <i class="ik ik-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php 
                unset($_SESSION['error']);
                endif; 
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a title="Cadastrar usuário" data-toggle="tooltip" data-placement="bottom" href="<?= base_url('usuarios/core/') ?>"><button class="btn btn-success">Novo +</button></a>
                        </div>
                        <div class="card-body">
                            <table class="table data_table">
                                <thead>
                                    <tr>
                                        <th class="pl-4">#</th>
                                        <th>Usuário</th>
                                        <th>E-mail</th>
                                        <th>Nome</th>
                                        <th>Tipo de acesso</th>
                                        <th>Ativo</th>
                                        <th class="nosort text-right pr-25">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($usuarios as $user) : ?>
                                        <tr>
                                            <td class="px-4"><?= $user->id ?></td>
                                            <td><?= $user->username ?></td>
                                            <td><?= $user->email ?></td>
                                            <td><?= $user->first_name ?></td>
                                            <td><?= $this->ion_auth->is_admin($user->id) ? 'Administrador' : 'Membro' ?></td>
                                            <td><?= ($user->active) == 1 ? '<span class="badge badge-pill badge-success mb-1">Sim</span>' : '<span class="badge badge-pill badge-warning mb-1">Não</span>'; ?></td>
                                            <td class="px-4">
                                                <div class="table-actions">
                                                    <a title="Editar" data-toggle="tooltip" data-placement="bottom" class="btn btn-icon btn-primary" href="<?= base_url('/usuarios/core/' . $user->id) ?>"><i class="ik ik-edit-2"></i></a>
                                                    <span data-toggle="tooltip" data-placement="bottom" title="Excluir"><button class="btn btn-icon btn-danger" data-toggle="modal" data-target="#user-<?= $user->id?>"><i class="ik ik-trash-2"></i></button></span>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="user-<?= $user->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
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
                                                        <a href="<?= base_url($this->router->fetch_class() . '/del/' . $user->id)?>"><button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">Sim, excluir</button></a>
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
            <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Customizado por <a href="" class="text-dark">Marcelo Mesquita</a> <i class="fas fa-code text-dark"></i></span>
        </div>
    </footer>

</div>