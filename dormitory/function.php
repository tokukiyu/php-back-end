<?php
session_start();
include "config.php";
function loguot()
{
    session_destroy();
    unset($_SESSION['user_id']);
    header("Location: login.php");
    die;
}
function isLogin()
{
    global $conn;
    if (array_key_exists('staff_id', $_SESSION)) {
        $id = $_SESSION['staff_id'];


        $sql = "SELECT * FROM staff 
            where staff.`role`='admin' or staff.`role`='Admin' 
            and staff_id='$id' limit 1";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            return true;
        }
    } else {
        return false;
    }
}
function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
/*add new job to system here */
function  addJob()
{
    global $conn;
?>
    <div class="col-6">
        <div class="card">
            <div class="card-header text-capitalize">Add new job</div>
            <form class="form-group" action="index.php" method="post">
                <input type="text" name="job" placeholder="Enter new job">
                <input class="btn btn-primary" type="submit" name="submit_job" />
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['submit_job'])) {
        $jobName = ($_POST['job']);
        $jobName = check_input($jobName);
        $sql = "INSERT INTO `works_on`( `job_name`) 
       VALUES ('$jobName')";
        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("succeed")</script>';
        }
    }
}

/*add new block to system here */
function addBlock()
{
    global $conn;

    ?>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                add new building to the system
            </div>
            <div class="card-body">
                <form class="form-group" method="post">
                    <input type="text" name="block" placeholder="Enter new Block name"> <br>
                    <input type="radio" name="isnew" id="new" value="new"> <label for="new">New</label> <br>
                    <input type="radio" name="isnew" id="old" value="old"> <label for="old">old</label> <br>
                    <input class="btn btn-primary" type="submit" name="submit_block" />
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['submit_block'])) {
        $blockname = $_POST['block'];
        $blockname = check_input($blockname);
        if ($_POST['isnew'] == 'new')
            $isnew = 1;
        else
            $isnew = 0;
        $sql = "INSERT INTO `block`(`Block_name`, `Isnew`) VALUES ('$blockname','$isnew')";
        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("succeed")</script>';
        } else

            echo '<script>alert("eroor")</script>';
    }
}

function addRoom()
{
    global $conn;
    ?>
    <div class="col-6">
        <div class="card">
            <div class="card-header text-capitalize">
                add new Room to the system
            </div>
            <div class="card-body">
                <form class="form-group" method="post">
                    <h6>Select property of new dorm you are going to add</h6>
                    <select class="form-select form-control m-1 " name="bed" id="">
                        <option selected>Number of bed</option>
                        <?php
                        for ($i = 0; $i < 20; $i++)
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        ?>
                    </select> <br>
                    <select class="form-select form-control m-1" name="chair" id="">
                        <option selected>Number of chair</option>
                        <?php
                        for ($i = 0; $i < 20; $i++)
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        ?>
                    </select> <br>
                    <select class="form-select form-control m-1" name="table" id=""> <br>
                        <option selected>Number of table</option>
                        <?php
                        for ($i = 0; $i <= 20; $i++)
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        ?>
                    </select> <br>
                    <input type="radio" name="material" id="new" value="fulfilled"> <label for="new">have all material</label> <br>
                    <input type="radio" name="material" id="old" value="notfulfilled"> <label for="old">Does not have all the material</label> <br>
                    <select class="form-control m-1" name="block" id=""> <br>
                        <option selected>Select Block</option>
                        <?php
                        $sql = "SELECT `Block_name` FROM `block`";
                        $res = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($res) > 0)
                            $n = 0;
                        while ($n < mysqli_num_rows($res)) {
                            $data = mysqli_fetch_assoc($res);
                            echo '<option value="' . $data['Block_name'] . '">' . $data['Block_name'] . '</option>';;
                            $n++;
                        }
                        ?>
                    </select> <br>
                    <input class="btn btn-primary" type="submit" name="submit_room" />
                </form>
            </div>
        </div>
    </div>
    <?php

    if (isset($_POST['submit_room'])) {
        $bed = $_POST['bed'];
        $chair = $_POST['chair'];
        $table = $_POST['table'];
        $material = $_POST['material'];
        $block = $_POST['block'];
        $roomName = "";

        $sql = "SELECT * FROM `block` where Block_name='$block'";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            $data = mysqli_fetch_assoc($res);
            $data['rooms']++;
            if ($data['maxRoom'] >= $data['rooms']) {
                $room = $data['rooms'];
                $sql = "UPDATE `block` SET `rooms`='$room' WHERE  Block_name='$block' limit 1";
                $res = mysqli_query($conn, $sql);
                $roomName = $room;
            }
            if (!(empty($roomName) or ($roomName == ""))) {

                $blockId = $data['blockId'];
                $sql = "INSERT INTO `room`(`roomName`, `Block_id`, `number_of_chair`, `number_of_table`, `number_of_bed`, `freeBed`, `availability`, `materialFulfilled`)
                        VALUES ('$roomName','$blockId','$chair','$table','$bed','$bed','1','1')";
                $res = mysqli_query($conn, $sql);
            }
        }
    }
}



