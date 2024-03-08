<?php
// Importing the file user.php.
require("./user.php");
/**
 * The pattern for name field.
 */
const PATTERN = "/^[a-zA-Z-' ]*$/";

/**
 * For error messages.
 * fnameErr for first name error.
 * lnameErr for last name error.
 * fullNameErr for full name error.
 */
$fnameErr = $lnameErr = $fullNameErr = "";

/**
 * Method to check the inputs.
 */
function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

/**
 * Creating the method for validating the fist name and last name.
 */
function nameValidation($data, &$errorMsg)
{
    if (empty($data)) {
        $errorMsg = "This is required field.";
        return "";
    } else {
        $name = testInput($data);
        if (!preg_match(PATTERN, $name)) {
            $errorMsg = "Invalid input.";
            return "";
        } else if (empty($name)) {
            $errorMsg = "Invalid input.";
            return "";
        } else {
            return $name;
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = nameValidation($_POST['fname'], $fnameErr);
    $lname = nameValidation($_POST['lname'], $lnameErr);

    if(!empty($_POST['fullName'])){
        $fullNameErr = "This field is not editable.";
    }

    // Accessing image
    $imgName = $_FILES['image']['name'];
    $img_temp_name = $_FILES['image']['tmp_name'];
    move_uploaded_file($img_temp_name, "Uploads/$imgName");
}

// Message to show after successfull submit the form 
if(!empty($fname) && !empty($lname)){
    $message = "Hello, {$fname} {$lname}."; 
}

$user = new User($fname, $lname);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center my-5">
        <h1 class="text-center my-2"><?php echo $message;?></h1>

            <div class="col-6">
                <form class="row g-3 needs-validation" action="<?php echo $SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data"  onsubmit="return checkInputs()">
                    <div class="col-md-8">
                        <label for="validationCustom01" class="form-label">First name
                            <span class="require" id="fnameErr">*</span>
                        </label>
                        <input type="text" class="form-control item" id="fname" name="fname"  value="" minlength="3" maxlength="20" required>
                    </div>
                    <div class="col-md-8">
                        <label for="validationCustom02" class="form-label">Last name
                        <span class="require" id="lnameErr">*</span>
                        </label>
                        <input type="text" class="form-control item" id="lname" name="lname" accept="image/*"  value="" minlength="3" maxlength="20" required>
                    </div>
                    <div class="col-md-8">
                        <label for="validationCustom02" class="form-label">Upload image
                        </label>
                        <input type="file" class="form-control item" name="image"  required>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="submit" >
                    </div>
                </form>
            </div>

            <div class="mt-2" style="width: 100% !important;">
                <?php
                if (!empty($imgName)) { ?>
                    <img src="Uploads/<?php echo $imgName; ?>" height='400' width='400' style='display: block; margin: auto;'>
                    <h4 style='margin: 10px 0; text-align:center;'><?php echo "{$user->getFirstName()} {$user->getLastName()}"; ?></h4>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>