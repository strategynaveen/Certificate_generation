<?php 
// $myPhpVar= $_COOKIE['myJavascriptVar'];
//$myPhpVar = "nkdemo";
$alp = "nkdemo";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body >
<div class="container-fluid">
 
<div class="row">
    <div class="col-lg-5 col-md-4 col-sm-12">
        <br>
        <br>
        <div class="jumbotron border bg-light border-success shadow shadow-md">
            <h2 class="text-center text-info">Menus!!</h2>
            <br>
            <br>
            <div class="accordion" id="customtemplate"style="height:500px;width:500px;border:solid 2px orange;overflow:scroll;overflow-x:hidden;overflow-y:scroll;">
                <!-- background images tab -->
                <div class="accordion-item">
                    <h2 class="accordion-header " id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#custombackground" aria-expanded="true" aria-controls="custombackground">
                            Background Images 
                        </button>
                    </h2>
                    <div id="custombackground" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#customtemplate">
                        <!-- background images -->
                        <div class="accordion-body">
                            <div class="background-img">
                                <!-- background images row -->
                                <!-- admin images -->
                                <div class="row bg-success">
                                    <h5 class="text-center text-light bg-light text-dark">Default Images</h5>
                                         <?php 

                                        foreach($loadimg as $row){
                                    ?>
                             
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <img src="<?php echo base_url(); ?>/working_directory/admin/background-images/<?php echo $row->imgname; ?>" alt="" class="img-thumbnail imgb">        
                                    </div>  

                                    <?php
                                        }

                                    ?>   
                                </div>
                                <!-- admin images end -->
                                <br>
                                <!-- user images -->
                                <div class="row bg-info">
                                    <h5 class="text-center text-dark bg-light">User Images</h5>
                                        <?php 

                                            //print_r($user_bgimg);
                                            $dir =  do_hash($user_mail);
                                            foreach($user_bgimg as $ubgimg){
                                                ?>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <img src="<?php echo  base_url(); ?>/working_directory/<?php echo $dir; ?>/backgroundimg/<?php echo $ubgimg->imgname; ?>" alt="" class="img-thumbnail imgb">
                                                </div>
                                                <?php
                                            }
                                        
                                        ?>
                                </div>
                                <!-- user images end -->
                                <br>
                                <br>
                                <!-- user image selection form -->
                                <form action="<?php echo base_url(); ?>home/user_addbgimg" method="post" id="form_data" enctype='multipart/form-data'>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <input type="file" class="form-control form-control-md " id="ubgimg" name="ubgimg" required="true">
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="submit" class="btn btn-md btn-light border border-2 border-info text-info" id="user_add_bgimg" name="Loadimg" value="Upload Image">
                                        </div>
                                    </div>
                                </form>
                                <!-- user image selection form end -->
                                <!-- background images row end -->
                            </div>
                        </div>
                         <!-- background images end -->
                    </div>
                </div>
                <!-- background images tab end -->

                <!-- logo settings start -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#customlogo" aria-expanded="false" aria-controls="customlogo">
                            Logo's
                        </button>
                    </h2>
                    <div id="customlogo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#customtemplate">
                        <div class="accordion-body">
                            <!-- logo's -->
                            <div id="images">
                                <!-- admin  logo's -->
                                <div class="row bg-primary">
                                    <h5 class="text-center text-dark bg-light">Default Logo's</h5>
                                    <?php 
                                        
                                        // print_r($logo_img);
                                        foreach ($logo_img as $logo) {
                                    ?>
                                            
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <img src="<?php echo base_url(); ?>/working_directory/admin/logo/<?php echo $logo->logoname; ?>" alt="" class="img-thumbnail imgs mb-2" draggable="true">
                                        </div>
                                        
                                            
                                    <?php
                                        }
                                    
                                    ?>
                                </div>
                                <!-- admin logo's end -->
                                <br>
                                <!-- user logos -->
                                <div class="row bg-warning">
                                    <h5 class="text-center text-dark bg-light">User Logo's</h5>
                                    <?php 
                                        // echo $dir;
                                        // print_r($user_logo);
                                        foreach($user_logo as $logo_u){
                                            ?>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <img src="<?php echo base_url(); ?>/working_directory/<?php echo $dir; ?>/logo/<?php echo $logo_u->imgname; ?>" alt="" class="img-thumbnail imgs mb-2" draggable="true">
                                            </div>
                                            
                                            <?php
                                        }
                                    ?>
                                    <br>
                                </div>
                                <!-- user logos end -->
                                <br>
                                <!-- user logo selection form -->
                                <form action="<?php echo base_url(); ?>home/ulogo" method="post" enctype="multipart/form-data" > 
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <input type="file" class="form-control form-control-md" id="ulimg" name="ulimg" required="true">
                                        </div> 
                                        <div class="col-lg-4">
                                            <input type="submit" class="btn border border-2 text-primary border-primary" name="logosubmit" id="logosubmit" value="Upload Logo">
                                        </div>                                   
                                    </div>
                                </form>
                                <!-- user logo selection form end -->
                            </div>
                            <!-- logo's end -->
                        </div>
                    </div>
                </div>
                <!-- logo settings end -->

                <!-- text settings start -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#text" aria-expanded="false" aria-controls="text">
                                Text
                        </button>
                    </h2>
                    <div id="text" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#customtemplate">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <input type="text" placeholder="Type Text" class="form-control form-control-md" id="tname" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                <button type="submit" id="submitt" class="btn btn-sm btn-info"><i class="fa fa-paper-plane fa-2x"></i></button>
                                </div>
                                
                            </div>
                           <br>
                            <div class="row">
                                <!-- <div class="col-lg-4"></div> -->
                                <div class="col-lg-12">
                                    <button class="btn btn-md btn-info" id="staticbtn">Required Fields <i class="fa fa-anchor fa-2x"></i></button>
                                </div>
                                <!-- <div class="col-lg-4"></div>             -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- text settings end -->

                 <!-- Choose Seal  -->
                 <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ChooseSeal" aria-expanded="false" aria-controls="ChooseSeal">
                            Choose Seal
                        </button>
                    </h2>
                    <div id="ChooseSeal" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#customtemplate">
                        <div class="accordion-body">
                            <!-- <h6 class="text-center text-secondary">Choose Seal  on processing..</h6> -->
                            <br>
                            <div class="row"> 
                                <div class="col mx-auto">
                                    <button class="btn btn-sm btn-light border border-2 border-success text-success p-2" id="enc_dec_generate">Generate The Seal[QR] <i class="fa fa-plus fa-2x"></i></button>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
                <!-- Choose Seal end -->

                <!-- preview setting -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#preview" aria-expanded="false" aria-controls="preview">
                            Preview Certificate
                        </button>
                    </h2>
                    <div id="preview" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#customtemplate">
                        <div class="accordion-body">
                            <!-- <h4 class="text-center text-danger">Preview on Processing..</h4> -->
                            <div class="col-lg-12" target="_blank">
                                    <button class="btn btn-md btn-primary" id="previewbtn">Preview Certificate <i class="fa fa-eye"></i></button>
                            </div>
                            <!-- <div class="row">
                                <div class="col mx-auto">
                                    <img src="" alt="" id="demopreview" class="img-thumbnail mx-auto d-block rounded">
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- preivew setting end -->
               
                <!-- Change Paper Size -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingNine">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#changepapersize" aria-expanded="false" aria-controls="changepapersize">
                            Change Paper Size
                        </button>
                    </h2>
                    <div id="changepapersize" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#customtemplate">
                        <div class="accordion-body">
                            <p class="text-center text-success">First Select the Size After Click Download!!</p>
                            <br>
                            <select class="form-control" name="papersize" id="papersize">
                                <option value="" selected disabled>Choose Paper Size </option>
                                <option value="A3">A3</option>
                                <option value="A7">A7</option>
                                <option value="A4">A4</option>
                                <option value="s">Small</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Change Paper Size end -->

                <!-- Download/Print Cert  -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#downloadprint" aria-expanded="false" aria-controls="downloadprint">
                            Download/Print Certificate
                        </button>
                    </h2>
                    <div id="downloadprint" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#customtemplate">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-danger btn-md text-light" id="downloadpdf" type="button" >PDF <i class="fa fa-file-pdf"></i></button>
                                </div>
                                <div class="col-md-4"> 
                                   <button class="btn btn-info btn-md text-light" id="downloadjpg" type="button" >JPG <i class="fa fa-file-image"></i></button>
                                </div>
                                <div class="col-md-4"> 
                                   <button class="btn btn-primary btn-md text-light" id="printcertificate" type="button" >Print  <i class="fa fa-print"></i></button>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <!-- Download/Print Cert end -->

                <!-- Load Certificate -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingEight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#loadcertificate" aria-expanded="false" aria-controls="loadcertificate">
                            Load Certificate
                        </button>
                    </h2>
                    <div id="loadcertificate" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#customtemplate">
                        <div class="accordion-body">
                            <!-- <h6 class="text-center text-danger">Load Certificate on processing..</h6> -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-warning bt-md" id="select_json">Select Template</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                    </script>
                <!-- Load Certificate end -->

            </div>    
        </div>  
    </div>  
    <div class="col-lg-7 col-md-8 col-sm-12">
        <br>          
        <br>
        <div class="jumbotron border border-info shadow shadow-md bg-light" id="canvas-container">
            <div class="row">
                <!-- text  properties hidden -->
                <div class="col-lg-10">
                    <!-- <div id="textControls" hidden>  
                        <div class="row">
                            <div class="col-lg-6">
                                <select id="font_family" class="form-control">
                                    <option value="arial">Arial</option>
                                    <option value="HelveticaNeue" selected>Helvetica Neue</option>
                                    <option value="myriad pro">Myriad Pro</option>
                                    <option value="delicious">Delicious</option>
                                    <option value="verdana">Verdana</option>
                                    <option value="georgia">Georgia</option>
                                    <option value="courier">Courier</option>
                                    <option value="comic sans ms">Comic Sans MS</option>
                                    <option value="impact">Impact</option>
                                    <option value="monaco">Monaco</option>
                                    <option value="optima">Optima</option>
                                    <option value="hoefler text">Hoefler Text</option>
                                    <option value="plaster">Plaster</option>
                                    <option value="engagement">Engagement</option>
                                </select>
                            </div>
                            
                            <div class="col-lg-3">
                                <select id="text-align" class="form-control">
                                    <option value="left">Align Left</option>
                                    <option value="center">Align Center</option>
                                    <option value="right">Align Right</option>
                                    <option value="justify">Align Justify</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <input type="number" placeholder="Line Stroke " value="1" min="1" max="5" id="text-stroke-width" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-3">
                                 <input type="color" id="text_color" size="10">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  name="fonttype" type="checkbox" id="text_cmd_bold" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">B</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  name="fonttype" type="checkbox" id="text_cmd_italic" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">L</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  name="fonttype" type="checkbox" id="text_cmd_underline" value="option3" >
                                    <label class="form-check-label" for="inlineCheckbox3">Underline</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  name="fonttype" type="checkbox" id="text_cmd_linethrough" value="option3" >
                                    <label class="form-check-label" for="inlineCheckbox3">Linethrough</label>
                                </div>
                            </div>
                            
                        </div>
                    </div>  -->
                </div>
                <!-- text properties end -->

                <!-- <div class="col-lg-4"></div> -->
                <div class="col-lg-1">
                    <button class="btn btn-md btn-primary" id="jsonObject"><i class="fa fa-save"></i></button>
                </div>
                <div class="col-lg-1">
                    <button id="remove" class="btn btn-md btn-danger"><i class="fa fa-trash fa-1x"></i></button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col mx-auto">
                  <canvas id="canvas" height="500" width="650"></canvas>
                </div>
            </div>
            <br>
            <!-- testing required field button -->
            <!-- <button type="button" id="testbtn" class="btn btn-md btn-success">TestObjects</button> -->
        </div>           
        <br>            
    </div>
 </div> <!-- row end -->

