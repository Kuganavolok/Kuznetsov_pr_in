<?php
$title = "Ekran użytkownika";
require __DIR__ . "/head.php";
require "dbconnect.php";
?>
<div class="container-fluid overflow-hidden">
    <div class="row"><br></div>
    <div class="row gx-5">
        <div class="col-md-1">
        </div>
        <div class="col-md-3 border bg-light text-center">
            <a href="homeScreen.php">Powrót do ekranu głównego</a><br>

        </div>
        <div class="col-md-4 border bg-light text-center">
            <?php $user=$_SESSION['logged_user']->name;
            print_r("Cześć, ".$user."!");
            ?>
        </div>
        <div class="col-md-3 border bg-light text-center">
            <a href="logout.php">Wyloguj się z profilu</a>
            <br><br>
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="row">
        <br>
    </div>

    <div class="row gx-5">
        <div class="col-md-1"></div>
        <div class="col-md-4" style="background-color: rgba(0,0,0,0.05)">

            <div class="row">
                <?php
                $performer = $_SESSION['logged_user']->name;
                $mysql = new mysqli('localhost','root','','mybase');
                $result = $mysql->query("SELECT * FROM `step` WHERE `performer` = '$performer' AND `step`= 'do wykonywania' OR `performer`='$performer' AND `step`='w trakcie'");
                $mysql->close();
                ?>
                <form action="didIt.php" method="post">
                    <div class="mb-3">
                        <label for="note" class="form-label"><h5>Komentarż do zadania</h5></label>
                        <textarea class="form-control" id="note" name="note" rows="5"></textarea>
                    </div>
                    <select name="tasks" id="tasks" style="width: 200px;height: 40px">
                        <option selected disabled>zadanie</option>
                        <?php while ($task = $result->fetch_assoc()) { ?>
                            <option value ="<?php echo $task['tasks']; ?>"><?php echo $task['tasks'];  ?></option>
                        <?php } ?>
                    </select>
                    <input name="date" id="date" type="date" style="width: 200px;height: 40px">
                    <select name="step" id="step" style="width: 200px;height: 40px">
                        <option>w trakcie</option>
                        <option>wykonane</option>
                    </select><br><br>
                    <button class="btn btn-success" style="width: 100px;height: 40px">Zmiana</button>
                </form>
            </div>
        </div>
        <div class="col-md-6" style="background-color: rgba(0,0,0,0.06)">
            <div class="row">
                <?php
                $performer=$_SESSION['logged_user']->name;
                $mysql = new mysqli('localhost','root','','mybase');
                $result = $mysql->query("SELECT * FROM `step` WHERE `step` = 'do wykonywania' AND `performer` = '$performer'");
                $mysql->close();
                ?>
                <table class="table table-striped table-bordered" style="background-color: rgba(246,0,0,0.1)" >
                    <caption-top><h5>Aktywne zadania</h5></caption-top>
                    <thead class="table-dark">
                    <th style="width: 100px">date</th>
                    <th>zadanie</th>
                    </thead>
                    <?php
                    while($TasksList = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $TasksList['date']; ?></td>
                            <td><?php echo $TasksList['tasks']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <div class="row">
                <?php
                $performer=$_SESSION['logged_user']->name;
                $mysql = new mysqli('localhost','root','','mybase');
                $result = $mysql->query("SELECT * FROM `step` WHERE `step` = 'w trakcie' AND `performer` = '$performer' ");
                $mysql->close();
                ?>
                <table class="table table-striped table-bordered" style="background-color: rgba(111,164,255,0.2)">
                    <caption-top><h5>W trakcie</h5></caption-top>
                    <thead class="table-dark">
                    <th style="width: 100px">data</th>
                    <th>zadanie</th>
                    <th>komentaż</th>
                    </thead>
                    <?php
                    while($TasksList = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $TasksList['date']; ?></td>
                            <td><?php echo $TasksList['tasks']; ?></td>
                            <td><?php echo $TasksList['note']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="row">
                <?php
                $performer=$_SESSION['logged_user']->name;//$_COOKIE['user'];
                $mysql = new mysqli('localhost','root','','mybase');
                $result = $mysql->query("SELECT * FROM `step` WHERE `step` = 'wykonane' AND `performer` = '$performer'");
                $mysql->close();
                ?>

                <table class="table table-striped table-bordered" style="background-color: rgba(37,229,91,0.2)" >
                    <caption-top><h5>Wykonane zadania</h5></caption-top>
                    <thead class="table-dark">
                    <th style="width: 100px">data</th>
                    <th>zadanie</th>
                    <th>komentaż</th>
                    </thead>
                    <?php
                    while($TasksList = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $TasksList['date']; ?></td>
                            <td><?php echo $TasksList['tasks']; ?></td>
                            <td><?php echo $TasksList['note']; ?></td>

                        </tr>
                    <?php } ?>
                </table>
            </div>


         </div>

    </div>



<?php
require __DIR__ . "/foot.php";
?>