<!--Header-->
<header>

<nav class="navbar navbar-expand-lg " style="background: rgb(195,194,205);
background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">
  <div class="container-fluid">

    <div class="logo"> <a href="index.php"><img src="assets/images/paw.jpg" alt="" style="width:100px;height:74px;"/></a> </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

    

        <?php
                if(!isset($_SESSION['aid']) && !isset($_SESSION['did']) && !isset($_SESSION['oid'])){

      echo  '<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle link-dark mb-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Registration</a>
  <ul class="dropdown-menu" style="background: rgb(195,194,205); background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">
  <li><a class="dropdown-item" href="areg.php">Register as Adopter</a></li>
  <li><a class="dropdown-item" href="dreg.php">Register as Donator</a></li>
  <li><a class="dropdown-item" href="orgreg.php">Register as Organisation</a></li>
  </ul>
  </li>';

  
                }

                ?>

        <?php
                if(isset($_SESSION['aid'])){

                  echo '<li class="nav-item">
                  <a class="nav-link link-dark mb-3" aria-current="page" href="notice.php">View Important Notice</a>
                </li>';

                  echo '<li class="nav-item">
                  <a class="nav-link link-dark mb-3" aria-current="page" href="viewpets.php">View Pets for adoption</a>
                </li>';

                  echo '<li class="nav-item">
                  <a class="nav-link link-dark mb-3" aria-current="page" href="addtesti.php">Testify</a>
                </li>';

  echo '<li class="nav-item">
  <a class="nav-link link-dark mb-3" aria-current="page" href="change_apass.php">change Password</a>
</li>';

  echo '<p><a href="updateaprofile.php" class="btn btn-outline-dark">' .
  $_SESSION["an"] . '</a></p>';

  echo '<p><a href="logout.php" class="btn btn-outline-dark">Logout</a></p>';

  }
  
  elseif(isset($_SESSION['did'])){

  echo '<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle link-dark mb-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Manage Pets For adoption</a>
  <ul class="dropdown-menu" style="background: rgb(195,194,205); background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">
  <li><a class="dropdown-item" href="postpets.php">Post your pet</a></li>
  <li><a class="dropdown-item" href="view_postedpets.php">View your posted pets</a></li>
  <li><a class="dropdown-item" href="view_updated_pet.php">Update your pets details</a></li>
  <li><a class="dropdown-item" href="del_pet.php">Delete Your Pet</a></li>
  
  
  </ul>
  </li>';

  echo '<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle link-dark mb-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Manage Equipments</a>
  <ul class="dropdown-menu" style="background: rgb(195,194,205); background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">
  <li><a class="dropdown-item" href="postequip.php">Post Equipmentst</a></li>
  <li><a class="dropdown-item" href="view_postedequip.php">View your posted Equipments</a></li>
  <li><a class="dropdown-item" href="view_updated_equip.php">Update your Equipment details</a></li>
  <li><a class="dropdown-item" href="del_equip.php">Delete Equipment</a></li>
 
  
  </ul>
  </li>';

  echo '<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle link-dark mb-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Announcement</a>
  <ul class="dropdown-menu" style="background: rgb(195,194,205); background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">
  <li><a class="dropdown-item" href="postnotice.php">Post a notice</a></li>
  <li><a class="dropdown-item" href="view_posted_notice.php">View Notice</a></li>
  <li><a class="dropdown-item" href="view_updated_notice.php">Update Notice</a></li>
  <li><a class="dropdown-item" href="del_notice.php">Delete Notice</a></li>
  </ul>
  </li>';

  echo '<li class="nav-item">
  <a class="nav-link link-dark mb-3" aria-current="page" href="change_dpass.php">change Password</a>
</li>';

  echo '<p><a href="updatedprofile.php" class="btn btn-outline-dark">' .
  $_SESSION["dn"] . '</a></p>';
  echo '<p><a href="logout.php" class="btn btn-outline-dark">Logout</a></p>';
  }
  
  elseif(isset($_SESSION['oid'])){


    echo '<li class="nav-item">
      <a class="nav-link link-dark mb-3" aria-current="page" href="add_advert.php">Add Advert</a>
    </li>';
  
    echo '<li class="nav-item">
    <a class="nav-link link-dark mb-3" aria-current="page" href="change_opass.php">change Password</a>
  </li>';
  
    echo '<p><a href="updateoprofile.php" class="btn btn-outline-dark">' .
    $_SESSION["on"] . '</a></p>';
    echo '<p><a href="logout.php" class="btn btn-outline-dark">Logout</a></p>';
    }

    else{
      
      echo '<li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle link-dark mb-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Login</a>
      <ul class="dropdown-menu" style="background: rgb(195,194,205); background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">
      <li><a class="dropdown-item" href="login.php">Log In</a></li>
      <li><a class="dropdown-item" href="orglogin.php">Organisation Log
      In</a></li>
      <li><a class="dropdown-item" href="admin/loginadmin.php">Admin Log
      In</a></li>
      </ul>
      </li>'; 

  }

  ?>


      </ul>

    </div>
  </div>
</nav>




</header>
<!-- /Header --> 