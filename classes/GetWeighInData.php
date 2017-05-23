<?php
require('../../../myb4g-connect.php');
require('../library.php');
class GetWeighInData{
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
    public $data;
    public $json;

    public function __construct($connection){
      $this->connection = $connection;
    }

    public function get_weigh_ins(){
      $sql = "SELECT * FROM weigh_ins;";
      prewrap($sql);
      $result = mysqli_query($this->connection, $sql);
      if(!$result){echo('[ -GET WEIGH-IN DATA- | ARRAY] --- There has been an ERROR!!!');}
      $this->begin    = 0;
      $this->previous = 0;
      $this->current  = 0;
      $this->data = array();
      while($row = mysqli_fetch_assoc($result)){
        $this->data[] = array(
          'id'              =>    $row['wi_id'],
          'competitor_id'   =>    $row['wi_competitor_id'],
          'team_id'         =>    $row['wi_team_id'],
          'begin'           =>    $row['wi_begin'],
          'previous'        =>    $row['wi_previous'],
          'current'         =>    $row['wi_current'],
          'week_id'         =>    $row['wi_week_id'],
          'notes'           =>    $row['wi_notes'],
          'date_entered'    =>    $row['wi_date_entered']
        );
        $this->begin    += $row['wi_begin'];
        $this->previous += $row['wi_previous'];
        $this->current  += $row['wi_current'];
      }
      $this->json = json_encode($this->data);
      return $this->data;
    }

}

$weigh_in = new GetWeighInData($connection);
$weigh_in->get_weigh_ins();
prewrap($weigh_in);




  // GETTERS *******************************************************************
  // ********************** GET WEIGHT LOSS DATA *******************************
