<?PHP
/*
Plugin Name: Flowplayer for Wordpress
Plugin URI: http://saiweb.co.uk/wordpress-flowplayer
Description: Flowplayer Wordpress Extension GPL Edition
Version: 2.0.1.2
Author: David Busby
Author URI: http://saiweb.co.uk
*/
/**
 * FlowPlayer for Wordpress
 * ©2008 David Busby
 * @see http://creativecommons.org/licenses/by-nc-sa/2.0/uk
 */

/**
 * defines
 */
 define("PLAYER",'/flowplayer_3.0.1_gpl/flowplayer-3.0.1.swf');
/**
 * WP Hooks
 */
add_action('wp_head', 'flowplayer_head');
add_filter('the_content', 'flowplayer_content');
add_action('admin_menu', 'flowplayer_admin');
$fp = new flowplayer();
/**
 * END WP Hooks
 */
 
 
/**
 * Flowplayer <head></head> additions (js, css etc).
 */
 function flowplayer_head() {
 	$html = "\n<!-- Saiweb.co.uk Flowplayer For Wordpress Javascript Start -->\n";
	$html .= '<script type="text/javascript" src="'.RELATIVE_PATH.'/flowplayer_3.0.1_gpl/flowplayer.min.js"></script>';
 	$html .= "\n<!-- Saiweb.co.uk Flowplayer For Wordpress Javascript END -->\n";
 	echo $html;
 }
/**
 * Admin menu function!
 */
function flowplayer_admin () {
	/**
	 * We're in the admin page
	 */
	 if (function_exists('add_submenu_page')) {
		add_options_page(
							'Wordpress Flowplayer', 
							'Wordpress Flowplayer', 
							8, 
							basename(__FILE__), 
							'flowplayer_page'
						);
	}
	/**
	 * Add javascript
	 */
}

/**
 * Admin menu <head></head> additions
 */
 function flowplayer_admin_head() {
 	/**
 	 * Standard JS
 	 */
 	flowplayer_head();
 	/**
 	 * Admin specific
 	 */
 	$html = "\n<!-- Saiweb.co.uk Flowplayer For Wordpress ADMIN Javascript Start -->\n";
 	$html .= '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>';	
 	$html .= "\n".'<script type="text/javascript" src="'.RELATIVE_PATH.'/js/farbtastic/farbtastic.js"></script>';
 	$html .= "\n".'<link rel="stylesheet" href="'.RELATIVE_PATH.'/js/farbtastic/farbtastic.css" type="text/css" />';
 	$html .= "\n<!-- Saiweb.co.uk Flowplayer For Wordpress ADMIN Javascript END -->\n";
 	echo $html;
 }
 
/**
 * Output 'selected' bool options based on arg passed
 * @var string true / false
 * @return string HTML
 */
function bool_select($current) {
	switch($current) {
		 		case "true":
		 			$html = '<option selected value="true">true</option><option value="false">false</option>';
		 		break;
		 		case "false":
		 			$html = '<option value="true" >true</option><option selected value="false">false</option>';
		 		break;
		 		default:
		 			$html = '<option value="true">true</option><option selected value="false">false</option>';
		 		break;
		 	}
		 return $html;
}

/**
 * Generate opacity options
 */
function opacity_select($current) {
	//setup possble vals array
	$vals = array (
					"1.0" => "",
					"0.9" => "",
					"0.8" => "",
					"0.7" => "",
					"0.6" => "",
					"0.5" => "",
					"0.4" => "",
					"0.3" => "",
					"0.2" => "",
					"0.1" => ""
					);
	//set current selected value
	$vals[$current] = "selected";
	//set html
	$html ='	
				<option '.$vals["1.0"].' value="1.0">1.0</option>
				<option '.$vals["0.9"].' value="0.9">0.9</option>
				<option '.$vals["0.8"].' value="0.8">0.8</option>
				<option '.$vals["0.7"].' value="0.7">0.7</option>
				<option '.$vals["0.6"].' value="0.6">0.6</option>
				<option '.$vals["0.5"].' value="0.5">0.5</option>
				<option '.$vals["0.4"].' value="0.4">0.4</option>
				<option '.$vals["0.3"].' value="0.3">0.3</option>
				<option '.$vals["0.2"].' value="0.2">0.2</option>
				<option '.$vals["0.1"].' value="0.1">0.1</option>
			'; 
	return $html;
}
/**
 * build hidden inputs
 */
