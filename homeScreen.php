<?php
$title="Ekran główny";
require __DIR__ . "/head.php";
require "dbconnect.php";
?>



<div class="container-fluid overflow-hidden">
    <div class="row">
        <br>
    </div>
    <div class="row gx-5">
        <div class="col-md-1">
        </div>
        <div class="col-md-3 border bg-light text-center">
            <a href="authorization.php">Konto użytkownika</a><br>
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
    <div class="row gx-5" >
        <div class="col-md-1"></div>
        <div class="col-md-5" style="background-color: rgba(210,191,67,0.18)">
            <div class="row">
                <br>
            </div>
            <div class="row">
                  <table class="table table-bordered table-striped">
                    <caption-top><h5>Projekt:</h5></caption-top>
                    <tr>
                        <td>Naprawa rowera Romet</td>
                    </tr>
                  </table>
            </div>
            <div class="row">
                    <?php
                    $mysql = new mysqli('localhost','root','','mybase');
                    $result = $mysql->query("SELECT * FROM `users` WHERE `login` = 'Admin'");
                    $mysql->close();
                    ?>
                    <table class="table table-bordered table-striped">
                        <caption-top><h5>Menedżer proekta:</h5></caption-top>
                        <?php while($TasksList = $result->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <?php echo $TasksList['name'];?>
                                </td>
                                <td>
                                    <?php echo $TasksList['family'];?>
                                </td>
                                <td>
                                    <?php echo $TasksList['email'];?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
            </div>
            <div class="row" >
                    <?php
                    $mysql = new mysqli('localhost','root','','mybase');
                    $result = $mysql->query("SELECT * FROM `users`");
                    $mysql->close();
                    ?>
                    <table class="table table-bordered table-striped">
                        <caption-top><h5>Zespól projekta</h5></caption-top>
                        <?php while($TasksList = $result->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <?php echo $TasksList['name'];?>
                                </td>
                                <td>
                                    <?php echo $TasksList['family'];?>
                                </td>
                                <td>
                                    <?php echo $TasksList['email'];?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>

            </div>
        </div>
        <div class="col-md-5" style="background-color: rgba(0,0,0,0.05)">
            <div class="row">
                <?php
                $mysql = new mysqli('localhost','root','','mybase');
                $result = $mysql->query("SELECT * FROM `step` WHERE `step` = 'do wykonywania' ");
                $mysql->close();
                ?>

                <table class="table table-striped table-bordered" style="background-color: rgba(246,0,0,0.1)">
                    <caption-top><h5>Do wykonywania</h5></caption-top>
                    <thead class="table-dark">
                    <th style="width: 100px">data</th>
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
        <div class="row">                              <!--Таблица в течении-->
            <?php
            $mysql = new mysqli('localhost','root','','mybase');
            $result = $mysql->query("SELECT * FROM `step` WHERE `step` = 'w trakcie'");
            $mysql->close();
            ?>
            <table class="table table-striped table-bordered" style="background-color: rgba(111,164,255,0.2)" >
                <caption-top><h5>W trakcie</h5></caption-top>
                <thead class="table-dark">
                <th style="width: 100px">data</th>
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
        <div class="row">                               <!--Таблица сделано-->
            <?php
            $mysql = new mysqli('localhost','root','','mybase');
            $result = $mysql->query("SELECT * FROM `step` WHERE `step` = 'wykonane'");
            $mysql->close();
            ?>
            <table class="table table-striped table-bordered" style="background-color: rgba(37,229,91,0.2)" >
                <caption-top><h5>Wykonane zadania</h5></caption-top>
                <thead class="table-dark"">
                <th style="width: 100px">data</th>
                <th>zadanie</th>
                </thead>
                <?php
                while($TasksList = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $TasksList['date']; ?></td>
                        <td><?php echo $TasksList['tasks']; ?></td>
                    </tr>
                <?php }?>
            </table>
        </div>
    </div>
    </div>
</div>
<?php
require __DIR__ . "/foot.php"
?>