function addInventory($block)
{
    global $conn;

    ?>
    <div class="col-6">
        <div class="card">
            <div class="card-header text-capitalize">
                add new Inventory to Room
            </div>
            <div class="card-body">
                <form class="form-group" method="post">
                    <h6>Select property of new invetory you are going to add</h6>
                    <select class="form-control" name="item_name" id="">
                        <option selected> select item type</option>
                        <option value="bed">full bed</option>
                        <option value="table">Table</option>
                        <option value="chair">chair</option>
                    </select>
                    <input class="form-control m-1" type="number" name="item_quantity" placeholder="Enter items Quantity" />
                    <select class="form-select form-control m-1" name="room" id=""> <br>
                        <option selected>Select room number</option>

                        <?php

                        $sql = "SELECT room.*, block.Block_name from  room
                                inner join `block`  on  block.blockId=room.Block_id 
                                where block.Block_name='$block'";


                        $res = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_assoc($res);
                        $n = 0;

                        while ($n < mysqli_num_rows($res)) {
                            $data = mysqli_fetch_assoc($res);
                            echo '<option value="' . $data['roomName'] . '">' . $data['roomName'] . '</option>';;
                            $n++;
                        }
                        ?>
                    </select> <br>
                    <input class="btn btn-primary" type="submit" name="submit_inventory" />
                </form>
            </div>
        </div>
    </div>
    <?php

    if (isset($_POST['submit_inventory'])) {

        $item = $_POST['item_name'];
        $room = $_POST['room'];

        $get = "SELECT * FROM `room`  WHERE roomName='$room'";
        $res = mysqli_query($conn, $get);
        $data = mysqli_fetch_assoc($res);


        if ($item == "bed") {
            $qnt = $_POST['item_quantity'] + $data['number_of_bed'];
            $sql = "UPDATE `room` SET `number_of_bed`='$qnt' WHERE roomName='$room'";
        } else if ($item == "table") {
            $qnt = $_POST['item_quantity'] + $data['number_of_table'];
            $sql = "UPDATE `room` SET `number_of_table`='$qnt' WHERE roomName='$room'";
        } else if ($item == "chair") {
            $qnt = $_POST['item_quantity'] + $data['number_of_chair'];
            $sql = "UPDATE `room` SET `number_of_chair`='$qnt' WHERE roomName='$room'";
        }

        mysqli_query($conn, $sql);

        $roomId = $data['roomId'];
        $sql1 = "INSERT INTO `inventory`( `roomId`, `Item_name`, `Quantity`, `isNew`) 
                 VALUES ('$roomId','$item','$qnt','1')";
        mysqli_query($conn, $sql1);
    }
}

