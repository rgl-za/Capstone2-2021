<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>우리집 앞마당 모니터링</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    
    <link href="css/style.css" rel="stylesheet">
    
    <link href="css/pages/reports.css" rel="stylesheet">
    <link href="css/comunity_styles.css" rel="stylesheet" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <style>
/* Visual improvements. */
body, html { 
	margin: 20px 0; 
	width: 100%; 
	height: 100%; 
	background: #56b968;
	font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
}

.container { 
	max-width: 700px; 
	margin: 0 auto 100px;
}

h1 { 
	color: #fff;
}

h1 svg {
	position: relative;
	top: 20px;
	margin-right: 10px;
}

.container .ck.ck-content {
	padding: 0 1em;
}

</style>

<body>

<?php include 'header.php'?>

<div class="container">
	<div class="row" style="margin-bottom: 20px">
		<h1><svg width="68" height="65" viewBox="0 0 68 65" xmlns="http://www.w3.org/2000/svg"><path d="M45.586 9.267a12.604 12.604 0 0 0-1.329 5.65c0 7.032 5.744 12.733 12.83 12.733l.273-.003V45.48a5.987 5.987 0 0 1-3.019 5.19L31.65 63.673a6.076 6.076 0 0 1-6.037 0L2.922 50.67a5.984 5.984 0 0 1-3.02-5.19V19.474c0-2.14 1.15-4.12 3.02-5.19L25.611 1.28a6.076 6.076 0 0 1 6.037 0l13.937 7.986zm-29.44 11.89c-.834 0-1.51.67-1.51 1.498v.715c0 .828.676 1.498 1.51 1.498h25.49c.832 0 1.51-.67 1.51-1.498v-.715c0-.827-.678-1.498-1.51-1.498h-25.49zm0 18.454c-.834 0-1.51.67-1.51 1.498v.715c0 .828.676 1.498 1.51 1.498h25.49c.832 0 1.51-.67 1.51-1.498v-.715c0-.827-.678-1.498-1.51-1.498h-25.49zm0-9.227c-.834 0-1.51.67-1.51 1.498v.715c0 .828.676 1.498 1.51 1.498h18.48c.832 0 1.508-.67 1.508-1.498v-.715c0-.827-.676-1.498-1.51-1.498H16.146zm41.191-5.232c-5.835 0-10.565-4.695-10.565-10.486 0-5.792 4.73-10.487 10.565-10.487 5.835 0 10.565 4.696 10.565 10.488 0 5.79-4.73 10.486-10.565 10.486v-.001zm3.422-8.68c0-.467-.084-.875-.25-1.225a2.547 2.547 0 0 0-.687-.88 2.888 2.888 0 0 0-1.026-.531 4.418 4.418 0 0 0-1.259-.175c-.134 0-.283.006-.447.018-.15.01-.3.034-.446.07l.075-1.4h3.587v-1.8h-5.462l-.214 5.06c.32-.116.682-.21 1.09-.28.405-.071.77-.107 1.087-.107.218 0 .437.02.655.063.218.04.413.114.585.218s.313.244.422.419c.11.175.163.39.163.65 0 .424-.132.745-.396.96a1.434 1.434 0 0 1-.938.326c-.352 0-.656-.1-.912-.3-.256-.2-.43-.453-.523-.762l-1.925.588c.1.35.258.664.472.943.214.279.47.514.767.706.298.19.63.339.995.443.365.104.75.156 1.151.156.437 0 .86-.064 1.272-.193.41-.13.778-.323 1.1-.581a2.8 2.8 0 0 0 .775-.981c.193-.396.29-.864.29-1.405z" fill="#FFF" fill-rule="evenodd"/></svg> CKEditor 5 and VueJS framework</h1>
	</div>
	
	<div class="row">
		<div id="app">
    <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
</div>
	</div>
	
</div>


<?php include 'footer.php'?>

    

<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/base.js"></script>

</script>

<script>
Vue.use( CKEditor );

const app = new Vue( {
    el: '#app',
    data: {
        editor: ClassicEditor,
        editorData: '<h1>Title</h1><p>Content of the editor.</p>',
        editorConfig: {
            // The configuration of the editor.
        }
    }
} );
</script>

  </body>

</html>
