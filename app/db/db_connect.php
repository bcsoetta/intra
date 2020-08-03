<?php

$con = mysqli_connect(host, username, password, dbname);

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQLi";
}
