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
			array( 'supports' => array(null), )
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
			'title'         => __( 'Chapter Information', 'sed-features' ),
			'object_types'  => array( 'sedf-chapter', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
		) );

		$box->add_field( array(
	    'name'    => 'Greek Designation',
	    'desc'    => 'should be spelled out (i.e. Alpha, not A)',
	    'id'      => 'chapter_designation',
	    'type'    => 'text_medium',
		) );

		$box->add_field( array(
	    'name'    => 'Charter Date',
	    'id'      => 'chapter_charter1',
	    'type'    => 'text_date_timestamp',
		) );

		$box->add_field( array(
	    'name'    => 'Recharter Date 1',
	    'id'      => 'chapter_charter2',
			'type'    => 'text_date_timestamp',
		) );

		$box->add_field( array(
	    'name'    => 'Recharter Date 2',
	    'id'      => 'chapter_charter3',
			'type'    => 'text_date_timestamp',
		) );

		$box->add_field( array(
	    'name'    => 'School Name',
	    'id'      => 'chapter_school',
	    'type'    => 'text_medium',
		) );

		$box->add_field( array(
	    'name'    => 'Address',
	    'id'      => 'chapter_address',
	    'type'    => 'text_medium',
		) );

		$box->add_field( array(
	    'name'    => 'Chapter Website',
	    'id'      => 'chapter_url',
	    'type'    => 'text_medium',
		) );

		$box->add_field( array(
	    'name'             => 'Big Brother',
	    'id'               => 'chapter_big_brother',
	    'type'             => 'select',
	    'show_option_none' => true,
	    'default'          => 'custom',
	    'options'          => 'all_chapters',
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
		$columns = array();
		$new_column = array(
			'chapter' => sprintf( __( '%s' ), $this->post_type( 'singular' ) ),
			'school' => 'School',
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
			case 'chapter':
				echo sprintf( '<a href="%s">%s</a>', get_edit_post_link($post_id), get_post_meta( $post_id, 'chapter_designation', true ) );
				break;

			case 'school':
				echo get_post_meta( $post_id, 'chapter_school', true );
				break;
		}
	}
}