</div>  <!-- container end-->

<!-- modal for preview certificate -->
<div class="modal fade" id="modal_preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title text-center text-success">Preview Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <img src="" id="modalpreview_show" class="img-thumbnail mx-auto d-block rounded" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col mx-auto">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- <p><?php echo $user_mail; ?></p> -->
            </div>
        </div>
    </div>
</div>

<!-- modal for end preview certificate -->

<!-- modal for json file selection in load certificate -->
<div class="modal fade" id="json_file_select" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-warning">Your Templates!!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalbody_demo">
        <p><?php echo $user_mail; ?></p>
        <br>
        <?php 
        
        $map = directory_map("./working_directory/".$dir."/certificate");
        
        ?>

        <?php foreach($map as $file){
            ?>
             <div class="form-check">
                <input class="form-check-input" type="radio" name="template_name" id="template_name" value="<?php echo $file; ?>">
                <label class="form-check-label text-dark " for="template_name">
                <?php echo $file; ?>
                </label>
             </div>
           
       <?php } ?>
            <div hidden>
                <input type="text" class="form-control " id="dir_location_cer" value="<?php echo base_url(); ?>/working_directory/<?php echo $dir; ?>/certificate/">
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="loadcertificatevalue">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- modal for json file selection in load certificate end -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/521/fabric.min.js"></script> -->
<script src="<?php echo base_url(); ?> assets/naveen/fabric.min.js"></script>
<script>
//     // text properties control
// canvas.on('object:selected', function(e) {
//   if (e.target.type === 'i-text') {
//     document.getElementById('textControls').hidden = false;
//   }
// });
// canvas.on('before:selection:cleared', function(e) {
//   if (e.target.type === 'i-text') {
//     document.getElementById('textControls').hidden = true;
//   }
// });

// text edit control properties functions 



</script>

</body>
</html>