function flowplayer_colours($fp) {
$html ='<ul>
		<li><input disabled type="radio" name="tgt" value="backgroundColor" checked /> controlbar</li>		
		<!--<li><input disabled type="radio" name="tgt" value="canvas" /> canvas</li> Not stable yet-->
		<li><input disabled type="radio" name="tgt" value="sliderColor" /> sliders</li>
		<li><input disabled type="radio" name="tgt" value="buttonColor" /> buttons</li>
		<li><input disabled type="radio" name="tgt" value="buttonOverColor" /> mouseover</li>
		<li><input disabled type="radio" name="tgt" value="durationColor" /> total time</li>
		<li><input disabled type="radio" name="tgt" value="timeColor" /> time</li>
		<li><input disabled type="radio" name="tgt" value="progressColor" /> progress</li>
		<li><input disabled type="radio" name="tgt" value="bufferColor" /> buffer</li>
		</ul>
';

$html .= 
'
<input type="hidden" name="backgroundColor" value="'.$fp->conf['backgroundColor'].'" />		
<input type="hidden" name="canvas" value="'.$fp->conf['canvas'].'" />
<input type="hidden" name="sliderColor" value="'.$fp->conf['sliderColor'].'" />
<input type="hidden" name="buttonColor" value="'.$fp->conf['buttonColor'].'" />
<input type="hidden" name="buttonOverColor" value="'.$fp->conf['buttonOverColor'].'" />
<input type="hidden" name="durationColor" value="'.$fp->conf['durationColor'].'" />
<input type="hidden" name="timeColor" value="'.$fp->conf['timeColor'].'" />
<input type="hidden" name="progressColor" value="'.$fp->conf['progressColor'].'" />
<input type="hidden" name="bufferColor" value="'.$fp->conf['bufferColor'].'" />
';
return $html;
}
/**
 * Admin config menu
 */
function flowplayer_page() {
	//initialize the class:
	$fp = new flowplayer();
//setup required files
flowplayer_admin_head();	
	$html = 
'
<script language="Javascript" type="text/javascript">
	$(document).ready(function() {
		//load player
		$f("player", "'.RELATIVE_PATH.PLAYER.'", {
				plugins: {
  					 controls: {    					
      					buttonOverColor: \''.$fp->conf['buttonOverColor'].'\',
      					sliderColor: \''.$fp->conf['sliderColor'].'\',
      					bufferColor: \''.$fp->conf['bufferColor'].'\',
      					sliderGradient: \'none\',
      					progressGradient: \'medium\',
      					durationColor: \''.$fp->conf['durationColor'].'\',
      					progressColor: \''.$fp->conf['progressColor'].'\',
      					backgroundColor: \''.$fp->conf['backgroundColor'].'\',
      					timeColor: \''.$fp->conf['timeColor'].'\',
      					buttonColor: \''.$fp->conf['buttonColor'].'\',
      					backgroundGradient: \'none\',
      					bufferGradient: \'none\',
   						opacity:1.0
   						}
				},
				clip: {
					url:\'http://blip.tv/file/get/N8inpasadena-Flowers457.flv\',
					autoPlay: '.(isset($fp->conf['autoplay'])?$fp->conf['autoplay']:'false').',
       				autoBuffering: '.(isset($fp->conf['autobuffer'])?$fp->conf['autobuffer']:'false').'
				},
				screen: {
					top:\'10px\',
					left:20,
					width:300,
					height:200
				},
		
				logo: {
					width:200
				},
		
				canvas: {
					backgroundColor:\'#333333\'
				},
				onLoad: function() {
					$(":input[name=tgt]").removeAttr("disabled");		
				},
				onUnload: function() {
					$(":input[name=tgt]").attr("disabled", true);		
				}
			});
		//colour picker call back to api and hidden vars		
		$(\'#colourpicker\').farbtastic(function(color){
			var tgt = $(":input[name=tgt]:checked").val();
			//set to hidden input
			$(":input[name="+tgt+"]").val(color);
			var player = $f("player");
				
			if (player.isLoaded()) {						

			// adjust canvas bgcolor. uses undocumented API call. not stabilized yer
			if (tgt == \'canvas\') {					
				player._api().fp_css("canvas", {backgroundColor:color});
				
			// adjust controlbar coloring
			} else {
	
				window.canvasColor = color;
				player.getControls().css(tgt, color);	
			}			
			
		} else {
			player.load();	
		}			
		});
	});