function assignAllToRoom()
{
    global $conn;

    ?>
    <div class="card">
        <div class="card-header">
            Assign all students to available dorm
        </div>
        <div class="card-body">
            <form class="form-group" method="post">
                <select class="form-control" name="block" id="">
                    <option selected> select block to add students</option>
                    <?php
                    $sql = "SELECT `Block_name` FROM `block` order by Block_name asc";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0)
                        $n = 0;
                    while ($n < mysqli_num_rows($res)) {
                        $data = mysqli_fetch_assoc($res);
                        if ($data['Block_name'] > 'B003') {
                            $d = $data['Block_name'] . ' Female';
                        } else {

                            $d = $data['Block_name'] . ' Male';
                        }
                        echo '<option value="' . $data['Block_name'] . '">' . $d . '</option>';
                        $n++;
                    }
                    ?>
                </select>
                </select>
                <label for="start">Start date</label> <input id='start' name="start" type="date" class="form-control">
                <label for="end"></label>End date <input id="end" type="date" name="end" class="form-control">
                <input type="submit" class="btn btn-primary m-3" name="assign" value="Set date">
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['assign']) && isset($_POST['start'])) {
        $start = $_POST['start'];
        $end = $_POST['end'];
        $block = $_POST['block'];
        if (!empty($_POST['start']) and !empty($_POST['end']) and !empty($_POST['block'])) {
            $sql = "SELECT * FROM `block` WHERE `Block_name` = '$block'";
            $block_data = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            $blockId = $block_data['blockId'];

            $stud = "SELECT * FROM `student` ORDER BY `fname` ASC";
            $stud_result = mysqli_query($conn, $stud);

            $room = "  SELECT r.*, COUNT(b.Room_id) AS num_students
                        FROM `room` r
                        LEFT JOIN `booking` b ON r.roomId = b.Room_id
                        WHERE r.Block_id = '$blockId'
                        GROUP BY r.roomId
                        HAVING num_students < 6";
            $room_result = mysqli_query($conn, $room);
            if ($block > 'B003') {
                $stud = "SELECT * FROM `student` WHERE `sex`='Female' ORDER BY `fname` ASC";
                $stud_result = mysqli_query($conn, $stud);
            } else {
                $stud = "SELECT * FROM `student` WHERE `sex`='Male' ORDER BY `fname` ASC";
                $stud_result = mysqli_query($conn, $stud);
            }

            if ($room_result && $stud_result) {
                while ($dorm = mysqli_fetch_assoc($room_result)) {
                    $rom = $dorm['roomId'];
                    $num_students = $dorm['num_students'];
                    $freebed = $dorm['freeBed'];
                    while ($stud_data = mysqli_fetch_assoc($stud_result)) {
                        $stud_id = $stud_data['Student_id'];

                        // Check if student is already assigned to a room
                        $check = "SELECT * FROM `booking` WHERE `Student_id` = '$stud_id'";
                        $check_result = mysqli_query($conn, $check);

                        if ($check_result && mysqli_num_rows($check_result) == 0) {
                            // Check if room has available space
                            if ($num_students < 6 && $freebed > 0) {
                                $sql = "INSERT INTO `booking` (`Student_id`, `Room_id`, `checkin_date`, `checkout_date`) 
                                VALUES ('$stud_id', '$rom', '$start', '$end')";
                                mysqli_query($conn, $sql);
                                $num_students++;
                                $freebed--;
                                $updt = "UPDATE room set freeBed = '$freebed' where roomId='$rom'";
                                mysqli_query($conn, $updt);
                            } else {
                                $updt = "UPDATE room set `availability` = '0' where roomId='$rom'";
                                mysqli_query($conn, $updt);
                                break;  // No more space in room, move on to next room
                            }
                        }
                    }
                    mysqli_data_seek($stud_result, 0);  // Reset pointer to first student
                }
                echo "Students assigned to rooms successfully!";
            } else {
                echo "Error";
            }
        } else {
            echo ' <div class="alert alert-danger m-2 " role="alert">
           you did not enter all requered value
         </div>';
        }
    }
}
function addStudent()
{
    ?>

    <div class="card">
        <div class="card-header text-capitalize">student registration form</div>
        <div class="card-body">
            <form action="" method="post" class="form-group m-auto">
                <input class="form-control" type="text" name="fname" placeholder="first name" />
                <br />
                <input class="form-control" type="text" name="mname" placeholder="middle name" />
                <br />
                <input class="form-control" type="text" name="lname" placeholder="last name" />
                <br />
                <input class="form-control" type="number" name="phone_number" placeholder="phone number" />
                <br />
                <input class="form-control" type="text" name="email" placeholder="email" />
                <br />
                <input class="form-control" type="date" name="B_date" placeholder="Birth date" />
                <input class="form-control" type="number" name="year" placeholder="year" />
                <br />
                <label for="sex-male">Male</label>

                <input type="radio" id="sex-male" hidden name="sex" value=" " checked />
                <input type="radio" id="sex-male" name="sex" value="Male" />
                <br />
                <label for="sex-female">Female</label>
                <input type="radio" name="sex" value="Female" /> <br>
                <input class="btn btn-primary" type="submit" name="adstudent" value="submit" />

            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['adstudent'])) {

        global $conn;
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mname = $_POST['mname'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $B_date = $_POST['B_date'];
        $sex = $_POST['sex'];
        $year = $_POST['year'];
        $okay = true;
        if (
            !filter_var($email, FILTER_VALIDATE_EMAIL) or
            empty($fname) or empty($lname) or
            empty($mname) or empty($email) or
            empty($B_date) or empty($year) or empty($sex)
        ) {
            $okay = false;
            echo ' <div class="alert alert-warning m-2 " role="alert">
         you did not fill the form
         </div>';
        }
        if ($okay) {
            $fname = check_input($fname);
            $lname = check_input($lname);
            $mname = check_input($mname);
            $phone_number = check_input($phone_number);
            $email = check_input($email);
            $year = check_input($year);


            $sql = "INSERT INTO `student`(`fname`, `mname`, `lname`, `sex`, `B_date`, `phone_number`, `email`, `year`) 
          VALUES ('$fname','$mname','$lname','$sex','$B_date','$phone_number','$email','$year')";
            if (mysqli_query($conn, $sql)) {
                echo ' <div class="alert alert-success m-2 " role="alert">
                the student added success fully
             </div>';
            }
        }
    }
}

