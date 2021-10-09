<!DOCTYPE html>

<html lang="en">
  
  <head>

    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="http://mywebdevpractice-com.stackstaging.com/style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
    <title>Twitter</title>
  
  </head>
  
  <body>
    
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  
  <div class="container-fluid">
    
    <a class="navbar-brand" href="index.php">Twitter</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
     
      <span class="navbar-toggler-icon"></span>
   
    </button>
    
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          
          <a class="nav-link" href="?page=timeline">Your Timeline</a>
        
        </li>
        
        <li class="nav-item">
          
          <a class="nav-link" href="?page=yourtweets">Your Tweets</a>
        
        </li>
        
        <li class="nav-item">
          
          <a class="nav-link" href="?page=publicprofile">Public Profile</a>
        
        </li>
      
      </ul>
      
      <div class="d-flex">
          
        <?php if($_SESSION['id']) { ?>
        
        <a class="btn btn-outline-success" href="?function=logout">Logout</a>
        
        <?php } else{ ?>
        
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Login/Signup</button>
        
        <?php } ?>
        
      </div>
    
    </div>
  
  </div>

</nav>