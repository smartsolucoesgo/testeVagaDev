<?php

namespace SmartSolucoes\Model;

use DateTime;
use SmartSolucoes\Core\Model;
use SmartSolucoes\Libs\Helper;

class Commitment extends Model
{

  public function showCommitment($table, $order_by)
  {
    $sql = "
          SELECT * FROM {$table} 
          WHERE id_user = {$_SESSION['id_user']} ORDER BY {$order_by}
        ";
    $query = $this->PDO()->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }
  
  public function listEventCalendar()
  {
    $id_user = $_SESSION['id_user'];

    $query_events = "SELECT * FROM commitment 
                      WHERE id_user = {$_SESSION['id_user']}";
    $resultado_events = $this->PDO()->prepare($query_events);
    $resultado_events->execute();

    $eventos = [];

    while ($row_events = $resultado_events->fetch(\PDO::FETCH_ASSOC)) {

      $date = new DateTime($row_events['date_commitment']);
      $date_end = new DateTime($row_events['date_commitment_end']);
      $date__ = new DateTime($row_events['date_commitment_end']);

      $id = $row_events['id'];
      $user_id = $row_events['id_user'];
      $title = $row_events['title_commitment'];
      $description = $row_events['description_commitment'];
      $url = @$row_events['url'] ? '******' : '';
      $color = @$row_events['color'] ? '#fff' : '';
      $start = $date->format('Y-m-d H:m:s');
      $end = $date_end->format('Y-m-d H:m:s');
      $date__ = $date__->format('Y-m-d H:m:s');

      $eventos[] = [
        'id' => $id,
        'title' => $title,
        'description' => $description,
        'url' => $url,
        'color' => $color,
        'start' => $start,
        'end' => $end,
        'user_id' => $user_id,
        'date__' => $date__
      ];
    }
    return json_encode($eventos);
  }

}
