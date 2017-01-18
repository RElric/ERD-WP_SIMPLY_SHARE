<?php

require_once(WP_PLUGIN_DIR.'/ERD_WP_SIMPLY_SHARE/erd_wp_simply_share-class_social_network.php');

class ERD_SS_PUBLIC_VIEW {
		private $atts;
		private $content;

		public function __construct($atts, $content) {
				$this->atts = $atts;
				$this->content = $content;
		}

		public function retrieve_html(/*$social_networks*/) {
		    $class = "erd_ss_horizontal";
		    $display = null;

		    switch ($this->atts['display']) {
			    	case 'vertical':
						    switch ($this->atts['size']) {
							    	case 'tiny':
								        $class = "erd_ss_vertical erd_ss_tiny";
								    		break;

							    	case 'small':
								        $class = "erd_ss_vertical erd_ss_small";
								    		break;

							    	case 'medium':
								        $class = "erd_ss_vertical erd_ss_medium";
								    		break;

							    	case 'big':
								        $class = "erd_ss_vertical erd_ss_big";
								    		break;

							    	case 'huge':
								        $class = "erd_ss_vertical erd_ss_huge";
								    		break;
							    	
							    	default:
						            $class = "erd_ss_vertical erd_ss_medium";
								    		break;
						    }
				    		break;

			    	case 'horizontal':
						    switch ($this->atts['size']) {
							    	case 'tiny':
								        $class = "erd_ss_horizontal erd_ss_tiny";
								    		break;

							    	case 'small':
								        $class = "erd_ss_horizontal erd_ss_small";
								    		break;

							    	case 'medium':
								        $class = "erd_ss_horizontal erd_ss_medium";
								    		break;

							    	case 'big':
								        $class = "erd_ss_horizontal erd_ss_big";
								    		break;

							    	case 'huge':
								        $class = "erd_ss_horizontal erd_ss_huge";
								    		break;
							    	
							    	default:
						            $class = "erd_ss_horizontal erd_ss_medium";
								    		break;
						    }
				    		break;
			    	
			    	default:
			    			$class = "erd_ss_horizontal erd_ss_medium"
				    		break;
		    }

		    $display = "<div class='erd_simply_share ".$class."'>";

		    if($this->content != null) :
		        $display .= '<p class="title">'.$this->content.'</p>';
		    endif;

		    $display .= '<ul class="erd_ss_social_links">';

		    if(get_option('erd_wp_simply_share_twitter') == 1) :
		        $display .= '<li><a href="http://www.twitter.com/home/?status='.get_the_title().' - '.get_the_permalink().'" rel="external no_follow" target="_blank" class="twitter_btn"><span class="fa fa-2x fa-twitter"></span></a></li>';
		    endif;

		    if(get_option('erd_wp_simply_share_facebook') == 1) :
		        $display .= '<li><a href="http://www.facebook.com/sharer.php?u='.get_the_permalink().'&amp;t='.get_the_title().'" rel="external no_follow" target="_blank" class="facebook_btn"><span class="fa fa-2x fa-facebook"></span></a></li>';
		    endif;

		    if(get_option('erd_wp_simply_share_linkedin') == 1) :
		        $display .= '<li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;title='.get_the_title().'&amp;url='.get_the_permalink().'" rel="external no_follow" target="_blank" class="linkedin_btn"><span class="fa fa-2x fa-linkedin"></span></a></li>';
		    endif;

		    $display .= '</ul></div>';

		    return $display;
		}
}
