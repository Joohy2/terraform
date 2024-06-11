<?php
// 세션 시작
session_start();

// 데이터베이스 연결
$servername = "your-rds-endpoint";
$username = "your-db-username";
$password = "your-db-password";
$dbname = "your-db-name";

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 폼이 제출되었을 때
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 디버그 메시지
    error_log("Form submitted: username=$username");

    // 입력된 사용자 이름과 비밀번호가 데이터베이스에 있는지 확인
    $sql = "SELECT id, username, password FROM login WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // 결과 확인
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // 세션에 사용자 정보 저장
            $_SESSION['username'] = $row['username'];
            // 디버그 메시지
            error_log("Login successful for user: " . $_SESSION['username']);
            // 로그인 성공 시 페이지 이동
            header("Location: coffee.php");
            exit();
        } else {
            // 로그인 실패 시 에러 메시지
            $error = "사용자 이름 또는 비밀번호가 잘못되었습니다.";
            error_log("Login failed: incorrect password");
        }
    } else {
        // 로그인 실패 시 에러 메시지
        $error = "사용자 이름 또는 비밀번호가 잘못되었습니다.";
        error_log("Login failed: username not found");
    }
    $stmt->close();
}

// 데이터베이스 연결 닫기
$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Login - 밀리프레소 Site</title>
    <style>
        body {
            font-family: 'Noto Sans KR', sans-serif;
            text-align: center;
            background-color: #fff;
            margin: 0;
            padding-top: 50px;
        }
        .logo-container img {
            max-width: 200px;
            margin-bottom: 30px;
        }
        h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }
        form {
            background-color: #f4f4f4;
            display: inline-block;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            margin-right: 10px;
        }
        input[type=text], input[type=password] {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }
        input[type=submit] {
            background-color: #00a4db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #0077a1;
        }
        .error-message {
            color: red;
        }
    </style>
</head>
<body>

<h1>LOGIN PAGE2</h1>

<form action="" method="post">
    <label for="username">ID :</label>
    <input type="text" name="username" required>
    <label for="password">PW :</label>
    <input type="password" name="password" required>
    <input type="submit" value="로그인">
</form>

<?php
// 에러 메시지 표시
if (isset($error)) {
    echo '<p class="error-message">' . $error . '</p>';
}
?>

</body>
</html>
