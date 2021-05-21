<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
          crossorigin="anonymous">
</head>
<body>


<div class="container mt-4">
<a href="HomeSceen.php">Home screen</a>
    <br>
    <?php
    $First= $_COOKIE['user'];
    print_r("Hi, ".$First."!");
    ?>




</div>
<?php
$performer=$_COOKIE['user'];
$mysql = new mysqli('localhost','root','','todoit');
$result = $mysql->query("SELECT * FROM `tasks` WHERE `user` = '$performer' ");
$mysql->close();
?>
<h1>Active tasks</h1>
<div>
    <table class="table table-striped table-bordered" >
        <tr>
            <th>task</th><th>date</th>
        </tr>
        <?php
        while($TasksList = $result->fetch_assoc()) { ?>
            <tr>

                <td><?php echo $TasksList['tasks']; ?></td><td><?php echo $TasksList['date']; ?></td>
            </tr>
        <?php } ?>

    </table>

</div>
<?php
$performer=$_COOKIE['user'];
$mysql = new mysqli('localhost','root','','todoit');
$result = $mysql->query("SELECT * FROM `tasks` WHERE `user` = '$performer' ");
$mysql->close();
?>
<form action="DidIt.php" method="get">


    <select name="tasks" id="tasks" >
        <option disabled>choose task</option>
        <?php while ($task = $result->fetch_assoc()) { ?>
            <option value ="<?php echo $task['tasks']; ?>"><?php echo $task['tasks'];  ?></option>
        <?php } ?>
    </select >
    <input name="date" id="date" type="date" >
    <button class="btn btn-success">I did it!</button>



</form>









<?php
$performer=$_COOKIE['user'];
$mysql = new mysqli('localhost','root','','todoit');
$result = $mysql->query("SELECT * FROM `completed tasks` WHERE `performer` = '$performer' ");
$mysql->close();
?>
<h1>Completed tasks</h1>
<div>
    <table class="table table-striped table-bordered" >
        <tr>
            <th>task</th><th>date</th>
        </tr>
        <?php
        while($TasksList = $result->fetch_assoc()) { ?>
            <tr>

                <td><?php echo $TasksList['tasks']; ?></td><td><?php echo $TasksList['date']; ?></td>
            </tr>
        <?php } ?>

    </table>
</div>

</body>
</html>