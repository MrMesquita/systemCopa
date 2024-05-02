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
                                        <?= $titulo_anterior ?>
                                    </a>
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
                            <?= isset($user) ? 'Última atualização: '.formata_data_banco_com_hora($user->date_last_update) : 'Preencha os campos com os dados do usuário';?>
                        </div>
                        <div class="card-body">
                            <form class="forms-sample" method="POST">
                                <div class="form-group row">
                                    <div class="col-md-6 mb-10">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" name='first_name' value="<?= isset($user) ? $user->first_name : set_value('first_name');?>" placeholder="Nome">
                                        <?= form_error('first_name', '<div class="text-danger">','</div>') ?>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label>Sobrenome</label>
                                        <input type="text" class="form-control" name='last_name' value="<?= isset($user) ? $user->last_name : set_value('last_name');?>" placeholder="Sobrenome">
                                        <?= form_error('last_name', '<div class="text-danger">','</div>') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 mb-10">
                                        <label>Usuário</label>
                                        <input type="text" class="form-control" name='username' value="<?= isset($user) ? $user->username : set_value('username');?>" placeholder="Usuário">
                                        <?= form_error('username', '<div class="text-danger">','</div>') ?>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name='email' value="<?= isset($user) ? $user->email : set_value('email');?>" placeholder="Email">
                                        <?= form_error('email', '<div class="text-danger">','</div>') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 mb-10">
                                        <label>Senha</label>
                                        <input type="password" class="form-control" name='password' placeholder="Password">
                                        <?= form_error('password', '<div class="text-danger">','</div>') ?>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label>Confirma senha</label>
                                        <input type="password" class="form-control" name='confirmPassword' placeholder="Password">
                                        <?= form_error('confirmPassword', '<div class="text-danger">','</div>') ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 mb-10">
                                        <label>Perfil de acesso</label>
                                        
                                        <select class="form-control" name="perfil">
                                            <?php if(isset($user)):?>
                                                <option value="2" <?= $group->id == 2 ?'selected' : ''?>>Membro</option>
                                                <option value="1" <?= $group->id == 1 ?'selected' : ''?>>Administrador</option>
                                            <?php else: ?>
                                                <option value="2">Membro</option>
                                                <option value="1">Administrador</option>
                                            <?php endif; ?>
                                        </select> 
                                    </div>

                                    <div class="col-md-6 mb-10">
                                        <label>Ativo</label>
                                        
                                        <select class="form-control" name="active"> 

                                            <?php if(isset($user)):?>
                                                <option value="0" <?= $user->active == 0 ?'selected' : ''?>>Não</option>
                                                <option value="1" <?= $user->active == 1 ?'selected' : ''?>>Sim</option>
                                            <?php else: ?>
                                                <option value="0">Não</option>
                                                <option value="1">Sim</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <?php if(isset($user)): ?>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control" name='user_id' value="<?= $user->id ?>">
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary mr-2">Cadstrar</button>
                                <a href="<?= base_url("/usuarios")?>"><button class="btn btn-light">Cancelar</button></a>
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