<?php get_header(); ?>

    <div class="wrapper row">

        <div class="col col-5 v-middle testIO-form auth">
            <h3 class="section-title">
                <?php echo __( '_Sign in to', DOMAIN_LANG ) .' '. get_bloginfo('name'); ?>
            </h3>
            <?php wp_login_form( array(  
                    'redirect' => home_url(),   
                    'id_username' => 'user',  
                    'id_password' => 'pass',  
                )
            ); ?>
        </div>

        <div class="col col-5 v-middle testIO-form auth">
            <h3 class="section-title"><?php echo __( '_Create Account', DOMAIN_LANG ); ?></h3>
            <form id="registerform" action="<?php echo wp_registration_url(); ?>" method="post">
                <p>
                    <label for="user_login">
                    <?php echo __( '_Username', DOMAIN_LANG ); ?><br>
                        <input type="text" name="user_login" id="user_login" class="input" value="" size="20" style="">
                    </label>
                </p>
                <p>
                    <label for="user_email">
                        <?php echo __( '_E-mail', DOMAIN_LANG ); ?><br>
                        <input type="email" name="user_email" id="user_email" class="input" value="" size="25">
                    </label>
                </p>

                <p id="reg_passmail"><?php echo __( '_check mail', DOMAIN_LANG ); ?></p>

                <br class="clear">
                <input type="hidden" name="redirect_to" value="">

                <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php echo __( '_button auth', DOMAIN_LANG ); ?>">
            </form>

        </div>

    </div>

<?php get_footer(); ?>