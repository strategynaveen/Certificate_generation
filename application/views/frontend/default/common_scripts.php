<!-- <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
<script type="text/javascript">

    var paper_size = "";
function toggleRatingView(course_id) {
  $('#course_info_view_'+course_id).toggle();
  $('#course_rating_view_'+course_id).toggle();
  $('#edit_rating_btn_'+course_id).toggle();
  $('#cancel_rating_btn_'+course_id).toggle();
}

function publishRating(course_id) {
    var review = $('#review_of_a_course_'+course_id).val();
    var starRating = 0;
    starRating = $('#star_rating_of_course_'+course_id).val();
    if (starRating > 0) {
        $.ajax({
            type : 'POST',
            url  : '<?php echo site_url('home/rate_course'); ?>',
            data : {course_id : course_id, review : review, starRating : starRating},
            success : function(response) {
                location.reload();
            }
        });
    }else{

    }
}

function isTouchDevice() {
  return (('ontouchstart' in window) ||
     (navigator.maxTouchPoints > 0) ||
     (navigator.msMaxTouchPoints > 0));
}

function redirect_to(url){
  if(!isTouchDevice() && $(window).width() > 767){
    window.location.replace(url);
  }
}



 
var canvas = new fabric.Canvas('canvas');


// backgroud is working changeing on under proccessing..
$(".imgb").click(function(){
    var count = $('.imgb');
    var index_val = count.index($(this));
        //alert(index_val);
    var bgsrc= $('.imgb')[index_val].getAttribute("src");
    var imgsrc = bgsrc;

    // canvas.setBackgroundImage(imgsrc,canvas.renderAll.bind(canvas),{
    //      height:600,
    //      width:800
		
    
    // });
// code modifying background image on strategy
	fabric.Image.fromURL(imgsrc, function(img) {
        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
            scaleX: canvas.width / img.width,
            scaleY: canvas.height / img.height
        });
    }); 

});

// object removing
$('#remove').click(function(){
    var object = canvas.getActiveObject();
    if (!object){
        alert('Please select the element to remove');
        return '';
    }
    canvas.remove(object);
});
// text adding function
$("#submitt").click(function(){
    var tname = $("#tname").val();
   
    //alert(tfamily);
    var textEditable = new fabric.Textbox(
            tname, {
            fontSize: 20,
            fontFamily:'Arial',
            editable: true
    });

    canvas.add(textEditable);
    canvas.centerObject(textEditable);
  
});
// text adding function end

function handleDragStart(e) {
    [].forEach.call(images, function (img) {
        img.classList.remove('img_dragging');
    });
    this.classList.add('img_dragging');
}

function handleDragOver(e) {
    if (e.preventDefault) {
        e.preventDefault(); 
    }

    e.dataTransfer.dropEffect = 'copy'; 
    return false;
}

function handleDragEnter(e) {
    // this / e.target is the abric.Ccurrent hover target.
    this.classList.add('over');
}

function handleDragLeave(e) {
    this.classList.remove('over'); // this / e.target is previous target element.
}

function handleDrop(e) {
    // this / e.target is current target element.

    if (e.stopPropagation) {
        e.stopPropagation(); // stops the browser from redirecting.
    }

    var img = document.querySelector('#images img.img_dragging');

    console.log('event: ', e);

    var newImage = new fabric.Image(img, {
        // width: img.width,
        // height: img.height,
      
        left: e.layerX,
        top: e.layerY
    });
    canvas.add(newImage);

    return false;
}

function handleDragEnd(e) {
    // this/e.target is the source node.
    [].forEach.call(images, function (img) {
        img.classList.remove('img_dragging');
    });
}

//if (Modernizr.draganddrop) {
    // Browser supports HTML5 DnD.

    // Bind the event listeners for the image elements
    var images = document.querySelectorAll('#images img');
    [].forEach.call(images, function (img) {
        img.addEventListener('dragstart', handleDragStart, false);
        img.addEventListener('dragend', handleDragEnd, false);
    });
    // Bind the event listeners for the canvas
    var canvasContainer = document.getElementById('canvas-container');
    canvasContainer.addEventListener('dragenter', handleDragEnter, false);
    canvasContainer.addEventListener('dragover', handleDragOver, false);
    canvasContainer.addEventListener('dragleave', handleDragLeave, false);
    canvasContainer.addEventListener('drop', handleDrop, false);
//} else {
    // Replace with a fallback to a library solution.
  //  alert("This browser doesn't support the HTML5 Drag and Drop API.");
//}

// navigation header waiting to strategy
// $(document).ready(function () {
//     $(function () {
//         $('.nava').click(function (e) {
//             e.preventDefault();
//             $('.nava').removeClass('bgnavactive ');
//             $(this).addClass('bgnavactive ');

