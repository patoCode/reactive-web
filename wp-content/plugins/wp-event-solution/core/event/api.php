<?php

namespace Etn\Core\Event;

use \Etn\Utils\Helper;

defined( 'ABSPATH' ) || exit;

class Api extends \Etn\Base\Api_Handler {

    /**
     * define prefix and parameter patten
     *
     * @return void
     */
    public function config() {
        $this->prefix = 'event';
        $this->param  = ''; // /(?P<id>\w+)/
    }

    /**
     * get user profile when user is logged in
     * @API Link www.domain.com/wp-json/eventin/v1/event/
     * @return array status_code, messages, content
     */
    public function get_events() {

        $status_code     = 0;
        $messages        = $content        = [];
        $translated_text = ['see_details_text' => esc_html__( 'See Details', 'eventin' )];
        $request         = $this->request;

        if ( !empty( $request['id'] ) && is_numeric( $request['id'] ) ) {
            
            // request for a single event
            $event_id = $request['id'];
            $event    = (array) get_post( $event_id );  // obj
            $event_meta = get_post_meta( $event_id ); // array
            $serialized_meta = ["etn_event_schedule", "etn_event_socials", "etn_ticket_variations"];

            // prepare event meta
            foreach( $event_meta as $key => $val ){

                if( is_array($val) ){
                    $event_meta[$key] = $val[0];
                }

                if( in_array($key, $serialized_meta) ){
                    $event_meta[$key] = maybe_unserialize( $event_meta[$key] );
                }

            }

            
            //prepare event taxonomy
            $content['etn_category']    = $categories = array_keys( Helper::get_event_category($event_id) );
            $content['etn_tags']        = $tags       = array_keys( Helper::get_event_tag($event_id) );
            
            
            $event_meta['etn_event_logo_url']  = ( isset( $event_meta['etn_event_logo'] ) && !empty( $event_meta['etn_event_logo'] ) ) ? wp_get_attachment_url( $event_meta['etn_event_logo'] ) : '';
            $event_meta['_thumbnail_id_url']   = ( isset( $event_meta['_thumbnail_id'] ) && !empty( $event_meta['_thumbnail_id'] ) ) ? wp_get_attachment_url( $event_meta['_thumbnail_id'] ) : '';
            $event_meta['banner_bg_image_url'] = ( isset( $event_meta['banner_bg_image'] ) && !empty( $event_meta['banner_bg_image'] ) ) ? wp_get_attachment_url( $event_meta['banner_bg_image'] ) : '';
            
            $event_meta['selected_etn_category'] = wp_get_post_terms( $event_id, 'etn_category', [ 'fields' => 'ids' ] );
            $event_meta['selected_etn_tags']     = wp_get_post_terms( $event_id, 'etn_tags', [ 'fields' => 'ids' ] );
            $content =  $event + $event_meta;


            return [
                'status_code' => 200,
                'messages'    => [
                    'success' => esc_html__( 'Event data retrieve successful', 'eventin' ),
                ],
                'content'     => $content,
            ];

        } else {

            // request for all events, may include filtering

            // pass input field for checking empty value
            $inputs_field = [
                ['name' => 'month', 'required' => true, 'type' => 'number'],
                ['name' => 'year', 'required' => true, 'type' => 'number'],
                ['name' => 'display', 'required' => false, 'type' => 'text'],
                ['name' => 'endDate', 'required' => false, 'type' => 'text'],
                ['name' => 'startTime', 'required' => false, 'type' => 'text'],
            ];

            $validation = Helper::input_field_validation( $request, $inputs_field );

            if ( !empty( $validation['status_code'] ) && $validation['status_code'] == true ) {
                $input_data = $validation['data'];
                $month      = sprintf( "%02d", $input_data['month'] );
                $year       = $input_data['year'];
                $display    = !empty( $input_data['display'] ) ? $input_data['display'] : '';
                $endDate    = !empty( $input_data['endDate'] ) ? filter_var( $input_data['endDate'], FILTER_VALIDATE_BOOLEAN ) : false;
                $startTime  = !empty( $input_data['startTime'] ) ? filter_var( $input_data['startTime'], FILTER_VALIDATE_BOOLEAN ) : false;

                $event_list = Helper::get_events_by_date( $month, $year, $display, $endDate, $startTime );

                if ( !empty( $event_list ) ) { // empty means no error message, proceed
                    $status_code         = 1;
                    $content             = $event_list;
                    $messages['success'] = 'success';
                } else {
                    $messages['error'] = 'error';
                }

            } else {
                $status_code = $validation['status_code'];
                $messages    = $validation['messages'];
            }

            return [
                'status_code'     => $status_code,
                'messages'        => $messages,
                'content'         => $content,
                'translated_text' => $translated_text,
            ];
        }

    }

