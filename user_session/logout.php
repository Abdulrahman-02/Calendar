<?php

session_start();
session_unset();
session_destroy();

//retourner à index.php
header("location: ../index.php");