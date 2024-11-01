<?php
/*
Plugin Name: Simple Twitter Slider
Plugin URI: https://wordpress.org/support/profile/amybeagh
Description: Simple Twitter Slider - Display your Twitter Feeds on your website.
Version: 1.0
Author :Amy Beagh
Author URI: https://wordpress.org/support/profile/amybeagh
*/

class sm_tw_slider{
    public $option;
	
    public function __construct() {
		
        //you can run delete_option method to reset all data
        //delete_option('simple_tw_sl_plugin_option');
        $this->option = get_option('simple_tw_sl_plugin_option');
        $this->sm_tw_sl_register_settings_and_fields();
    }

    

    public  function sm_tw_sl__tools_option_page(){

        add_options_page('Simple Twitter Slider', 'Simple Twitter Slider ', 'administrator', __FILE__, array('sm_tw_slider','sm_tw_sl_tools_option'));

    }

    

    public function sm_tw_sl_tools_option(){?>
	<div class="wrap">
		<div class="stws_main">
		<h2 class="top-style">Simple Twitter Slider Settings</h2>
		  <form method="post" action="options.php" enctype="multipart/form-data" class="stws_frm">
		
			<?php settings_fields('simple_tw_sl_plugin_option'); ?>
		
			<?php do_settings_sections(__FILE__); ?>
		
			<p class="stws_submit">
		
			  <input name="submit" type="submit" class="button-success" value="Save Changes"/>
		
			</p>
		
		  </form>
		
		</div>
	</div>
	<?php
	}

    public function sm_tw_sl_register_settings_and_fields(){

        register_setting('simple_tw_sl_plugin_option', 'simple_tw_sl_plugin_option',array($this,'sm_tw_sl_validate_settings'));

        add_settings_section('sm_tw_sl_main_section', '', array($this,'sm_tw_sl_main_section_cb'), __FILE__);

        //Start Creating Fields and Options

        //sidebar image

        //add_settings_field('sidebarImage', 'Sidebar Image', array($this,'sidebarImage_settings'),__FILE__,'sm_tw_sl_main_section');

       
        //pageURL
        add_settings_field('stws_pageURL', 'Twitter Profile Name', array($this,'stws_pageURl_settiongs'), __FILE__,'sm_tw_sl_main_section');

        //pageid
        add_settings_field('stws_pageid', 'Twitter Widget ID', array($this,'stws_pageid_settings'), __FILE__,'sm_tw_sl_main_section');

  
 		//marginTop
        add_settings_field('stws_marginTop', 'Margin Top', array($this,'stws_marginTop_settings'), __FILE__,'sm_tw_sl_main_section');

        //width
        add_settings_field('stws_width', 'Width', array($this,'stws_widht_settings'), __FILE__,'sm_tw_sl_main_section');

        //height
        add_settings_field('stws_height', 'Height', array($this,'stws_height_settings'), __FILE__,'sm_tw_sl_main_section');
		
		 //linkcolor option

        add_settings_field('stws_linkcolor', 'Display Linkcolor', array($this,'page_link_color'),__FILE__,'sm_tw_sl_main_section');
		
		//alignment option
        add_settings_field('stws_alignment', 'Alignment Position', array($this,'stws_alligment_settings'),__FILE__,'sm_tw_sl_main_section');

        //color_scheme option
        add_settings_field('color_scheme', 'Color Theme', array($this,'Page_color_scheme_settings'),__FILE__,'sm_tw_sl_main_section');

         //header option
        add_settings_field('stws_header', 'Display Header', array($this,'page_heading_settings'),__FILE__,'sm_tw_sl_main_section');

        //footer option
        add_settings_field('stws_footer', 'Display Footer', array($this,'page_footer_settings'),__FILE__,'sm_tw_sl_main_section');

        //border option
        add_settings_field('stws_border', 'Display Border', array($this,'page_border'),__FILE__,'sm_tw_sl_main_section');

         //scrollbar option

        add_settings_field('stws_scrollbar', 'Display scrollbar', array($this,'page_scrollbar'),__FILE__,'sm_tw_sl_main_section');
		
		// show/hide option
		
		add_settings_field('stws_status', 'Show/Hide on Frontend', array($this,'stws_status_settings'),__FILE__,'sm_tw_sl_main_section');
        

        //jQuery option

        

    }

