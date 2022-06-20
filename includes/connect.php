<?php

   $connect = mysqli_connect('localhost', 'root', '', 'bank');

   if(!$connect) {
       die('Error connect database');
   }

