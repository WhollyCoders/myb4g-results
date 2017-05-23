<?php
if(isset($_GET['week_end'])){
  $week_end = $_GET['week_end'];
  require('../../myb4g-connect.php');
  require('./library.php');
  require('./classes/GetWeekEnd.php');
  require('./classes/Team.php');
  require('./classes/WeighIn.php');
  require('./classes/Compute.php');
  require('./classes/Result.php');
// ***** GET WEEK END DATA ********
  $week     = new GetWeekEnd($week_end);

// ***** INSTANTIATE TEAM OBJECT *********
  $team     = new Team($connection);
// ***** INSTANTIATE RESULT OBJECT *********
  $res_data = new Result();
  // ***** INSTANTIATE WEIGH-IN OBJECT *********
    $weigh_in = new WeighIn($connection, $res_data);
// ***** GET WEIGHT LOSS DATA FOR THE CURRENT WEEK **********
  $weigh_in->get_wl_data_competition($week_end);
  $result   = $weigh_in->data;
  // prewrap($weigh_in);
    // prewrap($result);
  // $competition_sum = array(
  //   'begin'     =>    $weigh_in->begin,
  //   'previous'  =>    $weigh_in->previous,
  //   'current'   =>    $weigh_in->current
  // );

// ***** INSTANTIATE COMPUTE OBJECT *********
  $res                      = new Compute($competition_sum);
// ***** SET WEIGHT LOSS DATA VARIABLES *******
  $weight_loss              = $res->results['weight_loss'];
  $weight_loss_pct          = $res->results['weight_loss_percent'];
  $overall_weight_loss      = $res->results['overall_weight_loss'];
  $overall_weight_loss_pct  = $res->results['overall_weight_loss_percent'];

// ******* GET ALL TEAMS *********
  $teams = $team->get_teams();

}else{

}
?>
<header>
  <img src="./images/l2l.jpg" alt="Losing to Live - Logo">
</header>
<section>
  <div class="section-header">
    <h1>Weekly Statistics From Week Ending <strong><?php echo($week->week_end); ?></strong></h1>
    <h2>Our total weight loss from last week is <strong><?php echo($weight_loss); ?></strong> pounds!!!</h2>
    <h2>Our overall total weight loss for the competition is <strong><?php echo($overall_weight_loss); ?></strong> pounds</h2>
  </div>
  <hr>
  <h2>Team Names</h2>
  <table id="table-team-names" class="table">
    <tr>
      <th>Team ID</th>
      <th>Team Name</th>
      <th>Team Leader</th>
    </tr>
<?php foreach ($teams as $team) { ?>
  <tr>
    <td><?php echo($team['team_id']); ?></td>
    <td><?php echo($team['team_name']); ?></td>
    <td><?php echo($team['team_leader']); ?></td>
  </tr>
<?php } ?>
  </table>
  <h3>Weekly Individual Weight Loss</h3>
  <ol>
    <?php foreach ($results as $result) { ?>
      <li><?php echo($competitor); ?> - <?php echo($team); ?> (<?php echo($weight_loss); ?> LBS) <?php echo($weight_loss_pct); ?>%</li>
    <?php } ?>
  </ol>
  <h3>Overall Individual Weight Loss</h3>
  <ol>
    <li>Competitor #1 - Squash Smashers (-1.6 LBS) -0.6639%</li>
    <li>Competitor #2 - Squash Smashers (-1.6 LBS) -0.6639%</li>
    <li>Competitor #3 - Squash Smashers (-1.6 LBS) -0.6639%</li>
  </ol>
  <h3>Weekly Team Weight Loss</h3>
  <ol>
    <li>Competitor #1 - Squash Smashers (-1.6 LBS) -0.6639%</li>
    <li>Competitor #2 - Squash Smashers (-1.6 LBS) -0.6639%</li>
    <li>Competitor #3 - Squash Smashers (-1.6 LBS) -0.6639%</li>
  </ol>
  <h3>Overall Team Weight Loss</h3>
  <ol>
    <li>Competitor #1 - Squash Smashers (-1.6 LBS) -0.6639%</li>
    <li>Competitor #2 - Squash Smashers (-1.6 LBS) -0.6639%</li>
    <li>Competitor #3 - Squash Smashers (-1.6 LBS) -0.6639%</li>
  </ol>
  <h1>Overall Biggest Loser: Joseph Blowe (-13.6 LBS) -6.1818%</h1>
  <h3>Most Raw Pounds Lost</h3>
  <ol>
    <li>Competitor #1 - (-1.6 LBS)</li>
    <li>Competitor #2 - (-1.6 LBS)</li>
    <li>Competitor #3 - (-1.6 LBS)</li>
  </ol>
  <table class="table">
    <tr>
      <th>Place</th>
      <th>Team Name</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Raw LBS</th>
      <th>% Loss</th>
    </tr>
    <tr>
      <td>1</td>
      <td>Squash Smashers</td>
      <td>Joseph</td>
      <td>Blowe</td>
      <td>-13.6</td>
      <td>6.1818</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Squash Smashers</td>
      <td>Joseph</td>
      <td>Blowe</td>
      <td>-13.6</td>
      <td>6.1818</td>
    </tr>
    <tr>
      <td>3</td>
      <td>Squash Smashers</td>
      <td>Joseph</td>
      <td>Blowe</td>
      <td>-13.6</td>
      <td>6.1818</td>
    </tr>
    <tr>
      <td>4</td>
      <td>Squash Smashers</td>
      <td>Joseph</td>
      <td>Blowe</td>
      <td>-13.6</td>
      <td>6.1818</td>
    </tr>
    <tr>
      <td>5</td>
      <td>Squash Smashers</td>
      <td>Joseph</td>
      <td>Blowe</td>
      <td>-13.6</td>
      <td>6.1818</td>
    </tr>
    <tr>
      <td>6</td>
      <td>Squash Smashers</td>
      <td>Joseph</td>
      <td>Blowe</td>
      <td>-13.6</td>
      <td>6.1818</td>
    </tr>
    <tr>
      <td>7</td>
      <td>Squash Smashers</td>
      <td>Joseph</td>
      <td>Blowe</td>
      <td>-13.6</td>
      <td>6.1818</td>
    </tr>
    <tr>
      <td>8</td>
      <td>Squash Smashers</td>
      <td>Joseph</td>
      <td>Blowe</td>
      <td>-13.6</td>
      <td>6.1818</td>
    </tr>
    <tr>
      <td>9</td>
      <td>Squash Smashers</td>
      <td>Joseph</td>
      <td>Blowe</td>
      <td>-13.6</td>
      <td>6.1818</td>
    </tr>
    <tr>
      <td>10</td>
      <td>Squash Smashers</td>
      <td>Joseph</td>
      <td>Blowe</td>
      <td>-13.6</td>
      <td>6.1818</td>
    </tr>
  </table>
  <hr>
  <div class="b4g-assignment">
    <h2>Weekly Assignment</h2>
    <h3>Your reading assignment for March 23rd is:</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
      incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
      exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
  </div>
  <div class="b4g-weigh-in">
    <h2>Weigh-In Procedure</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
      incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
      exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
  </div>
  <div class="b4g-notes">
    <h2>Notes To Remember</h2>
    <ul>
      <li>Note #1</li>
      <li>Note #2</li>
      <li>Note #3</li>
      <li>Note #4</li>
    </ul>
  </div>
</section>
