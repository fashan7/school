<?php
if(isset($_SESSION['logusersid']))
    return header("location: /");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Lock Screen</title>

    <!-- Bootstrap core CSS -->
    <link href="/../public/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/../public/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="/../public/css/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/../public/css/style.css?1" rel="stylesheet">
    <link href="/../public/css/style-responsive.css" rel="stylesheet" />
     <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="shortcut icon" href="../public/media/fashan/logo.png" />
    <script src="/../public/js/jquery.particles.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script src="/../public/ajax/login.js"></script>

</head>

<body class="lock-screen hold-transition login-page background" onload="startTime()">
    <canvas class="canvas" style="position: fixed; z-index: -9999"></canvas>
    <div class="lock-wrapper">

        <div id="time"></div>

        <form role="form" class="form-inline" method="post" id="loginForm">
            <div class="lock-box text-center">
<!--                <div class="lock-name">Jonathan Smith</div>-->
                <div class="lock-name">
                        <div class="form-group">
                            <input type="text" placeholder="Username" id="username" name="username" class="form-control lock-input" style="border: none" value="<?=$_COOKIE['username']?>" autocomplete="off">          
                        </div>                
                </div>
                <img src="../public/img/avatar.jpg" alt="lock avatar"/>
                <div class="lock-pwd">
                        <div class="form-group">
                            <input type="password" placeholder="Password" id="password" name="password" class="form-control lock-input" style="border: none">
                            <button class="btn btn-lock" type="submit" name="login" id="login">
                                <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>                
                </div>
            </div>
        </form>
    </div>
    <script>
        function startTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('time').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){startTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
    </script>
    <script src="/../public/js/bootstrap/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.canvas').particles({
          connectParticles: true,
          color: '#ffffff',
          size: 3,
          maxParticles: 40,
          speed: 1.0
        });
    });
    </script>
</body>
</html>
