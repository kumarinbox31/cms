<style>
    .pbmit-sticky-header > .container:nth-of-type(2){
        display:none !important;
    }
</style>
<header id="masthead" class="site-header pbmit-header-style-2 pbmit-sticky-logo-no">
			<div class="pbmit-sticky-header pbmit-header-sticky-yes pbmit-sticky-type- pbmit-sticky-bg-color-white"></div>
			<div class="pbmit-header-overlay">
				<div class="pbmit-header-height-wrapper" style="min-height:100px;">
					<div
						class="pbmit-main-header-area pbmit-sticky-logo-no pbmit-responsive-logo-no pbmit-header-wrapper pbmit-bg-color-white">
						<div class="container"><!-- container -->
							<div class="pbmit-header-content d-flex justify-content-between align-items-center">
								<div class="pbmit-logo-menuarea d-flex justify-content-between align-items-center">
									<div class="site-branding pbmit-logo-area">
										<div class="wrap">
											<h1 class="site-title"><a href="/" rel="home"><span
														class="site-title-text"><?php echo theTitle(); ?></span><img class="pbmit-main-logo"
														src="<?php echo LOGO ?>"
														alt="<?php echo theTitle(); ?>" title="<?php echo theTitle(); ?>" /></a></h1>
											<!-- Logo area -->
										</div><!-- .wrap -->
									</div><!-- .site-branding -->
									<div class="pbmit-menuarea">
										<!-- Top Navigation Menu -->
										<div class="navigation-top">
											<div class="wrap">
												<nav id="site-navigation"
													class="main-navigation pbmit-navbar  pbmit-main-active-color-#fba311 pbmit-dropdown-active-color-#fba311"
													aria-label="Top Menu">
													<div class="menu-main-menu-container">
													    <?
                                                            $arr = [
                                                                'id' => 'pbmit-top-menu',
                                                                'class' => 'menu',
                                                                'itemClass' => 'menu-item menu-item-type-post_type menu-item-object-page menu-item-',
                                                                'anchorClass' => '',
                                                                'dropdownUlClass' => 'sub-menu',
                                                                'childItemClass' => 'menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-',
                                                                'childAnchorClass' => '',
                                                                'childActiveClass' => 'current-menu-item current_page_item',
                                                                'dropdownLiClass' => 'menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-',
                                                                'dropdownAnchorClass' => '',
                                                                'extendBefore' => '',
                                                                'extendAfter' => '',
                                                            ];
                                                            $items = $this->MenuModel->items($id)['items'];
                                                            print $this->MenuModel->get_menu($items, $arr);
                                                
                                                        ?>
													    </div>
												</nav><!-- #site-navigation -->
											</div><!-- .wrap -->
										</div><!-- .navigation-top -->
									</div>
								</div><!-- .justify-content-between -->
								<div class="pbmit-right-box d-flex align-items-center">
									
									<?php /*
									<div class="pbmit-button-box">
										<div class="pbmit-header-button">
											<a href="tel:+1(212)255-511">
												<span class="pbmit-header-button-text-1">+1(212)255-511</span> </a>
										</div>
									</div>
									<div class="pbmit-search-cart-box">
										<div class="pbmit-header-search-btn"><a href="#" title="Search"><i
													class="pbmit-base-icon-search-1"></i></a></div>
										<div class="pbmit-cart-wrapper pbmit-cart-style-1 pbmit-show-cart-amount-no">
											<a href="cart/index.html" class="pbmit-cart-link">
												<span class="pbmit-cart-details">
													<span class="pbmit-cart-icon"><i
															class="pbmit-base-icon-shopping-cart"></i></span>
													<span class="pbmit-cart-count">0</span>
												</span><span class="woocommerce-Price-amount amount"><span
														class="woocommerce-Price-currencySymbol">&#8377;</span>0.00</span></a>
										</div>
									</div>
									<div class="pbmit-button-box-second">
										<div class="pbmit-header-button2">
											<a href="contact-us/index.html">
												<span class="pbmit-header-button2-text">Get a Quote</span><span
													class="pbmit-button-icon-wrapper"><span class="pbmit-button-icon"><i
															class="pbmit-base-icon-black-arrow-1"></i></span></span>
											</a>
										</div>
									</div>
									*/ ?>
									<div class="pbmit-burger-menu-wrapper">
										<div class="pbmit-mobile-menu-bg"></div>
										<button id="menu-toggle" class="nav-menu-toggle">
											<i class="pbmit-base-icon-menu-1"></i>
										</button>
									</div>
								</div>
							</div>
						</div><!-- .container-end -->
					</div><!-- .pbmit-header-wrapper -->
				</div><!-- .pbmit-header-height-wrapper -->
			</div><!-- .pbmit-header-overlay -->
			<?php /* <div class="pbmit-slider-area">
				<p class="rs-p-wp-fix"></p>
				<sr7-module data-alias="slider-demo-01" data-id="1" id="SR7_1_1" class="rs-ov-hidden"
					data-version="6.7.21">
					<sr7-adjuster></sr7-adjuster>
					<sr7-content>
						<sr7-slide id="SR7_1_1-1" data-key="1">
							<sr7-bg id="SR7_1_1-1-6" class="sr7-layer"><noscript><img
										src="<?php echo theme_path(); ?>demo1/wp-content/uploads/sites/2/2024/08/slide-a-01.jpg" alt="slide-a-01"
										title="slide-a-01"></noscript></sr7-bg>
							<sr7-txt id="SR7_1_1-1-1" class="sr7-layer">Needs Professional Cleaning</sr7-txt>
							<sr7-txt id="SR7_1_1-1-3" class="sr7-layer">Let Us Do Your <br />
								Dirty Work</sr7-txt>
							<sr7-txt id="SR7_1_1-1-4" class="sr7-layer">Hire us! We are a professional cleaning company
								offering services.</sr7-txt>
							<a id="SR7_1_1-1-5" class="sr7-layer" href="services/index.html" target="_self"><span
									class="pbmit-button-text">Our Services</span><span
									class="pbmit-button-icon-wrapper"><span class="pbmit-button-icon"><i
											class="pbmit-base-icon-black-arrow-1"></i></span></span></a>
						</sr7-slide>
						<sr7-slide id="SR7_1_1-3" data-key="3">
							<sr7-bg id="SR7_1_1-3-6" class="sr7-layer"><noscript><img
										src="<?php echo theme_path(); ?>demo1/wp-content/uploads/sites/2/2024/08/slide-a-02.jpg" alt="slide-a-02"
										title="slide-a-02"></noscript></sr7-bg>
							<sr7-txt id="SR7_1_1-3-1" class="sr7-layer">Ultimate Clean Solutions</sr7-txt>
							<sr7-txt id="SR7_1_1-3-3" class="sr7-layer">Cleaning made fun <br />
								not a chore!</sr7-txt>
							<sr7-txt id="SR7_1_1-3-4" class="sr7-layer">Hire us! We are a professional cleaning company
								offering services.</sr7-txt>
							<a id="SR7_1_1-3-5" class="sr7-layer" href="services/index.html" target="_self"><span
									class="pbmit-button-text">Our Services</span><span
									class="pbmit-button-icon-wrapper"><span class="pbmit-button-icon"><i
											class="pbmit-base-icon-black-arrow-1"></i></span></span></a>
						</sr7-slide>
						<sr7-slide id="SR7_1_1-4" data-key="4">
							<sr7-bg id="SR7_1_1-4-6" class="sr7-layer"><noscript><img
										src="<?php echo theme_path(); ?>demo1/wp-content/uploads/sites/2/2024/08/slide-a-03.jpg" alt="slide-a-03"
										title="slide-a-03"></noscript></sr7-bg>
							<sr7-txt id="SR7_1_1-4-1" class="sr7-layer">Your clean, our guarantee.</sr7-txt>
							<sr7-txt id="SR7_1_1-4-3" class="sr7-layer">Cleaning with a <br />
								personal touch</sr7-txt>
							<sr7-txt id="SR7_1_1-4-4" class="sr7-layer">Hire us! We are a professional cleaning company
								offering services.</sr7-txt>
							<a id="SR7_1_1-4-5" class="sr7-layer" href="services/index.html" target="_self"><span
									class="pbmit-button-text">Our Services</span><span
									class="pbmit-button-icon-wrapper"><span class="pbmit-button-icon"><i
											class="pbmit-base-icon-black-arrow-1"></i></span></span></a>
						</sr7-slide>
						<sr7-slide id="SR7_1_1-2" data-key="2">
						</sr7-slide>
					</sr7-content>
					<image_lists style="display:none">
						<img data-src="<?php echo theme_path(); ?>demo1///xclean-demo.pbminfotech.com/demo1/wp-content/uploads/sites/2/2024/08/slide-a-icon.png"
							data-libid="2805" data-lib="medialibrary" title="slide-a-icon" width="0" height="0"
							data-dbsrc="<?php echo theme_path(); ?>demo1/Ly94Y2xlYW4tZGVtby5wYm1pbmZvdGVjaC5jb20vZGVtbzEvd3AtY29udGVudC91cGxvYWRzL3NpdGVzLzIvMjAyNC8wOC9zbGlkZS1hLWljb24ucG5n" />
						<img data-src="<?php echo theme_path(); ?>demo1///xclean-demo.pbminfotech.com/demo1/wp-content/uploads/sites/2/2024/08/slide-a-01.jpg"
							data-libid="2801" data-lib="medialibrary" alt="slide-a-01" title="slide-a-01" width="0"
							height="0"
							data-dbsrc="<?php echo theme_path(); ?>demo1/Ly94Y2xlYW4tZGVtby5wYm1pbmZvdGVjaC5jb20vZGVtbzEvd3AtY29udGVudC91cGxvYWRzL3NpdGVzLzIvMjAyNC8wOC9zbGlkZS1hLTAxLmpwZw==" />
						<img data-src="<?php echo theme_path(); ?>demo1///xclean-demo.pbminfotech.com/demo1/wp-content/uploads/sites/2/2024/08/slide-a-02.jpg"
							data-libid="2802" data-lib="medialibrary" alt="slide-a-02" title="slide-a-02" width="0"
							height="0"
							data-dbsrc="<?php echo theme_path(); ?>demo1/Ly94Y2xlYW4tZGVtby5wYm1pbmZvdGVjaC5jb20vZGVtbzEvd3AtY29udGVudC91cGxvYWRzL3NpdGVzLzIvMjAyNC8wOC9zbGlkZS1hLTAyLmpwZw==" />
						<img loading="lazy"
							data-src="<?php echo theme_path(); ?>demo1///xclean-demo.pbminfotech.com/demo1/wp-content/uploads/sites/2/2024/08/slide-a-03.jpg"
							data-libid="2803" data-lib="medialibrary" alt="slide-a-03" title="slide-a-03" width="0"
							height="0"
							data-dbsrc="<?php echo theme_path(); ?>demo1/Ly94Y2xlYW4tZGVtby5wYm1pbmZvdGVjaC5jb20vZGVtbzEvd3AtY29udGVudC91cGxvYWRzL3NpdGVzLzIvMjAyNC8wOC9zbGlkZS1hLTAzLmpwZw==" />
					</image_lists>
				</sr7-module>
				<script>
					//SR7.PMH ??= {}; SR7.PMH["SR7_1_1"] = { cn: 0, state: false, fn: function () { if (_tpt !== undefined && _tpt.prepareModuleHeight !== undefined) { _tpt.prepareModuleHeight({ id: "SR7_1_1", el: [700, 700, 650, 550, 450], type: 'standard', shdw: '0', gh: [700, 700, 650, 550, 450], gw: [1460, 1460, 1024, 778, 480], vpt: ['100px&#039;,&#039;100px&#039;,&#039;100px&#039;,&#039;100px&#039;,&#039;100px'], size: { fullWidth: true, fullHeight: false }, mh: '0', onh: 0, onw: 0, bg: { color: '{"orig":"transparent","type":"solid","string":"transparent"}' } }); SR7.PMH["SR7_1_1"].state = true; } else if ((SR7.PMH["SR7_1_1"].cn++) < 100) setTimeout(SR7.PMH["SR7_1_1"].fn, 19); } }; SR7.PMH["SR7_1_1"].fn();
				</script>
			</div> */?>
		</header><!-- #masthead -->
