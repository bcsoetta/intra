<div class="homex"><a href="/">&#9778;</a></div>
<div class="info">
    <img src="<?php echo baseurl; ?>assets/images/loader.svg">
</div>

<div class="smart-wrap">
	<div class="form-titlex">Form Pendaftaran</div>
	<div class="smart-forms smart-container wrap-3">
        <form id="form-daftar" action="<?php echo baseurl; ?>app/db/db_data.php">
        	<div class="form-body theme-yellow">
            	<div class="section">
                	<label for="password" class="field-label">Nama</label>
                	<label class="field prepend-icon">
                    	<input type="text" name="name" id="name" class="gui-input" placeholder="Isikan nama">
                        <span class="field-icon"><i class="fa fa-user"></i></span>
                    </label>
                </div>

                <div class="section">
                    <label for="email" class="field-label">Alamat email</label>
                    <label class="field prepend-icon">
                        <input type="email" name="email" id="email" class="gui-input" placeholder="contoh@gmail.com">
                        <span class="field-icon"><i class="fa fa-envelope"></i></span>
                    </label>
                </div>

            	<div class="section">
                	<label for="username" class="field-label">Username </label>
                    <div class="smart-widget sm-right smr-120">
                        <label class="field prepend-icon">
                            <input type="text" name="username" id="username" class="gui-input" placeholder="Isikan username" autocomplete="off">
                            <span class="field-icon"><i class="fa fa-user"></i></span>
                        </label>
                        <label for="username" class="button">.bcsoetta.org</label>
                    </div>
                </div>

            	<div class="section">
                	<label for="password" class="field-label">Password</label>
                	<label class="field prepend-icon">
                    	<input type="password" name="password" id="password" autocomplete="off" class="gui-input">
                        <span class="field-icon"><i class="fa fa-lock"></i></span>
                    </label>
                </div>

            	<div class="section">
                	<label for="confirmPassword" class="field-label">Konfirmasi password</label>
                	<label class="field prepend-icon">
                    	<input type="password" name="confirmPassword" id="confirmPassword" autocomplete="off" class="gui-input">
                        <span class="field-icon"><i class="fa fa-unlock-alt"></i></span>
                    </label>
                </div>

            	<div class="section">
                    <label class="option option-yellow">
                        <input id="termscheck" type="checkbox" name="terms" value="Saya menyatakan setuju dengan syarat dan ketentuan di website ini">
                        <span class="checkbox"></span>
                        Setuju dengan <a href="#" class="smart-link"> syarat dan ketentuan </a>
                    </label>
                </div>

            </div>
            <div class="form-footer">
                <input type="hidden" name="action" value="daftar">
            	<button type="submit" class="button btn-yellow">Kirim</button>
            </div>
        </form>
  	</div>
</div>
