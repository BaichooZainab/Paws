<!--Header-->
<header>

<nav class="navbar navbar-expand-lg " style="background: rgb(77,77,83);
background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">
  <div class="container-fluid">

    <!-- <div class="logo"> <a href="dashboard.php"><img src="../assets/images/paw.jpg" alt="" style="width:100px;height:74px;"/></a> </div> -->

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

     


         <?php
        if(isset($_SESSION['admin_id'])){

         echo '<li class="nav-item">
          <a class="nav-link link-dark mb-3" aria-current="page" href="dashboard.php">Dashboard

          <i class="fa-solid fa-paw fa-fade" style="color: #000000;"></i>

          </a>
        </li>';
         

          echo '<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle link-dark mb-3" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Manage Notice 
        
          <i class="fa-solid fa-bullhorn fa-fade" style="color: #000000;"></i>
          </a>

          <ul class="dropdown-menu" style="background: rgb(195,194,205);
background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">
              <li><a class="dropdown-item" href="view_allnotice.php">view all Notice</a></li>
              <li><a class="dropdown-item" href="delete_notice.php">Delete Notice</a></li>
          </ul>
      </li>';

      echo '<li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle link-dark mb-3" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Manage Pet Type
      <i class="fa-solid fa-dog fa-fade" style="color: #000000;"></i>
      </a>

      <ul class="dropdown-menu" style="background: rgb(195,194,205);
background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">
          <li><a class="dropdown-item" href="addpet_type.php">Add Pet Type</a></li>
          <li><a class="dropdown-item" href="searchpettype.php">Search Pet Type</a></li>
          <li><a class="dropdown-item" href="view_pettype.php">View Pet Type</a></li>
          <li><a class="dropdown-item" href="view_updated_pet_type.php">View Updated Pet Type</a></li>
          <li><a class="dropdown-item" href="view_del_pet_type.php">Delete Pet Type</a></li>
      </ul>
  </li>';


          echo '<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle link-dark mb-3" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Manage Donators
          
          <i class="fa-solid fa-user fa-fade" style="color: #000000;"></i>
          
          </a>

          <ul class="dropdown-menu" style="background: rgb(195,194,205);
background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">
              <li><a class="dropdown-item" href="viewdonator.php">View Donators</a></li>
              <li><a class="dropdown-item" href="searchdonator.php">Search Donators</a></li>
              <li><a class="dropdown-item" href="deletedonator.php">Delete Donators</a></li>
              <li><a class="dropdown-item" href="blockdonator.php">Block Donators</a></li>
          </ul>
      </li>';

      echo '<li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle link-dark mb-3" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Manage Adopters
      
      <i class="fa-solid fa-user fa-fade" style="color: #000000;"></i>

      </a>

      <ul class="dropdown-menu" style="background: rgb(195,194,205);
background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">
          <li><a class="dropdown-item" href="viewadopter.php">View Adopters</a></li>
          <li><a class="dropdown-item" href="s_adopter.php">Search Adopters</a></li>
          <li><a class="dropdown-item" href="d_adopter.php">Delete Adopters</a></li>
          <li><a class="dropdown-item" href="blockadopter.php">Block Adopters</a></li>
      </ul>
  </li>';

  echo '<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle link-dark mb-3" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Request list
  
  <i class="fa-solid fa-hourglass fa-fade" style="color: #000000;"></i>
  
  </a>

  <ul class="dropdown-menu" style="background: rgb(195,194,205);
background: linear-gradient(90deg, rgba(195,194,205,1) 0%, rgba(147,107,47,0.9836309523809523) 49%, rgba(167,170,171,1) 100%);">
      <li><a class="dropdown-item" href="approveadvert.php">Advert Requests</a></li>
      <li><a class="dropdown-item" href="approvetesti.php">Testimonial Requests</a></li>
      <li><a class="dropdown-item" href="approvenotice.php">Notice Requests</a></li>
      <li><a class="dropdown-item" href="approveequip.php">Equipment Requests</a></li>
  </ul>
</li>';

echo '<li class="nav-item">
<a class="nav-link link-dark mb-3" aria-current="page" href="viewadoption.php">Adoption Requests

<i class="fa-solid fa-paw fa-fade" style="color: #000000;"></i>

</a>
</li>';



          echo '<p><a href="dashboard.php" class="btn btn-outline-dark">' .
          $_SESSION["admin_name"] . '</a></p>';
          echo '<p><a href="admin_logout.php" class="btn btn-outline-dark">Logout</a></p>';

        }

      ?>



      </ul>



    </div>
  </div>
</nav>




</header>
<!-- /Header --> 