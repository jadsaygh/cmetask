<?php

include __DIR__. "/../config/connect.php";


$sql = "SELECT clients.email, clients.name, companies.company_name FROM clients JOIN companies_clients_r ON clients.id = companies_clients_r.client_id JOIN companies ON companies.id = companies_clients_r.company_id ORDER BY clients.id DESC;";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // Output data of each row
  echo "<table class='table'><tr><th>Name</th><th>Email</th><th>Company Name</th></tr>";
  while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr><td>" . $row["name"]. "</td><td> " . $row["email"]."</td><td>  " . $row["company_name"]. "</td></tr> ";
  }
  echo "</table>";
} else {
  echo "0 results";
}

mysqli_close($conn);

?>