//           var countopt = $('.nava');
//           var indexoptnav = countopt.index($(this));
//          // alert(indexoptnav);
//         //  var activepage = $('.option-menu');
//         //  activepage[indexoptnav].addClass('.active')
//         });
//     });
// });

// recipient static fields
$(document).on("click",'#staticbtn',function(){
	//alert("static fields");
	var cname = "College Name";
	var dname = "Web Developement";
	var sname = "Naveen Kumar";
	var cdate = "<?php echo date("d-m-Y"); ?>";
	var signtext = "Sign In Name";

	// college name
	var clgname = new fabric.Textbox(cname,{
		left: 180,
    	top: 50, 
		fontSize: 40,
		width:360,
        editable: true
		
	});
    // clgname.toObject = function() {
    //     return {
    //         id: 'college_name'
    //     };
    // };

	clgname.id = "college_name"; 
	canvas.add(clgname);
    // canvas.renderAll();
	// domain name
	var domain_name = new fabric.Textbox(dname,{
		left:250,
		top:200,
		fontSize: 20,
		width:200,
		editable:true
	});
    // domain_name.toObject = function() {
    //     return {
    //         id: 'domain_name'
    //     };
    // };
   
	domain_name.id = "domain_name";
	canvas.add(domain_name);
    // canvas.renderAll();
	// student name
	var stud_name = new fabric.Textbox(sname,{
		left:100,
		top: 300,
		fontSize: 20,
		width:180,
		editable:true
	});
    // stud_name.toObject = function() {
    //     return {
    //         id: 'stud_name'
    //     };
    // };
	stud_name.id = "student_name";
	canvas.add(stud_name);
    // canvas.renderAll();

	// certificate date
	var c_date = new fabric.Textbox(cdate,{
		top:150,
		left:110,
		fontSize: 20,
		width:90,
		editable:true
	});
    // c_date.toObject = function() {
    //     return {
    //         id: 'c_date'
    //     };
    // };
	c_date.id = "date";
	canvas.add(c_date);
    // canvas.renderAll();
	// sign in certificate
	var sign_in = new fabric.Textbox(signtext,{
		top:350,
		left:250,
		fontSize:18,
		width:120,
		editable:true
	});
    // sign_in.toObject = function() {
    //     return {
    //         id: 'sign_name'
    //     };
    // };
	sign_in.id = "signin";
	canvas.add(sign_in);
    //canvas.renderAll();
});

// recipient fields checking valid or not valid
$(document).on("click",'#testbtn',function(){
	canvas.forEachObject(function(obj) {
    	if (obj.id && obj.id === 'date') {
        	console.log("date testing... ok");
    	}
		else if(obj.id && obj.id == 'student_name'){
			console.log('student name .. ok');
		}
		else if(obj.id && obj.id == 'domain_name'){
			console.log("domain name.. ok");
		}
		else if(obj.id && obj.id == 'college_name'){
			console.log('college name...ok');
		}
		else if(obj.id && obj.id == 'signin'){
			console.log('signin name ......ok');
		}
		else{
			alert("no fields are valid");
		}
	});
});


// json code save the user directory that means login directory
//Save canvas into JSON......
$("#jsonObject").click(function(){
    jsonObject = JSON.stringify(canvas);
    console.log(jsonObject);
    //Save Canvas into JSON
    var a = document.createElement("a");
    var file = new Blob([JSON.stringify(canvas)],{
        type: 'text/plain'
    });
    a.href = URL.createObjectURL(file);
    console.log("URL Created...");
    a.download = "json.txt";
    console.log("File Downloaded")
	// then if you remove the command download json.txt
    a.click();
    console.log("Completed...");
    //Post the JSON Data...
    var doc = btoa(jsonObject);
    // var file_name = "user";
        $.ajax({
            method:"POST",
            url:"<?php echo base_url(); ?>/Home/downloadjson",
            data:{data:doc},
        }).done(function(data){
            alert(data);
        });
        console.log("Data send");
});

$("#previewbtn").click(function(){
    var dataURL = canvas.toDataURL("image/JPEG",1.0);
    var link = document.createElement('img');
    //link.download = "My-Certificate.png";
    link.src = dataURL;
    //link.click();
    var imgpreview = document.getElementById("modalpreview_show");
    imgpreview.setAttribute("src",link.src);
    $("#modal_preview").modal('show');
});

