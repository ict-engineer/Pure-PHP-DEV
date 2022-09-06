<?php
  $currentFile = $_SERVER["PHP_SELF"];
  $parts = explode('/', $currentFile);
  $filename = $parts[count($parts) - 1];
?>
<div class="menubardiv"><div class="menufloatright"><ul id="nav"><li><a href="index">Home</a></li><li class="devider"><img src="images/devider.png"></li><li><a href="garage">Garage</a></li><li class="devider"><img src="images/devider.png"></li><li><a href="tracking">Tracking</a></li><li class="devider"><img src="images/devider.png"></li><li><a href="safedeal">Safedeal</a></li><li class="devider"><img src="images/devider.png"></li><?php if($_SESSION['user_id']==''){ ?><li><a href="member">Members</a></li><li class="devider"><img src="images/devider.png"></li><?php } else if($_SESSION['user_id']!=''){?><li><a href="transactions">Transactions</a></li><li class="devider"><img src="images/devider.png"></li><?php } ?><li><a href="guide">Guide</a></li><li class="devider"><img src="images/devider.png"></li><li><a href="terms">Terms</a></li><li class="devider"><img src="images/devider.png"></li><li><a href="faq">FAQ</a></li><li class="devider"><img src="images/devider.png"></li><li><a href="support">Support</a></li><li class="devider"><img src="images/devider.png"></li><li><a href="contact">Contact</a></li></ul></div>
    
<div class="resmenu">     
   <div class="container">
      <div id="content">
        <div id="menu1" class="menu_container green_glass full_width">
            <div class="mobile_collapser"><label for="hidden_menu_collapser"><span class="mobile_menu_icon"></span></label></div>
            <input id="hidden_menu_collapser" type="checkbox">
            <ul>
                <li><a href="index">Home</a></li>
                <li><a href="garage">Garage</a></li>
                <li><a href="tracking">Tracking</a></li>
                <li><a href="safedeal">Safedeal</a></li>
                <?php if($_SESSION['user_id']==''){ ?>
                <li><a href="member">Members</a></li>
                <?php } else if($_SESSION['user_id']!=''){?>
                <li><a href="transactions">Transactions</a></li>
                <?php } ?>
                <li><a href="guide">Guide</a></li>
                <li><a href="terms">Terms</a></li>
                <li><a href="faq">FAQ</a></li>
                <li><a href="support">Support</a></li>
                <li><a href="contact">Contact</a></li>
            </ul>
        </div>
     </div>
   </div>
</div>      
</div>