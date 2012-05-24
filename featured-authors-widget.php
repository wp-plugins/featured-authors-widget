<?php
/*
Plugin Name: Featured Authors Widget
Plugin URI: http://www.colinduwe.com/featured-authors-widget
Description: This plugin provides a widget where an admin can select various authors of the blog to feature in a sidebar.
Version: 1.0
Author: Colin Duwe
Author URI: http://www.colinduwe.com
License: GPL2
*/

// Add our hook on init to load the widget
add_action( 'widgets_init', 'load_featured_authors_widget' );

// Standard register widget function
function load_featured_authors_widget() {
	register_widget( 'Featured_Authors' );
}


/**
 * Featured_Authors class.
 *
 */
class Featured_Authors extends WP_Widget {
	/**
	 * Widget setup.
	 */
	function Featured_Authors() {
		global $wp_version;
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'featured-authors', 'description' => 'Feature your blog\'s authors in your blog\'s sidebar.' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'cd_fa' );

		/* Create the widget. */
		$this->WP_Widget( 'cd_fa', 'Featured Authors', $widget_ops, $control_ops );
		
		if (version_compare($wp_version,"2.8","<"))
		{
			exit ("Featured Authors requires Wordpress version 2.8 or later. Please update Wordpress. :)");
		}
	}
		
	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$avatar = $instance['avatar'];
		$num_posts = $instance['num_posts'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
		foreach($instance['authors'] as $author){
			$author_obj = get_userdata($author); 
			echo '<div class="cd-fa-wrap">';
			if($avatar){
				echo '<div class="avatar-wrap">';
				echo get_avatar( $author, 60 );
				echo '</div>';
			}
			echo '<div class="cd-fa-info">';
			echo '	<span class="author vcard"><a href="';
			get_author_link ( TRUE, $author);
			echo '" title="Posts by ' . $author_obj->display_name . '" rel="author">' . $author_obj->display_name . '</a></span>';
			echo '<ul>';
				$query = 'author='.$author.'&posts_per_page=' . $num_posts . '&ignore_sticky_posts=1';
				query_posts($query);
				while (have_posts()) : the_post(); ?>
					<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="featured-contrib-story"><?php the_title(); ?></a></li>
				<?php endwhile; 
			echo '</ul></div><div class="fix"></div></div>';

		}
			
		echo $after_widget;
		wp_reset_query();
	}
	
	// Update the settings for a particular instance
	// of the widget. 
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['authors'] = $new_instance['authors'];
		$instance['avatar'] = $new_instance['avatar'];
		$instance['num_posts'] = $new_instance['num_posts'];

		return $instance;
	}

	// Display the form with the options for an
	// instance of the widget.
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Featured Authors', 'authors' => array(), 'avatar' => TRUE, 'num_posts' => 3 );
		$instance = wp_parse_args( (array) $instance, $defaults );?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

	    <p>
	    	<label for="<?php echo $this->get_field_id( 'authors' ); ?>">Select Authors:</label><br />
	    	<?php 
			$users = get_users( 'who=author' );
			foreach($users as $user){
				echo '<input type="checkbox" id="'. $this->get_field_id( 'authors' ) .'[]"name="'. $this->get_field_name('authors').'[]"';
				if(in_array($user->ID, $instance['authors']))
					echo ' checked="checked"';
				echo ' value="'.$user->ID.'" />'.$user->display_name.'<br />';
			}
	    	?>
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id( 'num_posts' ); ?>">Max number of posts to display per author:</label><br />
        	 
        	<input type="text" name="<?php echo $this->get_field_name( 'num_posts' ); ?>" value="<?php echo $instance['num_posts']; ?>" id="<?php echo $this->get_field_id( 'num_posts' ); ?>" size="4" />
	    </p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['avatar'], true ); ?> id="<?php echo $this->get_field_id( 'avatar' ); ?>" name="<?php echo $this->get_field_name( 'avatar' ); ?>" />
    		<label for="<?php echo $this->get_field_id( 'avatar' ); ?>"><?php _e('Display the authors\'s avatars?'); ?></label>
		</p>



	<?php
	}


}

?>