</script>
<div class="wrap">
<form id="wpfp_options" method="post">
<div id="icon-options-general" class="icon32"><br></div>
<h2><a href="http://www.saiweb.co.uk">Saiweb</a> Flowplayer for Wordpress</h2>
<h3>Like this plugin?</h3>
A lot of development time and effort went into Flowplayer and this plugin, you can help support further development by purchasing a comercial license for flowplayer.
<h3><a href="http://flowplayer.org/download/index.html?aff=100">Get a commercial license now!</a></h3>
<h3>Please set your default player options below</h3>
<table>
	<tr>
		<td>AutoPlay: </td>
		<td>
		 	<select name="autoplay">';
	$html .= bool_select($fp->conf['autoplay']);	 	
	$html .=' 
		 	</select>
		 </td>
	</tr>
	<tr>
		<td>Commercial License Key: </td>
		<td>
			<input type="text" size="20" name="key" id="key" value="'.$fp->conf['key'].'" />	
			(Required for certain features i.e. custom logo)
		</td>
	</tr>
	<tr>
		<td>Relative Path: </td>
		<td>
			<input type="text" size="20" name="rpath" id="rpath" value="'.(isset($fp->conf['rpath'])?$fp->conf['rpath']:'/wp-content/plugins/word-press-flow-player').'" />	
			(Only change this if you have a non standard word press install)
		</td>
	</tr>	
	<tr>
		<td>Auto Buffering:</td>
		<td><select name="autobuffer">';
$html .= bool_select($fp->conf['autobuffer']);
$html .='
		</select></td>
	</tr>
	<tr>
		<td><div id="colourpicker"></div></td>
		<td>
			'.flowplayer_colours($fp).'
		</td>
	<tr>
		<td>&nbsp;</td>
		<td>
			<input type="submit" name="submit" class="button-primary" value="Save Changes" />
		</td>
	</tr>
</table>
</form>
<div id="player" style="width:300px;height:200px;"></div>
<br /><br />
<h3><a href="http://trac.saiweb.co.uk/saiweb">Report a Bug</a></h3>
</div>';
 
 echo $html;
}

function flowplayer_content( $content ) {
	$fp = new flowplayer();
	
	$regex = '/\[FLOWPLAYER=([a-z0-9\:\.\-\&\_\/]+)\,([0-9]+)\,([0-9]+)\]/i';
	$matches = array();

	preg_match_all($regex, $content, $matches);
	
	if($matches[0][0] != '') {
		foreach($matches[0] as $key => $data) {
			/**
			 * 0 = string
			 * 1 = media
			 * 2 = width
			 * 3 = height
			 */
			$content = str_replace($matches[0][$key], $fp->build_min_player($matches[2][$key], $matches[3][$key], $matches[1][$key]),$content);

		}
	
	} 
	return $content;
}

class flowplayer
{
	private $count = 0;
	
	/**
	 * Relative URL path
	 */
	const RELATIVE_PATH = '';
	/**
	 * Where videos _should_ be stored
	 */
	const VIDEO_PATH = '';
	/**
	 * Where the config file should be
	 */
	private $conf_path = '';
	
	/**
	 * config stack
	 */
	public $conf = array();
	
	/**
	 * Class construct
	 */
	public function __construct() {
		//set conf path
		$this->conf_path = realpath(dirname(__FILE__)).'/saiweb_wpfp.conf';
		//if a post event has occured
		if(isset($_POST['submit'])) {
			//write config
			$this->_set_conf();
		}
		//load conf data into stack
		$this->_get_conf();
	}
	/**
	 * get config vars
	 * 
	 * @return bool Returns false on failiure, true on success
	 */
	private function _get_conf() {
		//check file exists
		if(file_exists($this->conf_path)) {
			//open file for reading
			$fp = fopen($this->conf_path,'r');
			//check if failed to open
			if(!$fp) {
				error_log('Could not open '.$this->conf_path);
				$return = false;
			} else {
				//read data
				$data = fread($fp,filesize($this->conf_path));
				//get each line
				$tmp = explode("\n",$data);
				//get each var
				foreach($tmp as $key => $dat) {
					//split from var:val
					$data = explode(':', $dat);
					//build into conf stack
					$this->conf[$data[0]] = $data[1];
					$return = true;
				}
			}
			if(!defined('RELATIVE_PATH')){
				define('RELATIVE_PATH',(isset($this->conf['rpath'])?$this->conf['rpath']:'/wp-content/plugins/word-press-flow-player'));
				define('VIDEO_PATH',(isset($this->conf['rpath'])?substr(0, strpos($this->conf['rpath'],'wp-content'),$this->conf['rpath']).'wp-content/videos':'/wp-content/videos')); 
			}
			fclose($fp);
		} else {
			error_log("Files does not exist: $this->conf_path, attempting to create");
			//attempt to create file
			if(touch($this->conf_path)) {
				//everything is ok!
				error_log($this->conf_path.' Created');
				//read the data
				$this->_get_conf();
			} else {
				//failed
				error_log($this->conf_path.' Creation failed');
				$return = false;
			}
		}
		
		return $return;
	}
	/**
	 * write config vars
	 */
	private function _set_conf() {
		//attempt to open file
		$fp = fopen($this->conf_path,'w');
		
		if(!$fp) {
			error_log('Could not open '.$this->conf_path.' for writing');
		} else {
			//file is opened for editing!
			$str = ''; //setup holder var
			//loop post data
			foreach($_POST as $key => $data) {

				//do not want to record the submit value in the config file
				if($key != "submit") {
					$str .= $key.':'.$data."\n";
				}
			}
			//comit data
			$len = strlen($str);
			//check lenght
			if($len > 0) { 
				//attempt write
				$write = fwrite($fp, $str, $len);
				//report if failed to error_log
				if(!$write) {
					error_log('Could not write to '.$this->conf_path);
				}
			} else {
				//report 0 length write attempt
				error_log('Caught attempt to write 0 length to config file, aborted');
			}
			fclose($fp);
		}
	}
	/**
	 * Salt function
	 * @return string salt
	 */
	private function _salt() {
        $salt = substr(md5(uniqid(rand(), true)), 0, 10);    
        return $salt;
	}
	