function searchStudent($search)
{
    if ($search != "") {
        global $conn;
        $sql = "SELECT booking.Student_id, booking.Room_id, room.roomName, block.Block_name, block.blockId, student.fname, student.sex, student.lname 
            FROM room 
            RIGHT JOIN `block` ON room.Block_id=block.blockId 
            LEFT JOIN booking ON room.roomId = booking.Room_id 
            INNER JOIN student ON booking.Student_id=student.Student_id 
            WHERE fname LIKE '%$search%'
            ORDER BY booking.Student_id ASC
            ";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            if (mysqli_num_rows($res) == 0) {
                echo '<div class="alert alert-warning m-2 " role="alert">
            there is no data with that name
            </div>';
            } else {
                displayStudent($res);
    ?>
    <?php }
        }
    } else {
        echo '<div class="alert alert-warning m-2 " role="alert">
                you did not enter any value  
                </div>';
    }
}

function displayStudent($res)
{
    ?> <table class="table table-dark table-hover">
        <tr>
            <th>
                #
            </th>
            <th>
                ID
            </th>
            <th>
                first name
            </th>
            <th>
                last name
            </th>
            <th>
                Sex
            </th>
            <th>
                room
            </th>
            <th>
                block
            </th>

        </tr>
        <?php
        $n = 1;
        while ($stud_data = mysqli_fetch_assoc($res)) {
            echo '<tr>';

            echo '<td>
    ' . $n . '
                 </td>';
            echo  '<td>
        ' . $stud_data['Student_id'] . '
            </td>';
            echo '<td>
            ' . $stud_data['fname'] . '
                </td>';
            echo '<td>
                ' . $stud_data['lname'] . '
                    </td>';
            echo '<td>
                    ' . $stud_data['sex'] . '
                        </td>';

            echo '<td>
             ' . $stud_data['roomName'] . '
                            </td>';
            echo '<td>
             ' . $stud_data['Block_name'] . '
                                </td>';
            echo '</tr>';
            $n++;
        } ?>
    </table>
<?php
}

