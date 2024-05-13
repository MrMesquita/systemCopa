<style>
    @media (max-width: 567px){
        #DataTables_Table_0_wrapper > .row:nth-of-type(2) > .col-sm-12{
            overflow-x: auto !important; 
        }
    }
</style>
<?php $this->load->view('layout/navbar'); ?>

<div class="page-wrap">

    <?php $this->load->view('layout/sidebar'); ?>


        <div class="main-content">
        <div class="page-header">
                <div id="header-classificacao" class="row align-items-end">
                    <div class="col-sm-8">
                        <div class="page-header-title">
                            <i class="<?= $icon_view ?>"></i>
                            <div class="d-inline">
                                <h5><?= $titulo ?></h5>
                                <span><?= $sub_titulo ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a title='Home' href="<?= base_url('/') ?>"><i class="ik ik-home"></i></a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong><?= $_SESSION['success'] ?></strong>
                            <button type="button" class="close" data-dimiss="alert" aria-label="Close">
                                <i class="ik ik-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php 
                unset($_SESSION['success']);
            endif; 
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table data_table col-sm">
                                    <thead>
                                        <tr>
                                            <th>Times</th>
                                            <th>Pts</th>
                                            <th>Jogos</th>
                                            <th>V</th>
                                            <th>E</th>
                                            <th>D</th>
                                            <th>GP</th>
                                            <th>GC</th>
                                            <th>SG</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($classificacoes as $classificacao) : 
                                        $time = $this->core_model->get_by_id('times', array('id' => $classificacao->time_id));
                                        $copa = $this->core_model->get_by_id('copas', array('id' => $classificacao->copa_id));    
                                        ?>
                                            
                                            <tr>
                                                <td><?= $time->nome_time?></td>
                                                <td><?= $classificacao->pts; ?></td>
                                                <td><?= $classificacao->jogo; ?></td>
                                                <td><?= $classificacao->vitoria; ?></td>
                                                <td><?= $classificacao->empate; ?></td>
                                                <td><?= $classificacao->derrota; ?></td>
                                                <td><?= $classificacao->gol_marcado; ?></td>
                                                <td><?= $classificacao->gol_contra; ?></td>
                                                <td><?= $classificacao->saldo_gol; ?></td>
                                            </tr>
                                        <?php endforeach;?>
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
                <span class="text-center text-sm-left d-md-inline-block">Copyright © <?= date('Y');?> ThemeKit v2.0. All Rights Reserved.</span>
                <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Customizado por <a href="javascript:void()" class="text-dark">Marcelo Mesquita</a> <i class="fas fa-code text-dark"></i></span>
            </div>
        </footer>
        
    </div>
