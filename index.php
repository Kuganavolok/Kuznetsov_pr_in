<?php
$title = "Start";
require __DIR__ . "/head.php";
require "dbconnect.php";
?>


<div class="container-fluid overflow-hidden">
    <div class="row"><br></div>
    <div class="row"><br></div>
    <div class="row"><br></div>
    <div class="row gx-5">
        <div class="col-md-5"></div>
        <div class="col-md-2 bg-warning text-center" >
            <div class="row"><br></div>
            <div class="row">
                <h1>ToDoIT</h1>
            </div>
            <div class="row"><br></div>
            <div class="row">
                <form action="authorization.php">
                    <button class="btn btn-success">Logowanie</button>
                </form>
            </div>
            <div class="row"><br></div>
            <div class="row">
                <form action="registration.php">
                    <button class="btn btn-danger">Rejestracja</button>
                </form>
            </div>
            <div class="row"><br></div>
         </div>
    </div>
</div>



<?php
require __DIR__ . "/foot.php";
?>