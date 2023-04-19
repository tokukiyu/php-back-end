<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>students room</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">


</head>

<body>
    <div class="row justify-content-center">
        <div id="search_student" class="col">
            <div class="card">
                <div class="card-header bg-primary">find your room</div>
                <div class="card-body">
                    <form class="d-flex col-5" role="search" method="get">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search by name" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit" name="submit">Search</button>
                    </form>
                    <?php
                    include "config.php";
                    if (isset($_GET['submit'])) {
                        searchStudent($_GET['search']);
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

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>