<?php
  # Start PHP Session to keep track of whether or not load is getting generated
  session_start();
  
  # Check to see if the user requested load to be generated (GET genload=1) or
  # if the genload session variable has not been set
  if ($_GET['genload'] == 1 && !isset($_SESSION['genload'])) {
    # Load is not being generated, so set session variables and generate load
    $_SESSION['genload'] = 1;   # load is being generated
    $_SESSION['cpuload'] = 100; # initially set cpuload to 100%

    # This will generate load by zipping and unzipping 100M of nothing
    echo exec('dd if=/dev/zero bs=100M count=100 | gzip | gzip -d  > /dev/null &');
    # echo "Generating CPU Load! (auto refresh in 2 seconds)";
    echo "<meta http-equiv=\"refresh\" content=\"2,URL=/\" />";
    exit; 
  }

  # Check to see if cpuload is still high (this variable is set by 
  # getcpuload.php when the load is determined.
  if ($_SESSION['cpuload'] > 50) echo "Performing CPU intensive operations</br>Instance under high CPU Load!";
  else {
    # Load is not being generated for some reason, so unset genload and display
    # a form to allow the user to generated load.
    unset($_SESSION['genload']);
?>
<form action="putcpuload.php" type="GET">
<input type="hidden" name="genload" value="1">
<input type="submit" value="Generate Load">
</form>
<?php } ?>
