<?php
require('../../../myb4g-connect.php');
require('../library.php');
class WeighIn{
  public $connection;
  public $db_name;
  public $table_name;
  public $id;
  public $competitor_id;
  public $team_id;
  public $week_id;
  public $begin;
  public $previous;
  public $current;
  public $notes;
  public $results = array();
  public $wl;
  public $wlp;
  public $owl;
  public $owlp;
  public $data;
  public $json;

  public function __construct($params){
    $this->set_params($params);
    $this->create_weigh_ins_table();
    $this->insert_weigh_in_data();
    $this->compute_weigh_in_results();
    $this->create_results_table();
    $this->insert_weigh_in_results();
  }

  // SET PARAMS *************************
  public function set_params($params){
    $this->connection     = $params['connection'];
    $this->db_name        = $params['db_name'];
    $this->table_name     = $params['table_name'];
    $this->id             = $params['id'];
    $this->competitor_id  = $params['competitor_id'];
    $this->team_id        = $params['team_id'];
    $this->week_id        = $params['week_id'];
    $this->begin          = $params['begin'];
    $this->previous       = $params['previous'];
    $this->current        = $params['current'];
    $this->notes          = $params['notes'];
  }

  // CREATE WEIGH-INS TABLE *************************
  public function create_weigh_ins_table(){
    $sql = $this->get_create_table_query();
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo("[ -CREATE WEIGH-INS TABLE- ] --- There has been an ERROR!!!");}
  }

  // INSERT WEIGH IN DATA ****************************************************

  public function insert_weigh_in_data(){
    $this->create_weigh_ins_table();
    $sql = $this->get_insert_query();
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo("[ -INSERT WEIGH-INS- ] --- There has been an ERROR!!!");}
  }

  // *** COMPUTE WEIGH-IN RESULTS **********************************************

  public function compute_weigh_in_results(){
    $this->results['weight_loss']                 = $this->get_weight_loss();
    $this->results['weight_loss_percent']         = $this->get_weight_loss_percent();
    $this->results['overall_weight_loss']         = $this->get_overall_weight_loss();
    $this->results['overall_weight_loss_percent'] = $this->get_overall_weight_loss_percent();
  }

  //**** CREATE RESULTS TABLE **************************************************

  public function create_results_table(){
    $sql = $this->get_create_results_table_query();
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo(' -CREATE RESULTS TABLE- | ***** ERROR *****');}
  }

  //***** INSERT WEIGH-IN RESULTS **********************************************

  public function insert_weigh_in_results(){
    $this->create_results_table();
    $sql = $this->get_insert_results_query();
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo("[ -INSERT RESULTS- ] --- There has been an ERROR!!!");}
  }

// ***************************************************************************    
  public function get_create_table_query(){
    return $sql = "CREATE TABLE IF NOT EXISTS `mybod4god`.`weigh_ins` (
      `wi_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
      `wi_competitor_id` INT UNSIGNED NOT NULL ,
      `wi_team_id` INT UNSIGNED NOT NULL ,
      `wi_begin` DECIMAL(4,1) NOT NULL ,
      `wi_previous` DECIMAL(4,1) NOT NULL ,
      `wi_current` DECIMAL(4,1) NOT NULL ,
      `wi_week_id` INT UNSIGNED NOT NULL ,
      `wi_notes` TEXT NOT NULL ,
      `wi_date_entered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
      UNIQUE( `wi_competitor_id`, `wi_week_id`),
      PRIMARY KEY (`wi_id`)
    ) ENGINE = InnoDB;
    ";
  }

  public function get_insert_query(){
    return $sql = "INSERT INTO `weigh_ins` (
      `wi_id`,
      `wi_competitor_id`,
      `wi_team_id`,
      `wi_begin`,
      `wi_previous`,
      `wi_current`,
      `wi_week_id`,
      `wi_notes`,
      `wi_date_entered`
    ) VALUES (
      NULL,
      '$this->competitor_id',
      '$this->team_id',
      '$this->begin',
      '$this->previous',
      '$this->current',
      '$this->week_id',
      '$this->notes',
      CURRENT_TIMESTAMP
    );";
  }

  public function get_weight_loss(){
    return $this->wl = number_format($this->previous - $this->current, 1);
  }
  public function get_weight_loss_percent(){
    return $this->wlp = number_format(($this->get_weight_loss() / $this->previous) * 100, 6);;
  }
  public function get_overall_weight_loss(){
    return $this->owl = number_format($this->begin - $this->current, 1);
  }
  public function get_overall_weight_loss_percent(){
    return $this->owlp = number_format(($this->get_overall_weight_loss() / $this->begin) * 100, 6);
  }

  public function get_create_results_table_query(){
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

  public function get_insert_results_query(){
    return $sql = "INSERT INTO `results` (
      `result_id`,
      `result_competitor_id`,
      `result_team_id`,
      `result_week_id`,
      `result_weight_loss`,
      `result_weight_loss_pct`,
      `result_overall_weight_loss`,
      `result_overall_weight_loss_pct`,
      `result_date_entered`
    ) VALUES (
      NULL,
      '$this->competitor_id',
      '$this->team_id',
      '$this->week_id',
      '$this->wl',
      '$this->wlp',
      '$this->owl',
      '$this->owlp',
      CURRENT_TIMESTAMP
    );";
  }

}
  // ********************** FOR TESTING PURPOSES *********************************
