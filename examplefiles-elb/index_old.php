<?php
  # Get the instance ID from meta-data and store it in the $instance_id variable
  $url = "http://169.254.169.254/latest/meta-data/instance-id";
  $instance_id = file_get_contents($url);

  # Print the Instance ID
  echo "Instance ID: <b>" . $instance_id . "</b><br/>";

  # Get the instance's availability zone from metadata and store it in the $zone variable
  $url = "http://169.254.169.254/latest/meta-data/placement/availability-zone";
  $zone = file_get_contents($url);

  # Print the Availability Zone
  echo "Zone: <b>" . $zone . "</b><br/>";

  # Include RDS configuration
  include 'rds.conf.php';
  if ($RDS_URL == "") {
	# RDS not configured, so show load generation info
	# Get the instance CPU Load
  	echo "CPU Load: <b>";
  	include 'getcpuload.php';
  	echo "</b>";

  	# Get the instance CPU Load Generation form
  	echo "<p>";
  	include 'putcpuload.php';

  	# Check to see if genload session variable has been set, if so, refresh periodically
  	session_start();
  	if (isset($_SESSION['genload'])) echo "<meta http-equiv=\"refresh\" content=\"5\" />";
  } else {
	# RDS configured, so show address book
	include 'addressbook.php';
  }
?>
