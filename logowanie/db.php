
  <?php
  $dbhost = 'localhost';     
  $dblogin = 'Patryk';
  $dbpass = '123';
  $dbselect = 'tebedu';
  mysql_connect($dbhost,$dblogin,$dbpass);
  mysql_select_db($dbselect) or die("B��d przy wyborze bazy danych");
  mysql_query("SET CHARACTER SET UTF8");
  ?>