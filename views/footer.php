    <footer class="footer mt-auto py-3 bg-light">
       
       <div class="container">
          
          <p>&copy;My Awesome Website</p>
  
      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
     <div class="modal-dialog">
    
      <div class="modal-content">
      
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body">
          
       <div class="alert alert-danger" id="errorMessage"></div>
        
        <form>
  
          <div>
              
            <input type="hidden" id="loginActive" value="1">
    
            <label for="email" class="form-label">Email Address</label>
    
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    
         </div>
  
         <div>
    
           <label for="password" class="form-label">Password</label>
    
           <input type="password" class="form-control" id="password" name="password">
  
         </div>
         
       </form>
      
      </div>
      
      <div class="modal-footer">
          
        <a id="toggleForms">Sign Up</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="loginSignup">Login</button>
      </div>
    </div>
  </div>
</div>
   
  </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>

    
<script type="text/javascript">
    
  $("#toggleForms").click(function() { 
   
   if($("#loginActive").val()== "1") {
           
          $("#loginActive").val("0");
          
          $("#toggleForms").html("Login");
          
          $("#loginSignup").html("Sign up");
          
          $("#exampleModalLabel").html("Sign up");
           
       } else {
          
          $("#loginActive").val("1");
          
          $("#toggleForms").html("Sign up");
          
          $("#loginSignup").html("Login");
          
          $("#exampleModalLabel").html("Login");
            
           
       }
       
  })
  
  
  $("#loginSignup").click(function() {

    var email = $("#email").val();

    var password = $("#password").val();

    var loginActive = $("#loginActive").val();
      
     $.ajax({
         
        type:"POST",
        url:"action.php?action=loginsignup",
        data:{email:email, password:password, loginActive:loginActive},
        success:function(result) {
            
            if(result=="1") {
                
                window.location.assign("index.php");
                
            }else {
                
                $("#errorMessage").html(result).show();
                
            }
        }
         
     }); 
      
  });
  
  
  $(".toggleFollow").click(function() {
      
      var id = $(this).attr("data-userId");
      
     $.ajax({
         
         type:"POST",
         url:"action.php?action=toggleFollow",
         data:"userId=" + id,
         success:function(result) {
             
             if(result == "1") {
                 
                 $("a[data-userId='" + id + "']").html("Follow");
                 
             } else if(result == "2") {
                 
                 $("a[data-userId='" + id + "']").html("Unfollow");
                 
             }
             
         }
         
     }) 
      
  })
  
  $("#tweetButton").click(function() {
      
      $.ajax ({
          
         type:"POST",
         url:"action.php?action=postTweets",
         data:"tweetContent=" + $("#tweetContent").val(),
         success:function(result) {
            
            if(result=="1") {
                
                $("#tweetSuccess").show();
                $("#tweeetFail").hide();
            
            }else if(result!="") {
                
               $("#tweetFail").html(result).show();
               $("tweetSuccess").hide();
                
            }
             
         }
          
      })
      
  })
    
</script>
   
  </body>

</html>