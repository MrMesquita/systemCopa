<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">

    <?php $this->load->view('layout/sidebar'); ?>

    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-users bg-blue"></i>
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


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3><?= $titulo ?></h3>
                        </div>
                        <div class="card-body">
                            <table class="table data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
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
                                            <td><?= $user->id ?></td>
                                            <td><?= $user->username ?></td>
                                            <td><?= $user->email ?></td>
                                            <td><?= $user->first_name ?></td>
                                            <td><?= $this->ion_auth->is_admin($user->id) ? 'Administrador' : 'Membro'?></td>
                                            <td><?= $user->active == 1   ? 'Sim' : 'Não' ?></td>
                                            <td>
                                                <div class="table-actions">
                                                    <a title="Visualizar" data-toggle="tooltip" data-placement="bottom" href="/usuarios/<?= $user->id ?>"><i class="ik ik-eye"></i></a>
                                                    <a title="Editar" data-toggle="tooltip" data-placement="bottom" href="#"><i class="ik ik-edit-2"></i></a>
                                                    <a title="Excluir" data-toggle="tooltip" data-placement="bottom" href="#"><i class="ik ik-trash-2"></i></a>
                                                </div>
                                            </td>
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