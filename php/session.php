<?php    

    session_start();
    session_set_cookie_params(2*7*24*60*60);
    // Making the cookie live for 2 weeks


    if( $_SESSION['UserId'] && !isset($_COOKIE['gpmRemember']) )
    {
        // If you are logged in, but you don't have the gpmRemember cookie (browser restart)

        $_SESSION = array();
        session_destroy();

        // Destroy the session
    } 

    $mysql_host = "mysql1.000webhost.com";
    $mysql_database = "a3120811_gpm";
    $mysql_user = "a3120811_plleras";
    $mysql_password = "Canada2654";
    $con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database);

    //if($_POST['submit']=='Login')
    //{
        // Checking whether the Login form has been submitted
        $err = array();
        // Will hold our errors

        if(!$_POST['email'] || !$_POST['password'])
            $err[] = 'All the fields must be filled in!';

        if(!count($err))
        {
            $_POST['email'] = mysqli_real_escape_string($con,$_POST['email']);
            $_POST['password'] = mysqli_real_escape_string($con,$_POST['password']);

            // Escaping all input data

            $row = mysqli_fetch_assoc(mysqli_query($con,"SELECT UserId,Email,FirstName FROM Users WHERE Email='{$_POST['email']}' AND Password='".md5($_POST['password'])."'"));

            if($row['Email'])
            {
                // If everything is OK login

                $_SESSION['Email']=$row['Email'];
                $_SESSION['UserId'] = $row['UserId'];
                $_SESSION['Name'] = $row['FirstName'];

                // Store some data in the session
                setcookie('gpmRemember',$_POST['rememberMe']);
                //echo '<script type="text/javascript">alert("loged in!");</script>'; 
            }
            else $err[]='Wrong email and/or password!';
        }

        if($err){
            // Save the error messages in the session
            $_SESSION['msg']['login-err'] = implode('<br />',$err);
            //echo $_SESSION['msg']['login-err']; 
        }
        //echo $_SESSION['UserId'];

        //Get scores from DB and cache them
        $uid = $_SESSION['UserId'];
        $result = mysqli_query($con,"SELECT * FROM `Scores` WHERE UserId = '".$uid."'");
        $result1 = mysqli_query($con,"SELECT * FROM `Bonus` WHERE UserId = '".$uid."'");

        while($srow = mysqli_fetch_assoc($result)){
           
            if($srow['UserId']){
                $key1 = $srow['RoundNum']."M".$srow['GameNum']."A";
                $val1 = $srow['Team1'];
                $key2 = $srow['RoundNum']."M".$srow['GameNum']."B";
                $val2 = $srow['Team2'];

                $_SESSION[$key1] = $val1;
                $_SESSION[$key2] = $val2;
            }
        }

        $keys = array("A1","A2","B1","B2","C1","C2","D1","D2","E1","E2","F1","F2","G1","G2","H1","H2" );
        while($srow = mysqli_fetch_assoc($result1)){            
            if($srow['UserId']){            
                $count = 0;
                while($count <=15){
                    $val = $srow[$keys[$count]];
                    $_SESSION[$keys[$count]] = $val;
                    $count++;
                }
            }
        }

        header("Location: http://www.gpm2014.tk#page-top");
        exit;
    //}
?>