<?php
/*
	Section: Branding DMS
	Author: MrFent
	Author URI: http://www.MrFent.com
	Demo: http://branding-dms.MrFent.com
	Description: Shows the main site logo/title and social icons.
	Class Name: BrandingDMS
	Version: 1.0.0  
	Workswith: header 
	Filter: component, social
	PageLines: true
	v3: true
*/

class BrandingDMS extends PageLinesSection {
		function section_persistent() {
				add_filter( 'pl_settings_array', array( $this, 'add_site_logo' ) );
				add_filter( 'pl_settings_array', array( $this, 'add_social_icons' ) );
				add_filter( 'pless_vars', array( $this, 'add_less_vars'));
		}
		
		function add_less_vars( $vars ) {
				$iconimagesize = str_replace(array(' '), array(''), (pl_setting( 'iconimagesize')) ? pl_setting( 'iconimagesize') : 24);
				$iconimagesize = preg_replace(array('/[^0-9]/'), array(''), $iconimagesize );
				$vars['icon-size'] = $iconimagesize.'px';
				return $vars;
		}
			
		function Social_Icon_Help(){
		    	ob_start();?><?php _e( '<div class="opt-name">Upload your own custom icons</div>For best results, use an image with a 1:1 ratio.', 'branding-dms' ); return ob_get_clean();
		}
		
		function add_site_logo( $array ) {
	            $array['basic_settings']['opts'][] = array(
						'title' 	=> __( 'Main Site Logo', 'branding-dms' ),
						'default' 	=> '[pl_parent_url]/images/dms.png',
						'key'		=> 'dms_main_logo',	
						'type' 		=> 'image_upload',
						'label'		=> __( 'Upload site logo', 'branding-dms' ),
						'help'		=> __( 'This is your default custom header/site logo image', 'branding-dms' ),
				);
	        	return $array;
		}
		
		function hr(){
		    	ob_start();?><hr /><?php return ob_get_clean();
		}
		
		function addlinkheader(){
		    	ob_start();?><?php _e( '<div class="opt-name">Add URLs to activate icons</div>', 'branding-dms' );?><?php return ob_get_clean();
		}
		
