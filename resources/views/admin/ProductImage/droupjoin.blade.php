<html>

<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>

<style>

.wrapper {
    background: #39E2B6;
    height: 100%;
    width: 100%;
    position: fixed;
    top: 0;
    z-index: 9999;
    text-align: center;
    left: 0;
    font-size: 100px;
    font-family: calibri;
    color: white;
    line-height: 100vh;
}

.dropzone {
  width: 50%;
  margin: 1%;
  border: 2px dashed #3498db !important;
  border-radius: 5px;
}
</style>
</head>

<body>

<div class="wrapper" style="visibility:hidden; opacity:0" >DROP HERE</div>


<form action="/upload" class="dropzone" id="dropzone">
    <div class="dz-message ">
      <span class="text">
      Drop files here or click to upload + 
      </span>
      
    </div>
  </form>
<script>
//to enable full window
var lastTarget = null;

window.addEventListener("dragenter", function(e){ // drag start
    // unhide our red overlay
    showWrapper();
    lastTarget = e.target; // cache the last target here
});

window.addEventListener("dragleave", function (e) { // user canceled

    if(e.target === lastTarget || e.target === document)
    {
        hideWrapper();
    }

});

window.addEventListener("dragover", function (e) { //to stop default browser act
    e.preventDefault();
});

window.addEventListener("drop", function(e){

    e.preventDefault();
    hideWrapper();

    // if drop, we pass object file to dropzone
    var myDropzone = Dropzone.forElement(".dropzone");
    myDropzone.handleFiles(e.dataTransfer.files);

});


function hideWrapper() {
    document.querySelector(".wrapper").style.visibility = "hidden";
    document.querySelector(".wrapper").style.opacity = 0;
}

function showWrapper() {
    document.querySelector(".wrapper").style.visibility = "";
    document.querySelector(".wrapper").style.opacity = 0.5;
}
</script>
</body>
</html>