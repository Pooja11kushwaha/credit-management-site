<?php
    require_once('db.php'); //connect to database

    $query = "select * from users";
    $result = mysqli_query($link,$query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<style> 
         p 
         { 
         margin:80px 100px 50px 80px; 
         } 
      </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <title>credit management</title>
</head>
<body>
  <header class="text-gray-700 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
      <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
          <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
        </svg>
        <span class="ml-3 text-xl"><p>LIST OF ALL USERS</p></span>
      </a>
      <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
        <a class="mr-5 hover:text-gray-900 " onclick="location.href=''">User Detail</a>
        <a class="mr-5 hover:text-gray-900"></a>
      </nav>
      <button class="inline-flex items-center bg-gray-200 border-0 py-1 px-3 focus:outline-none hover:bg-gray-300 rounded text-base mt-4 md:mt-0">click on the transfer credits
        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class=" " viewBox="0 0 24 24">
          <path d="M5 12h14M12 5l7 7-7 7"></path>
        </svg>
      </button>
    </div>
  </header>
  <style>
table
{
border-collapse: collapse;
width: 100%;
color: #588c7e;
font-family: monospace;
font-size: 25px;
text-align: left;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
        <table>
			<thead>
      <p>
				<tr>
                    <th>S No.</th>
    				<th>Name</th>
    				<th>Email</th>
    				<th>Credits</th>
                    <th>transfer</th>
				</tr>
			</thead>

            <!--fetch and display data from MySQL-->
            <?php
                $i=1;

                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["credit"] . "</td>";
                    echo "<td><a href=transfer.php?name=" . $row['name'] . ">Transfer credits</a><td>";
                    echo "</tr>";
                    ++$i;
                }
            ?>

        </p>
        </table>
    </body>
</html>
