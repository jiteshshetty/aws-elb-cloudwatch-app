<?php
  # This code performs a simple vmstat and grabs the current CPU idle time
  $idle_cpu = exec('vmstat 1 2 | awk \'{ for (i=1; i<=NF; i++) if ($i=="id") { getline; getline; print $i }}\'');

  # Print out the idle time, subtracted from 100 to get the current CPU utilization
  echo 100-$idle_cpu . "%";
  
  # Start a session and record teh current CPU utilization load as a session variable
  session_start();
  $_SESSION['cpuload'] = 100-$idle_cpu;
?>