		function add_social_icons( $array ) {
	            $position_mode = array(
					array(
						'key'		=> 'icon_pos_bottom',	
						'type' 		=> 'text',
						'default' 	=> '12',
						'label'		=> __( 'Icon distance from bottom in pixels. Default is 12px.', 'branding-dms' )
					),
					array(
						'key'		=> 'icon_pos_right',	
						'type' 		=> 'text',
						'default' 	=> '1',
						'label'		=> __( 'Icon distance from right in pixels. Default is 1px.', 'branding-dms' ),
					),
					array(
						'key'		=> 'iconmode',
						'type' 		=> 'select',
						'default'	=> __( 'images', 'branding-dms' ),							
						'label'		=> __( 'Select icon type (then refresh)', 'branding-dms' ),
						'opts'		=> array(
									'images'		=> array( 'name' => __( 'Images', 'branding-dms' ) ),
									'iconfont'	 	=> array( 'name' => __( 'Font Awesome Icons', 'branding-dms' ) ),
						)));
				$iconmode = ($this->opt('iconmode')) ? $this->opt('iconmode') : 'images';
			
			if ($iconmode == 'images') {	
				$icon_size_rss = array(		
					array(
						'key'		=> 'iconimagesize',	
						'type' 		=> 'text',
						'label'		=> __( 'Custom icon size in pixels. Default is 24px', 'branding-dms' ),
					),
					array(
						'key'		=> 'hr',			
						'type'		=> 'template',
						'template'	=> $this->hr()
					),
					array(
						'key'		=> 'rssicon',	
						'type' 		=> 'check',
						'label'		=> __( 'Hide RSS feed icon', 'branding-dms' ),
					));
			if(!pl_setting('rssicon')) {	
				$social_b = array(
					array(
						'key'		=> 'rsslink',	
						'type' 		=> 'text',
						'label'		=> __( 'Custom RSS feed link', 'branding-dms' ),
						'help'		=> __( 'If you want the RSS icon to link to a feed other than your website, enter the custom URL here. Otherwise just leave this blank.', 'branding-dms' ),
					),
					array(
						'key'		=> 'hr',			
						'type'		=> 'template',
						'template'	=> $this->hr()
					));
			} else { $social_b = array(); } 
			
			} else {	
				$icon_size_rss = array(		
					array(
						'key'		=> 'iconfontsize',	
						'type' 		=> 'text',
						'default'	=> '27',
						'label'		=> __( 'Icon font-size in pixels. Default is 27px', 'branding-dms' ),
					),
					array(
						'key'		=> 'hr',			
						'type'		=> 'template',
						'template'	=> $this->hr()
					),
					array(
						'key'		=> 'rssicon',	
						'type' 		=> 'check',
						'label'		=> __( 'Hide RSS feed icon', 'branding-dms' ),
					));
			if(!pl_setting('rssicon')) {	
				$social_b = array(
					array(
						'key'		=> 'rsslink',	
						'type' 		=> 'text',
						'label'		=> __( 'Custom RSS feed link', 'branding-dms' ),
						'help'		=> __( 'If you want the RSS icon to link to a feed other than your website, enter the custom URL here. Otherwise just leave this blank.', 'branding-dms' ),
					),
					array(
					    'key'   => 'rssiconselect',
						'type'  => 'select_icon',
						'default'	=> 'rss-sign',
						'label'	=> __( 'RSS Icon', 'branding-dms' ),
					),
					array(
						'key'	=> 'rssiconcolor',
						'type' 	=> 'color',					
						'label' => __( 'RSS icon color', 'branding-dms' ),
						'default'	=> 'f68727'
					),
					array(
						'key'		=> 'hr',			
						'type'		=> 'template',
						'template'	=> $this->hr()
					));
			} else { $social_b = array(); }
			}
			
			if ($iconmode == 'images') {
					
				$icon_options = array(	
					array(
						'key'		=> 'addlinkheader',			
						'type'		=> 'template',
						'template'	=> $this->addlinkheader()
					),
					array(
						'key'		=> 'gpluslink',	
						'type' 		=> 'text',
						'label'		=> __( 'Your Google+ Profile URL', 'branding-dms' ),
					),
					array(
						'key'		=> 'facebooklink',	
						'type' 		=> 'text',
						'label'		=> __( 'Your Facebook Profile URL', 'branding-dms' ),
					),
					array(
						'key'		=> 'twitterlink',	
						'type' 		=> 'text',
						'label'		=> __( 'Your Twitter Profile URL', 'branding-dms' ),
					),
					array(
						'key'		=> 'linkedinlink',	
						'type' 		=> 'text',
						'label'		=> __( 'Your LinkedIn Profile URL', 'branding-dms' ),
					),
					array(
						'key'		=> 'youtubelink',	
						'type' 		=> 'text',
						'label'		=> __( 'Your YouTube Profile URL', 'branding-dms' ),
					),
					array(
						'key'		=> 'vimeolink',	
						'type' 		=> 'text',
						'label'		=> __( 'Your Vimeo Profile URL', 'branding-dms' ),
					),
					array(
						'key'		=> 'pinterestlink',	
						'type' 		=> 'text',
						'label'		=> __( 'Your Pinterest Profile URL', 'branding-dms' ),
					),
					array(
						'key'		=> 'instagramlink',	
						'type' 		=> 'text',
						'label'		=> __( 'Your Instagram Profile URL', 'branding-dms' ),
					),
					array(
						'key'		=> 'stumbleuponlink',	
						'type' 		=> 'text',
						'label'		=> __( 'Your StumbleUpon Profile URL', 'branding-dms' ),
					),
					array(
						'key'		=> 'tumblrlink',	
						'type' 		=> 'text',
						'label'		=> __( 'Your Tumblr Profile URL', 'branding-dms' ),
					),
					array(
						'key'		=> 'flickrlink',	
						'type' 		=> 'text',
						'label'		=> __( 'Your Flickr Profile URL', 'branding-dms' ),
					),
					array(
						'key'		=> 'etsylink',	
						'type' 		=> 'text',
						'label'		=> __( 'Your Etsy Profile URL', 'branding-dms' ),
					),
					array(
						'key'		=> 'bloglovinlink',	
						'type' 		=> 'text',
						'label'		=> __( 'Your Bloglovin Profile URL', 'branding-dms' ),
					),
					array(
						'key'		=> 'socialhelp',			
						'type'		=> 'template',
						'template' 	=> $this->Social_Icon_Help()
					),
					array(
						'key'		=> 'custom_images_array',
				    	'type'		=> 'accordion', 
						'post_type'	=> __('Custom Icon', 'branding-dms' ),
						'opts'		=> array(
								array(
									'key'	=> 'iconimageupload',	
									'type' 	=> 'image_upload',
									'label'	=> __( 'Upload a custom image', 'branding-dms' ),
								),
								array(
									'key'	=> 'iconimagetitle',	
									'type' 	=> 'text',
									'label'	=> __( 'Icon title', 'branding-dms' ),
								),
								array(
									'key'	=> 'iconimagelink',	
									'type' 	=> 'text',
									'label'	=> __( 'Icon URL', 'branding-dms' ),
					))));	
			} else {	
				$icon_options = array(	
						array(
							'key'		=> 'custom_iconfont_array',
					    	'type'		=> 'accordion', 
							'post_type'	=> __('Font Awesome Icon', 'branding-dms' ),
							'opts'		=> array(
									array(
									    'key'   => 'iconfontselect',
										'type'  => 'select_icon',
										'label'	=> __( 'Select icon', 'branding-dms' ),
									),
									array(
										'key'	=> 'iconfontcolor',
										'type' 	=> 'color',					
										'label' => __( 'Icon color', 'branding-dms' ),
										'default' => '000000'
									),
									array(
										'key'	=> 'iconfonttitle',	
										'type' 	=> 'text',
										'label'	=> __( 'Icon title', 'branding-dms' ),
									),
									array(
										'key'	=> 'iconfontlink',	
										'type' 	=> 'text',
										'label'	=> __( 'Icon URL', 'branding-dms' ),
					)))); 
				}
				
				$social_ab = array_merge( $position_mode, $icon_size_rss );
				$social_abd = array_merge( $social_ab, $social_b );
				$social_abdo = array_merge( $social_abd, $icon_options );
				
				$array['social_media']['opts'][] = array(
						'title' => 'Social Icons',
						'type'	=> 'multi',
						'opts'	=> $social_abdo		
				);
	        	return $array;
		}
		
