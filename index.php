<?php
// Importing the file user.php.
require("./user.php");
/**
 * The pattern for name field.
 */
const NAMEPATTERN = "/^[a-zA-Z-' ]*$/";

const PHONEPATTERN = "/^(\+91)[1-9][0-9]{9}$/";
$errors = [];
$subjects = [];
$marks = [];

/**
 * Make a instace of class user.
 */
$user = new User();


/**
 * Check if method is post or not.
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check and and set the First name.
    $fname = User::testInput($_POST['fname']);

    // Check and and set the Last name.
    $lname = User::testInput($_POST['lname']);

    // Validate and set the First name.
    $fname = $user->nameValidate($fname, NAMEPATTERN, 'fname');

    // Validate and set the Last name.
    $lname = $user->nameValidate($lname, NAMEPATTERN, 'lname');

    // Validate and set the Last name.
    $phone = $user->validatePhone($_POST['phone'], PHONEPATTERN, 'phone');

    // Validate Subject marks pair.
    $user->validateSubjectMarks($_POST['marks'], 'textarea');

    // Set the subject array.
    $subjects = $user->getSubject();

    // Set marks
    $marks = $user->getMarks();

    // Set errors.
    $errors = $user->getError();

    // Accessing image
    $imgName = $_FILES['image']['name'];
    $img_temp_name = $_FILES['image']['tmp_name'];
    move_uploaded_file($img_temp_name, "Uploads/$imgName");
}

// Message to show after successfull submit the form 
if (!empty($fname) && !empty($lname)) {
    $message = "Hello, {$fname} {$lname}.";
}

?>
<!-- HTML start from here.-->
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
            <h1 class="text-center my-2"><?php echo $message; ?></h1>
            <p class="text-center my-2"><?php echo $phone; ?></p>
            <div class="col-12 col-md-10 col-lg-6">
                <form class="row g-3 needs-validation" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" onsubmit="return checkInputs()">

                    <!-- Field to take input of first name. -->
                    <div class="col-md-8">
                        <label for="validationCustom01" class="form-label">First name
                            <span class="require" id="fnameErr">* <?php echo $errors['fname']; ?></span>
                        </label>
                        <input type="text" class="form-control item" id="fname" name="fname" value="<?php echo $_POST['fname']?>" minlength="3" maxlength="20" required>
                    </div>

                    <!-- Field to take input of last name. -->
                    <div class="col-md-8">
                        <label for="validationCustom02" class="form-label">Last name
                            <span class="require" id="lnameErr">* <?php echo $errors['lname']; ?></span>
                        </label>
                        <input type="text" class="form-control item" id="lname" name="lname" value=" <?php echo $_POST['lname']?> " minlength="3" maxlength="20" required>
                    </div>
                    <!-- Field to take input of last name. -->
                    <div class="col-md-8">
                        <label for="validationCustom02" class="form-label">Phone
                            <span class="require" id="phoneErr">* <?php echo $errors['phone']; ?></span>
                        </label>
                        <input type="text" class="form-control item" id="phone" name="phone" value=" <?php echo $_POST['phone']?>" minlength="3" maxlength="20" required>
                    </div>

                    <!-- Field to take input of image -->
                    <div class="col-md-8">
                        <label for="validationCustom02" class="form-label">Upload image
                        </label>
                        <input type="file" class="form-control item" name="image" accept="image/*" required>
                    </div>

                    <!-- Field to take input of subject marks pair. -->
                    <div class="col-md-8">
                        <label for="floatingTextarea2">Subject marks (Format: Subject|Marks)
                            <span class="require" id="marksErr">* <?php echo $errors['textarea']; ?></span>
                        </label>
                        <div class="form-floating">
                            <textarea class="form-control" id="marks" style="height: 100px" name="marks" value = "<?php echo $_POST['marks']?>" required></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <input class="btn btn-primary" type="submit" name="submit">
                    </div>
                </form>
            </div>
            <div style="width: 100% !important;" class="mt-2">
                <?php
                if (!empty($imgName)) { ?>
                    <img src="./Uploads/<?php echo $imgName; ?>" height='400' width='400' style='display: block; margin: auto;'>
                <?php
                }
                ?>
            </div>

            <!-- Printing the table. -->
            <div>
                <h4 style="margin: 10px 0; text-align:center;"> Entered Marks</h4>
                <table class="table table-hover">
                    <thead>
                        <tr class="table-dark">
                            <th scope="col">#</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $srl = 1;
                        for ($i = 0; $i < count($subjects); $i++) {
                        ?>
                            <tr>
                                <td><?php echo $srl; ?></td>
                                <td><?php echo $subjects[$i]; ?></td>
                                <td><?php echo $marks[$i]; ?></td>
                            </tr>
                        <?php
                            $srl = $srl + 1;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>