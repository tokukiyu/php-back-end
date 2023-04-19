<?php
include "nav.php";
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col m-2">
            <a href="#add_new_stduent" class="badge badge-info text-capitalize text-monospace text-xl-left">Add new student to the system</a>
        </div>
        <div class="col m-2">
            <a href="#assign_all" class="badge  badge-primary text-capitalize text-monospace text-xl-left">assign students to Available room</a>
        </div>
        <div class="col m-2">
            <a href="#search_student" class="badge  badge-success text-capitalize text-monospace text-xl-left">Search student in the system</a>
        </div>
        <div class="col m-2">
            <a href="#clear_student" class="badge  badge-warning text-capitalize text-monospace text-xl-left">clear student from the system</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div id="search_student" class="col">
            <div class="card">
                <div class="card-header bg-primary">Search student</div>
                <div class="card-body">
                    <form class="d-flex col-5" role="search" method="get">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search by name" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit" name="submit">Search</button>
                    </form>
                    <?php

                    if (isset($_GET['submit']))
                        searchStudent($_GET['search']);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <form class="d-flex col-5 p-2" action="" method="get">

                <select class="form-control" name="block" id="">
                    <option value="B002">Display all in block</option>
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
                </select>
                <input class="btn btn-info" type="submit" name="set" value="change">

            </form>
            <?php
            $block = 'B002';
            if (isset($_GET['set'])) {
                $block = $_GET['block'];
            }
            global $conn;
            /*Displaying Information based on given condition adn reletion between entities. 
                * here we applied JOIN property of sql command to select information from each table
                */
                
            $sql = " SELECT booking.Student_id, booking.Room_id,room.roomName,block.Block_name, block.blockId, student.fname,student.sex, student.lname from booking 
                     RIGHT JOIN student ON booking.Student_id=student.Student_id 
                     JOIN room ON booking.Room_id=room.roomId 
                     JOIN `block` ON room.Block_id=block.blockId where Block_name='$block'
                     ORDER BY room.roomName ASC";

            $res = mysqli_query($conn, $sql);
            displayStudent($res);

            ?>

        </div>
    </div>
    <div class="row">
        <div id="add_new_stduent" class="col-6">
            <?php
            addStudent();
            ?>
        </div>
        <div id="assign_all" class="col-6">
            <?php
            assignAllToRoom();
            ?>
        </div>
        <div id="clear_student" class="col-6">
            <div class="card">
                <div class="card-header">
                    clear student
                </div>
                <div class="card-body">
                    <form class="form-group" action="" method="get">
                        <input class="form-control" type="text" name="fname" placeholder="Enter first name ">
                        <input class="form-control" type="text" name="lname" placeholder="Enter last name ">
                        <input class="btn btn-warning m-2" type="submit" name="remove" value="remove">
                    </form>

                    <?php
                    if (isset($_GET['remove'])) {
                        clearStudent($_GET['fname'], $_GET['lname']);
                    }
                    function clearStudent($fname, $lname)
                    {
                        global $conn;
                        searchStudent($fname);
                    ?>
                        <div class="alert alert-warning m-2 " role="alert">
                            do you really want to clear this student from room?

                        </div>
                        <form action="" method="post">

                            <input class="btn btn-danger m-2" type="submit" name="clear" value="clear">
                            <input class="btn btn-secondary m-2" onclick="window.location.href = 'http://localhost/dormitory/studentInfo.php';" name="back" value="don't">

                        </form>

                    <?php
                        if (isset($_POST['clear'])) {
                            $sql = "DELETE FROM student where fname='$fname' AND lname='$lname' ";
                            $res = mysqli_query($conn, $sql);

                            if ($res) {
                                echo ' <div class="alert alert-success m-2 " role="alert">
                           the student cleared success fully
                        </div>';
                            }
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
