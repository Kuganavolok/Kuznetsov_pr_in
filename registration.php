<?php
$title = "Formularz rejestracji nowego użytkownika";
require __DIR__ . "/head.php";
require "dbconnect.php";

$data = $_POST;
if(isset($data['do'])){
    $errors = array(); //masyw do zbierania błędów
    if(trim($data['login']) == '') {
        $errors[] = "Wpisz login!";
    }
    if(trim($data['email']) == '') {
        $errors[] = "Wpisz email!";
    }
    if(trim($data['name']) == '') {
        $errors[] = "Wpisz imię!";
    }
    if(trim($data['family']) == '') {
        $errors[] = "Wpisz nazwisko!";
    }
    if(trim($data['password']) == '') {
        $errors[] = "Wpisz hasło!";
    }
    if($data['password_2'] != $data['password']) {
        $errors[] = "Ponownie wpisane hasło jest nieprawidłowe!";
    }
    if(mb_strlen($data['name'])<3||mb_strlen($data['name'])>50){
        $errors[] = "Nieprawidłowa długość nazwy";
    }
    if(mb_strlen($data['family'])<5||mb_strlen($data['name'])>50){
        $errors[] = "Nieprawidłowa długość nazwiska";
    }
    if(mb_strlen($data['password'])<2||mb_strlen($data['name'])>10){
        $errors[] = "Nieprawidłowa długość hasła (od 2 do 10 znaków)";
    }
    if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $data['email'])){
        $errors[] = "Nieprawidłowo wpisany e-mail";
    }
    if(R::count('users',"login = ?", array($data['login'])) > 0){
        $errors[] = "Użytkownik z takim login istnieje!";
    }
    // Wszystko sprawdzone, rejestrujemy
    // Tworzymy tabelę users
    if(empty($errors)) {
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->family = $data['family'];
        $user->login = $data['login'];
        $user->password = password_hash($data['password'],PASSWORD_DEFAULT); // Hash
        R::store($user);// Zapisujemy tabelę
        echo '<div style="color: green; ">Jesteś pomyślnie zarejestrowany! <a href="authorization.php">Autoryzować się</a>.</div>';
    }
    else {
        echo '<div style="color: red;">'. array_shift($errors).'</div><hr>';
    }
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h2>Formularz rejestracyjny</h2>
            <form action="registration.php" method="post">
                <input type="text" class="form-control" name="login" id="login" placeholder="Wpisz login"><br>
                <input type="email" class="form-control" name="email" id="email" placeholder="Wpisz email"><br>
                <input type="text" class="form-control" name="name" id="name" placeholder="Wpisz imię"><br>
                <input type="text" class="form-control" name="family" id="family" placeholder="Wpisz nazwisko"><br>
                <input type="password" class="form-control" name="password" id="password" placeholder="Wpisz hasło"><br>
                <input type="password" class="form-control" name="password_2" id="password_2" placeholder="Powtórz hasło"><br>
                <button class="btn btn-success" name="do" type="submit">Zarejestrować się</button>
            </form>
            <br>
            <p>Masz już konto? Kliknij  <a href="authorization.php">tutaj</a>.</p>
            <p>Powrót do ekranu <a href="index.php">głównego</a>.</p>
        </div>
    </div>
</div>

<?php
require __DIR__ . "/foot.php";
?>
