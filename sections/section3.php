<h1 class="title"> Matched Clients </h1>
<table class='table'>
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Company Name</th>
  </tr>

<?php 
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://ah-devsec.com/test/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  $data = json_decode($response, true);

  
  include __DIR__. "/../config/connect.php";


  
  foreach($data as $client) {
    $name = $client['name'];
    $email = $client['email'];
    $sql = "SELECT clients.email, clients.name, companies.company_name FROM clients JOIN companies_clients_r ON clients.id = companies_clients_r.client_id JOIN companies ON companies.id = companies_clients_r.company_id WHERE clients.name = '$name' AND clients.email = '$email';";

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr><td>" . $row["name"]. "</td><td> " . $row["email"]."</td><td>  " . $row["company_name"]. "</td></tr> ";
    }
  }

?>
</table>