<?php
// Check if the form has been submitted
if (isset($_POST['address_required'])) {
    // Get the form values
    $address_required = isset($_POST['address_required']) ? $_POST['address_required'] : 'off';
    $default_gpk = isset($_POST['default_gpk']) ? $_POST['default_gpk'] : '';

    // Set the cookies
    setcookie('address_required', $address_required, time() + (86400 * 30), '/');
    setcookie('default_gpk', $default_gpk, time() + (86400 * 30), '/');
}

// Get the cookies
$address_required = isset($_COOKIE['address_required']) ? $_COOKIE['address_required'] : 'off';
$default_gpk = isset($_COOKIE['default_gpk']) ? $_COOKIE['default_gpk'] : '';

// Check if the display form has been submitted
if (isset($_POST['print_address'])) {
    // Get the form values
    $print_address = isset($_POST['print_address']) ? $_POST['print_address'] : 'off';
    $print_gpk = isset($_POST['print_gpk']) ? $_POST['print_gpk'] : 'off';
    $font_size = isset($_POST['font_size']) ? $_POST['font_size'] : '';
    $wrap_format = isset($_POST['wrap_format']) ? $_POST['wrap_format'] : 'normal';

    // Set the cookies
    setcookie('print_address', $print_address, time() + (86400 * 30), '/');
    setcookie('print_gpk', $print_gpk, time() + (86400 * 30), '/');
    setcookie('font_size', $font_size, time() + (86400 * 30), '/');
    setcookie('wrap_format', $wrap_format, time() + (86400 * 30), '/');
}

// Get the cookies
$print_address = isset($_COOKIE['print_address']) ? $_COOKIE['print_address'] : 'off';
$print_gpk = isset($_COOKIE['print_gpk']) ? $_COOKIE['print_gpk'] : 'off';
$font_size = isset($_COOKIE['font_size']) ? $_COOKIE['font_size'] : '';
$wrap_format = isset($_COOKIE['wrap_format']) ? $_COOKIE['wrap_format'] : 'normal';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Input Form</title>
</head>
<body>
<h1>Student Input Form</h1>

<!-- Input form -->
<h2>Input Settings</h2>
<form method="post">
    <label>
        <input type="radio" name="address_required" value="on" <?php if ($address_required === 'on') { echo 'checked'; } ?>>
        Address is required
    </label>


    <label>
        <input type="radio" name="address_required" value="off" <?php if ($address_required === 'off') { echo 'checked'; } ?>>
        Address is not required
    </label>
    <br/>

    <label>
        Default GPK:
        <input type="number" name="default_gpk" min="0" max="4" step="0.01" value="<?php echo $default_gpk; ?>">
    </label>

    <!-- Display form -->
    <h2>Display Settings</h2>

    <label>
        <input type="radio" name="print_address" value="on" <?php if ($print_address === 'on') { echo 'checked'; } ?>>
        Print address
    </label>

    <label>
        <input type="radio" name="print_address" value="off" <?php if ($print_address === 'off') { echo 'checked'; } ?>>
        Do not print address
    </label>
    <br/>

    <label>
        <input type="radio" name="print_gpk" value="on" <?php if ($print_gpk === 'on') { echo 'checked'; } ?>>
        Print GPK score
    </label>


    <label>
        <input type="radio" name="print_gpk" value="off" <?php if ($print_gpk === 'off') { echo 'checked'; } ?>>
        Do not print GPK score
    </label>
    <br/>

    <label>
        Default font size:
        <input type="number" name="font_size" value="<?php echo $font_size; ?>">
    </label>
    <br/>

    <label>
        Wrap format:
        <select name="wrap_format">
            <option value="normal" <?php if ($wrap_format === 'normal') { echo 'selected'; } ?>>Normal</option>
            <option value="bold" <?php if ($wrap_format === 'bold') { echo 'selected'; } ?>>Bold</option>
            <option value="italic" <?php if ($wrap_format === 'italic') { echo 'selected'; } ?>>Italic</option>
            <option value="underline" <?php if ($wrap_format === 'underline') { echo 'selected'; } ?>>Underline</option>
        </select>
    </label>

    <br/><br/>
    <button type="submit">Save</button>
</form>
</body>
</html>
