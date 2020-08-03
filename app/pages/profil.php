<div class="form-titlex">Profil</div>
<div class="container">
	<div id="header-profile">
		<i class="fa fa-bars" aria-hidden="true"></i>
	</div>
	<main>
		<div class="row">
			<div class="left col-lg-4">
				<div class="photo-left">
					<img class="photo" src="<?php echo baseurl; ?>assets/images/user.svg" />
				</div>
				<h4 class="name" id="namex"><?php echo (isset($_SESSION['sdata']['name'])) ? $_SESSION['sdata']['name']: ""; ?></h4>
				<p class="info" id="emailx"><?php echo (isset($_SESSION['sdata']['nip'])) ? $_SESSION['sdata']['nip']: ""; ?></p>
				<p class="info" id="group"><?php echo (isset($_SESSION['sdata']['group'])) ? $_SESSION['sdata']['group']: ""; ?></p>
				<p class="desc" id="perusahaanx"><?php echo (isset($_SESSION['sdata']['tempat'])) ? $_SESSION['sdata']['tempat']: "You company name should be here.."; ?></p>
			</div>
			<div class="right col-lg-8">
				<div class="row gallery">
					<div class="col-md-4">
						<div class="infox">
						    <img src="<?php echo baseurl; ?>assets/images/loader.svg">
						</div>
						<div class="smart-wrap">
							<div class="form-titlex">&#9881;</div>
							<div class="smart-forms smart-container wrap-2">
						        <form id="form-profil" action="<?php echo baseurl; ?>app/db/db_data.php">
						        	<div class="form-body theme-yellow">
										<div class="spacer-t40 spacer-b30">
					                    	<div class="tagline"><span>Username & Password</span></div>
					                    </div>

					                    <div class="section">
						                    <label for="username" class="field-label">Username</label>
						                    <label class="field">
						                        <input type="text" value="<?php echo (isset($_SESSION['sdata']['username'])) ? $_SESSION['sdata']['username']: ""; ?>" name="username" id="username" class="gui-input" disabled>
						                    </label>
						                </div>

						            	<div class="section">
						                	<label for="password" class="field-label">Ganti password</label>
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

						            </div>
						            <div class="form-footer">
						                <input type="hidden" name="action" value="uprofil">
										<input type="hidden" id="user_id" name="user_id" value="<?php echo (isset($_SESSION['sdata']['user_id'])) ? $_SESSION['sdata']['user_id']: ""; ?>">
						            	<button type="submit" class="button btn-yellow">Simpan</button>
						            </div>
						        </form>
						  	</div>
						</div>
					</div>
					<!-- <div class="col-md-4">
						<img src="<?php echo baseurl; ?>assets/images/pexels-photo-113338.jpeg" />
					</div> -->
				</div>
			</div>
	</main>
</div>
