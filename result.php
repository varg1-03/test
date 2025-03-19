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

$score = 0;

// Получение всех вопросов из базы данных
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $question_id = $row["id"];
        $correct_option = $row["correct_option"];
        $user_answer = $_POST["q" . $question_id];

        if ($user_answer == $correct_option) {
            $score++;
        }
    }
}

$total_questions = $result->num_rows;
$percentage = ($score / $total_questions) * 100;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат теста</title>
    <link rel="stylesheet" href="style_test.css">
</head>
<body>
    <div class="result-container">
        <h1>Результат теста</h1>
        <div class="result-card">
            <h2>Ваш результат:</h2>
            <div class="progress-bar">
                <div class="progress" style="width: <?php echo $percentage; ?>%;"></div>
            </div>
            <p class="score"><?php echo $score; ?> из <?php echo $total_questions; ?></p>
            <p class="percentage"><?php echo round($percentage, 2); ?>%</p>
            <a href="test.php" class="retry-button">Пройти тест снова</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>