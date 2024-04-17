<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Возраст и годы до пенсии</title>
</head>
<body>
<h1>Возраст и годы до пенсии Задание 1-3</h1>

<form method="POST" action="">
    <label for="name">Имя:</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required><br><br>
    <?php if (isset($_POST['name']) && empty($_POST['name'])): ?>
        <p style="color: red">Поле имя не заполнено</p>
    <?php endif; ?>
    
    <label for="group">Группа:</label>
    <input type="text" name="group" id="group" value="<?= htmlspecialchars($_POST['group'] ?? '') ?>" required><br><br>
    <?php if (isset($_POST['group']) && empty($_POST['group'])): ?>
        <p style="color: red">Поле группа не заполнено</p>
    <?php endif; ?>
    
    <label for="gender">Пол:</label>
    <label><input type="radio" name="gender" value="male" required> Мужской</label>
    <label><input type="radio" name="gender" value="female" required> Женский</label><br><br>
    
    <label for="birthday">День рождения:</label>
    <select name="birthday" id="birthday" required>
        <?php for ($i = 1; $i <= 31; $i++): ?>
            <option value="<?= $i ?>" <?= ($_POST['birthday'] ?? '') == $i ? 'selected' : '' ?>><?= $i ?></option>
        <?php endfor; ?>
    </select><br><br>
    <?php if (isset($_POST['birthday']) && empty($_POST['birthday'])): ?>
        <p style="color: red">Поле день рождения не заполнено</p>
    <?php endif; ?>
    
    <label for="birthmonth">Месяц:</label>
    <select name="birthmonth" id="birthmonth" required>
        <?php for ($i = 1; $i <= 12; $i++): ?>
            <option value="<?= $i ?>" <?= ($_POST['birthmonth'] ?? '') == $i ? 'selected' : '' ?>><?= date('F', strtotime("2023-$i-01")) ?></option>
        <?php endfor; ?>
    </select><br><br>
    <?php if (isset($_POST['birthmonth']) && empty($_POST['birthmonth'])): ?>
        <p style="color: red">Поле месяц не заполнено</p>
    <?php endif; ?>
    
    <label for="birthyear">Год:</label>
    <select name="birthyear" id="birthyear" required>
        <?php for ($i = date('Y') - 19; $i >= 1900; $i--): ?>
            <option value="<?= $i ?>" <?= ($_POST['birthyear'] ?? '') == $i ? 'selected' : '' ?>><?= $i ?></option>
        <?php endfor; ?>
    </select><br><br>
    <?php if (isset($_POST['birthyear']) && empty($_POST['birthyear'])): ?>
        <p style="color: red">Поле год не заполнено</p>
    <?php endif; ?>
    
    <label for="driver_license">Наличие водительского удостоверения:</label>
    <input type="checkbox" name="driver_license" id="driver_license" value="1" <?= isset($_POST['driver_license']) ? 'checked' : '' ?>><br><br>
    
    <input type="submit" value="Рассчитать">
</form>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    if (empty($errors)) {
        $age = date('Y') - $_POST['birthyear'] - 1;
        if (date('m') < $_POST['birthmonth'] || date('m') === $_POST['birthmonth'] && date('d') < $_POST['birthday']) {
            $age++;
        }

        $retirement_age = $_POST['gender'] === 'male' ? 65 : 63;
        $years_to_retirement = $retirement_age - $age;

        echo "<p>Имя: {$_POST['name']}</p>";
        echo "<p>Группа: {$_POST['group']}</p>";
        echo "<p>Возраст: $age</p>";
        echo "<p>Годы до пенсии: $years_to_retirement</p>";
        echo "<p>Наличие водительского удостоверения: " . ($_POST['driver_license'] ? 'Да' : 'Нет') . "</p>";
    }
}

?>

</body>
</html>