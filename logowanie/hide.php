<?php session_start();
          require_once('db.php');
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <title>Skrypt logowania z wykorzystaniem PHP i bazy MySQL</title>
    </head>

    <body>
      
      <?php if ($_SESSION['auth'] == TRUE) {
              echo 'UKRYTA TRE��!<br>';
      }
      else {
              echo '<meta http-equiv="refresh" content="1; URL=index.php">';
              echo '<p style="padding-top:10px;"><strong>Pr�ba nieautoryzowanego dost�pu...</strong><br>trwa przenoszenie do formularza logowania<p></p>';
      }
      ?>
      
       <?php if ($_SESSION['auth'] == TRUE) {
          echo 'UKRYTA TRE��!<br>';
          echo '<a href="index.php?logout=true">Wyloguj si�</a>';
  }
  else {
          echo '<meta http-equiv="refresh" content="1; URL=index.php">';
          echo '<p style="padding-top:10px;"><strong>Pr�ba nieautoryzowanego dost�pu...</strong><br>trwa przenoszenie do formularza logowania<p></p>';
  }
  ?>
    </body>
    </html>