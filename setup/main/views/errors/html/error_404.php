<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--<meta charset="utf-8">-->
<!--<title>404 Page Not Found</title>-->
<!--<style type="text/css">-->

<!--::selection { background-color: #E13300; color: white; }-->
<!--::-moz-selection { background-color: #E13300; color: white; }-->

<!--body {-->
<!--	background-color: #fff;-->
<!--	margin: 40px;-->
<!--	font: 13px/20px normal Helvetica, Arial, sans-serif;-->
<!--	color: #4F5155;-->
<!--}-->

<!--a {-->
<!--	color: #003399;-->
<!--	background-color: transparent;-->
<!--	font-weight: normal;-->
<!--}-->

<!--h1 {-->
<!--	color: #444;-->
<!--	background-color: transparent;-->
<!--	border-bottom: 1px solid #D0D0D0;-->
<!--	font-size: 19px;-->
<!--	font-weight: normal;-->
<!--	margin: 0 0 14px 0;-->
<!--	padding: 14px 15px 10px 15px;-->
<!--}-->

<!--code {-->
<!--	font-family: Consolas, Monaco, Courier New, Courier, monospace;-->
<!--	font-size: 12px;-->
<!--	background-color: #f9f9f9;-->
<!--	border: 1px solid #D0D0D0;-->
<!--	color: #002166;-->
<!--	display: block;-->
<!--	margin: 14px 0 14px 0;-->
<!--	padding: 12px 10px 12px 10px;-->
<!--}-->

<!--#container {-->
<!--	margin: 10px;-->
<!--	border: 1px solid #D0D0D0;-->
<!--	box-shadow: 0 0 8px #D0D0D0;-->
<!--}-->

<!--p {-->
<!--	margin: 12px 15px 12px 15px;-->
<!--}-->
<!--</style>-->
<!--</head>-->
<!--<body>-->
<!--	<div id="container">-->
<!--		<h1><?php echo $heading; ?></h1>-->
<!--		<?php echo $message; ?>-->
<!--	</div>-->
<!--</body>-->
<!--</html>-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Lost in Space</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --bg: #0f172a;
            --text: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .container {
            text-align: center;
            padding: 2rem;
            z-index: 1;
        }

        .error-code {
            font-size: clamp(8rem, 20vw, 15rem);
            font-weight: 900;
            line-height: 1;
            background: linear-gradient(to bottom, #6366f1, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
            animation: float 6s ease-in-out infinite;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        p {
            color: #94a3b8;
            margin-bottom: 2rem;
            max-width: 450px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 25px -5px rgba(99, 102, 241, 0.4);
        }

        /* Background blur effects */
        .glow {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, rgba(15, 23, 42, 0) 70%);
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        @media (max-width: 640px) {
            h1 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>

    <div class="glow"></div>

    <div class="container">
        <div class="error-code">404</div>
        <h1>You look a bit lost.</h1>
        <p>The page you're looking for was either moved, deleted, or perhaps never existed in this dimension.</p>
        <a href="/" class="btn">Take Me Home</a>
    </div>

</body>
</html>