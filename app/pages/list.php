<div class="appnull"><?php if (!isset($_SESSION['sdata']['apps_data'])) { echo "Silahkan lengkapi data profil.."; } ?></div>
<div class="grid">
    <?php if (isset($_SESSION['sdata']['apps_data'])) { $apps = $_SESSION['sdata']['apps_data']; foreach ($apps as $app) { ?>
        <?php if ($app['app_sso'] == 'Y') { ?>
            <div class="grid-div ssoy">
                <a href="<?php echo $app['app_url']; ?>" target="_blank">
                    <img src="/assets/images/ui.svg" alt="">
                    <div class="apptitle-ssoy"><?php echo $app['app_name']; ?></div>
                </a>
            </div>
        <?php } else { ?>
            <div class="grid-div sson">
                <a href="<?php echo $app['app_url']; ?>" target="_blank">
                    <img src="/assets/images/gear.svg" alt="">
                    <div class="apptitle-sson"><?php echo $app['app_name']; ?></div>
                </a>
            </div>
        <?php } ?>
        
    <?php } } ?>
</div>