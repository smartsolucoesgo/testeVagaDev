<?php
$title = '';
$css = [
    'assets/admin/css/plugins/dataTables/datatables.min.css'
];
$script = [
    'assets/admin/js/plugins/dataTables/datatables.min.js'
];
require APP . 'view/admin/_templates/initFile.php';
?>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.css" rel="stylesheet">

<link href="css/animate.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <i class="fa fa-users fa-3x pull-right icon-heading"></i>
        <h2>Agenda</h2>
    </div>
</div>

<div class="col-md-12 m-t-md">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <a href="<?= URL_ADMIN ?>/agenda/novo" class="btn btn-primary btn-sm">Novo</a>
        </div>
        <div class="ibox-content">
            <div id="calendar"></div>
        </div>
        <div class="ibox-content d-flex justify-content-between" style="display: flex;flex-direction: row; flex-wrap: wrap;align-items: baseline;justify-content: center;">

            <?php foreach ($response as $key => $commitment) {
                $date = new DateTime($commitment['date_commitment']);
                $date1 = new DateTime($commitment['created_at']);
            ?>
                <div class="row col-4" style="margin:10px;align-items: center;width: 40%; background-color: #3a4050;color: white; padding: 10px;">
                    <div class="col-4 border">
                        <div class="card border">
                            <div class="card-body mb-2">
                                <h2 class="card-title"><b><i class="fa fa-arrow-right"></i> <?= $commitment['title_commitment'] ?></b></h2>
                                <p class="card-text"><i class="fa fa-file"></i> <?= $commitment['description_commitment'] ?></p>
                                <h4 class="card-text"><b><i class="fa fa-calendar"></i> <?= $date->format("d/m/Y H:i") ?></b></h4>
                            </div>
                            <div class="mt-3" style="display: flex;justify-content: space-around;align-items: center;">
                                <div>
                                    <small class="text-muted">Criado em: <?= $date1->format("d/m/Y H:i") ?></small>
                                </div>
                                <a href="<?= URL_ADMIN ?>/agenda/editar/<?= $commitment['id'] ?>" id="editar" class="btn btn-sm btn-primary">Editar <i class="fa fa-pen"></i></a>
                                <a href="<?= URL_ADMIN ?>/agenda/remover/<?= $commitment['id'] ?>" id="remover" class="btn btn-sm btn-danger">Deletar <i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
require APP . 'view/admin/_templates/endFile.php';
?>