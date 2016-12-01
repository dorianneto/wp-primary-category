<?php

class PrimaryCategory
{
    /**
     * Field name utilized by database, wordpress application etc
     * @var string
     */
    private $fieldName = 'primary_category';

    /**
     * Label name of field
     * @var string
     */
    private $labelName = 'Select a primary category';

    /**
     * Construct of this object
     */
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'metaBox'));
        add_action('save_post', array($this, 'fieldData'));
    }

    /**
     * Generate the Meta Box
     * @return void
     */
    public function metaBox()
    {
    	$post_types = get_post_types();

    	foreach ($post_types as $post_type) {
    		if ($post_type == 'page') { continue;}

    		add_meta_box (
    			$this->fieldName,
    			$this->labelName,
    			array($this, 'metaBoxContent'),
    			$post_type,
    			'side',
    			'high'
    		);
    	}
    }

    /**
     * Includes a content inside Meta Box generated
     * @return void
     */
    public function metaBoxContent()
    {
        global $post;

    	$primary_category = '';
    	$current_selected = get_post_meta($post->ID, $this->fieldName, true);
    	$categories       = get_the_category();

        if (!empty($current_selected)) {
            $primary_category = $current_selected;
        }

    	$output = '<select name="' . $this->fieldName . '" id="' . $this->fieldName . '">';

    	foreach($categories as $category) {
            $selected = selected($primary_category, $category->name, false);
    		$output  .= '<option value="' . $category->name . '" ' . $selected . '>' . $category->name . '</option>';
    	}

    	$output .= '</select>';

    	echo $output;
    }

    /**
     * Action to save or update data in the field
     * @return void
     */
    public function fieldData()
    {
        global $post;

        $field = filter_input(INPUT_POST, $this->fieldName, FILTER_SANITIZE_STRING);

    	if (!empty($field)) {
    		update_post_meta($post->ID, $this->fieldName, $field);
    	}
    }
}
