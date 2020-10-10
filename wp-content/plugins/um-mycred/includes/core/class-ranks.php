<?php namespace um_ext\um_mycred\core;


if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Class Ranks
 */
class Ranks {


	/**
	 * Ranks constructor.
	 */
	function __construct() {
	}


	/**
	 * Get user progress
	 *
	 * @param $user_id
	 *
	 * @return int|string
	 */
	function get_progress( $user_id ) {

		$mycred = mycred();

		$key = $mycred->get_point_type_key();

		$users_balance = $mycred->get_users_balance( $user_id, $key );
		$users_rank = mycred_get_users_rank( $user_id );
		if ( is_object( $users_rank ) ) {
			$max = $users_rank->maximum;
		}


		if ( ! $users_balance || ! isset( $max ) || empty( $max ) ) {
			return 0;
		}
		$progress = number_format( ( ( floatval( $users_balance ) / floatval( $max ) ) * 100 ), 1 );

		if ( $progress < number_format( 100, 1 ) ) {

		} else {
			$progress = number_format( 100, 1 );
		}

		return $progress;

	}
}