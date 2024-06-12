<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Millipresso Site</title>
    <style>
        body {
            font-family: 'Noto Sans KR', sans-serif;
            text-align: center;
            background-color: #fff; /* 흰색 배경 */
            margin: 0;
            padding-top: 100px; /* 로고와 버튼이 좀 더 중앙에 오도록 패딩 추가 */
        }
        .logo-container img {
            max-width: 200px; /* 로고의 크기를 조절 */
            margin-bottom: 30px;
        }
        h1 {
            font-size: 2em; /* 타이틀의 폰트 크기를 조절 */
            color: #333; /* 다크 그레이 색상 */
            margin-bottom: 50px; /* 타이틀과 버튼 사이 간격 */
        }
        .button {
            border: 2px solid #00a4db; /* 버튼의 테두리 색상 */
            background-color: transparent; /* 투명 배경 */
            color: #00a4db; /* 버튼 글자 색상 */
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        .button:hover {
            background-color: #00a4db; /* 버튼을 호버했을 때 배경색 변경 */
            color: #fff; /* 버튼 글자색을 백색으로 변경 */
        }
    </style>
</head>
<body>2wsz

<h1>Millipresso 사이트 CICD V1 </h1>

<button class="button" onclick="location.href='/login';">로그인</button>
<button class="button" onclick="location.href='/createuser';">회원가입</button>

</body>
</html>