//Load Json Object....
$("#downloadpdf").click(function(){
   // alert("pdf");
    var paper_size = sessionStorage.getItem("papersize");
   // alert(paper_size);
    if (paper_size) {
        if (paper_size == 'A3') {
            var pdfsize = canvas.toDataURL({ multiplier: 3.496 }); 
            var pdf = new jsPDF('l');
            pdf.addImage(pdfsize,'JPEG',20,50);
            pdf.save("My-Certificate.pdf");
            sessionStorage.removeItem('papersize'); 
        }
        else if (paper_size == 'A7') {
            var pdfsize = canvas.toDataURL({ multiplier: 1.748 });
            var pdf = new jsPDF('l');
            pdf.addImage(pdfsize,'JPEG',20,50);
            pdf.save("My-Certificate.pdf");
            sessionStorage.removeItem('papersize'); 
        }
        else if (paper_size == 'A4') {
            var pdfsize = canvas.toDataURL({ multiplier: 4.96 });
            var pdf = new jsPDF('l');
            pdf.addImage(pdfsize,'JPEG',20,50);
            pdf.save("My-Certificate.pdf");
            sessionStorage.removeItem('papersize'); 
        }else{
            var pdfsize = canvas.toDataURL({ multiplier: 0.6 });
            var pdf = new jsPDF();
            pdf.addImage(pdfsize,'JPEG',20,50);
            pdf.save("My-Certificate.pdf");
            sessionStorage.removeItem('papersize'); 
        } 
    }else{
       alert("Please Select Paper Size!!");
   }
   
   // pdf.save("My-Certificate.pdf");
});

$("#downloadjpg").click(function(){
    alert("png");
    var paper_size = sessionStorage.getItem("papersize");
    //alert(paper_size);
    if (paper_size) {
        if (paper_size == 'A3') {
            var image=canvas.toDataURL({ multiplier: 3.496 });
            var link = document.createElement('a');
            link.download = "My-Certificate.png";
            link.href = image;
            link.click();
            
        }
        else if(paper_size == 'A7'){
            var image=canvas.toDataURL({ multiplier: 1.748 });
            var link = document.createElement('a');
            link.download = "My-Certificate.png";
            link.href = image;
            link.click();
        }
        else if(paper_size == 'A4'){
            var image=canvas.toDataURL({ multiplier: 4.96 });
            var link = document.createElement('a');
            link.download = "My-Certificate.png";
            link.href = image;
            link.click();
        }
        else{
            var image=canvas.toDataURL({ multiplier: 0.6 });
            var link = document.createElement('a');
            link.download = "My-Certificate.png";
            link.href = image;
            link.click(); 
        }
        sessionStorage.removeItem('papersize'); 
    }
    else{
        alert("Please Select Paper Size!!");
    }
    
    //link.click();

});

// print certificate
$("#printcertificate").click(function(){
    var dataURL = canvas.toDataURL();
    var windowContent = '<!DOCTYPE html>';
    windowContent += '<html>'
  //windowContent += '<head><title>Print canvas</title></head>';
    windowContent += '<body>'
    windowContent += '<img src="' + dataURL + '" onload=window.print();window.close();>';
    windowContent += '</body>';
    windowContent += '</html>';
    var printWin = window.open('', '', 'width=340,height=260');
    printWin.document.open();
    printWin.document.write(windowContent);

});


//Load Certificate 
/*
document.getElementById('loadfile').onchange = function handleImage(e) {
    var reader = new FileReader();
    reader.onload = function(event) {
      console.log('Image Loaded....');
      var imgObj = new Image();
      imgObj.src = event.target.result;
      imgObj.onload = function() {
        // start fabricJS stuff

        var image = new fabric.Image(imgObj);
        image.set({
          left: 0,
          top: 0,
          angle: 00,
          padding: 50,
          cornersize: 10
        });
        
       
        //image.scale(getRandomNum(0.1, 0.25)).setCoords();
       // image.scale(0.2);
        
        canvas.add(image);

        // end fabricJS stuff
      }

    }
    reader.readAsDataURL(e.target.files[0]);
  }

  */

// encryption decryption public key and private key generation
$(document).on("click",'#enc_dec_generate',function(){
    //var generate_btn = document.getElementById("qrcode_generate_btn");
    //alert("wokring...");
    var date = "";
    var sname = "";
    var dname = "";
    var clgname = "";
    var sign_name = "";
    canvas.forEachObject(function(obj) {
    	if (obj.id && obj.id === 'date') {
        	date = obj.text;
    	}
		else if(obj.id && obj.id == 'student_name'){
			sname = obj.text;
		}
		else if(obj.id && obj.id == 'domain_name'){
			dname = obj.text;
		}
		else if(obj.id && obj.id == 'college_name'){
			clgname = obj.text;
		}
		else (obj.id && obj.id == 'signin')
			sign_name = obj.text;
		
	});
    $.ajax({
        url:"<?php echo base_url(); ?>Home/enc_dec_generate",
        method:"POST",
        data:{date:date,sname:sname,dname:dname,clgname:clgname,sign_name:sign_name},
        success:function(data){
            alert(data);

            qrsrc ="<?php echo base_url(); ?>Home/qrview";
            fabric.Image.fromURL(qrsrc, function(img) {
                var oImg = img.set({ left: 200, top: 200}).scale(0.25);
                canvas.add(oImg);
            });

            // generate_btn.classList.replace("d-none","d-inline");
        }
       
    });
});

