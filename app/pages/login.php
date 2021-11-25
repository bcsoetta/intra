<div class="homex"><a href="<?php echo baseurl; ?>">&#9778;</a></div>
<div class="info">
    <img src="<?php echo baseurl; ?>assets/images/loader.svg">
</div>
<div class="smart-wrap">
	<div class="form-titlex">Login</div>
	<div class="smart-forms smart-container wrap-3">
        <form id="form-login" action="<?php echo baseurl; ?>app/db/ssod.php">
			<input type="hidden" name="appid" value="<?php echo $appid ?>">
        	<div class="form-body theme-yellow">
                <div class="section">
                    <label for="username" class="field-label">Username</label>
                    <label class="field prepend-icon">
                        <input type="text" name="username" id="username" class="gui-input">
                        <span class="field-icon"><i class="fa fa-user"></i></span>
                    </label>
                </div><!-- end section -->
            	<div class="section">
                	<label for="password" class="field-label">Password</label>
                	<label class="field prepend-icon">
                    	<input type="password" name="password" id="password" autocomplete="off" class="gui-input">
                        <span class="field-icon"><i class="fa fa-lock"></i></span>
                    </label>
                </div><!-- end section -->

            </div><!-- end .form-body section -->
            <div class="form-footer">
                <input type="hidden" name="action" value="login">
            	<button type="submit" class="button btn-yellow">Kirim</button>
            </div><!-- end .form-footer section -->
        </form>
  	</div>
</div>
