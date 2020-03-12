 <html>

   <head>

      <title>图形计算器（面向对象）</title>

      <meta http-equiv="Content-Type" content="text/html;charset=utf-8">

   </head>

   <body>

        <center>

             <h1>图形（面积 && 周长)计算器）<h1>

             <a href="index.php?action=rect">矩形</a>||    //action 是动作提交

             <a href="index.php?action=triangle">三角形</a>||

             <a href="index.php?action=circle">圆形</a>

             <hr>

        </center>

        <?php

               error_reporting(E_ALL & ~E_NOTICE);

               function __autoload($className)

               {

                       include strtolower($className).".class.php";


                     }



                echo new Form();



                if(isset($_POST["sub"])){

                echo new Result();

                  }

         ?>

  </body>

</html>