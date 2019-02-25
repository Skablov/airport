<?php
  include('bd.php');
  header('Content-Type: text/html; charset=UTF-8');
  header("HTTP/1.1 200 OK");

  switch ($_POST['command'])
  {
    case 'read':
      $result = mysql_query("SELECT * FROM flight",$db);
      $r = array();
      while($res = mysql_fetch_array($result))
      {
        array_push($r,$res['id'],$res['place_d'],$res['land_a'],$res['dep'],$res['ari'],$res['places']);
      }
      echo json_encode($r);
      break;

    case 'add_pas':
      $id = $_POST['select'];
      $date = $_POST['date'];
      $type = $_POST['type'];
      $name = $_POST['name'];
      $result = mysql_query("SELECT places FROM local WHERE id='$id' and date_d='$date'",$db);
      $res = mysql_fetch_array($result);
      if(empty($res['places']))
      {
        $re = mysql_query("SELECT places FROM flight WHERE id='$id'",$db);
        $res = mysql_fetch_array($re);
        $places = $res['places'] - 1;
        $result = mysql_query("INSERT INTO local (id,date_d,places) VALUES ('$id','$date','$places')",$db);
        $r = mysql_query("INSERT INTO passangers (id,date_d,name,type) VALUES ('$id','$date','$name','$type')",$db);
        echo 'Успешно';
        break;
      }
      else
      {
        if($res['places'] == 0)
        {
          echo 'Мест на данный рейс нету!';
          break;
        }
        else {
          $places = $res['places'] - 1;
          $result = mysql_query("UPDATE local SET places='$places' WHERE id='$id' and date_d='$date'",$db);
          $r = mysql_query("INSERT INTO passangers (id,date_d,name,type) VALUES ('$id','$date','$name','$type')",$db);
          echo 'Успешно';
          break;
        }
      }
    case 'del':
      $id = $_POST['id'];
      $result = mysql_query("DELETE FROM flight WHERE id='$id'",$db);
      echo 'Успешно!';
      break;
    case 'add_fl':
      $ari = $_POST['ari'];
      $dep = $_POST['dep'];
      $number = $_POST['number'];
      $time_d = $_POST['time_d'];
      $time_a = $_POST['time_a'];
      $result = mysql_query("INSERT INTO flight (place_d, land_a, dep, ari, places) VALUES ('$dep','$ari','$time_d','$time_a','$number')", $db);
      echo 'Успешно! БД обновлена!';
      break;

  }

 ?>
