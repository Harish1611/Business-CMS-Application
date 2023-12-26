<?php
/*
 Template Name: Data Template
 */

get_header();

// Include the TCPDF library
require_once get_template_directory() . '/tcpdf/tcpdf.php';

global $wpdb;

// Check if form is submitted for deletion
if(isset($_POST['delete_record'])) {
    $record_id = $_POST['delete_record'];
    $wpdb->delete('wp_companyrecord', array('id' => $record_id));

    // Redirect to the same page after deletion
    header("Location: ".$_SERVER['REQUEST_URI']);
    exit();
}

// Check if form is submitted for PDF generation
if(isset($_POST['generate_pdf'])) {
    $record_id = $_POST['generate_pdf'];
    generatePDF($wpdb->get_results("SELECT * FROM wp_companyrecord WHERE id = $record_id"));
}

// Check if form is submitted for editing
if(isset($_POST['edit_record'])) {
    $record_id = $_POST['edit_record'];
    header("Location: /edit-emp?id=$record_id");
    exit();
}

$result = $wpdb->get_results("SELECT * FROM wp_companyrecord");
?>


  

<div class="container  ">
<div class="row pt-3">
        <div class="col-8 ms-auto">
            <h3 class=""> Records Dashboard </h3>
        </div>

        <div class="col-4 ms-auto text-end">
            <button type="button" class="btn btn-primary"> <a href="/new-emp" style="text-decoration:none; color:white"> Create New Record</a> </button>
        </div>
    </div>
    <hr>

    <div class="row text-center "> 
        <div class="col">
            <h3> All Records </h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> Record Name </th>
                        <th> Field </th>
                        <th> Number </th>
                        <th> Description </th>


                        <th> PDF  </th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($result as $data) { ?>
                        <tr>
    <td> <?php echo $data->name; ?> </td>
    <td> <?php echo $data->field; ?> </td>
    <td> <?php echo $data->number; ?> </td>
    <td> <?php echo $data->description; ?> </td>

    <td>
    <form method="post">
            
            <input type="hidden" name="generate_pdf" value="<?php echo $data->id; ?>">
            <button type="submit" class="btn btn-success"><i class="fa fa-file-pdf-o"></i></button>
        </form>
       
    </td>
    <td>
    <form method="post">
            <input type="hidden" name="delete_record" value="<?php echo $data->id; ?>">
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form> 
    </td>
    <td>
        
        <form method="post">
            <input type="hidden" name="edit_record" value="<?php echo $data->id; ?>">
            <button type="submit" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
        </form>
    </td>
</tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php get_footer(); ?>
<?php
// Function to generate and download PDF for a specific record
function generatePDF($data) {

    // Set your logo file path
   $logoFilePath = 'logo.jpg';

   // Add an image logo
  

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->Image($logoFilePath, 10, 10, 30, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    // Set image scale
   $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'', PDF_HEADER_STRING, array(9,21,91), array(0,64,128));

    $pdf->setFooterData(array(0,64,0), array(0,64,128));
  
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->AddPage();

    
    $nameofrecord = $data[0]->name;
    $nameoffield = $data[0]->field;
    $nameofnumber = $data[0]->number;
    $nameofdescription = $data[0]->description;
    
   
    

    $pdf->SetFont('Helvetica', 'B', 12); // Reset font for heading

    $pdf->Cell(0, 22,'Report Record',0,1,'C',0,'',false,'M','M');

    $pdf->SetFont('Helvetica', '', 10,'', true); // Set font for content

    $pdf->ln(5);

    $pdf->Cell(180, 15,'Date: '.date("j / n / Y"),0,1,'R',0,'',0,false,'M','M');

    $pdf->SetTextColor(102, 102, 102);

    $pdf->writeHTML("
        <h4>Record Name: $nameofrecord</h4>
        <h4>Record Field: $nameoffield</h4>
        <h4>Record Number: $nameofnumber</h4>
        <h4>Record Description: $nameofdescription</h4>
    ");

    ob_end_clean();
    // Download PDF to browser
    // $pdf->Output('Record_Report_' . $data[0]->id . '.pdf', 'D');
    
    // Open PDF to browser
    $pdf->Output('Record_Report_' . $data[0]->id . '.pdf', 'I');


    

}
?>