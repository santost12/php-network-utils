<!DOCTYPE html>
<html>
<head>
<title>PHP network utils</title>
<style>
* {
  font-size: 105%;
}

pre {
  font-family: 'Courier New', monospace;
  color: lightgreen;
}

body {
  background-color: black;
}
</style>
</head>
<body>

<form method="get">
<select name="action">
  <option value="ipv4-ping">IPv4 ping</option>
  <option value="ipv4-routes">IPv4 routes</option>
  <option value="ipv4-trace">IPv4 traceroute</option>

  <option value="ipv6-ping">IPv6 ping</option>
  <option value="ipv6-routes">IPv6 routes</option>
  <option value="ipv6-trace">IPv6 traceroute</option>
</select>
  <input type="text" name="ip" placeholder="IP address"/><br><br>
  <input type="submit" name="submit"/>
</form>
<?php
if (isset($_GET['submit'])) {
  $action = $_GET['action'];
  $ipaddr = $_GET['ip'];


  function ping($ipaddr) {
    if(empty($ipaddr)) {
      echo "<pre>Error: You need to enter an IP address or domain name</pre>";
      exit();
    }

    $cmd = "ping -c3 $ipaddr 2>&1";
    $output = shell_exec($cmd);
    echo "<pre>$output</pre>";
  }


  function get_all_routes() {
    $output = shell_exec("ip route");
    echo "<pre>$output</pre>";
  }


  function get_all_routes_v6() {
    $output = shell_exec("ip -6 route");
    echo "<pre>$output</pre>";
  }


  function traceroute($ipaddr) {
    if (empty($ipaddr)) {
      echo "<pre>Error: You need to enter an IP address or domain name</pre>";
      exit();
    }

    $cmd = "traceroute -q 2 -n $ipaddr 2>&1";
    $output = shell_exec($cmd);
    echo "<pre>$output</pre>";
  }


  switch($action) {
    case "ipv4-ping":
    case "ipv6-ping":
      ping($ipaddr);
      break;

    case "ipv4-routes":
      get_all_routes();
      break;

    case "ipv6-routes":
      get_all_routes_v6();
      break;

    case "ipv4-trace":
    case "ipv6-trace":
      traceroute($ipaddr);
      break;
  }
}
?>
</body>
</html>
