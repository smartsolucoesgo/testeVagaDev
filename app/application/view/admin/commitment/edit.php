<?php
$title = '';
$css = [
    'assets/admin/css/plugins/jasny/jasny-bootstrap.min.css',
    'assets/admin/css/plugins/select2/select2.min.css',
];
$script = [
    'assets/admin/js/plugins/jasny/jasny-bootstrap.min.js',
    'assets/admin/js/plugins/parsley/parsley.min.js',
    'assets/admin/js/plugins/parsley/i18n/pt-br.js',
    'assets/admin/js/plugins/maskedinput/jquery.maskedinput.min.js',
    'assets/admin/js/plugins/select2/select2.full.min.js',
];
require APP . 'view/admin/_templates/initFile.php';
?>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-md-12">
            <i class="fa fa-users fa-3x pull-right icon-heading"></i>
            <h2>Agenda</h2>
        </div>
    </div>

    <div class="col-md-12 m-t-md">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= isset($response['title_commitment']) ? 'Agenda: ' . $response['title_commitment'] : 'Novo compromisso' ?></h5>
            </div>
            <div class="ibox-content">

                <form role="form" method="post" action="<?= isset($response['id']) ? URL_ADMIN . '/agenda/salvar' : URL_ADMIN . '/agenda/cadastrar' ?>" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Data inicial <?= isset($response['date_commitment']) ? date("Y-m-d\TH:i", strtotime($response['date_commitment'])) : '' ?></label>
                                        <input type="datetime-local" name="date_commitment" placeholder="" class="form-control telefone" value="<?= isset($response['date_commitment']) ? date("Y-m-d\TH:i", strtotime($response['date_commitment'])) : '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Data final <?= isset($response['date_commitment_end']) ? date("Y-m-d\TH:i", strtotime($response['date_commitment_end'])) : '' ?></label>
                                        <input type="datetime-local" name="date_commitment_end" placeholder="" class="form-control telefone" value="<?= isset($response['date_commitment_end']) ? date("Y-m-d\TH:i", strtotime($response['date_commitment_end'])) : '' ?>">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Titulo da tarefa</label>
                                        <input type="text" name="title_commitment" placeholder="" class="form-control" value="<?= isset($response['title_commitment']) ? $response['title_commitment'] : '' ?>" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Descrição da tarefa</label>
                                        <input name="description_commitment" value="<?= isset($response['description_commitment']) ? trim($response['description_commitment']) : '' ?>" class="form-control p-5" required>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="hr-line-dashed m-t-sm"></div>
                            <div class="form-group m-b-n-sm">
                                <input type="hidden" name="id" value="<?= isset($response['id']) ? $response['id'] : '' ?>">
                                <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
                                <input type="hidden" name="id_update_user" value="<?= $_SESSION['id_user'] ?>">
                                <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Salvar</strong></button>
                                <a href="javascript:history.back()" class="btn btn-default m-t-n-xs"><strong>Voltar</strong></a>
                            </div>
                        </div>

                    </div>

                </form>

                <div class="clearfix"></div>

            </div>
        </div>
    </div>

<?php
require APP . 'view/admin/_templates/endFile.php';
?>
