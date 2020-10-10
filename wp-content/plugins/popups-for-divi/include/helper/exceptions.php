<?php //phpcs:ignore WordPress.Files.FileName.InvalidClassFileName
/**
 * Defines custom exceptions that are thrown by Popups for Divi.
 *
 * @package Popups_For_Divi
 * @phpcs:disable Generic.Files.OneObjectStructurePerFile.MultipleFound
 */

defined( 'ABSPATH' ) || die();

/**
 * Exception that is thrown, when a requested application module does not exist. It
 * indicates, that either an invalid module is used, or that the app tries to access a
 * module before it was registered.
 *
 * @since 2.0.0
 */
class PFD_Exception_Module_Not_Found extends Exception {}

/**
 * Exception that is thrown, when the application tries to register a new module, but
 * the specified module class does not exist. Either the module class contains a typo
 * (i.e. invalid class name) or the class definition was not loaded yet.
 *
 * @since 2.0.0
 */
class PFD_Exception_Invalid_Module_Class extends Exception {}

/**
 * Exception that is throws when the application tries to register two modules with
 * the same name. That's a clear indicator of unstructured or too complex code.
 *
 * @since 2.0.0
 */
class PFD_Exception_Module_Already_Registered extends Exception {}
