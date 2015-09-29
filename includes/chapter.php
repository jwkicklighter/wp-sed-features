<?php
/**
 * SED Features Chapter
 *
 * @version 0.1.0
 * @package SED Features
 */

require_once dirname(__FILE__) . '/../vendor/cpt-core/CPT_Core.php';
require_once dirname(__FILE__) . '/../vendor/cmb2/init.php';

class SEDF_Chapter extends CPT_Core {
	/**
	 * Parent plugin class
	 *
	 * @var class
	 * @since  0.1.0
	 */
	protected $plugin = null;

	/**
	 * Constructor
	 * Register Custom Post Types. See documentation in CPT_Core, and in wp-includes/post.php
	 *
	 * @since 0.1.0
	 * @return  null
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();

		// Register this cpt
		// First parameter should be an array with Singular, Plural, and Registered name
		parent::__construct(
			array( __( 'Chapter', 'sed-features' ), __( 'Chapters', 'sed-features' ), 'sedf-chapter' ),
			array( 'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ), )
		);
	}

	/**
	 * Initiate our hooks
	 *
	 * @since 0.1.0
	 * @return  null
	 */
	public function hooks() {
		add_action( 'cmb2_init', array( $this, 'fields' ) );
	}

	/**
	 * Add custom fields to the CPT
	 *
	 * @since  0.1.0
	 * @return  null
	 */
	public function fields() {
		$prefix = '_sedf_chapter_';

		$box = new_cmb2_box( array(
			'id'            => $prefix . 'metabox',
			'title'         => __( 'SED Features Chapter Meta Box', 'sed-features' ),
			'object_types'  => array( 'sedf-chapter', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
		) );
	}

	/**
	 * Registers admin columns to display. Hooked in via CPT_Core.
	 *
	 * @since  0.1.0
	 * @param  array  $columns Array of registered column names/labels
	 * @return array           Modified array
	 */
	public function columns( $columns ) {
		$new_column = array(
		);
		return array_merge( $new_column, $columns );
	}

	/**
	 * Handles admin column display. Hooked in via CPT_Core.
	 *
	 * @since  0.1.0
	 * @param  array  $column Array of registered column names
	 */
	public function columns_display( $column, $post_id ) {
		switch ( $column ) {
		}
	}
}