    /**
     * @description get settings data  through api
     * @API Link www.domain.com/wp-json/eventin/v1/event/settings
     * @return array
     */
    public function get_settings() {
        $status_code = 0;
        $messages    = $content    = [];
        $request     = $this->request;
        $settings    = \Etn\Core\Settings\Settings::instance()->get_settings_option();

        if ( !is_admin() && !current_user_can( 'manage_options' ) ) {

            if ( !wp_verify_nonce( $this->request->get_header( 'X-WP-Nonce' ), 'wp_rest' ) ) {
                $messages[] = esc_html__( 'Nonce is not valid! Please try again.', 'eventin' );
            } else {

                if ( !empty( $settings ) ) {
                    $content['settings'] = $settings;
                }

            }

        } else {
            $messages[] = esc_html__( 'You haven\'t authorization permission to update settings.', 'eventin' );
        }

        $sample_date      = strtotime( date( 'd' ) . " " . date( 'M' ) . " " . date( 'Y' ) );
        $date_formats     = Helper::get_date_formats();
        $get_date_formats = [];

        if ( is_array( $date_formats ) ) {

            foreach ( $date_formats as $key => $date_format ) {
                array_push( $get_date_formats, date( $date_format, $sample_date ) );
            }

        }

        return [
            'status_code'      => $status_code,
            'messages'         => $messages,
            'date_format_list' => $get_date_formats,
            'content'          => $content,
        ];
    }

    /**
     * save settings data through api
     *
     * @return array
     */
    public function post_settings() {
        $status_code = 0;
        $messages    = $content    = [];
        $request     = $this->request;

        if ( !is_admin() && !current_user_can( 'manage_options' ) ) {

            if ( !wp_verify_nonce( $this->request->get_header( 'X-WP-Nonce' ), 'wp_rest' ) ) {
                $messages[] = esc_html__( 'Nonce is not valid! Please try again.', 'eventin' );
            } else {

                if ( isset( $request['data'] ) && !empty( $request['data'] ) ) {
                    $status_code                           = 1;
                    $all_settings                          = get_option( 'etn_event_options', [] );
                    $settings                              = $request['data'];
                    $all_settings['events_per_page']       = isset( $settings['events_per_page'] ) ? absint( $settings['events_per_page'] ) : 10;
                    $all_settings['date_format']           = isset( $settings['date_format'] ) ? $settings['date_format'] : "";
                    $all_settings['time_format']           = isset( $settings['time_format'] ) ? $settings['time_format'] : "";
                    $all_settings['etn_primary_color']     = isset( $settings['etn_primary_color'] ) ? $settings['etn_primary_color'] : "";
                    $all_settings['etn_secondary_color']   = isset( $settings['etn_secondary_color'] ) ? $settings['etn_secondary_color'] : "";
                    $all_settings['attendee_registration'] = isset( $settings['attendee_registration'] ) ? $settings['attendee_registration'] : "";
                    $all_settings['sell_tickets']          = isset( $settings['sell_tickets'] ) ? $settings['sell_tickets'] : "";
                    update_option( 'etn_event_options', $all_settings );
                }

            }

        } else {
            $messages[] = esc_html__( 'You haven\'t authorization permission to update settings.', 'eventin' );
        }

        return [
            'status_code' => $status_code,
            'messages'    => $messages,
            'content'     => $content,
        ];
    }

    /**
     * save email data through api from onboard
     *
     * @return array
     */
    public function post_onboard_mail() {
        $status_code = 0;
        $messages    = $content    = [];
        $request     = $this->request;
        $email       = !empty( $request['email'] ) ? $request['email'] : '';
        $data        = [];

        if ( $email ) {
            $status_code   = 1;
            $data['email'] = $email;
            $url           = '';
            wp_remote_post( $url, ['body' => $data] );
            $content['email'] = $request['email'];
        }

        return [
            'status_code' => $status_code,
            'messages'    => $messages,
            'content'     => $content,
        ];
    }

}

new Api();