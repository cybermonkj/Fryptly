<?php
/**
 * Base component for other PFD-classes.
 *
 * @package Popups_For_Divi
 */

/**
 * Base class.
 *
 * This base class is shared with other divimode plugins.
 *
 * When this file needs to be updated, change the version number and propagate all
 * changes to the other plugins!
 *
 * @version 2.1.0
 */
class PFD_Component {
	/**
	 * Whether the current instance was already set up.
	 *
	 * @since 1.2.3
	 * @var bool
	 */
	private $setup_complete = false;

	/**
	 * Holds details about registered child modules of the component.
	 *
	 * Used by add_module() / module() / module_type().
	 *
	 * @since 1.2.3
	 * @var array
	 */
	private static $internal_modules = [];

	/**
	 * Set up the new component.
	 *
	 * @since 1.2.3
	 */
	public function __construct() {
		// Initialize variables instantly.
		$this->setup_instance();
	}

	/**
	 * Setup class variables during constructor call.
	 *
	 * @since 1.2.3
	 * @return void
	 */
	protected function setup_instance() {
		// This function can be overwritten in the child class.
	}

	/**
	 * Setup all the hooks of the object and initialize members.
	 *
	 * @since 1.2.3
	 * @return void
	 */
	public function setup() {
		// This function can be overwritten in the child class.
	}

	/**
	 * Marks the current instance as set-up.
	 *
	 * @since 1.2.3
	 * @return void
	 */
	final public function internal_setup() {
		$this->setup_complete = true;
	}

	/**
	 * Registers a setup hook name and returns $this for chaining.
	 *
	 * @since 1.2.3
	 * @param string $hook_name Defines the WP action which triggers setup().
	 * @return PFD_Component
	 */
	final public function setup_on( $hook_name ) {
		if ( ! $this->setup_complete ) {
			add_action( $hook_name, [ $this, 'setup' ] );
			add_action( $hook_name, [ $this, 'internal_setup' ] );
		}

		return $this;
	}

	/**
	 * Returns the main application object.
	 *
	 * @since 1.2.3
	 * @return PFD_App
	 */
	final public static function app() {
		return $GLOBALS['divi_popup'];
	}

	/**
	 * Registers a new child module of the current component.
	 *
	 * @throws PFD_Exception_Invalid_Module_Class When the specified class name is invalid.
	 * @throws PFD_Exception_Module_Already_Registered When the given module identifier is already registered.
	 *
	 * @since 1.2.3
	 * @param string $id         Identifier of the module, used to address it later.
	 * @param string $class_name Class name of the new module.
	 * @return object The newly created module instance.
	 */
	final protected static function add_module( $id, $class_name ) {
		if ( ! class_exists( $class_name ) ) {
			throw new PFD_Exception_Invalid_Module_Class( 'Class not found: ' . $class_name );
		}
		if ( isset( self::$internal_modules[ $id ] ) ) {
			throw new PFD_Exception_Module_Already_Registered( 'Module already registered: ' . $id );
		}

		// Create the new module instance.
		$inst = new $class_name();

		// Store the instance for later access.
		self::$internal_modules[ $id ] = [
			'id'    => $id,
			'class' => $class_name,
			'inst'  => $inst,
		];

		return $inst;
	}

	/**
	 * Returns a previously registered module instance.
	 *
	 * When the current instance has no component with that identifier, then the
	 * $strict param determines whether to check all parent components or whether
	 * an error should be thrown.
	 *
	 * @throws PFD_Exception_Module_Not_Found When no module with the requested
	 *         identifier exists.
	 *
	 * @since 1.2.3
	 * @param string $id     The module identifier.
	 * @param bool   $strict When false, then the parents module() is returned in
	 *                       case the current component does not have the requested
	 *                       module.
	 * @return object Returns the module instance.
	 */
	final public static function module( $id, $strict = false ) {
		if ( isset( self::$internal_modules[ $id ] ) ) {
			return self::$internal_modules[ $id ]['inst'];
		}

		if ( $strict ) {
			throw new PFD_Exception_Module_Not_Found( 'No module found with id: ' . $id );
		} else {
			return null;
		}
	}

	/**
	 * Returns the class name of the requested module, or an empty string when no
	 * module with the given identifier was registered.
	 *
	 * @since 1.2.3
	 * @param string $id The module identifier.
	 * @return string Returns the class name of the module, or an empty string when
	 *                the module was not registered.
	 */
	final public function module_type( $id ) {
		if ( isset( self::$internal_modules[ $id ] ) ) {
			return self::$internal_modules[ $id ]['class'];
		}

		return '';
	}
}
