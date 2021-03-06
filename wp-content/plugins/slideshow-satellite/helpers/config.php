<?php

class SatelliteConfigHelper extends SatellitePlugin {

    function __construct() {

    }
    
    /**
     *
     * @param string $option ie 'slide' or 'watermark'
     * @param object $model ie $this -> Slide
     * @return array 
     */
    
    function displayOption($option, $model) {
        
        switch ($option) {
            
            case 'gallery':
                
                $optionsArray = array (
                array(  "name" => "The Gallery Editor",
                        "type" => "title"),

                array(  "type" => "open"),

                array(  "name"      => "Gallery Name",
                        "id"        => "title",
                        "type"      => "text",
                        "value"     => $model -> data -> title,
                        "std"       => "New Gallery"),

                array(  "name"      => "Gallery Type",
                        "desc"      => "What kind of slideshow is this?",
                        "id"        => "type",
                        "type"      => "select",
                        "value"     => $model -> data -> type,
                        "std"       => "custom slides",
                        "options"   => array(
                                       array('id' => 'custom slides', 'title' => 'Custom Slides'))),

                array(  "name"      => "Description",
                        "desc"      => "This will be used in future slideshow versions to describe the slideshow before someone selects to view it.",
                        "id"        => "description",
                        "value"     => $model -> data -> description,
                        "type"      => "textarea"),
                    
                array(  "name"      => "Upload Images",
                        "desc"      => "Select multiple images using the uploader, then drag the thumbs to order them right here before saving the gallery",
                        "id"        => "slides",
                        "type"      => "upload"),

                array(  "name"      => "Theme",
                        "desc"      => "Which Theme should this slideshow use? Flipbook is similar to an animated gif",
                        "id"        => "theme",
                        "value"     => $model -> data -> theme,
                        "type"      => "select",
                        "std"       => "standard",
                        "options"   =>  array(
                                        array("id" => "standard", "title" => "Standard"),
                                        array("id" => "flipbook", "title" => "Flipbook"),
                                        array("id" => "infinite", "title" => "Infinite Scroll"))),

                array(  "name"      => "Caption sizing",
                        "desc"      => "Large is In Charge for a reason. Default is how you have it set in General Configuration",
                        "id"        => "font",
                        "type"      => "select",
                        "value"     => $model -> data -> font,
                        "std"       => "Default",
                        "options"   => array(
                                       array('id' => '1', 'title' => 'Default'),
                                       array('id' => '2', 'title' => 'Mid-Sized'),
                                       array('id' => '3', 'title' => 'Big Boy'),
                                       array('id' => '4', 'title' => 'In Charge'))),

                array(  "name"      => "Caption Position",
                        "desc"      => "Where would you like to display the caption?",
                        "id"        => "capposition",
                        "value"     => $model -> data -> capposition,
                        "type"      => "select",
                        "std"       => "Overlayed",
                        "options"   => array(
                                        array('id' => 'Overlayed', 'title' => 'Overlayed'), 
                                        array('id' => 'On Right', 'title' => 'On Right'),
                                        array('id' => 'Disabled', 'title' => 'Disabled'))),
                    
                array(  "name"      => "Clean Start",
                        "desc"      => "Caption and Navigation Arrows display on mouse hover",
                        "id"        => "caphover",
                        "type"      => "checkbox",
                        "value"     => $model -> data -> caphover),

                array(  "name"      => "Pause on Hover",
                        "desc"      => "Pause the advancement of the slideshow on hover? Only works with auto being on",
                        "id"        => "pausehover",
                        "type"      => "checkbox",
                        "value"     => $model -> data -> pausehover),

                array(  "type"      => "close")

                );	
                
                break;  
              
            case 'images':
              
              $image = $this->get_option('Images');
              $optionsArray = array (
                array(  "name"      => "Image resizing",
                        "desc"      => "Newly uploaded images will be resized to fit within this size if larger",
                        "id"        => "resize",
                        "type"      => "select",
                        "value"     => $image['resize'],
                        "std"       => 1024,
                        "options"   => array(
                                       array('id' => 0, 'title' => 'No Resizing'),
                                       array('id' => 1024, 'title' => '1024 px'),
                                       array('id' => 900, 'title' => '900 px'),
                                       array('id' => 800, 'title' => '800 px'),
                                       array('id' => 600, 'title' => '600 px'))
                        ),
                  
                array(  "name"      => "Open Images in...",
                        "desc"      => "Thickbox is the standard, built into wordpress, but if you use another plugin choose custom",
                        "id"        => "imagesbox",
                        "type"      => "select",
                        "value"     => $image['imagesbox'],
                        "std"       => 'T',
                        "options"   => array(
                               array('id' => 'N', 'title' => __('No link', SATL_PLUGIN_NAME)),
                               array('id' => 'W', 'title' => __('Window', SATL_PLUGIN_NAME)),
                               array('id' => 'T', 'title' => __('Thickbox', SATL_PLUGIN_NAME)),
                               array('id' => 'C', 'title' => __('Custom', SATL_PLUGIN_NAME))
                               )
                        ),
                array(  "name"      => __('Page Link Target', SATL_PLUGIN_NAME),
                        "desc"      => __("This is setting your link target, in HTML it would be '_self' or '_blank'", SATL_PLUGIN_NAME),
                        "id"        => "pagelink",
                        "type"      => "select",
                        "value"     => $image['pagelink'],
                        "std"       => 'S',
                        "options"   => array(
                               array('id' => 'S', 'title' => __('Current Tab', SATL_PLUGIN_NAME)),
                               array('id' => 'B', 'title' => __('New Tab', SATL_PLUGIN_NAME))
                               )
                    ));
                break;
            
            case 'slide':
                
                $Gallery = new SatelliteGallery();
                $section = ($_GET['single']) ? $_GET['single'] : $model -> data -> section;
                
                $optionsArray = array(
                array(  "name"      => "Title",
                        "desc"      => "title/name of your slide as it will be displayed to your users.",
                        "id"        => "title",
                        "type"      => "text",
                        "value"     => $model -> data -> title,
                        "std"       => "New Slide"),
                array(  "name"      => "Description",
                        "desc"      => "description of your slide as it will be displayed in the caption.",
                        "id"        => "description",
                        "type"      => "textarea",
                        "value"     => $model -> data -> description,
                        "std"       => ""),
                array(  "name"      => "Gallery",
                        "desc"      => "The gallery this slide belongs to",
                        "id"        => "section",
                        "type"      => "select",
                        "value"     => $section,
                        "std"       => "Select a Gallery",
                        "options"   => $Gallery -> getGalleries()),
                array(  "name"      => "Caption Location",
                        "desc"      => "Default is the bottom caption bar",
                        "id"        => "textlocation",
                        "type"      => "select",
                        "value"     => $model -> data -> textlocation,
                        "std"       => "D",
                        "options"   => array(
                                array('id'=>'N', 'title'=>'None'),
                                array('id'=>'D', 'title'=>'Default'),
                                array('id'=>'BR', 'title'=>'Bottom Right'),
                                array('id'=>'TR', 'title'=>'Top Right')))
                    );                
                break;
              
            case 'preloader':
                $preloader = $this->get_option('Preloader');
                $params = array("start" => 1,
                                "skip1" => 1,
                                "firstend" => 5,
                                "end"      => 35,
                                "skip2"    => 3);
                $optionsArray = array(
                array(  "name"      => "Preload # of Images",
                        "desc"      => "How many images should load before the slideshow loads?",
                        "id"        => "quantity",
                        "type"      => "select",
                        "std"       => "1",
                        "value"     => $preloader['quantity'],
                        "options"   => $this->showNumberConfig($params,"images"))
                    );
                break;
            
            case 'watermark':
                
                $Gallery = new SatelliteGallery();
                $Slide = new SatelliteSlide();
                $watermark = $this->get_option('Watermark');
                $params = array("start" => 20,
                                "skip1" => 10,
                                "end" => 100);

                $optionsArray = array(
                array(  "name"      => "Watermarking",
                        "desc"      => "With this checked - On your image uploads we will apply your chosen watermark",
                        "id"        => "enabled",
                        "type"      => "select",
                        "value"     => $watermark['enabled'],
                        "options"   => array(
                            array('id'=>1, 'title'=>'Enabled'),
                            array('id'=>0, 'title'=>'Disabled')
                            )),
                array(  "name"      => "Watermark Image",
                        "desc"      => "Create a gallery entitled \"Watermark\" if enabled. Upload transparent PNG images you'd like to use as the watermark there.",
                        "id"        => "image",
                        "type"      => "select",
                        "value"     => $watermark['image'],
                        "std"       => "Select a Watermark",
                        "options"   => $Slide -> getGalleryImages("Watermark")),
                array(  "name"      => "Watermark Opacity",
                        "desc"      => "At 100% opacity you can use advanced PNG-24 transparency, utilizing the percentage is best for PNG-8",
                        "id"        => "opacity",
                        "type"      => "select",
                        "value"     => $watermark['opacity'],
                        "std"       => "100",
                        "options"   => $this->showNumberConfig($params,"%")
                        ),
                array(  "name"      => "Watermark Location",
                        "desc"      => "Only bottom right for now",
                        "id"        => "location",
                        "type"      => "select",
                        "value"     => $watermark['location'],
                        "std"       => "BR",
                        "options"   => array(
                            array('id'=>'BR', 'title'=>'Bottom Right')
                            //array('id'=>'CX', 'title'=>'Cross X')
                            ))

                );                
                break;
        }
        return $optionsArray;
    }
    /**
     * @params array (start=>int, firstend=>int(optional), skip1=>int, end=int, skip2=int(optional)
     * @return array for configs to use 
     * 
     */
    function showNumberConfig($params, $extra = null) {
     $end = ($params['firstend']) ? $params['firstend'] : $params['end'];
     for ($i = $params['start'];$i <= $end; $i = $i + $params['skip1'] ) {
       $return[] = array("id" => $i, "title" => $i." ".$extra);
     }
     // Firstend means there must be a second end. Otherwise there's just an end
     if ($params['firstend']) {
       for ($i = $i+$params['skip2']-1;$i <= $params['end']; $i = $i + $params['skip2'] ) {
         $return[] = array("id" => $i, "title" => $i." ".$extra);
       }       
     }
     return $return;
    }
    /*
     * @return @string for sending to satellite orbit js
     */
    function getTransitionType() {
        
      if ($this->get_option('transition_temp') == "FB") {
          $transition = "fade-blend";
      } elseif ($this->get_option('transition_temp') == "FE") {
          $transition = "fade-empty";
      } elseif ($this->get_option('transition_temp') == "OHS") {
          $transition = "horizontal-slide";
      } elseif ($this->get_option('transition_temp') == "OVS") {
          $transition = "vertical-slide";
      } elseif ($this->get_option('transition_temp') == "OHP") {
          $transition = "horizontal-push";
      } elseif ($this->get_option('transition_temp') == "N") {
          $transition = "none";
      } else {
          $transition = "fade-blend";
      }

      return $transition;
    }
    
    function getProOption($option,$pID) {
        $option = $this->get_option($option);
        if (is_array($option)) {
            foreach ($option as $skey => $sval) {                        
                if ($skey == $pID)
                    return $sval;
            }
        }
        return null;
    }
    /*
     * Returns to list($transition,$animspeed,$autospeed,$auto)
     * @return array
     */
    function getFlipBookSettings() {
      return array("none","1","100","Y");
    }
    

}
?>
