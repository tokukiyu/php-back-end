<?php
include "config.php";
include 'nav.php';

?>
<div class="big-title m-0 p-1">
  <h1> dormitory mangement system</h1>

</div>
<div class="col-200">
  <div class="card-container">
    <div class="card1">
      <div class="card11">
        <img src="images/student.png" alt="" wi> <br>
        <a class="nav-link" href="studentInfo.php">

          <?php
          $sql = "SELECT COUNT(Student_id) as student_count from student";
          $res = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($res);
          $student_count = $row['student_count'];
          echo $student_count . " Students ";
          ?>


        </a>
      </div>
      <div class="card11"> <img src="images/database.png" alt="">
        <br>
        <a class="nav-link" href="staff.php">
          <?php
          $sql = "SELECT COUNT(Staff_id) as staff_count from staff";
          $res = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($res);
          $staff_count = $row['staff_count'];
          echo  $staff_count . " Staff Employees ";
          ?>
        </a>
      </div>
      <div class="card11"> <img src="images/dorm.png" alt=""> <br>
        <a class="nav-link" href="roomInfo.php">

          <?php
          $sql = "SELECT COUNT(roomId) as room_count from room";
          $res = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($res);
          $room_count = $row['room_count'];
          echo  $room_count . " Rooms";
          ?>


        </a>
      </div>
      <div class="card11"> <img src="images/block.png" alt="">
        <br>
        <a class="nav-link" href="roomInfo.php">

          <?php
          $sql = "SELECT COUNT(blockId) as block_count from `block`";
          $res = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($res);
          $block_count = $row['block_count'];
          echo  $block_count . " Blocks";
          ?>


        </a>
      </div>
    </div>
    <div class="card2">
      <h1><a href="#">ROOMS</a></h1>

      <?php

      $sql = "SELECT COUNT(roomId) as room_count from room where number_of_bed=6 or `availability`=1";
      $res = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($res);
      $room_count = $row['room_count'];


      $sql1 = "SELECT COUNT(roomId) as room_count from room where number_of_bed<6 or `availability`=0";
      $res1 = mysqli_query($conn, $sql1);
      $row1 = mysqli_fetch_assoc($res1);
      $room_count1 = $row1['room_count'];

      $room_percent = round(($room_count / ($room_count + $room_count1)) * 100);
      $occupied_percent = round(($room_count1 / ($room_count + $room_count1)) * 100);


      ?>
      <h5>free rooms: <?php echo $room_count; ?></h5>
      <div class="progress">
        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $room_percent; ?>%" aria-valuenow="<?php echo $room_percent; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $room_percent; ?>%</div>
      </div>
      <h5>Occupied room: <?php echo $room_count1; ?></h5>
      <div class="progress">
        <div class="progress-bar bg-info text-dark" role="progressbar" style="width: <?php echo $occupied_percent; ?>%" aria-valuenow="<?php echo $occupied_percent; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $occupied_percent; ?>%</div>
      </div>
    </div>
    <div class="card2 justify-content-start">
      <h1><a href="#">STUDENTS</a></h1>
      <div>
        <?php
        global $conn;
        $sql = "SELECT COUNT(Student_id) as student_count from student where sex='Male'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $student_count = $row['student_count'];
        $sql1 = "SELECT COUNT(Student_id) as student_count from student where sex='Female'";
        $res1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($res1);
        $student_count1 = $row1['student_count'];
        $male_percent = round(($student_count / ($student_count + $student_count1)) * 100);
        ?>
        <h5>Male Students: <?php echo $student_count; ?></h5>
        <div class="progress">
          <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $male_percent; ?>%" aria-valuenow="<?php echo $male_percent; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $male_percent; ?>%</div>
        </div>
        <?php
        $female_percent = round(($student_count1 / ($student_count + $student_count1)) * 100);
        ?>
        <h5>Female Students: <?php echo $student_count1; ?></h5>
        <div class="progress">
          <div class="progress-bar bg-info text-dark" role="progressbar" style="width: <?php echo $female_percent; ?>%" aria-valuenow="<?php echo $female_percent; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $female_percent; ?>%</div>
        </div>
      </div> 
    </div>

  </div>
</div>
<div class="container-fluid m-0">


</div>
</div>

<?php
