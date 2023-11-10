
<!--Header-->
<header class="row">

<div class="container-fluid"> 
    <div class="row"> 
        <div class="d-flex flex-column justify-content-between col-auto bg-dark min-vh-100">
            <div class="mt-4">
               
                 <ul class="nav nav-pills flex-column mt-2 mt-sm-0" id="menu">
                    <li class="nav-item my-sm-1 my-2">
                        <a href="#" class="nav-link text-white text-center text-sm-start" aria-current="page">
                            <i class="fa-solid fa-paw fa-fade" style="color: #ae9561;"></i>
                            <span class="ms-2 d-none d-sm-inline" href="">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item my-sm-1 my-2 disabled">
                        <a href="#sidemenu" data-bs-toggle="collapse" class="nav-link text-white text-center text-sm-start" aria-current="page">
                            <i class="fa-solid fa-dog" style="color: #ae9561;"></i>
                            <span class="ms-2 d-none d-sm-inline">Manage Pet-Type</span>
                            <i class="fa-solid fa-caret-down"></i>
                        </a>

                        <ul class="nav collapse ms-1 flex-column" id="sidemenu" data-bs-parent="#menu">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="addpet_type.php"  aria-current="page">Add Pet-Type</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white" href="searchpettype.php"  aria-current="page">Search Pet-Type</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white" href="view_pettype.php"  aria-current="page">View Pet-Type</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white" href="view_updated_pet_type.php"  aria-current="page">Update Pet-Type</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white" href="view_del_pet_type.php"  aria-current="page">Delete Pet-Type</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item my-sm-1 my-2 disabled">
                        <a href="#sidemenu" data-bs-toggle="collapse" class="nav-link text-white text-center text-sm-start" aria-current="page">
                            <i class="fa-solid fa-user" style="color: #ae9561;"></i>
                            <span class="ms-2 d-none d-sm-inline">Manage Donators</span>
                            <i class="fa-solid fa-caret-down"></i>
                        </a>

                        <ul class="nav collapse ms-1 flex-column" id="sidemenu" data-bs-parent="#menu">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="viewdonator.php"  aria-current="page">View Donators</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white" href="searchdonator.php"  aria-current="page">Search Donators</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white" href="deletedonator.php"  aria-current="page">Delete Donators</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item my-sm-1 my-2 disabled">
                        <a href="#sidemenu" data-bs-toggle="collapse" class="nav-link text-white text-center text-sm-start" aria-current="page">
                            <i class="fa-solid fa-user" style="color: #ae9561;"></i>
                            <span class="ms-2 d-none d-sm-inline">Manage Adopters</span>
                            <i class="fa-solid fa-caret-down"></i>
                        </a>

                        <ul class="nav collapse ms-1 flex-column" id="sidemenu" data-bs-parent="#menu">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="v_adopter.php"  aria-current="page">View Adopters</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white" href="s_adopter.php"  aria-current="page">Search Adopters</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white" href="del_adopter"  aria-current="page">Delete Adopters</a>
                            </li>
                        </ul>
                    </li>
                </ul>       
            </div> 

            <div>
                <div class="dropdown open">
                    <a class="btn border-none outline-none text-white dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-circle-user" style="color: #ae9561;"></i>
                            <span class="ms-1 d-none d-sm-inline">Admin</span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="triggerId">
                        <a class="dropdown-item" href="admin_logout.php">Admin LogOut</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>




</header>
<!-- /Header --> 