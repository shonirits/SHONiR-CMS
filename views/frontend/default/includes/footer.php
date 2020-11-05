
<footer>
  <div class="container t-footer">
<div class="col-md-12">
<div class="row heading">
  <div class="col-md-6 col-12">
    <h1><span>QUICK </span>LINKS</h1>
    <hr>
    <div class="links">
      <ul>          
        <li><a href="<?php echo SHONiR_BASE ?>" >Homepage</a></li>
    <li><a href="<?php echo SHONiR_BASE.'Products'?>" >Products</a></li>
    <li><a href="<?php echo SHONiR_BASE.'Custom/enquiry'?>" >Custom Product Enquiry</a></li> 
    <li><a href="<?php echo SHONiR_BASE.'Reviews/feedback'?>" >Customer Reviews</a></li> 
    <li><a href="<?php echo SHONiR_BASE.'Gallery'?>" >Factory Tour</a></li>  
        <?php echo SHONiR_Pages_Menu_Fnc($Pages_Tree, 0, false);?>
  <li><a href="<?php echo SHONiR_BASE.'Contact'?>">Contact Us</a></li>
      </ul>
    </div>    
    </div>
    <div class="col-md-6 col-12 newsletter">
      <h1><span>KEEP</span> CONNECTED</h1>
      <hr>
      <p><span>Get updates by subscribe our monthly newsletter</span></p>
   <div class="frm">
   <form name="SHONiR_Subscribe_Frm" id="SHONiR_Subscribe_Frm">
      <input type="email" name="email" id="email" placeholder="Type your email address...">
      <input type="button" onclick="SHONiR_Subscribe_Fnc();" value="Subscribe">
    </form>
   </div>
<div class="social">
  <ul>
    <li>
      <a class="facebook" href="<?php echo SHONiR_SETTINGS['social_facebook']?>" ><i class=" fab fa-facebook-square" aria-hidden="true"></i></a>
    </li>
    <li>
      <a class="twitter" href="<?php echo SHONiR_SETTINGS['social_twitter']?>"><i class=" fab fa-twitter" aria-hidden="true"></i></a>
    </li>
    <li>
      <a class="instagram " href="<?php echo SHONiR_SETTINGS['social_instagram']?>"><i class="fab fa-instagram" aria-hidden="true"></i></a>
    </li>
    <li>
      <a class="youtube" href="<?php echo SHONiR_SETTINGS['social_youtube']?>"><i class=" fab fa-youtube" aria-hidden="true"></i></a>
    </li>
    <li>
      <a class="linkedin" href="<?php echo SHONiR_SETTINGS['social_linkedin']?>"><i class=" fab fa-linkedin" aria-hidden="true"></i></a>
    </li>
  </ul>
</div>
      </div>
</div>
</div>
<div class="row bottom">
  <div class="col-md-6 col-12 copyright">
    <p>Copyrights  &copy; <?php echo SHONiR_SETTINGS['config_copyrights']?> <a href="<?php echo SHONiR_HTTP.'://'.SHONiR_SETTINGS['website_url']?>" ><?php echo SHONiR_SETTINGS['website_company']?></a>. All rights reserved.</p>
</div>
<div class="col-md-6 developer col-12">
    <p><a title="This website search engine optimization by ExTech Corporation"  href="https://www.ex.com.pk/web-promotion.html" target="_blank"><span>Website Optimization</span></a>
&amp; <a title="This website maintained by ExTech Corporation"  href="https://www.ex.com.pk/web-development.html" target="_blank"><span>Maintained</span></a>
by <a title="This website designed and developed by ExTech Corporation"  href="https://www.ex.com.pk/website-packages.html" target="_blank">ExTech Corporation</a></p>
</div>
</div>
  </div>


</footer>

