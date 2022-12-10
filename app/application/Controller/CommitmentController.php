<?php

namespace SmartSolucoes\Controller;

use SmartSolucoes\Model\Commitment;
use SmartSolucoes\Libs\Helper;

class CommitmentController
{

    private $table = 'commitment';
    private $baseView = 'admin/commitment';
    private $urlIndex = 'agenda';

    public function index()
    {
        $model = New Commitment();
        // $response = $model->showCommitment($this->table,'date_commitment DESC');
        $response = $model->listEventCalendar();
        Helper::view($this->baseView.'/index',$response);
    }

    public function viewNew()
    {
        $model = New Commitment();
        $response['commitment'] = $model->all('commitment','id', false, false, 'id');
        Helper::view($this->baseView.'/edit',$response);
    }

    public function viewEdit($param)
    {
        $model = New Commitment();
        
        $response = $model->find($this->table,$param['id']);
        Helper::view($this->baseView.'/edit',$response);
    }

    public function create()
    {
        $model = New Commitment();
        $model->create($this->table,$_POST, ['id', 'acesso', 'id_update_user']);
        $response = $model->all('commitment','id', false, false, 'id');
        // Helper::view($this->baseView.'/index', $response);
        header('location: ' . URL_ADMIN .'/' .$this->urlIndex);
    }

    public function update()
    {
        $model = New Commitment();
        $model->save($this->table,["id"=>$_POST['id'], "title_commitment" => $_POST["title_commitment"], "date_commitment" => $_POST['date_commitment'], "description_commitment"=>$_POST['description_commitment']]);
        header('location: ' . URL_ADMIN .'/' .$this->urlIndex);
    }

    public function delete($param)
    {
        $model = New Commitment();
        $model->delete($this->table,'id', $param['id']);
        header('location: ' . URL_ADMIN .'/' .$this->urlIndex);
    }

}
