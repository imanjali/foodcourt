<html>
<head>
<title>secure login form</title>
</head>
<body>
<?php

                        if(!defined("HOST"))
                        {
                            define("HOST","localhost");
                        }
                        if(!defined("USER"))
                        {
                            define("USER","root");
                        }
                        if(!defined("PASSWORD"))
                        {
                            define("PASSWORD","");
                        }
                        if(!defined("DATABASE"))
                        {
                            define("DATABASE","foodcourt");
                        }
                        $mysqli=new mysqli(HOST,USER,PASSWORD,DATABASE);
						$username=$_POST['username'];
                        $password=$_POST['password'];
						
						if(isset($_POST['submit']))
						{
							if(empty($_POST['username']) || empty($_POST['password']))
							{
								echo "fill all the details";
							}
							else
							{
								$user_string=mysql_real_escape_string($username);
								$pass_string=mysql_real_escape_string($password);
								$stm=$mysqli->prepare("select password from foodcourt.signup where username='$user_string'");
								$stm->execute();
								$stm->bind_result($passfromdb);
								$stm->store_result();
								if($stm->fetch() && $passfromdb==$pass_string)
								{
									session_start();
								    $_SESSION['name']=$username;
								    header("location:next.php");
								}
								else
								{
									echo "enter correct username or password";
								}
							}
						}
						
	
?>
<form name="login" action="" method="post">
<input type="text" name="username" placeholder="user" />
<input type="password" name="password" placeholder="password" />
<input type="submit" name="submit" value="submit" />
</form>
</body>
</html>