 <?php session_start();
          require_once('db.php');
    ?>
<!DOCTYPE html>
    <html>
    <head>
    <title>Skrypt logowania z wykorzystaniem PHP i bazy MySQL</title>
    
    </head>

    <body>
    
     <?php
    /* je�eli nie wype�niono formularza - to znaczy nie istnieje zmienna login, has�o i sesja auth
     * to wy�wietl formularz logowania
     */
    if (!isset($_POST['login']) && !isset($_POST['password']) && $_SESSION['auth'] == FALSE){
      
    
  ?>
  
      <form name="form-logowanie" action="index.php" method="post">
          Login: <input type="text" name="login"><br>
          Has�o: <input type="password" name="password">
          <input type="submit" name="zaloguj" value="Zaloguj">
      </form>
  
  <?php
  }
    /* je�eli istnieje zmienna login oraz password i sesja z autoryzacj� u�ytkownika jest FALSE to wykonaj
     * skrypt logowania
     */
    elseif (isset($_POST['login']) && isset($_POST['password']) && $_SESSION['auth'] == FALSE) {
      
        // je�eli pole z loginem i has�em nie jest puste      
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
          
        // dodaje znaki unikowe dla potrzeb polece� SQL
        $login = mysql_real_escape_string($_POST['login']);
        $password = mysql_real_escape_string($_POST['password']);
        
        // szyfruj� wpisane has�o za pomoc� funkcji md5()
        $password = md5($password);
        
        /* zapytanie do bazy danych
         * mysql_num_rows - sprawdzam ile wierszy odpowiada zapytaniu mysql_query
         * mysql_query - pobierz wszystkie dane z tabeli user gdzie login i has�o odpowiadaj� wpisanym danym
         */
        $sql = mysql_num_rows(mysql_query("SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$password'"));
        
            // je�eli powy�sze zapytanie zwraca 1, to znaczy, �e dane zosta�y wpisane poprawnie i rejestruj� sesj�
            if ($sql == 1) {
              
                // zmienne sesysje user (z loginem zalogowanego u�ytkownika) oraz sesja autoryzacyjna ustawiona na TRUE
                $_SESSION['user'] = $login;
                $_SESSION['auth'] = TRUE;
                
                //przekierwuj� u�ytkownika na stron� z ukrytymi informacjami
                echo '<meta http-equiv="refresh" content="1; URL=hide.php">';
                echo '<p style="padding-top:10px;"><strong>Prosz� czeka�...</strong><br>trwa logowanie i wczytywanie danych<p></p>';
            }
            
            // je�eli zapytanie nie zwr�ci 1, to wy�wietlam komunikat o b��dzie podczas logowania
            else {
                echo '<p style="padding-top:10px;color:red" ;="">B��d podczas logowania do systemu<br>';
                echo '<a href="index.php" style="">Wr�� do formularza</a></p>';
            }
        }
        
        // je�eli pole login lub has�o nie zosta�o uzupe�nione wy�wietlam b��d
        else {
            echo '<p style="padding-top:10px;color:red" ;="">B��d podczas logowania do systemu<br>';
            echo '<a href="index.php" style="">Wr�� do formularza</a></p>';    
        }
    }
     // je�eli sesja auth jest TRUE to przekieruj na ukryt� podstron�
    elseif ($_SESSION['auth'] == TRUE && !isset($_GET['logout'])) {
        echo '<meta http-equiv="refresh" content="1; URL=hide.php">';
        echo '<p style="padding-top:10px;"><strong>Prosz� czeka�...</strong><br>trwa wczytywanie danych<p></p>';
    }

    // wyloguj si�
    elseif ($_SESSION['auth'] == TRUE && isset($_GET['logout'])) {
        $_SESSION['admin_user'] = '';
        $_SESSION['admin_auth'] = FALSE;
        echo '<meta http-equiv="refresh" content="1; URL=index.php">';
        echo '<p style="padding-top:10px;"><strong>Prosz� czeka�...</strong><br>trwa wylogowywanie<p></p>';
    }
 ?>
    </body>
      
    </html>