<!DOCTYPE html>
<html>
<head>
    <title>Welcome to cicd</title>
</head>
<body>
    <h1>Welcome to cicd V2 </h1>
    <p>joooooooworld.</p>
    <a href="http://3-tier-app-alb-279909349.ap-southeast-1.elb.amazonaws.com/">Go to was Page</a>
</body>
</html>
 
<?php
// 세션 시작
session_start();

// 로그인되지 않은 경우 로그인 페이지로 리디렉션
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 로그아웃 처리
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    // 모든 세션 변수 제거
    $_SESSION = array();
    // 세션 쿠키 제거
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    // 세션 파괴
    session_destroy();
    // 로그인 페이지로 리디렉션
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milli Presso</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans KR', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .header {
            width: 100%;
            background: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
            font-size: 2em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header a {
            color: white;
            text-decoration: none;
            padding: 0 20px;
        }
        .webtoon-list {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
            width: 80%;
            max-width: 1200px;
            margin-top: 50px;
        }
        .menu-tab {
            width: 100%;
            background: #f0f0f0;
            margin-bottom: 20px;
            text-align: center;
            padding: 10px 0;
        }
        .menu-tab a {
            color: #333;
            text-decoration: none;
            margin: 0 10px;
        }
        .menu-tab a:hover {
            color: #666;
        }
        .webtoon-link {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
            text-decoration: none;
            color: #333;
        }
        .webtoon-link:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .webtoon-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .webtoon-title {
            margin-top: 8px;
            font-size: 1.1em;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>Milli Presso</div>
    </div>
    <div class="menu-tab">
        <a href="#home" class="menu-item">홈</a>
        <a href="#webtoons" class="menu-item">커피 목록</a>
        <a href="#favorites" class="menu-item">즐겨찾기</a>
        <a href="#settings" class="menu-item">설정</a>
    </div>
    <div class="webtoon-list">
        <a href="one" class="webtoon-link featured">
            <img src="coffee.jpg" alt="Webtoon 1" class="webtoon-image">
            <div class="webtoon-title">블랙 원두</div>
        </a>
        <a href="two" class="webtoon-link featured">
            <img src="coffee.jpg" alt="Webtoon 1" class="webtoon-image">
            <div class="webtoon-title">아로마 원두</div>
        </a>
        <a href="three" class="webtoon-link featured">
            <img src="coffee.jpg" alt="Webtoon 1" class="webtoon-image">
            <div class="webtoon-title">시카고 원두</div>
        </a>
        <a href="four" class="webtoon-link featured">
            <img src="coffee.jpg" alt="Webtoon 1" class="webtoon-image">
            <div class="webtoon-title">밀리프레소 원두</div>
        </a>
    </div>
</body>
</html>
