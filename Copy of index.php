<?php
ob_start();
session_start();
include_once 'includes/class.Main.php';
//Object initialization
$dbf = new User();

$menu_title=$dbf->fetchSingle("seo","id='1'");
$pageTitle=$menu_title[meta_title];
$metaDescr=$menu_title[meta_descr];
$metaKeyword=$menu_title[meta_keyword];

include 'application_top.php';
?>
<body>
<?php include 'header.php'; ?>
<nav><div class="menubar"><?php include 'menu.php'; ?></div></nav>
<content>
    <div class="contentouterdiv">
    	<div class="contentsecdiv">
        	<div class="contentleftdiv">
            	<div class="bannerdiv"><?php include 'banner.php'; ?></div> 
                <div class="spacer1"></div>
                <div class="spacer2"></div>
				<div class="contentsec">
                 	<h1>RELIABLE SHIPPING <span>sOLUTIONS</span></h1>
                	 <?php $rel_shipping=$dbf->getDataFromTable("contents","content","id='9'");?>
                 	<div class="contxt"> <?php echo stripslashes($rel_shipping); ?><br /> <br /></div>
                </div><div class="shadow"><img src="images/shadow.png" /></div>              
             </div>
             <div class="contentrightdiv"><?php include 'right_menu.php'; ?></div>
             <div class="spacer2"></div>      
              <div class="contentsec1"> 
                 <h1>International Cargo Transport Service Via <span>Transmith Group </span></h1>
                   <?php $international=$dbf->getDataFromTable("contents","content","id='8'");?>
                    <div class="contxt">
                      <?php echo stripslashes($dbf->cut($international,620)); ?>
                        <div class="spacer"></div>
                        <div align="right"><a href="readmore"><img src="images/readmoe.png" /></a></div>
                        <div class="spacer"></div>
                        <div class="spacer"></div>
    			  </div>
               </div>
               <div class="spacer1"></div>
       </div>   
    </div>
</content>

<footer>
    <?php include('footer.php'); ?>
</footer>

</body>
</html>
