<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">

    <?php $this->load->view('layout/sidebar'); ?>

    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-6">
                        <div class="page-header-title">
                            <i class="bi bi-table bg-blue"><?= $icon_view ?></i>
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
                                    <a title="Listar classificações" href="<?= base_url($this->router->fetch_class()) ?>">Classificações</a>
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
                            Preencha os campos com os dados da classificação
                        </div>
                        <div class="card-body">
                            <form class="forms-sample" method="POST" action="<?= $action ?>">
                                <div class="form-group row">
                                    <div class="col-md-6 mb-10">
                                        <label for="time">Time</label>
                                        <select class="form-control" name="time" required> 
                                            <?php 
                                                if(isset($classificacao)):
                                                    $time = $this->core_model->get_by_id('times', array('id' => $classificacao->time_id));?>
                                                    <option value="<?= $time->id ?>"><?= $time->nome_time ?></option>
                                            <?php endif; ?>
                                            <?php if(!isset($classificacao)):?>
                                                <option value="">-----</option>
                                            <?php endif;
                                            foreach($times as $time): ?>
                                                <option value="<?= $time->id?>"><?= $time->nome_time ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label for="copa">Copa</label>
                                        <select class="form-control" name="copa" required>      
                                            <?php 
                                                if(isset($classificacao)):
                                                    $copa = $this->core_model->get_by_id('copas', array('id' => $classificacao->copa_id));?>
                                                    <option value="<?= $copa->id ?>"><?= $copa->copa_name ?></option>
                                            <?php endif; ?>
                                            <?php if(!isset($classificacao)):?>
                                                <option value="">-----</option>
                                            <?php endif;
                                                foreach($copas as $copa): ?>
                                                    <option value="<?= $copa->id?>"><?= $copa->copa_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label for="pts">Pontos</label>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" name='pts' value="<?= isset($classificacao) ? $classificacao->pts : 0 ?>" min="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label for="pts">Jogo</label>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" name='jogo' value="<?= isset($classificacao) ? $classificacao->jogo : 0 ?>" min="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label for="pts">Vitórias</label>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" name='vitoria' value="<?= isset($classificacao) ? $classificacao->vitoria : 0 ?>" min="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label for="pts">Empates</label>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" name='empate' value="<?= isset($classificacao) ? $classificacao->empate : 0 ?>" min="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label for="pts">Derrotas</label>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" name='derrota' value="<?= isset($classificacao) ? $classificacao->derrota : 0 ?>" min="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label for="pts">Gols marcados</label>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" name='gol_marcado' value="<?= isset($classificacao) ? $classificacao->gol_marcado : 0 ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label for="pts">Gols contras</label>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" name='gol_contra' value="<?= isset($classificacao) ? $classificacao->gol_contra : 0 ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label for="pts">Saldo de gols</label>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" name='saldo_gol' value="<?= isset($classificacao) ? $classificacao->saldo_gol : 0 ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php if(isset($classificacao)): ?>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control" name='classificacao_id' value="<?= $classificacao->id ?>">
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary mr-2">Salvar</button>
                                <a href="<?= base_url("/classificacao")?>" class="btn btn-light">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
            <div class="w-100 clearfix">
                <span class="text-center text-sm-left d-md-inline-block">Copyright © <?= date('Y');?> ThemeKit v2.0. All Rights Reserved.</span>
                <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Customizado por <a href="javascript:void()" class="text-dark">Marcelo Mesquita</a> <i class="fas fa-code text-dark"></i></span>
            </div>
    </footer>
