    <?php global $mytheme; ?>
			<!-- footer -->
			<footer class="footer" role="contentinfo" >

                <div class="container">
                    <p class="h2"><?php echo bloginfo('name');?></p>
                    <div class="social">
                        <a href="<?php echo esc_url($mytheme['fb-link']);?>"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        <a href="<?php echo esc_url($mytheme['tw-link']);?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="<?php echo esc_url($mytheme['ig-link']);?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </div>
                    <p class="copyright">© 2018 <a href="/"><?php echo $mytheme['copy-text'];?></a> all rigts reserved</p>
                </div>
			</footer>
			<!-- /footer footer-bg -->
		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>
	</body>
</html>
