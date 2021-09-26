<?php
  session_start();
  unset($_SESSION["loginGoogle"]);
  header("Location: http://localhost/correios");