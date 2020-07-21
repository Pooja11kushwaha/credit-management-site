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
    <title><p>credit management</p></title>
</head>

<body>
  <header class="text-gray-700 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
      <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
          <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
        </svg>
        <span class="ml-3 text-xl">SELECTED USER FOR  CREDITS TRANSFER </span>
      </a>
      <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
       
      </nav>
      
    </div>
  </header>
<?php
    require_once('db.php'); //connect to database

    $name = $_GET['name'];
    $query = "select * from users where name='" . $name . "'";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_array($result);
    
    $query = "select name from users where name<>'" . $row['name'] . "'";
    $result = mysqli_query($link,$query);

    if(isset($_POST['transfer'])) {
        if($_POST['credits_tr'] > $row['credit']) {
            echo "Credits transferred cannot be more than " . $row['credit'] . "<br>";
        }

        else {
            $query = "update users set credit=credit-" . $_POST['credits_tr'] . " where name='" . $row['name'] . "'";
            mysqli_query($link,$query);

            $query = "update users set credit=credit+" . $_POST['credits_tr'] . " where name='" . $_POST['to_user'] . "'";
            mysqli_query($link,$query);

            $query = "insert into transfers values('" . $row['name'] . "','" . $_POST['to_user'] . "'," . $_POST['credits_tr'] . ")";
            mysqli_query($link,$query);

            header("Location: user.php");
        }
    }
?>

<html>
	<head>
        <title><p>Transfer Credits</P></title>
    </head>
    

    <body>
    <p>
    <div class="flex md:mt-4 mt-6">
          <button class="inline-flex text-white bg-indigo-500 border-0 py-1 px-4 focus:outline-none hover:bg-indigo-600 rounded" onclick="location.href='user.php'">BACK</button>
          
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
              <path d=""></path>
            </svg>
          </a>
        </div>
        <br><br>
        <p style="color:#008080"><b>Hello <?php echo $row['name'] ?>,</b></p>
        <br>
        <p style ="color:#008080"><b>Your credits are: <?php echo $row['credit'] ?></b></p>

        <br></br>

        <form action="#" method="post">
            <fieldset>
  

                <legend>

                <div class="w3-panel w3-leftbar w3-border-blue w3-pale-blue">
    <p><b>TRANSFER DETAILS</b></p>
  </div>
  </legend>
  <p style ="color:#008080"><b> Credits: <input type="number" name="credits_tr" min =0 value=1 required></b></p>
                <br><br>
                <p style ="color:#008080"><b> Transfer to: <select name="to_user" required></b></p>
                    <option value =""></option>

                <?php
                        while($tname = mysqli_fetch_array($result)) {
                            echo "<option value='" . $tname['name'] . "'>" . $tname['name'] . "</option>";
                        }
                ?>

                </select>
                <br>
            </fieldset>
            <br>
            <b><input type="submit" name="transfer" value="Transfer"></b>
        </form>
        </p>
    </body>
</html>
