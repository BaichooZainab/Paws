<?php

function checkUserAuth(){
    if (!isset($_SESSION['aid']) && !isset($_SESSION['did']) && !isset($_SESSION['oid'])) {
        header("Location: index.php");
    }
    }

    function validateOldPass()
{
if (strlen($_POST['txtoldpass']) < 1) {
return 'Old Password is required';
}
}
function validateCPass()
{
if ($_POST['txtnewpass'] != $_POST['txtcpass']) {
return 'Password does not match';
}
}

function validateNPass()
{
if ($_POST['txtnewpass'] < 1) {
return 'Password is required';
}
}


function validateOPass()
{
if (strlen($_POST['txtoldpass']) < 1) {
return 'Old Password is required';
}
}
function validateConPass()
{
if ($_POST['txtnewpass'] != $_POST['txtcpass']) {
return 'Password does not match';
}
}

function validateNewPass()
{
if ($_POST['txtnewpass'] < 1) {
return 'Password is required';
}
}


function validateEmptyField($input, $field)
{
// Data validation for empty fields
if (strlen($input) <= 3) {
return "$field is required";
}
}

function validateFileUp(){
    if ( strlen($_FILES['filestandpic']['name']) < 1) {
    return 'File upload is mandatory!';
    }
}



function validateFileUpPoster(){
    if ( strlen($_FILES['fileposter']['name']) < 1) {
    return 'File upload is mandatory!';
    }
}

function flashMessages(){
    if ( isset($_SESSION["errormsg"]) ) {
    echo('<p style="color:red">'. $_SESSION["errormsg"] . '</p>');
     //delete the session
     unset($_SESSION['errormsg']);
    }
    if ( isset($_SESSION['successmsg']) ) {
    echo '<p style="color:green">'. $_SESSION['successmsg'] . '</p>';
     //delete the session
     unset($_SESSION['successmsg']);

     
    } 
}

function validateTName(){
    if ( strlen($_POST['txttname']) < 1) {
    return 'Testify name required';
    }
}

function validateEquipName(){
    if ( strlen($_POST['txtename']) < 1) {
    return 'Equip name required';
    }
}

function validateNoticeName(){
    if ( strlen($_POST['txtnoticename']) < 1) {
    return 'Notice name required';
    }
}

    function validateFileUpPic(){
    if ( strlen($_FILES['filepic']['name']) < 1) {
    return 'File upload is mandatory!';
    }
    }

    function validateSpeciesName(){
        if ( strlen($_POST['txtspecies']) < 1) {
        return 'Species Name required';
        }
    }

    function validatePet(){
        if ( strlen($_POST['txtpetname']) < 1) {
        return 'Pet name required';
        }
    }

    function validateImage(){
        if ( strlen($_FILES['pet_image']['name']) < 1) {
        return 'Pictire upload is mandatory!';
        }
    }
    function validateDUName(){
        if ( strlen($_POST['txtduname']) < 1) {
        return 'Donator Name required';
        }
    }

    function validatepic(){
        if ( strlen($_FILES['pic']['name']) < 1) {
        return 'picture is mandatory!';
        }
    }



    function validateFirstName(){
        if ( strlen($_POST['txtdfname']) < 1) {
        return 'First name is required';
        }
        }

        function validateOrgName(){
            if ( strlen($_POST['txtoname']) < 1) {
            return 'Org Name is required';
            }
            }


        function validatefname(){
            if ( strlen($_POST['txtafname']) < 1) {
            return 'First name is required';
            }
            }

            function validateOrgPic(){
                if ( strlen($_FILES['org_profile']['name']) < 1) {
                return 'File up is mandatory!';
                }
                }

        function validateFileProfilePic(){
        if ( strlen($_FILES['d_profile']['name']) < 1) {
        return 'File up is mandatory!';
        }
        }

        function validateFileProfile(){
            if ( strlen($_FILES['a_profile']['name']) < 1) {
            return 'File up is mandatory!';
            }
            }


        function validateEmail()
        {
        if (strlen($_POST['txtemail']) < 1) {
        return 'Email is required';
        } else if (strpos($_POST['txtemail'], '@') < 1) {
        return "Invalid Email";
        }
        }
        function validatePass()
        {
        if (strlen($_POST['txtpass']) < 1) {
        
        return 'Password is required';
        }
        }

        function validateOEmail()
        {
        if (strlen($_POST['txtoemail']) < 1) {
        return 'Email is required';
        } else if (strpos($_POST['txtoemail'], '@') < 1) {
        return "Invalid Email";
        }
        }
        function validateOP()
        {
        if (strlen($_POST['txtopass']) < 1) {
        
        return 'Password is required';
        }
        }

        function validateAdminName()
        {
        if (strlen($_POST['txtadname']) < 1) {
        return 'Admin Name is required';
        } 
        }

        function validateAdminPass()
        {
        if (strlen($_POST['txtadpass']) < 1) {
        
        return 'Admin Password is required';
        }
        }
        

        function validatemail()
        {
        if (strlen($_POST['txtdemail']) < 1) {
        return 'Email is required';
        } else if (strpos($_POST['txtdemail'], '@') < 1) {
        return "Invalid Email";
        }
        }
        function validatep()
        {
        if (strlen($_POST['txtdpass']) < 1) {
        
        return 'Password is required';
        }
        }

function validateNumericField($input, $field)
{
// Data validation to check numeric entries
if (!is_numeric($input)) {
return "$field is invalid";
}
}


?>