    public function sm_tw_sl_validate_settings($plugin_option){

        return($plugin_option);

    }

    public function sm_tw_sl_main_section_cb(){

        //optional

    }



    //stws_marginTop_settings

    public function stws_marginTop_settings() {

        if(empty($this->option['stws_marginTop'])) $this->option['stws_marginTop'] = "100";

        echo "<input name='simple_tw_sl_plugin_option[stws_marginTop]' type='text' value='{$this->option['stws_marginTop']}' />";

    }

     //stws_pageURl_settiongs

    public function stws_pageURl_settiongs() {

        if(empty($this->option['stws_pageURL']))
		 
		$this->option['stws_pageURL'] = "";

        echo "<input name='simple_tw_sl_plugin_option[stws_pageURL]' type='text' value='{$this->option['stws_pageURL']}' />";

    }

    //stws_pageid_settings

    public function stws_pageid_settings() {

        if(empty($this->option['stws_pageid'])) 
		
		$this->option['stws_pageid'] = "";

        echo "<input name='simple_tw_sl_plugin_option[stws_pageid]' type='text' value='{$this->option['stws_pageid']}' />";

    }   

   

    //stws_widht_settings

    public function stws_widht_settings() {

        if(empty($this->option['stws_width'])) $this->option['stws_width'] = "292";

        echo "<input name='simple_tw_sl_plugin_option[stws_width]' type='text' value='{$this->option['stws_width']}' />";

    }

    //stws_height_settings

    public function stws_height_settings() {

        if(empty($this->option['stws_height'])) $this->option['stws_height'] = "300";

        echo "<input name='simple_tw_sl_plugin_option[stws_height]' type='text' value='{$this->option['stws_height']}' />";

    }

    //Page_color_scheme_settings

    public function Page_color_scheme_settings(){
        if(empty($this->option['color_scheme'])) $this->option['color_scheme'] = "light";
		 $items = array('light','dark');
        foreach($items as $item_color){
            $selected = ($this->option['color_scheme'] === $item_color) ? 'checked = "checked"' : '';
			echo "<input type='radio' name='simple_tw_sl_plugin_option[color_scheme]' value='$item_color' $selected> ".ucfirst($item_color)."&nbsp;";
        }
    }

   

    //alignment_settings

    public function stws_alligment_settings(){
        if(empty($this->option['stws_alignment'])) $this->option['stws_alignment'] = "left";
        $items = array('left','right');
        foreach($items as $item){
			$selected = ($this->option['stws_alignment'] === $item) ? 'checked = "checked"' : '';
			echo "<input type='radio' name='simple_tw_sl_plugin_option[stws_alignment]' value='$item' $selected> ".ucfirst($item)."&nbsp;";
          }
    }

  

      //page_heading_settings

    public function page_heading_settings(){
        if(empty($this->option['stws_header'])) $this->option['stws_header'] = "header";
        $items = array('header','noheader');
        foreach($items as $stws_header){
			$selected = ($this->option['stws_header'] === $stws_header) ? 'checked = "checked"' : '';
			echo "<input type='radio' name='simple_tw_sl_plugin_option[stws_header]' value='$stws_header' $selected> ".ucfirst($stws_header)."&nbsp;";
        }
    }



      //page_footer_settings

    public function page_footer_settings(){

        if(empty($this->option['stws_footer'])) $this->option['stws_footer'] = "footer";

        $items = array('footer','nofooter');
        foreach($items as $stws_footer){
			$selected = ($this->option['stws_footer'] === $stws_footer) ? 'checked = "checked"' : '';
			echo "<input type='radio' name='simple_tw_sl_plugin_option[stws_footer]' value='$stws_footer' $selected> ".ucfirst($stws_footer)."&nbsp;";
        }
    }



