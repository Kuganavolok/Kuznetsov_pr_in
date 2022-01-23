<?php
$title = "Formularz autoryzacji";
require __DIR__ . "/head.php";
require "dbconnect.php";

$data = $_POST;

if(isset($_SESSION['logged_user'])){                     //проверка на админ нет когда залогованы и отправка на нужную страницу
    if ($_SESSION['logged_user']->login == 'Admin'){
        header('Location:adminScreen.php');}
    else{
        header('Location:user.php');}
}

if(isset($data['do_login'])){
    $errors = array();
    $user = R::findOne('users','login = ?', array($data['login']));

     if($user) {
        if(password_verify($data['password'], $user->password)) {
            $_SESSION['logged_user'] = $user;
            if ($data['login'] != 'Admin'){
                header('Location:user.php');}
            else{
                header('Location:adminScreen.php');
            }
        }
        else  {
            $errors[] = 'Hasło jest niepoprawne!';
        }
    }
    else {
        $errors[] = 'Nie znaleziono użytkownika o takim loginie!';
    }
    if(!empty($errors)) {
        echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>';
    }
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h2>Formularz autoryzacji</h2>
            <form action="authorization.php" method="post">
                <input type="text" class="form-control" name="login" id="login" placeholder="Wpisz login" required><br>
                <input type="password" class="form-control" name="password" id="pass" placeholder="Wpisz hasło" required><br>
                <button class="btn btn-success" name="do_login" type="submit">Autoryzować się</button>
            </form>
            <br>
            <p>Jeśli nie jesteś jeszcze zarejestrowany, kliknij  <a href="registration.php">tutaj</a>.</p>
            <p>Powrót do ekranu <a href="index.php">głównego</a>.</p>
        </div>
    </div>
</div>

<?php
require __DIR__ . "/foot.php";
?>


