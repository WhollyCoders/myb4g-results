<?php
require('../../../myb4g-connect.php');
require('../library.php');
class UpdateWeighIn{
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

  public function __construct($params){
    $this->set_params($params);
    $this->update_weigh_in();
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

  // UPDATE WEIGH IN ************************************************************

  public function update_weigh_in(){
    $sql      = $this->get_update_query();
    prewrap($sql);
    $result = mysqli_query($this->connection, $sql);
    if(!$result){echo("[ -UPDATE WEIGH-IN- ] --- There has been an ERROR!!!");}
  }

  // ***********************************************************
  public function get_update_query(){
    return $sql = "UPDATE `weigh_ins` SET `wi_competitor_id`='$this->competitor_id',
    `wi_team_id`='$this->team_id',
    `wi_week_id`='$this->week_id',
    `wi_begin`='$this->begin',
    `wi_previous`='$this->previous',
    `wi_current`='$this->current',
    `wi_notes`='$this->notes'
    WHERE `wi_id`='$this->id';";
  }

}
//************** FOR TESTING PURPOSES *****************************************
//***** UPDATE WEIGH-IN *****
  //
  // $db_name        = 'mybod4god';
  // $table_name     = 'weigh_ins';
  // $id             = '10';
  // $competitor_id  = '8';
  // $team_id        = '1';
  // $begin          = '200.2';
  // $previous       = '185.8';
  // $current        = '172.5';
  // $week_id        = '1';
  // $notes          = 'This is the LATEST iteration of the WeighIn model';
  //
  // $params = array(
  //   'connection'      =>    $connection,
  //   'db_name'         =>    $db_name,
  //   'table_name'      =>    $table_name,
  //   'id'              =>    $id,
  //   'competitor_id'   =>    $competitor_id,
  //   'team_id'         =>    $team_id,
  //   'week_id'         =>    $week_id,
  //   'begin'           =>    $begin,
  //   'previous'        =>    $previous,
  //   'current'         =>    $current,
  //   'notes'           =>    $notes
  //
  // );
  //
  // $update = new UpdateWeighIn($params);
  // prewrap($update);

 ?>