          //page_border

    public function page_border(){
        if(empty($this->option['stws_border'])) $this->option['stws_border'] = "true";
        $items = array('true','false');
        foreach($items as $stws_border){
            $selected = ($this->option['stws_border'] === $stws_border) ? 'checked = "checked"' : '';
			echo "<input type='radio' name='simple_tw_sl_plugin_option[stws_border]' value='$stws_border' $selected> ".ucfirst($stws_border)."&nbsp;";
        }
    }



        //scroll_settings

    public function page_scrollbar(){

        if(empty($this->option['stws_scrollbar'])) $this->option['stws_scrollbar'] = "scrollbar";

        $items = array('scrollbar','noscrollbar');
        foreach($items as $stws_scrollbar){
            $selected = ($this->option['stws_scrollbar'] === $stws_scrollbar) ? 'checked = "checked"' : '';
            echo "<input type='radio' name='simple_tw_sl_plugin_option[stws_scrollbar]' value='$stws_scrollbar' $selected> ".ucfirst($stws_scrollbar)."&nbsp;";
        }
    }



    //page_link_color

    public function page_link_color() {

        if(empty($this->option['stws_linkcolor'])) $this->option['stws_linkcolor'] = "#2EA2CC";

        echo "<input name='simple_tw_sl_plugin_option[stws_linkcolor]' type='text' value='{$this->option['stws_linkcolor']}' />";

          

    }
	// stws_status_settings 
	
