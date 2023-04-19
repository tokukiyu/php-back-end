<?php
include "nav.php";
?>

<div class="container">
    <div class="row">
        <div class="col m-2">
            <a href="#add_staff" class="badge badge-info text-capitalize text-monospace text-xl-left">Add new Staff/Employee to the system</a>
        </div>
        <div class="col m-2">
            <a href="#search_staff" class="badge  badge-success text-capitalize text-monospace text-xl-left">Search staff in the system</a>
        </div>
        <div class="col m-2">
            <a href="#remove_staff" class="badge  badge-warning text-capitalize text-monospace text-xl-left">remove staff in the system</a>
        </div>
    </div>
    <div class="row justify-content-center p-2">
        <div id="search_staff" class="col">
            <div class="card">
                <div class="card-header bg-primary">Search employee</div>
                <div class="card-body">
                    <form class="d-flex col-5" role="search" method="get">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search by name" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit" name="submit">Search</button>
                    </form>
                    <?php

                    if (isset($_GET['submit'])) {
                        searchStaff($_GET['search']);
                    }
                    function searchStaff($search)
                    {
                        global $conn;
                        $sql = "SELECT works_on.job_name,staff.fname, staff.lname, staff.role, staff.Staff_id from staff
                       LEFT JOIN works_on ON works_on.job_name=staff.Job_title where staff.fname like '%$search%'";

                        $res = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($res) == 0) {
                            echo ' <div class="alert alert-warning m-2 " role="alert">
                            there is no Employee with that name in the database
                         </div>';
                        } else {
                            displayInTable($res);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center p-2">
        <div class="col">
            <?php
            global $conn;
            /*Displaying Information based on given condition adn reletion between entities. 
                * here we applied JOIN property of sql command to select information from each table
                */
            $sql = "SELECT works_on.job_name,staff.fname, staff.lname, staff.role, staff.Staff_id from staff
                           LEFT JOIN works_on ON works_on.job_name=staff.Job_title";

            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) == 0) {
                echo ' <div class="alert alert-warning m-2 " role="alert">
                there is no Employee in the data base
             </div>';
            } else {
                displayInTable($res);
            }
            ?>

        </div>
    </div>

    <div class="row justify-content-center p-2">
        <div class="col-6" id="add_staff">
            <div class="card">
                <div class="card-header text-capitalize">staff registration form</div>
                <div class="card-body"></div>
                <form method="post" class="form-group m-auto">
                    <input class="form-group" type="text" name="fname" placeholder="first name" />

                    <br />
                    <input class="form-group" type="text" name="mname" placeholder="middle name" />
                    <br />
                    <input class="form-group" type="text" name="lname" placeholder="last name" />
                    <br />
                    <input class="form-group" type="number" name="phone_number" placeholder="phone number" />
                    <br />
                    <input class="form-group" type="text" name="email" placeholder="email" />
                    <select class="form-select " name="job" id="">
                        <option selected>select job/role</option>
                        <option value="Admin">Admin</option>
                        <option value="Genitor">Genitor</option>
                        <option value="proctor">proctor</option>
                    </select>
                    <br />
                    <input class="form-group" type="date" name="B_date" placeholder="Birth date" />

                    <br />
                    <label class="form-group" for="sex-male">Male</label>
                    <input class="form-group" type="radio" id="sex-male" name="sex" value="Male" />
                    <br />
                    <label class="form-group" for="sex-female">Female</label>
                    <input class="form-group" type="radio" name="sex" value="Female" />
                    <br />
                    <input type="submit" name="submit" value="submit" />
                </form>
            </div>

            <?php
            if (isset($_POST['submit'])) {
                if (array_key_exists('job', $_POST)) {
                    addStaff();
                }
            }
            ?>
        </div>
        <div class="col-6" id="remove_staff">
            <div class="card">
                <div class="card-header">
                    clear Employee from system
                </div>
                <div class="card-body">
                    <form class="form-group" action="" method="get">
                        <input class="form-control" type="text" name="fname" placeholder="Enter first name ">
                        <input class="form-control" type="text" name="lname" placeholder="Enter last name ">
                        <input class="btn btn-warning m-2" type="submit" name="remove" value="remove">
                    </form>

                    <?php
                    if (isset($_GET['remove'])) {
                        clearStaff($_GET['fname'], $_GET['lname']);
                    }
                    function clearStaff($fname, $lname)
                    {
                        global $conn;
                        searchStaff($fname);
                    ?>
                        <div class="alert alert-warning m-2 " role="alert">
                            do you really want to clear this Employee from room?
                        </div>
                        <form action="" method="post">

                            <input class="btn btn-danger m-2" type="submit" name="clear" value="clear">
                            <input class="btn btn-secondary m-2" onclick="window.location.href = 'http://localhost/dormitory/staff.php';" name="back" value="don't">

                        </form>

                    <?php
                        if (isset($_POST['clear'])) {
                            $sql = "DELETE FROM staff where fname='$fname' AND lname='$lname' ";
                            $res = mysqli_query($conn, $sql);

                            if ($res) {
                                echo ' <div class="alert alert-success m-2 " role="alert">
                            the Employee cleared success fully
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