<?php
$mysql = new mysqli('localhost','root','','todoit');
$result = $mysql->query("SELECT * FROM `users` ");
$mysql->close();

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Screen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
          crossorigin="anonymous">

</head>
<body>

<div class="contaner mt-4">
    <a href="HomeSceen.php">Home screen</a>
    <h1> Create new task</h1>

    <form action="selectUser.php" method="get">


        <input type="text" class="form-control" name="task" id="task"
               placeholder="create a new task" size="20">
        <br>




        <select name="UserName" id="UserName" >
            <option disabled>choose a performer </option>
            <?php while ($user = $result->fetch_assoc()) { ?>
                <option value ="<?php echo $user['name']; ?>"><?php echo $user['name'];  ?></option>
            <?php } ?>
        </select >

        <br>
        <br>
        <input name="date" id="date" type="date" >
        <br>
        <br>

        <button  class="btn btn-success"> Create task </button> <br><br>
    </form>


</div>
<?php
$mysql = new mysqli('localhost','root','','todoit');
$result = $mysql->query("SELECT * FROM `tasks` ");
$mysql->close();
?>
<h1>Active tasks</h1>
<div>
    <table class="table table-striped table-bordered" >
        <tr>
            <th>performer</th><th>task</th><th>date</th>
        </tr>
        <?php
        while($TasksList = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $TasksList['user']; ?></td>
                <td><?php echo $TasksList['tasks']; ?></td><td><?php echo $TasksList['date']; ?></td>
            </tr>
        <?php } ?>

    </table>
    <?php
    $mysql = new mysqli('localhost','root','','todoit');
    $result = $mysql->query("SELECT * FROM `completed tasks` ");
    $mysql->close();
    ?>
    <h1>Completed tasks</h1>
    <table class="table table-striped table-bordered" >
        <tr>
            <th>performer</th><th>task</th><th>date</th>
        </tr>
        <?php
        while($TasksList = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $TasksList['performer']; ?></td>
                <td><?php echo $TasksList['tasks']; ?></td><td><?php echo $TasksList['date']; ?></td>
            </tr>
        <?php } ?>

    </table>


</div>


</body>
</html>