<?php
  $username = "root";
  $password = "rootpass";
  $hostname = "localhost";
  $dbname = "muellkalender";

  //Datenbankverbindung aufbauen
  $mysqli = new mysqli($hostname, $username, $password, $dbname);