	public function build_min_player($width, $height, $media, $server=false) {
			
			if(strpos($media,'http://') === false) {
				$media = VIDEO_PATH.$media;
			}
			//set player path
			$player = RELATIVE_PATH.PLAYER;
			
			$html = ''; //setup html var
			/**
			 * Fix #2 
			 * @see http://trac.saiweb.co.uk/saiweb/ticket/2
			 */
			$hash = md5($media.$this->_salt());
			
			/**
			 * flowplayer config
			 */
			 $html .= '<div id="saiweb_'.$hash.'" style="width:'.$width.'px; height:'.$height.'px;"></div>';

/**
 * key: \''.$this->conf['key'].'\',
 *
contextMenu: [ 
 
    {\'Worpress Flowplayer\' : function() { 
        location.href = "http://www.saiweb.co.uk/wordpress-flowplayer";  
    }}, 
     
    // menu separator.  
    \'-\', 
     
    {\'Get Flowplayer Comercial\' : function() { 
        location.href = "http://flowplayer.org/download/index.html?aff=100";  
    }} 
], 
 */
//$config = 'plugins:{controls:{buttonOverColor:\''.$this->conf['buttonOverColor'].'\',sliderColor:\''.$this->conf['sliderColor'].'\',bufferColor:\''.$this->conf['bufferColor'].'\',sliderGradient:\'none\',progressGradient:\'medium\',durationColor:\''.$this->conf['durationColor'].'\',progressColor:\''.$this->conf['progressColor'].'\',backgroundColor:\''.$this->conf['backgroundColor'].'\',timeColor:\''.$this->conf['timeColor'].'\',buttonColor:\''.$this->conf['buttonColor'].'\',backgroundGradient:\'none\',bufferGradient:\'none\',opacity:1.0}},clip:{url:\''.$media.'\',autoPlay:'.$this->conf['autoplay'].',autoBuffering:'.$this->conf['autobuffer'].'}';

//$embed = '<object width="'.$width.'" height="'.$height.'"><embed type="application/x-shockwave-flash" wmode="transparent" src="http://'.$_SERVER['SERVER_NAME'].$player.'?config={'.str_replace("\n", '', $config).'}" width="'.$width.'" height="'.$height.'"></embed></object>';


			$html .= '
<script language="JavaScript">
$f("saiweb_'.$hash.'", "'.$player.'", {
plugins: {
  					 controls: {    					
      					buttonOverColor: \''.$this->conf['buttonOverColor'].'\',
      					sliderColor: \''.$this->conf['sliderColor'].'\',
      					bufferColor: \''.$this->conf['bufferColor'].'\',
      					sliderGradient: \'none\',
      					progressGradient: \'medium\',
      					durationColor: \''.$this->conf['durationColor'].'\',
      					progressColor: \''.$this->conf['progressColor'].'\',
      					backgroundColor: \''.$this->conf['backgroundColor'].'\',
      					timeColor: \''.$this->conf['timeColor'].'\',
      					buttonColor: \''.$this->conf['buttonColor'].'\',
      					backgroundGradient: \'none\',
      					bufferGradient: \'none\',
   						opacity:1.0
   						}
				},
	clip: { 
        url: \''.$media.'\', 
        autoPlay: '.(isset($this->conf['autoplay'])?$this->conf['autoplay']:'false').',
        autoBuffering: '.(isset($this->conf['autobuffer'])?$this->conf['autobuffer']:'false').'
    }
});
</script>';
		return $html;
	}
}
?>
