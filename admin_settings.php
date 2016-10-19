
<style>
.postbox {
  padding-left: 10px;
}
</style>


<div class=wrap>
    <div class="icon32" id="icon-edit"><br /></div>
    <h2><?php _e('"Je suis Charlie" Ribbon', BB_LANG_TAG) ?></h2>
    <form method="post" name="optForm" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
        <div class="postbox " id="postexcerpt">
            <h3><?php _e('Ribbon Position', BB_LANG_TAG) ?></h3>
            <div class="inside">
                <p>
                    <label for="BB_opt_location_tl">
                        <input type="radio" id="BB_opt_location_tl" name=<?php echo '"'.BB_OPT_LOCATION.'"' ?> value="tl" 
							<?php if ($options[BB_OPT_LOCATION] == "tl") { print ' checked="checked"';} ?> />
						<?php _e('Top Left', BB_LANG_TAG) ?>
                    </label>
                    <label for="BB_opt_location_tr">
                        <input type="radio" id="BB_opt_location_tr" name=<?php echo '"'.BB_OPT_LOCATION.'"' ?> value="tr" 
							<?php if ($options[BB_OPT_LOCATION] == "tr") { print ' checked="checked"';} ?> />
						<?php _e('Top Right', BB_LANG_TAG) ?>
                    </label>
                    <label for="BB_opt_location_bl">
                        <input type="radio" id="BB_opt_location_bl" name=<?php echo '"'.BB_OPT_LOCATION.'"' ?> value="bl" 
							<?php if ($options[BB_OPT_LOCATION] == "bl") { print ' checked="checked"';} ?> />
						<?php _e('Bottom Left', BB_LANG_TAG) ?>
                    </label>
                    <label for="BB_opt_location_br">
                        <input type="radio" id="BB_opt_location_br" name=<?php echo '"'.BB_OPT_LOCATION.'"' ?> value="br" 
							<?php if ($options[BB_OPT_LOCATION] == "br") { print ' checked="checked"';} ?> />
						<?php _e('Bottom Right', BB_LANG_TAG) ?>
                    </label>
                </p>
            </div>
        </div>
        <div class="submit">
            <input type="submit" name=<?php echo BB_UPD_SETTINGS ?> value="<?php _e('Update Settings', BB_LANG_TAG) ?>" />
        </div>
    </form>
</div> 
