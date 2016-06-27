
		<aside id="left-panel">
			<!-- User info -->
			<div class="login-info">
				<span> 

					<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
						<img src="<?php echo ASSETS_URL; ?>/img/avatars/male.png" alt="me" class="online" />
						<span>
							User
						</span>
						<i class="fa fa-angle-down"></i>
					</a>

				</span>
			</div>
			<!-- end user info -->


			<nav>


				<?php
					$ui = new SmartUI();
					$ui->create_nav($page_nav)->print_html();
				?>

			</nav>
			<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>
		<!-- END NAVIGATION -->