// encryption decryption checking in specified user ajax 
/* 

if you want to check the encryption decryption working just enable now!!
*/
/*
$(document).on("click","#encsubmit",function(){
    var text = document.getElementById("enctext").value;
    $.ajax({
        url:"<?php echo base_url(); ?>Home/enc_dec",
        method:"POST",
        data:{text:text},
        success:function(data){
            alert(data);
        }
    });
});
*/
// qr code generation first getting fabric text inputs
/*
$(document).on("click","#qrcode_generate_btn",function(){
    //alert("working");
    var date = "";
    var sname = "";
    var dname = "";
    var clgname = "";
    var sign_name = "";
    canvas.forEachObject(function(obj) {
    	if (obj.id && obj.id === 'date') {
        	date = obj.text;
    	}
		else if(obj.id && obj.id == 'student_name'){
			sname = obj.text;
		}
		else if(obj.id && obj.id == 'domain_name'){
			dname = obj.text;
		}
		else if(obj.id && obj.id == 'college_name'){
			clgname = obj.text;
		}
		else (obj.id && obj.id == 'signin')
			sign_name = obj.text;
		
	});
    // var value_text = [date,sname,clgname,dname,sign_name];
    // alert(value_text);
   // var myModal = document.getElementById("staticBackdrop");
  
    $.ajax({
        url:"<?php echo base_url(); ?>/Home/user_detail_encode",
        method:"POST",
        data:{date:date,sname:sname,dname:dname,clgname:clgname,sign_name:sign_name},
        success:function(data){
            alert("Data Encoded!!");
           // document.cookie = "myJavascriptVar = " + data;

            
        }
    });
});
*/


// qrcode generation
/*
$(document).on("click","#qrcode_generation",function(){
    var encval = document.getElementById('get_enc_data').value;
    var qrsrc = "qrcode.php?data="+encval;
    fabric.Image.fromURL(qrsrc, function(img) {
        var oImg = img.set({ left: 150, top: 0}).scale(0.4);
        canvas.add(oImg);
    });
});
*/
// qr image to click  move on canvas 
/*
$(document).on("click",'#qr_to_canvas',function(){
   qrsrc =  $('#qr_to_canvas').attr('src');
    fabric.Image.fromURL(qrsrc, function(img) {
    var oImg = img.set({ left: 200, top: 200}).scale(0.25);
    canvas.add(oImg);
  });
});


// generate_qr_code
$(document).on("click",'#generate_qr_code',function(){
    var url = "<?php echo base_url(); ?>Home/qrview";
    $('#qr_to_canvas').attr('src',url);
});
*/
/*
add background image in user
$(document).on("click",'#user_add_bgimg',function(){
    alert("hi guys");
    var bgfile = document.getElementById("custom_img").value;
    $.ajax({
        url: "<?php echo base_url(); ?>home/user_addbgimg",
        method:"POST",
        data:{bgfile:bgfile},
        success:function(data){
            alert(data);
        }
    });
});

*/

// select json file in particular directory
$(document).on('click','#select_json',function(){
    //document.getElementById("modalbody_demo").reset();
    $('#json_file_select').modal('show');
});


// change paper size 
$(document).on('blur','#papersize',function(){

    var size = document.getElementById("papersize").value;
    var paper = '';
    if(size == 'A3'){
        paper = 'A3';
    }
    else if(size == 'A7'){
        paper = 'A7';
    }
    else if(size == 'A4'){
        paper = 'A4';
    }else{
        paper = 's';
    }
    //document.cookie = "papersize="+paper;
    //this.paper_size = paper;
    sessionStorage.setItem("papersize",paper);

});

// load certificate
$(document).on('click','#loadcertificatevalue',function(){
    var json = document.getElementById("template_name").value;
    var jsondir = document.getElementById("dir_location_cer").value;
    // alert(jsondir);
    // alert(json);
    var files = jsondir+json; 
     alert(files);
  const reader = new FileReader();
  var jsondata = reader.readAsJson(files);
  console.log(jsondata);


});

</script>
