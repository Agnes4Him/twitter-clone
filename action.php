<?php 

 include("functions.php");
 
 if($_GET['action'] == "loginsignup") {
     
     $error ="";
     
     if(!$_POST['email']) {
         
         $error .="An email address is required<br>";
     }
     
     else if(!$_POST['password']) {
         
         $error .="A password is required<br>";
         
     }
     
     else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
         
         $error .= "That email address is not valid<br>";
         
     }
     
     if($error!="") {
         
         echo $error;
     
     } else {
         
       if($_POST['loginActive']== "0") {
         
         $query = "SELECT * FROM twitterinfo WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
     
         $result=mysqli_query($link, $query);
         
         if(mysqli_num_rows($result) > 0) {
             
             $error = "That email address has been taken";
             
         } else {
             
           $query = "INSERT INTO twitterinfo (email, password) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."','".mysqli_real_escape_string($link, $_POST['password'])."')";
           
           if(!mysqli_query($link, $query)) {
               
               $error = "Sorry, could not sign you up. Try again later";
               
           } else {
               
               $_SESSION['id'] = mysqli_insert_id($link);
               
               $query = "UPDATE twitterinfo SET password='".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id='".mysqli_insert_id($link)."' LIMIT 1";
               
               mysqli_query($link, $query);
               
               echo 1;
               
           }
         }
         
        } else {
            
          $query = "SELECT * FROM twitterinfo WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
        
          $result=mysqli_query($link, $query);
          
          $row = mysqli_fetch_assoc($result);
          
          $hashedPassword = md5(md5($row['id']).$_POST['password']);
          
          if($hashedPassword == $row['password']) {
              
             echo 1; 
             
             $_SESSION['id'] = $row['id'];
              
          } else {
              
              $error = "That password does not exist";
              
          }
            
        }
     
     if($error!="") {
         
         echo $error;
         
     }
         
 }
 
}

if($_GET['action']=="toggleFollow") {
    
    $query="SELECT * FROM isFollowing WHERE follower='".mysqli_real_escape_string($link, $_SESSION['id'])."'AND isFollowing='".mysqli_real_escape_string($link, $_POST['userId'])."' LIMIT 1";
    
    $result=mysqli_query($link, $query);
    
    if(mysqli_num_rows($result) > 0) {
        
       $row=mysqli_fetch_assoc($result); 
       
      mysqli_query($link, "DELETE FROM isFollowing WHERE id='".mysqli_real_escape_string($link, $row['id'])."' LIMIT 1");
      
      echo "1";
      
    } else {
        
         mysqli_query($link, "INSERT INTO isFollowing (follower, isFollowing) VALUES ('".mysqli_real_escape_string($link, $_SESSION['id'])."','".mysqli_real_escape_string($link, $_POST['userId'])."')");
        
        echo "2";
    }
}

if($_GET['action']=="postTweets") {
    
    if(!$_POST['tweetContent']) {
        
        echo "Your tweet is empty";
    }
    
    else if(strlen($_POST['TWEETContent']) > 150) {
        
        echo "Your tweet is too long";
        
    }
    
    else {
        
        mysqli_query($link, "INSERT INTO tweet (tweets, userid, datetime) VALUES ('".mysqli_real_escape_string($link, $_POST['tweetContent'])."','".mysqli_real_escape_string($link, $_SESSION['id'])."',NOW())");
        
        echo "1";
    }
    
}
 
?>