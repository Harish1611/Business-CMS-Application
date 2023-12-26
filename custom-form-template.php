<?php
/*
 Template Name: Form Template
 */

get_header(); ?>

<div style="width:400px" class="container pl-5">
<h3 class="text-center pt-3" >New Record</h3>
    <hr>
<form role="form" method="POST" class="row " >

Record Name :<input id="name" name="name" type="text" placeholder="Enter Record Name" class="form-control" >
<br>
Record Field:<input id="field" name="field" type="text" placeholder="Enter Record Field" class="form-control" >
<br>
Record Number:<input id="recordnumber" name="recordnumber" type="number" placeholder="Enter Record Number" class="form-control" >
<br>
Record Description:<input id="description" name="description" type="text" placeholder="Enter Description Number" class="form-control" >
<br>
<div class="pt-4"></div>
<button type="submit" value="submit" class="btn btn-primary mb-3 mt-8 p-2" name="submission">Add Record</button>


</form>

</div>

<?php get_footer(); ?>