//***** CREATE *****

  $db_name        = 'mybod4god';
  $table_name     = 'weigh_ins';
  $id             = null;
  $competitor_id  = '8';
  $team_id        = '1';
  $begin          = '192.2';
  $previous       = '185.8';
  $current        = '172.5';
  $week_id        = '1';
  $notes          = 'This is the LATEST iteration of the WeighIn model';

  $params = array(
    'connection'      =>    $connection,
    'db_name'         =>    $db_name,
    'table_name'      =>    $table_name,
    'id'              =>    $id,
    'competitor_id'   =>    $competitor_id,
    'team_id'         =>    $team_id,
    'week_id'         =>    $week_id,
    'begin'           =>    $begin,
    'previous'        =>    $previous,
    'current'         =>    $current,
    'notes'           =>    $notes

  );

  $weigh_in = new WeighIn($params);
  prewrap($weigh_in);

  // ***** READ ******* GET Data - Array | JSON *****
  // $data = $weigh_in->get_weigh_ins();
  // prewrap($data);
  // echo($weigh_in->json);

// $id = 2;
// $week = 1;
// $data = $weigh_in->get_weigh_ins_team_week($id, $week);
// prewrap($data[0]['begin']);


  // $data = $weigh_in->select_weigh_in(2);
  // prewrap($data);
  // echo($weigh_in->json);

// $sql_select_weigh_ins = "SELECT * FROM `weigh_ins` WHERE wi_week_id='$week'";

  // ***** UPDATE *****
  // $id             = null;
  // $competitor_id  = '1';
  // $team_id        = '1';
  // $begin          = '232.2';
  // $previous       = '227.8';
  // $current        = '224.5';
  // $week_id        = '1';
  // $notes          = 'This is the LATEST iteration of the WeighIn model';
  //
  // $update_params = array(
  //   'id'              =>    $id,
  //   'competitor_id'   =>    $competitor_id,
  //   'team_id'         =>    $team_id,
  //   'begin'           =>    $begin,
  //   'previous'        =>    $previous,
  //   'current'         =>    $current,
  //   'week_id'         =>    $week_id,
  //   'notes'           =>    $notes
  // );
  //
  // $data = $weigh_in->select_weigh_in(1);
  // prewrap($data);
  //   echo('ID: '.$data[0]['id'].'<br>');
  //   echo('Competitor ID: '.$data[0]['competitor_id'].'<br>');
  //   echo('Team ID: '.$data[0]['team_id'].'<br>');
  //   echo('Beginning Weight: '.$data[0]['begin'].'<br>');
  //   echo('Previous Weight: '.$data[0]['previous'].'<br>');
  //   echo('Current Weight: '.$data[0]['current'].'<br>');
  //   echo('Week ID: '.$data[0]['week_id'].'<br>');
  //   echo('Notes: '.$data[0]['notes'].'<br>');
  //   echo('Date Entered: '.$data[0]['date_entered'].'<br>');

  // ***** DELETE *****
  // $weigh_in->delete_weigh_in(4);
  // $weigh_in->delete_weigh_in(7);

  ?>