		function instructions(){
		    ob_start();?><?php _e( 'You&#39;ll now see the new <strong>"Branding Logo"</strong> option on the <a href="<?php site_url() ?>?tablink=settings&amp;tabsublink=basic_settings"><i class="icon-picture icon-large"></i>Site Images</a> tab inside your <i class="icon-globe icon-large"></i> Settings. Use this setting to upload a default Branding Logo.<br /><br /> You can also add <strong>Social Icons</strong> to the Branding image. Go to the <a href="<?php site_url() ?>?tablink=settings&amp;tabsublink=social_media"><i class="icon-comments icon-large"></i> Social &amp; Local</a> Settings to configure.<hr /><hr />', 'branding-dms' ); return ob_get_clean();
		}
	
		function section_opts(){
				$options = array();
				$Instructions = array(
					array(
						'title' 	=> __( 'Instructions', 'featured-branding-dms' ),
						'key'		=> 'welcome',			
						'type'		=> 'template',
						'template'	=> $this->instructions()
					));
			if(!pl_setting('rssicon')) 	{
				$Hide_RSS_Icon = array(
					array(
						'key'		=> 'hiderssfeedicon',
						'type' 		=> 'check',
						'label'		=> __( 'Hide RSS Feed icon', 'branding-dms' ),
					));
			} else { 
				$Hide_RSS_Icon = array(); 
			}
			
				$custom_images_array = $this->opt('custom_images_array');
						
				$Hide_Social_Icons = array(
					array(
						'key'		=> 'hidesocialicons',
						'type' 		=> 'check',
						'label'		=> __( 'Hide social icons', 'branding-dms' ),
					));
					
				$Instructions_and_Hide_RSS_Icon = array_merge( $Instructions, $Hide_RSS_Icon );
				$Instructions_and_RSS_and_Social_Icons = array_merge( $Instructions_and_Hide_RSS_Icon, $Hide_Social_Icons );				
				$options[] = array(
						'title' 	=> __( 'Instructions', 'branding-dms' ),
						'type'		=> 'multi',
						'opts'		=>	$Instructions_and_RSS_and_Social_Icons				
					);
				return $options;
		}	

