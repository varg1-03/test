<?php
// Подключение к базе данных
$host = 'localhost';
$dbname = 'test';   //название бд
$username = 'root';  //имя пользователя
$password = '';  //пароль от пользователя

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Запрос к базе данных для получения вопросов
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тестирование</title>
    <link rel="stylesheet" href="style_test.css">
</head>
<body>
    <div class="container">
        <h1>Тестирование</h1>
        <form method="post" action="result.php">
            <?php
            if ($result->num_rows > 0) {
                // Вывод данных каждого вопроса
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='question-card'>";
                    echo "<h3>" . $row["question_text"] . "</h3>";
                    echo "<label><input type='radio' name='q" . $row["id"] . "' value='1' required> " . $row["option1"] . "</label><br>";
                    echo "<label><input type='radio' name='q" . $row["id"] . "' value='2'> " . $row["option2"] . "</label><br>";
                    echo "<label><input type='radio' name='q" . $row["id"] . "' value='3'> " . $row["option3"] . "</label><br>";
                    echo "<label><input type='radio' name='q" . $row["id"] . "' value='4'> " . $row["option4"] . "</label><br>";
                    echo "</div>";
                }
            } else {
                echo "<p>Вопросы не найдены.</p>";
            }
            ?>
            <br>
            <button type="submit" class="submit-button">Завершить тест</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>