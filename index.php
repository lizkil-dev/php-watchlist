<?php
session_start();

$link = mysqli_connect("localhost", "root", "", "moviedb");
mysqli_query($link, "SET names utf8");


if(isset($_GET["seite"]) && $_GET["seite"] == "logout")
{
	session_destroy();
	unset($_SESSION);
	setcookie("keep_login", "", time() -1); 
	unset($_COOKIE["keep_login"]); 
}



if(isset($_POST["user"]) && isset($_POST["password"]))
{
	if($_POST["user"] == "Lisa" && $_POST["password"] == "Lustig")
	{
		$_SESSION["loggedin"] = true;
		$_SESSION["user"] = "Lisa";
		if(isset($_POST["stay_loggedin"]))
		{
			setcookie("keep_login", "Lisa", time() + 60*60*24*365);
		};
		header("Location: ?seite=admin");
		exit;
	}
	else
	{
		$_SESSION["note"] = "<span class='warning'>Login not succesfull!</span></br>";
	}
}

if (isset($_COOKIE["keep_login"]))
{
	$_SESSION["loggedin"] = true;
	$_SESSION["user"] = "Lisa";
}
?>
<html>
<head>
	<title>MovieDB</title>
	<meta charset="utf-8" />	
	<link rel="stylesheet" href="css/style.css" />	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
	<nav>
	<a href="?seite=home">Home</a>
	

	<?php
	if(isset($_SESSION["loggedin"]))
	{
		// echo '<a href="?seite=admin">Admin</a>';
		echo '<a href="?seite=logout">Logout</a>';
	}
	else
	{
		echo '<a href="?seite=login">Login</a>';
	}
?>
	</nav>		
</header>

<main>
<?php

if(isset($_SESSION["note"]))
{
	echo $_SESSION["note"]; 
	unset($_SESSION["note"]); 
}

if(!isset($_GET["seite"]))
{
	$_GET["seite"] = "home"; 
}

switch($_GET["seite"])
{
	case "home":
		include("php/home.php"); 
	break;	
	case "login": 
		include("php/login.php"); 
	break; 
	case "logout": 
		include("php/logout.php"); 
	break; 
	case "admin": 
		if(isset($_SESSION["loggedin"]))
		{ 
			include("php/admin.php"); 
		 } 
		 else 
		{ 
			 header("Location: ?seite=login"); 
			 exit; 
		 }	 
	break;	 
	default:
		include("html/404.html"); 
}

?>

</main>

<footer>

</footer>

</body>
</html>
<?php
mysqli_close($link);
?>