		function dms_main_logo(){
			if ( pl_setting( 'dms_main_logo' ) )  {
				$logo = ($this->opt('dms_main_logo')) ? $this->opt('dms_main_logo') : '';
				$site_logo = sprintf( '<a class="home site-logo-link" href="%s" title="%s"><img class="site-logo-img" src="%s" alt="%s" /></a>', home_url(), get_bloginfo('name'), $logo, get_bloginfo('name'));
				echo $site_logo;
			} else {
				$site_title = sprintf( '<div class="title-container"><a class="home site-title-link" href="%s" title="%s">%s</a><h6 class="site-description subhead">%s</h6></div>', esc_url(home_url()), __('Home','pagelines'), get_bloginfo('name'), get_bloginfo('description'));
				echo apply_filters('pagelines_site_title', $site_title);
			}
		}

		function section_template() { 
		
				$icon_pos_bottom = (pl_setting( 'icon_pos_bottom')) ? pl_setting( 'icon_pos_bottom') : 12;
				$icon_pos_right = (pl_setting( 'icon_pos_right')) ? pl_setting( 'icon_pos_right') : 1;
				$iconmode = (pl_setting( 'iconmode')) ? pl_setting( 'iconmode') : 'images';
			 	
				printf('<div class="branding_wrap fix">');
				$this->dms_main_logo(); 
				pagelines_register_hook( 'before_branding_dms_icons' ); 
				printf('<div class="icons" style="bottom: %spx; right: %spx;">', $icon_pos_bottom, $icon_pos_right);
				pagelines_register_hook( 'branding_dms_icons_start' ); 
			
			if ($iconmode == 'images') {
	
			if (!pl_setting('rssicon')) {
		
			if (!$this->opt('hiderssfeedicon')){ 	
				$rssurl = (pl_setting( 'rsslink')) ? pl_setting( 'rsslink') : apply_filters( 'pagelines_branding_rssurl', get_bloginfo('rss2_url') );
				printf('<a target="_blank" href="%s" class="rsslink" title="RSS Feed"><img src="%s" alt="RSS Feed"/></a>', $rssurl, $this->base_url.'/icons/rss.png' ); 
			}}
			
			if (!$this->opt('hidesocialicons')){ 
		
			if ( pl_setting( 'twitterlink' ) ) 
				printf('<a target="_blank" href="%s" class="twitterlink" title="Twitter"><img src="%s" alt="Twitter"/></a>', $this->opt( 'twitterlink' ), $this->base_url.'/icons/twitter.png');
			
			if ( pl_setting( 'facebooklink' ) ) 
				printf('<a target="_blank" href="%s" class="facebooklink" title="Facebook"><img src="%s" alt="Facebook"/></a>', $this->opt( 'facebooklink' ), $this->base_url.'/icons/facebook.png');
			
			if(pl_setting('linkedinlink'))
				printf('<a target="_blank" href="%s" class="linkedinlink" title="LinkedIn"><img src="%s" alt="LinkedIn"/></a>', $this->opt( 'linkedinlink' ), $this->base_url.'/icons/linkedin.png');	
			
			if(pl_setting('youtubelink'))
				printf('<a target="_blank" href="%s" class="youtubelink" title="YouTube"><img src="%s" alt="Youtube"/></a>', $this->opt( 'youtubelink' ), $this->base_url.'/icons/youtube.png');
			
			if(pl_setting('vimeolink'))
				printf('<a target="_blank" href="%s" class="vimeolink" title="Vimeo"><img src="%s" alt="Vimeo"/></a>', $this->opt( 'vimeolink' ), $this->base_url.'/icons/vimeo.png');
			
			if(pl_setting('gpluslink'))
				printf('<a target="_blank" href="%s" class="gpluslink" title="Google+"><img src="%s" alt="Google+"/></a>', $this->opt( 'gpluslink' ), $this->base_url.'/icons/google.png');			
			
			if ( pl_setting( 'pinterestlink' ) ) 
				printf('<a target="_blank" href="%s" class="pinterestlink" title="Pinterest"><img src="%s" alt="Pinterest"/></a>', $this->opt( 'pinterestlink' ), $this->base_url.'/icons/pinterest.png');
						
			if ( pl_setting( 'instagramlink' ) ) 
				printf('<a target="_blank" href="%s" class="instagramlink" title="Instagram"><img src="%s" alt="Instagram"/></a>', $this->opt( 'instagramlink' ), $this->base_url.'/icons/instagram.png');	
										
			if ( pl_setting( 'tumblrlink' ) ) 
				printf('<a target="_blank" href="%s" class="tumblrlink" title="Tumblr"><img src="%s" alt="Tumblr"/></a>', $this->opt( 'tumblrlink' ), $this->base_url.'/icons/tumblr.png');	
			
			if(pl_setting('etsylink'))
				printf('<a target="_blank" href="%s" class="etsylink" title="Etsy"><img src="%s" alt="Etsy"/></a>', $this->opt( 'etsylink' ), $this->base_url.'/icons/etsy.png');								
		
			if(pl_setting('flickrlink'))
				printf('<a target="_blank" href="%s" class="flickrlink" title="Flickr"><img src="%s" alt="Flickr"/></a>', $this->opt( 'flickrlink' ), $this->base_url.'/icons/flickr.png');								

			if(pl_setting('bloglovinlink'))
				printf('<a target="_blank" href="%s" class="bloglovinlink" title="Bloglovin"><img src="%s" alt="Bloglovin"/></a>', $this->opt( 'bloglovinlink' ), $this->base_url.'/icons/bloglovin.png');	
			
			if(pl_setting('stumbleuponlink'))
				printf('<a target="_blank" href="%s" class="stumbleuponlink" title="StumbleUpon"><img src="%s" alt="StumbleUpon"/></a>', $this->opt( 'stumbleuponlink' ), $this->base_url.'/icons/stumbleupon.png');
							
				$custom_images_array = $this->opt('custom_images_array');
			if( !$custom_images_array || !is_array($custom_images_array) ){
				$custom_images_array = array( array(), array(), array() );
			}
			
			foreach( $custom_images_array as $images_array ){
								
			if (pl_array_get( 'iconimageupload', $images_array )){	
				$upload = pl_array_get( 'iconimageupload', $images_array );

			} else
				$upload = $this->base_url.'/icons/pagelines.png';	
			
			if (pl_array_get( 'iconimagetitle', $images_array )){	
			
				$title = pl_array_get( 'iconimagetitle', $images_array );
			
			} else 
				$title = 'PageLines';
			
			if (pl_array_get( 'iconimagetitle', $images_array )){	
				$class = str_replace(array(' '), array(''), strtolower(pl_array_get( 'iconimagetitle', $images_array )));
				$class = preg_replace(array('/[^A-Za-z0-9\-]/'), array(''), $class );
				$class = preg_replace(array('/-+/'), array('-'), $class );
			} else 
				$class = 'pagelines';	
			
			if (pl_array_get( 'iconimagelink', $images_array )){
				$link = pl_array_get( 'iconimagelink', $images_array );
			
			} else 	
				$link = 'http://www.pagelines.com';	
		
			if ((pl_array_get( 'iconimagetitle', $images_array )) || (pl_array_get( 'iconimagelink', $images_array )) || (pl_array_get( 'iconimageupload', $images_array )))
				printf('<a target="_blank" href="%s" class="%slink" title="%s"><img src="%s" alt="%s"/></a>', $link, $class, $title, $upload, $title );
			}}
			
			}else{ 
						
				$iconfontsize = str_replace(array(' '), array(''), (pl_setting( 'iconfontsize')) ? pl_setting( 'iconfontsize') : '27');
				$iconfontsize = preg_replace(array('/[^0-9]/'), array(''), $iconfontsize );
				
			if (!pl_setting('rssicon')) {

			if (!$this->opt('hiderssfeedicon')){ 	
				$rssurl = (pl_setting( 'rsslink')) ? pl_setting( 'rsslink') : apply_filters( 'pagelines_branding_rssurl', get_bloginfo('rss2_url') );
				$rssiconselect = (pl_setting( 'rssiconselect')) ? pl_setting( 'rssiconselect') : 'rss-sign';
				$rssiconcolor = (pl_setting( 'rssiconcolor')) ? pl_setting( 'rssiconcolor') : 'f68727';
				
				printf('<a target="_blank" href="%s" class="rsslink" title="RSS Feed"><i class="icon-%s" style="color:#%s;font-size:%spx;"></i></a>', $rssurl, $rssiconselect, $rssiconcolor, $iconfontsize ); 
				}}

			if (!$this->opt('hidesocialicons')){
				
				$custom_iconfont_array = $this->opt('custom_iconfont_array');
		
			if( !$custom_iconfont_array || !is_array($custom_iconfont_array) ){
				
				$custom_iconfont_array = array( array(), array(), array(), array() );
			}
			
				foreach( $custom_iconfont_array as $iconfont_array ){

			if (pl_array_get( 'iconfontselect', $iconfont_array )){	
				$select = pl_array_get( 'iconfontselect', $iconfont_array );

			} else
				$select = 'pagelines';	
				
			if (pl_array_get( 'iconfontcolor', $iconfont_array )){	
				$color = pl_array_get( 'iconfontcolor', $iconfont_array );

			} else
				$color = '000000';	


			if (pl_array_get( 'iconfonttitle', $iconfont_array )){	

				$title = pl_array_get( 'iconfonttitle', $iconfont_array );

			} else 
				$title = 'PageLines';

			if (pl_array_get( 'iconfonttitle', $iconfont_array )){	
				$class = str_replace(array(' '), array(''), strtolower(pl_array_get( 'iconfonttitle', $iconfont_array )));
				$class = preg_replace(array('/[^A-Za-z0-9\-]/'), array(''), $class );
				$class = preg_replace(array('/-+/'), array('-'), $class );
			} else 
				$class = 'pagelines';	

			if (pl_array_get( 'iconfontlink', $iconfont_array )){
				$link = pl_array_get( 'iconfontlink', $iconfont_array );

			} else 	
				$link = 'http://www.pagelines.com';	


			if ((pl_array_get( 'iconfonttitle', $iconfont_array )) || (pl_array_get( 'iconfontlink', $iconfont_array )) || (pl_array_get( 'iconfontselect', $iconfont_array )))
				printf('<a target="_blank" href="%s" class="%slink" title="%s"><i class="icon-%s" style="color:#%s;font-size:%spx;"></i></a>', $link, $class, $title, $select, $color, $iconfontsize );
			}}}
			
				pagelines_register_hook( 'branding_dms_icons_end' ); 
						
				echo '</div>';
					
				pagelines_register_hook( 'after_branding_dms_icons' ); 
				
				echo '</div>';
?>		
			<script type="text/javascript"> 
				jQuery('.icons a').hover(function(){ jQuery(this).fadeTo('fast', 1); },function(){ jQuery(this).fadeTo('fast', 0.5);});
			</script>
<?php 	
}
}