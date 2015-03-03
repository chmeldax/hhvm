<?php
$host   = getenv("MYSQL_TEST_HOST")   ? getenv("MYSQL_TEST_HOST") : "localhost";
$port   = getenv("MYSQL_TEST_PORT")   ? getenv("MYSQL_TEST_PORT") : 3306;
$user   = getenv("MYSQL_TEST_USER")   ? getenv("MYSQL_TEST_USER") : "root";
$passwd = getenv("MYSQL_TEST_PASSWD") ? getenv("MYSQL_TEST_PASSWD") : "";
$db     = getenv("MYSQL_TEST_DB")     ? getenv("MYSQL_TEST_DB") : "test";

$pdo = new PDO("mysql:dbname=$db;host=$host", $user, $passwd);

try {
  $pdo->query("CREATE TABLE test_nextrowset (
    id INT(1),
    PRIMARY KEY(id)
  )");

  $stm = $pdo->query("INSERT INTO test_nextrowset (id) VALUES (1);
               INSERT INTO test_nextrowset (id) VALUES (2, 3);
               INSERT INTO test_nextrowset (id) VALUES (4, 5, 6)");
  for ($i = 0; $i < 3; $i++) {
      var_dump($stm->rowCount());
      var_dump($stm->nextRowset());
  }

} catch (Exception $ex) {
	var_dump($ex);
} finally {
  $pdo->query("DROP TABLE test_nextrowset");
}
