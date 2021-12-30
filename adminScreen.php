<?php
$title = "Ekran kierownika projektu";
require __DIR__ . "/head.php";
require "dbconnect.php";

$mysql = new mysqli('localhost','root','','mybase');
$result = $mysql->query("SELECT * FROM `users` ");
$mysql->close();
?>
<div class="container-fluid overflow-hidden">
    <div class="row"><br></div>
    <div class="row gx-5">
        <div class="col-md-1">
        </div>
        <div class="col-md-3 border bg-light text-center">
            <a href="homeScreen.php">Powrót do ekranu głównego</a><br>
        </div>
        <div class="col-md-4 border bg-light text-center"><?php
            $user=$_SESSION['logged_user']->name;
            print_r("Cześć, ".$user."!");
            ?>
        </div>
        <div class="col-md-3 border bg-light text-center">
            <a href="logout.php">Wyloguj się z profilu</a><br><br>
        </div>
        <div class="col-md-1">
        </div>
    </div>
    <div class="row"><br>
    </div>
    <div class="row gx-5">
        <div class="col-md-1">
        </div>
        <div class="col-md-4" style="background-color: rgba(0,0,0,0.06)" >                                              <!--Форма задания-->
            <div class="row">
                <form action="selectUser.php" method="post">
                    <div class="mb-3">
                        <label for="note" class="form-label"> <h5>Utwórz nowe zadanie</h5></label>
                        <textarea class="form-control" name="task" id="task" rows="4"></textarea>
                    </div>
                    <select name="userName" id="userName" style="width: 200px;height: 40px">
                        <option selected disabled>wybór wykonawcy</option>
                        <?php while ($user = $result->fetch_assoc()) { ?>
                        <option value ="<?php echo $user['name']; ?>"><?php echo $user['name'];?></option>
                        <?php } ?>
                    </select ><br><br>
                    <input name="date" id="date" type="date" style="width: 200px;height: 40px"><br><br>
                    <button  class="btn btn-success" style="width: 100px;height: 40px">Utwórz</button><br><br>
                </form>
            </div>
            <div class="row">                                                                                           <!--Форма блокнота-->
                <form action="note.php" method="post">
                    <div class="mb-3">
                        <label for="note" class="form-label"> <h5>Notatki</h5></label>
                        <textarea class="form-control" id="note" name="note" rows="1"></textarea>
                    </div>
                    <button  class="btn btn-success" style="width: 100px;height: 40px">Utwórz</button>
                    <br><br>
                </form>
                <?php
                $mysql = new mysqli('localhost','root','','mybase');
                $result = $mysql->query("SELECT * FROM `note`");
                $mysql->close();

                ?>
                <form action="deleteTasks.php" method="post">
                <table class="table table-striped table-bordered" style="background-color: rgba(255,251,45,0.24)">
                    <?php
                    while($TasksList = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $TasksList['tasks']; ?></td>
                            <td style="width: 50px">
                                <button class="btn btn-outline-danger" name="del" value="<?php echo $TasksList['tasks'];?>">x</button>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                </form>
            </div>
        </div>
        <div class="col-md-6 " style="background-color: rgba(0,0,0,0.06)">                                               <!--Таблица до выполнения-->
            <div class="row">
                <?php
                $mysql = new mysqli('localhost','root','','mybase');
                $result = $mysql->query("SELECT * FROM `step` WHERE `step` = 'do wykonywania' ");
                $mysql->close();
                ?>

                    <table class="table table-striped table-bordered" style="background-color: rgba(246,0,0,0.1)">
                        <caption-top><h5>Do wykonywania</h5></caption-top>
                        <thead class="table-dark">
                            <th style="width: 100px">wykonawca</th>
                            <th style="width: 100px">data</th>
                            <th>zadanie</th>
                            <th style="width: 20px"></th>
                        </thead>
                    <?php
                    while($TasksList = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $TasksList['performer']; ?></td>
                            <td><?php echo $TasksList['date']; ?></td>
                            <td><?php echo $TasksList['tasks']; ?></td>
                            <form action="deleteTasks.php" method="post">
                                <td>
                                    <button class="btn btn-outline-danger" name="del" value="<?php echo $TasksList['tasks']; ?>">x</button>
                                </td>
                            </form>

                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="row">                                                                                           <!--Таблица в течении-->
                <?php
                $mysql = new mysqli('localhost','root','','mybase');
                $result = $mysql->query("SELECT * FROM `step` WHERE `step` = 'w trakcie'");
                $mysql->close();
                ?>
                <table class="table table-striped table-bordered" style="background-color: rgba(111,164,255,0.2)" >
                    <caption-top><h5>W trakcie</h5></caption-top>
                    <thead class="table-dark">
                        <th style="width: 100px">wykonawca</th>
                        <th style="width: 100px">data</th>
                        <th>zadanie</th>
                        <th>komentaż</th>
                        <!--<th style="width: 20px"></th>-->
                    </thead>
                    <?php
                    while($TasksList = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $TasksList['performer']; ?></td>
                            <td><?php echo $TasksList['date']; ?></td>
                            <td><?php echo $TasksList['tasks']; ?></td>
                            <td><?php echo $TasksList['note']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="row">                                                                                           <!--Таблица сделано-->
                <?php
                $mysql = new mysqli('localhost','root','','mybase');
                $result = $mysql->query("SELECT * FROM `step` WHERE `step` = 'wykonane'");
                $mysql->close();
                ?>

                <table class="table table-striped table-bordered" style="background-color: rgba(37,229,91,0.2)" >
                    <caption-top><h5>Wykonane zadania</h5></caption-top>
                     <thead class="table-dark"">
                        <th style="width: 100px">wykonawca</th>
                        <th style="width: 100px">data</th>
                        <th>zadanie</th>
                        <th>komentaż</th>
                     </thead>
                  <?php
                    while($TasksList = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $TasksList['performer']; ?></td>
                            <td><?php echo $TasksList['date']; ?></td>
                            <td><?php echo $TasksList['tasks']; ?></td>
                            <td><?php echo $TasksList['note']; ?></td>
                        </tr>
                    <?php }?>
                </table>
            </div>
         </div>
    </div>
</div>
<?php
require __DIR__ . "/foot.php";
?>