function addStaff()
{
    global $conn;
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $B_date = $_POST['B_date'];
    $sex = $_POST['sex'];
    $okay = true;
    if ($_POST['job'] == "Admin") {
        $role = $_POST['job'];
        $job = "manager";
    } else {
        $job = $_POST['job'];
        $role = "";
    }
    if (
        !filter_var($email, FILTER_VALIDATE_EMAIL) or
        empty($fname) or empty($lname) or empty($mname) or
        empty($email) or empty($B_date)  or empty($sex)
    ) {
        $okay = false;
        echo '<script>alert("error")</script>';
    }
    if ($okay) {
        $fname = check_input($fname);
        $lname = check_input($lname);
        $mname = check_input($mname);
        $phone_number = check_input($phone_number);
        $email = check_input($email);

        $sql = "INSERT INTO `staff`(`fname`, `mname`, `lname`, `Job_title`, `role`, `phone_number`, `email`) 
            VALUES ('$fname','$mname','$lname','$job','$role','$phone_number','$email')";


        if (mysqli_query($conn, $sql)) {
            echo ' <div class="alert alert-success m-2 " role="alert">
            the staff added success fully
         </div>';
        }
    }
}


function displayInTable($res)
{
?> <table class="table table-dark table-hover">
        <tr>
            <th>
                #
            </th>
            <th>
                ID
            </th>
            <th>
                first name
            </th>
            <th>
                last name
            </th>
            <th>
                job
            </th>
            <th>
                Role
            </th>
        </tr>
        <?php
        $n = 1;
        while ($staff_data = mysqli_fetch_assoc($res)) {
            echo '<tr>';

            echo '<td>
' . $n . '
             </td>';
            echo  '<td>
    ' . $staff_data['Staff_id'] . '
        </td>';
            echo '<td>
        ' . $staff_data['fname'] . '
            </td>';
            echo '<td>
            ' . $staff_data['lname'] . '
                </td>';

            echo '<td>
         ' . $staff_data['job_name'] . '
                        </td>';
            echo '<td>
          ' . $staff_data['role'] . '
                            </td>';

            $n++;
        } ?>
    </table>
<?php    }

function displayRoom($res)
{
?> <table class="table table-dark table-hover">
        <tr>
            <th>
                #
            </th>
            <th>
                Room No
            </th>
            <th>
                Number of bed
            </th>
            <th>
                Number of table
            </th>
            <th>
                Number of chair
            </th>
            <th>
                Number of free bed
            </th>
            <th>
                All material fulfilled
            </th>
            <th>
                Available
            </th>
            <th>
                Block
            </th>
        </tr>
        <?php
        $n = 1;
        while ($room_data = mysqli_fetch_assoc($res)) {
            echo '<tr>';

            echo '<td>
' . $n . '
             </td>';
            echo  '<td>
    ' . $room_data['roomName'] . '
        </td>';
            echo '<td>
        ' . $room_data['number_of_bed'] . '
            </td>';
            echo '<td>
            ' . $room_data['number_of_table'] . '
                </td>';

            echo '<td>
         ' . $room_data['number_of_chair'] . '
                        </td>';
            echo '<td>
          ' . $room_data['freeBed'] . '
                            </td>';
            if ($room_data['materialFulfilled'] == 0) {
                echo '<td>
                     No </td>';
            } else {
                echo '<td>
                     yes </td>';
            }
            if ($room_data['availability'] == 0) {
                echo '<td>
                       No </td>';
            } else {
                echo '<td>
                     yes </td>';
            }
            echo '<td>
                        ' . $room_data['Block_name'] . '
                                         </td>';
            $n++;
        } ?>
    </table>
<?php    }

?>