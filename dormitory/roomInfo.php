<?php
include "nav.php";

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <form class="d-flex col-5 p-2" action="" method="get">

                <select class="form-control" name="block" id="">
                    <option value="B002">Display all in block</option>
                    <?php
                    $sql = "SELECT `Block_name` FROM `block` order by Block_name asc";
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
            $sql = "SELECT room.*, block.Block_name from  room
               inner join `block`  on  block.blockId=room.Block_id 
               where block.Block_name='$block'";

            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                displayRoom($res);
            } else {
                echo ' <div class="alert alert-warning m-2 " role="alert">
              there is no room in this block
             </div>';
            }

            ?>

        </div>
    </div>
    <div class="row">
        <?php
        addInventory($block);
        addRoom();
        addBlock();
        ?>
    </div>

</div>