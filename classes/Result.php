<?php
require('../../../myb4g-connect.php');
require('../library.php');
require('./WeighIn.php');
class Result extends WeighIn{
  public $weight_loss;
  public $weight_loss_pct;
  public $overall_weight_loss;
  public $overall_weight_loss_pct;
  public $result;

  public function __construct($connection){
    $this->connection                  = $connection;
    // $this->competitor_id            = $data['competitor_id'];
    // $this->week_id                  = $data['week_id'];
    // $this->weight_loss              = $data['weight_loss'];
    // $this->weight_loss_pct          = $data['weight_loss_pct'];
    // $this->overall_weight_loss      = $data['overall_weight_loss'];
    // $this->overall_weight_loss_pct  = $data['overall_weight_loss_pct'];
    // $this->team_id                  = $data['team_id'];
    $this->create_table();
    // $this->post_result();
  }
  public function get_create_table_query(){
      return $sql = "CREATE TABLE IF NOT EXISTS `mybod4god`.`results` (
       `result_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
       `result_competitor_id` INT UNSIGNED NOT NULL ,
       `result_week_id` INT UNSIGNED NOT NULL ,
       `result_weight_loss` DECIMAL(4,1) NOT NULL ,
       `result_weight_loss_pct` DECIMAL(8,6) NOT NULL ,
       `result_overall_weight_loss` DECIMAL(4,1) NOT NULL ,
       `result_overall_weight_loss_pct` DECIMAL(8,6) NOT NULL ,
       `result_team_id` INT UNSIGNED NOT NULL ,
       `result_date_entered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
       UNIQUE( `result_competitor_id`, `result_week_id`),
       PRIMARY KEY (`result_id`)
       ) ENGINE = InnoDB;";
  }
  public function create_table(){
    $sql = $this->get_create_table_query();
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo(' -CREATE RESULTS TABLE- | ***** ERROR *****');}
  }

  public function get_insert_query(){
    return $sql = "INSERT INTO `results` (
              `result_id`,
              `result_competitor_id`,
              `result_week_id`,
              `result_weight_loss`,
              `result_weight_loss_pct`,
              `result_overall_weight_loss`,
              `result_overall_weight_loss_pct`,
              `result_team_id`,
              `result_date_entered`
            ) VALUES (
              NULL,
              '$this->competitor_id',
              '$this->week_id',
              '$this->weight_loss',
              '$this->weight_loss_pct',
              '$this->overall_weight_loss',
              '$this->overall_weight_loss_pct',
              '$this->team_id',
              CURRENT_TIMESTAMP
            );";
  }
  public function insert_result(){
    $sql = $this->get_insert_query();
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo(' -INSERT RESULT- | ***** ERROR *****');}
  }

}

$res = new Result($connection);
prewrap($res);

//   $competitor_id            = 6;
//   $week_id                  = 1;
//   $weight_loss              = 3.5;
//   $weight_loss_pct          = 2.35478;
//   $overall_weight_loss      = 11;
//   $overall_weight_loss_pct  = 3.21456;
//   $team_id                  = 1;
//
// $result_data = array(
//   'connection'                =>    $connection,
//   'competitor_id'             =>    $competitor_id,
//   'week_id'                   =>    $week_id,
//   'weight_loss'               =>    $weight_loss,
//   'weight_loss_pct'           =>    $weight_loss_pct,
//   'overall_weight_loss'       =>    $overall_weight_loss,
//   'overall_weight_loss_pct'   =>    $overall_weight_loss_pct,
//   'team_id'                   =>    $team_id
// );

// $result = new Result($result_data);
// prewrap($result);
 ?>
