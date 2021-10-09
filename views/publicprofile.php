<div class="container mainContainer">
 
  <div class="row">
    
     <div class="col-8">
         
        <?php if($_GET['userid']) { ?>
        
        <?php displayTweets($_GET['userid']); ?>
        
        <?php }else { ?>
         
        <h2>Activate Users</h2>
        
        <?php displayUsers(); ?>
        
        <?php } ?>
     
     </div>
     
     <div class="col-4">
      
        <?php displaySearch(); ?>
        
        <br><hr><br>
        
        <?php displayTweetBox(); ?>
         
     </div>
  
  </div>
  
</div>