//   public function get_wl_data_competition($week_id){
//     $sql = "SELECT * FROM `".$this->get_table_name()."` WHERE wi_week_id = $week_id;";
//     // prewrap($sql);
//     $result = mysqli_query($this->connection, $sql);
//     if(!$result){echo('[ GET COMPETITION WEIGH_IN DATA | ARRAY ] --- There has been an ERROR!!!');}
//     $this->begin    = 0;
//     $this->previous = 0;
//     $this->current  = 0;
//     $this->data = array();
//     while($row = mysqli_fetch_assoc($result)){
//       $this->data[] = array(
//         'id'              =>    $row['wi_id'],
//         'competitor_id'   =>    $row['wi_competitor_id'],
//         'team_id'         =>    $row['wi_team_id'],
//         'begin'           =>    $row['wi_begin'],
//         'previous'        =>    $row['wi_previous'],
//         'current'         =>    $row['wi_current'],
//         'week_id'         =>    $row['wi_week_id'],
//         'notes'           =>    $row['wi_notes'],
//         'date_entered'    =>    $row['wi_date_entered']
//       );
//
//       $begin    = $row['wi_begin'];
//       $previous = $row['wi_previous'];
//       $current  = $row['wi_current'];
//
//
//
//       $compute_data = array(
//         'begin'      =>    $begin,
//         'previous'   =>    $previous,
//         'current'    =>    $current
//       );
//
//       $compute = new Compute($compute_data);
//       prewrap($compute);
//
//       $result_data  = array(
//         'competitor_id'             =>    $row['wi_competitor_id'],
//         'week_id'                   =>    $row['wi_week_id'],
//         'weight_loss'               =>    $compute->results['weight_loss'],
//         'weight_loss_pct'           =>    $compute->results['weight_loss_percent'],
//         'overall_weight_loss'       =>    $compute->results['overall_weight_loss'],
//         'overall_weight_loss_pct'   =>    $compute->results['overall_weight_loss_percent'],
//         'team_id'                   =>    $row['wi_team_id'],
//       );
//
//       $result = new Result($result_data);
//
//       $this->begin    += $row['wi_begin'];
//       $this->previous += $row['wi_previous'];
//       $this->current  += $row['wi_current'];
//     }
//     $this->json = json_encode($this->data);
//     return $this->data;
//   }
//   ///////////////////////////////////////////////////////////////
//   public function get_wl_data_team($week_id, $team_id){
//     $sql = "SELECT * FROM weigh_ins WHERE wi_week_id=$week_id AND wi_team_id=$team_id;";
//     // prewrap($sql);
//     $this->result = mysqli_query($this->connection, $sql);
//     if(!$this->result){echo('[GET TEAM WEIGH-IN DATA | ARRAY] --- There has been an ERROR!!!');}
//     $this->data = array();
//     while($row = mysqli_fetch_assoc($this->result)){
//       $this->data[] = array(
//         'id'              =>    $row['wi_id'],
//         'competitor_id'   =>    $row['wi_competitor_id'],
//         'team_id'         =>    $row['wi_team_id'],
//         'begin'           =>    $row['wi_begin'],
//         'previous'        =>    $row['wi_previous'],
//         'current'         =>    $row['wi_current'],
//         'week_id'         =>    $row['wi_week_id'],
//         'notes'           =>    $row['wi_notes'],
//         'date_entered'    =>    $row['wi_date_entered']
//       );
//     }
//     $this->json = json_encode($this->data);
//     // prewrap($this->data);
//     return $this->data;
//   }
//
//   ///////////////////////////////////////////////////////////////////
//       public function get_db_name(){
//         return $this->db_name;
//       }
//       public function get_table_name(){
//         return $this->table_name;
//       }
//
//
//
//       public function get_weigh_ins_team($id){
//         $sql = "SELECT * FROM weigh_ins WHERE wi_team_id=$id;";
//         // prewrap($sql);
//         $this->result = mysqli_query($this->connection, $sql);
//         if(!$this->result){echo('[GET TEAM WEIGH-IN DATA | ARRAY] --- There has been an ERROR!!!');}
//         $this->data = array();
//         while($row = mysqli_fetch_assoc($this->result)){
//           $this->data[] = array(
//             'id'              =>    $row['wi_id'],
//             'competitor_id'   =>    $row['wi_competitor_id'],
//             'team_id'         =>    $row['wi_team_id'],
//             'begin'           =>    $row['wi_begin'],
//             'previous'        =>    $row['wi_previous'],
//             'current'         =>    $row['wi_current'],
//             'week_id'         =>    $row['wi_week_id'],
//             'notes'           =>    $row['wi_notes'],
//             'date_entered'    =>    $row['wi_date_entered']
//           );
//         }
//         $this->json = json_encode($this->data);
//         // prewrap($this->data);
//         return $this->data;
//       }
//
//       public function get_weigh_ins_team_week($id, $week){
//         $sql = "SELECT * FROM weigh_ins WHERE wi_team_id=$id AND wi_week_id=$week;";
//         // prewrap($sql);
//         $this->result = mysqli_query($this->connection, $sql);
//         if(!$this->result){echo('[GET TEAM WEIGH-IN DATA | ARRAY] --- There has been an ERROR!!!');}
//         $this->data = array();
//         while($row = mysqli_fetch_assoc($this->result)){
//           $this->data[] = array(
//             'id'              =>    $row['wi_id'],
//             'competitor_id'   =>    $row['wi_competitor_id'],
//             'team_id'         =>    $row['wi_team_id'],
//             'begin'           =>    $row['wi_begin'],
//             'previous'        =>    $row['wi_previous'],
//             'current'         =>    $row['wi_current'],
//             'week_id'         =>    $row['wi_week_id'],
//             'notes'           =>    $row['wi_notes'],
//             'date_entered'    =>    $row['wi_date_entered']
//           );
//         }
//         $this->json = json_encode($this->data);
//         // prewrap($this->data);
//         return $this->data;
//       }
//
//       public function select_weigh_in($week_id){
//         $sql = "SELECT * FROM `".$this->get_table_name()."` WHERE wi_week_id = $week_id;";
//         // prewrap($sql);
//         $result = mysqli_query($this->connection, $sql);
//         if(!$result){echo('[ GET ONE WEEK WEIGH_IN DATA | ARRAY ] --- There has been an ERROR!!!');}
//         $this->data = array();
//         while($row = mysqli_fetch_assoc($result)){
//           $this->data[] = array(
//             'id'              =>    $row['wi_id'],
//             'competitor_id'   =>    $row['wi_competitor_id'],
//             'team_id'         =>    $row['wi_team_id'],
//             'begin'           =>    $row['wi_begin'],
//             'previous'        =>    $row['wi_previous'],
//             'current'         =>    $row['wi_current'],
//             'week_id'         =>    $row['wi_week_id'],
//             'notes'           =>    $row['wi_notes'],
//             'date_entered'    =>    $row['wi_date_entered']
//           );
//         }
//         $this->json = json_encode($this->data);
//         return $this->data;
//       }
//
//       public function select_one_weigh_in($id){
//         $sql = "SELECT * FROM `".$this->get_table_name()."` WHERE wi_id = $id;";
//         // prewrap($sql);
//         $result = mysqli_query($this->connection, $sql);
//         if(!$result){echo('[ GET ONE COMPETITOR WEIGH_IN DATA | ARRAY ] --- There has been an ERROR!!!');}
//         $num_rows = mysqli_num_rows($result);
//         if($num_rows > 1){echo('[ GET ONE COMPETITOR WEIGH_IN DATA | ARRAY ] --- Check Weigh-In Data... There may be a DUPLICATE Weigh-In!!!');}
//         $this->data = array();
//         while($row = mysqli_fetch_assoc($result)){
//           $this->data[] = array(
//             'id'              =>    $row['wi_id'],
//             'competitor_id'   =>    $row['wi_competitor_id'],
//             'team_id'         =>    $row['wi_team_id'],
//             'begin'           =>    $row['wi_begin'],
//             'previous'        =>    $row['wi_previous'],
//             'current'         =>    $row['wi_current'],
//             'week_id'         =>    $row['wi_week_id'],
//             'notes'           =>    $row['wi_notes'],
//             'date_entered'    =>    $row['wi_date_entered']
//           );
//         }
//
//         $this->json = json_encode($this->data);
//         return $this->data;
//       }
//
//       public function delete_weigh_in($id){
//         $sql = "DELETE FROM `".$this->get_table_name()."` WHERE wi_id = $id;";
//         // prewrap($query);
//         $result = mysqli_query($this->connection, $sql);
//         return $result;
//       }
//   // ************************* SETTERS *****************************************
//       public function set_result_mod($module){
//         $this->result_mod = $module;
//       }
//
//       public function set_id($id){
//         $this->id = $id;
//       }
//
//       public function set_competitor_id($competitor_id){
//         $this->competitor_id = $competitor_id;
//       }
//
//       public function set_team_id($team_id){
//         $this->team_id = $team_id;
//       }
//
//       public function set_begin($begin){
//         $this->begin = $begin;
//       }
//
//       public function set_previous($previous){
//         $this->$previous = $previous;
//       }
//
//       public function set_current($current){
//         $this->$current = $current;
//       }
//       public function set_week_id($week_id){
//         $this->$week_id = $week_id;
//       }
//
//       public function set_notes($notes){
//         $this->$notes = $notes;
//       }
//
//
//
// }


 ?>
