<?php
/*
 Template Name: Edit Employee Template
 */

get_header();

global $wpdb;

if(isset($_GET['id'])) {
    $record_id = $_GET['id'];
    $record = $wpdb->get_row("SELECT * FROM wp_companyrecord WHERE id = $record_id");
    
    // Display form for editing with pre-filled data
    ?>
    <!-- <div class="container">
        <h3>Edit Employee Record</h3>
        <form role="form" method="POST">
            <input type="hidden" name="record_id" value="<?php echo $record->id; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $record->name; ?>" required>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $record->email; ?>" required>
            <label for="phone">Phone:</label>
            <input type="tel" name="phone" value="<?php echo $record->phone; ?>" required>
            <button type="submit" class="btn btn-primary" name="update_submission">Update Record</button>
        </form>
    </div> -->

    <div style="width:400px" class=" container pl-5">
    <h3 class="text-center pt-3" >Edit Record</h3>
    <hr>
<form role="form" method="POST" class="row " >
<input type="hidden" name="record_id" value="<?php echo $record->id; ?>">

Record Name :<input id="name" name="name" type="text" placeholder="Enter Record Name" class="form-control" value="<?php echo $record->name; ?>" required >
<br>
Record Field:<input id="field" name="field" type="text" placeholder="Enter Record Field" class="form-control" value="<?php echo $record->field; ?>" required >
<br>
Record Number:<input id="recordnumber" name="recordnumber" type="number" placeholder="Enter Record Number" class="form-control" value="<?php echo $record->number; ?>" required >
<br>
Record Description:<input id="description" name="description" type="text" placeholder="Enter Description Number" class="form-control" value="<?php echo $record->description; ?>" required >
<br>
<div class="pt-4"></div>
<button type="submit" class="btn btn-primary" name="update_submission">Update Record</button>


</form>

</div>
    <?php
}

get_footer();
?>
