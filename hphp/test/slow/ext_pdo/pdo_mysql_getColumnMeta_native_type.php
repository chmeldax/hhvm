<?php
$host   = getenv("MYSQL_TEST_HOST")   ? getenv("MYSQL_TEST_HOST") : "localhost";
$port   = getenv("MYSQL_TEST_PORT")   ? getenv("MYSQL_TEST_PORT") : 3306;
$user   = getenv("MYSQL_TEST_USER")   ? getenv("MYSQL_TEST_USER") : "root";
$passwd = getenv("MYSQL_TEST_PASSWD") ? getenv("MYSQL_TEST_PASSWD") : "";
$db     = getenv("MYSQL_TEST_DB")     ? getenv("MYSQL_TEST_DB") : "test";

$pdo = new PDO("mysql:dbname=$db;host=$host", $user, $passwd);

try {
  $pdo->query("CREATE TABLE test_native_type (
    true_false TINYINT(1)
  )");

  //$stm = $pdo->query("INSERT INTO test_native_type (true_false) VALUES (1)");
  //$stm->execute();
  //unset($stm);
  $stm = $pdo->query("SELECT true_false FROM test_native_type");
  var_dump($stm->getColumnMeta(0)['native_type']);
} catch (Exception $ex) {
} finally {
  $pdo->query("DROP TABLE test_native_type");
}
