<?php
	
	//Declare 
	$tabindex = 0; 
	
	//Header 
    get_header();
   
	//Get json stuff 
    $json = json_decode(file_get_contents('http://www.helsingborg.se/wp-content/plugins/helsingborg-widgets/helsingborg-event/json.php?count=6'));
    
	//Loop
    if ( !empty( $json ) && count( $json ) ) {
	    
	    echo '<div class="event-list">'; 
	    
	    foreach ( $json as $event ) {
		    
		    $tabindex++;
		    
		    echo '<a href="#" tabindex="' . $tabindex . '" class="event-item">'; 
		    
		    	echo '<span class="event-inner">'; 
		    
			    	//Image 
			    	if (isset($event->ImagePath) && $event->ImagePath != '') {
				    	echo '<span class="event-image" style="background-image:url(\''. $event->ImagePath . '\');"></span>'; 
			    	} else {
				    	echo '<span class="event-image image-missing" data-missing-image="' . __("Bild saknas") . '"></span>'; 
			    	}
			    	
			        echo '<span class="index-container">'; 
				        echo '    <span class="index-caption"><span>' . $event->Name . '</span></span>'; 
				        echo '    <span class="index-description">' . wpautop((strlen($event->Description) > 703) ? substr($event->Description,0,700).'...' : $event->Description, true) . '</span>'; 
				        echo '    <span class="index-date">' . dateToDay($event->Date) . ' kl. ' . $event->Time. '</span>'; 
				        echo '    <span class="index-place">' . $event->Location . '</span>'; 
			        echo '</span>'; 
		        
		        echo '</span>'; 
		        
		    echo '</a>'; 
				    
	    } 
	    
	    echo '</div>'; 
	    
	    echo '<div class="event-backdrop"></div>'; 
	    
    }
    
    get_footer();