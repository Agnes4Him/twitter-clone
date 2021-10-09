<?php

  session_start();

  $link=mysqli_connect("localhost:8889", "root", "root", "twitter");
  
  if(mysqli_connect_error()) {
      
      die("Could not connect to database");
  }
  
  if($_GET['function']=="logout") {
      
      session_unset();
  }
  
  function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'min'),
        array(1 , 'sec')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}
  
  function displayTweets($type) {
      
      global $link;
      
      if($type == 'public') {
          
          $whereClause="";
     
      } else if($type=='isFollowing') {
          
          $query = "SELECT * FROM isFollowing WHERE follower='".mysqli_real_escape_string($link, $_SESSION['id'])."'";
          
          $result = mysqli_query($link, $query);
          
          $whereClause="";
      
          while($row=mysqli_fetch_assoc($result)) {
          
             if($whereClause=="") {
              
                $whereClause="WHERE";
          
             }else{
              
                $whereClause.=" OR";
          
            }
            
            $whereClause.=" userid=".$row['isFollowing'];
            
          }
          
      }
      
      else if($type=='yourtweets') {
          
          $whereClause = "WHERE userid='".mysqli_real_escape_string($link, $_SESSION['id'])."'";
          
      }
      
      else if($type=='search') {
          
          '<p>Showing search results for"'.mysqli_real_escape_string($link, $_GET['q']).'":</p>';
          
          $whereClause = "WHERE tweets LIKE '%".mysqli_real_escape_string($link, $_GET['q'])."%'";
          
      }
      
      else if(is_numeric($type)) {
          
          $userQuery="SELECT * FROM twitterinfo WHERE id='".mysqli_real_escape_string($link, $type)."' LIMIT 1";
          
          $userQueryResult=mysqli_query($link, $userQuery);
          
          $user=mysqli_fetch_assoc($userQueryResult);
          
          echo "<h2>".mysqli_real_escape_string($link, $user['email'])."'s Tweets</h2>";
          
          $whereClause = "WHERE userid='".mysqli_real_escape_string($link, $type)."'";
          
      }
      
      $query="SELECT * FROM tweet ".$whereClause." ORDER BY 'datetime' DESC LIMIT 10";
      
      $result = mysqli_query($link, $query);
      
      if(mysqli_num_rows($result) == 0) {
      
      echo "There are no tweets to display";
      
    } else {
        
        while($row=mysqli_fetch_assoc($result)) {
            
            $userQuery="SELECT * FROM twitterinfo WHERE id='".mysqli_real_escape_string($link, $row['userid'])."' LIMIT 1";
            
            $userQueryResult=mysqli_query($link, $userQuery);
            
            $user=mysqli_fetch_assoc($userQueryResult);
            
            echo "<div id='tweet'><p><a href='?page=publicprofile&userid=".$user['id']."'>".$user['email']."</a> <span id='time'>".time_since(time()-strtotime($row['datetime']))." ago</span></p>";
            
            echo "<p>".$row['tweets']."</p>";
            
            echo "<p><a class='toggleFollow' data-userId='".$row['userid']."'>";
            
            $isFollowingQuery="SELECT * FROM isFollowing WHERE follower='".mysqli_real_escape_string($link, $_SESSION['id'])."' AND isFollowing='".mysqli_real_escape_string($link, $row['userid'])."' LIMIT 1";
            
            $isFollowingQueryResult=mysqli_query($link, $isFollowingQuery);
            
            if(mysqli_num_rows($isFollowingQueryResult) > 0) {
                
                echo "Unfollow";
                
            } else{
                
                echo "Follow";
                
            }
            
            echo "</a></p></div>";
            
        }
        
    }
    
  }
  
  function displaySearch() {
      
      echo '<div class="form-inline"><input type="text" placeholder="Search" name="q" id="search"><input type="hidden" name="page" value="search"><button class="btn btn-primary">Search Tweets</button></div>';

  }
  
  function displayTweetBox() {
      
      if($_SESSION['id'] > 0) {
          
       echo '<div class="alert alert-success" role="alert" id="tweetSuccess">Your tweet has been successfully sent!</div><div class="alert alert-danger" role="alert" id="tweetFail"></div><div class="form-inline"><input type="textarea" id="tweetContent"><button class="btn btn-primary" id="tweetButton">Post Tweets</button></div>';
   
          
      }
  }
  
  function displayUsers() {
      
      global $link;
      
      $query="SELECT * FROM twitterinfo LIMIT 10";
      
      $result=mysqli_query($link, $query);
      
      while($row = mysqli_fetch_assoc($result)) {
          
          echo "<p><a href='?page=publicprofile&userid=".$row['id']."'>".$row['email']."</a></p>";
          
      }
      
  }