<!-- Wrapper -->
<div id="login">

    <!-- Box -->
    <div class="form-signin">
        <h3>Sign in to Your Account</h3>

        <!-- Row -->
        <div class="row-fluid row-merge">

            <!-- Column -->
            <div class="span12">
                <div class="inner">

                    <!-- Form -->
                    <form method="post" action="<?php echo base_url("auth/login"); ?>">
                        <label class="strong">Username or Email</label>
                        <input type="text" name="username" class="input-block-level" tabindex="1" placeholder="Your Username or Email address"/> 
                        <label class="strong">Password <a class="password" tabindex="5" href="User_Guide.pdf" target="_blank">Click to download user guide</a></label>
                        <input type="password" tabindex="2" name="password" class="input-block-level" placeholder="Your Password"/> 
                        <div class="uniformjs"><label class="checkbox"><input tabindex="3" type="checkbox" value="remember-me">Remember me</label></div>
                        <div class="row-fluid">
                            <div class="span5 center">
                                <button class="btn btn-block btn-primary" tabindex="4" type="submit">Sign in</button>
                            </div>
                        </div>
                        <!-- CSRF token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                    </form>
                    <!-- // Form END -->

                </div>
            </div>
            <!-- // Column END -->

        </div>
        <!-- // Row END -->

        <div class="ribbon-wrapper"><div class="ribbon primary">HR KP</div></div>
    </div>
    <!-- // Box END -->

</div>
<!-- // Wrapper END -->	