	public function stws_status_settings(){
		 if(empty($this->option['stws_status'])) $this->option['stws_status'] = "on";
        $items = array('on','off');
        
	   foreach($items as $status_stws){
            $selected = ($this->option['stws_status'] === $status_stws) ? 'checked = "checked"' : '';
			echo "<input type='radio' name='simple_tw_sl_plugin_option[stws_status]' value='$status_stws' $selected> ".ucfirst($status_stws)."&nbsp;";
        }
		
	}

}

	add_action('admin_menu', 'sm_tw_sl_trigger_option_function');
	function sm_tw_sl_trigger_option_function(){
	
		sm_tw_slider::sm_tw_sl__tools_option_page();
	
	} 



	add_action('admin_init','sm_tw_sl_trigger_create_object');
	
	function sm_tw_sl_trigger_create_object(){
	
		new sm_tw_slider();
	
	}

	add_action('wp_footer','sm_tw_sl_add_content_in_footer');

		function sm_tw_sl_add_content_in_footer(){
			$optiontw = get_option('simple_tw_sl_plugin_option');
			extract($optiontw);
			$print_tw_sl = '';
			if($stws_pageURL == ''){
			$print_tw_sl.='<div class="error_sm_tw">Please Fill Out The Simple Twitter Slider Configuration First</div>';	
			} else {
			
			$print_tw_sl .= '<a class="twitter-timeline"
			
			  href="https://twitter.com/'.$stws_pageURL.'"
			
			  data-widget-id="'.$stws_pageid.'"
			
			  data-theme="'.$color_scheme.'"
			
			  data-link-color="'.$stws_linkcolor.'"
			
			  data-chrome="'.$stws_header.' '.$stws_footer.' '.$stws_scrollbar.' '.$stws_border.'" 
			
			  width="'.$stws_width.'"
			
			  height="'.$stws_height.'">
			
			</a>';
		}
		$stws_ImgURL = plugins_url('assets/twitter_stws_icon.png', __FILE__ );
?>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<?php 
if($stws_status == 'on'){

if($stws_alignment=='left'){?>

<style type="text/css">

div.stws_area_left{

	left: -<?php echo trim($stws_width+10);?>px; 

	top: <?php echo $stws_marginTop;?>px; 

	z-index: 10000; 

	height:<?php echo trim($stws_height+30);?>px;

	-webkit-transition: all .5s ease-in-out;

	-moz-transition: all .5s ease-in-out;

	-o-transition: all .5s ease-in-out;

	transition: all .5s ease-in-out;

	}

div.stws_area_left.stws_sh{

	left:0;

	}	

div.stws_inner_area_left{

	text-align: left;

	width:<?php echo trim($stws_width);?>px;

	height:<?php echo trim($stws_height);?>px;

	}

</style>

<div id="smiple_twitter_slider_display">

  <div id="stws-area_tw" class="stws_area_left">
 <a class="stws_open" id="stw_link" href="javascript:;"><img class="stws_outerimg" style="top: 0px;right:-45px;" src="<?php echo $stws_ImgURL;?>" alt=""> </a>
 
    <div id="stws_area_tw2" class="stws_inner_area_left"> 
   		<?php echo $print_tw_sl; ?> </div>
  </div>
  

</div>

<?php } else { ?>
<style type="text/css">

div.stws_area_right{

	right: -<?php echo trim($stws_width+10);?>px;

	top: <?php echo $stws_marginTop;?>px;

	z-index: 10000; 

	height:<?php echo trim($stws_height+30);?>px;

	-webkit-transition: all .5s ease-in-out;

	-moz-transition: all .5s ease-in-out;

	-o-transition: all .5s ease-in-out;

	transition: all .5s ease-in-out;

	}

div.stws_area_right.stws_sh{

	right:0;

	}	

div.stws_inner_area_right{

	text-align: left;

	width:<?php echo trim($stws_width);?>px;

	height:<?php echo trim($stws_height);?>px;

	}

		

</style>
<div id="smiple_twitter_slider_display">

  <div id="stws-area_tw" class="stws_area_right">
  
 <a class="stws_open tw_link_right" id="stw_link" href="javascript:;"><img class="stws_outerimg" style="top: 0px;left:-45px;" src="<?php echo $stws_ImgURL;?>" alt=""></a>
 
    <div id="stws_area_tw2" class="stws_inner_area_right"> <?php echo $print_tw_sl; ?> </div>

  </div>

</div>
<?php } } ?>


<script type="text/javascript">

jQuery(document).ready(function() {
jQuery('#stw_link').click(function(){
	jQuery(this).parent().toggleClass('stws_sh');
});});
</script>
<?php

}
add_action( 'wp_enqueue_scripts', 'register_sm_tw_sl_styles' );
add_action( 'admin_enqueue_scripts', 'register_sm_tw_sl_styles' );
function register_sm_tw_sl_styles() {
    wp_register_style( 'sm_tw_sl_style', plugins_url( 'assets/stws_sl.css' , __FILE__ ) );
    wp_enqueue_style( 'sm_tw_sl_style' );
}

/* shortcode function */
function simple_tw_slider_sh(){
	$optiontw1 = get_option('simple_tw_sl_plugin_option');
	extract($optiontw1);
	$print_tw_sl_sh = '';
	if($stws_pageURL == ''){
	$print_tw_sl_sh.='<div class="error_sm_tw">Please Fill Out The Simple Twitter Slider Configuration First</div>';	
	} else {
	
	$print_tw_sl_sh.='<div class="sm_tw_slider_shortcode_output"><a class="twitter-timeline"
	
	  href="https://twitter.com/'.$stws_pageURL.'"
	
	  data-widget-id="'.$stws_pageid.'"
	
	  data-theme="'.$color_scheme.'"
	
	  data-link-color="'.$stws_linkcolor.'"
	
	  data-chrome="'.$stws_header.' '.$stws_footer.' '.$stws_scrollbar.' '.$stws_border.'" 
	
	  width="'.$stws_width.'"
	
	  height="'.$stws_height.'">
	
	</a></div>';
	}
	return $print_tw_sl_sh;
}
add_shortcode('sm_tw_slider', 'simple_tw_slider_sh');