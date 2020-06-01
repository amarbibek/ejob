<?php
$conn = new mysqli("localhost","root","","jobportaldb");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}