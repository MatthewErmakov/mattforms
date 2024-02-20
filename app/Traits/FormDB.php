<?php 

namespace MattForms\App\Trait;

use \MattForms\App\Model\Form;

/**
 * * USED IN FORM PAGE CONTROLLERS *
 */
trait FormDB {

    public function get_form_by_id( int $form_id ) {
        $wpdb = $this->wpdb;
        $table_name = $wpdb->prefix . "matt_forms";
        $results = $wpdb->get_results( "SELECT * FROM {$table_name} WHERE `id` = '{$form_id}'" );
        $form = null;

        if ( is_array( $results ) && ! empty( $results ) ) {
            $value = reset( $results );

            $form = new Form( $value->title, maybe_unserialize( $value->fields ), $value->author_id, $value->modified_at );
            $form->set_id( $value->id );
        }

        return $form;
    }

    /**
     * Get all forms from DB
     * 
     * @param void
     * @return array $results
     */
    public function get_forms() : array {
        $wpdb = $this->wpdb;
        $table_name = $wpdb->prefix . "matt_forms";
        $results = $wpdb->get_results( "SELECT * FROM {$table_name}" );

        if ( is_array( $results ) ) {
            $results = array_map( function( $value ) {
                $form = new Form( $value->title, maybe_unserialize( $value->fields ), $value->author_id, $value->modified_at );
                $form->set_id( $value->id );
                
                return $form;
            }, $results );
        }

        return (array) $results;
    }

    /**
     * Push current Form to database
     * 
     * @param Form $form
     * @return bool|Form
     */
    public function flush( Form $form ) : bool|Form {
        $wpdb = $this->wpdb;
        $table_name = $wpdb->prefix . "matt_forms";
        $table_exists = $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" );
        $id = $form->get_id();

        /**
         * If 'matt_forms' table doesn't exist
         *     create this table
         */
        if ( \is_wp_error( $table_exists ) || \is_null( $table_exists ) ) {
            $this->create_table();
        }

        $form_db_data = $wpdb->get_results( "SELECT * FROM {$table_name} WHERE `id` = '{$id}'" );

        /**
         * Check if current user already exists in DB
         *       insert new user
         * otherwise
         *       update user by his id
         */
        if( ! $form_db_data ) {
            $insert = $wpdb->insert( $table_name, 
                [
                    'title'       => $form->get_title(),
                    'fields'      => serialize( $form->get_fields() ),
                    'author_id'   => $form->get_author_id(),
                    'modified_at' => $form->get_modified_at()
                ],
                [
                    '%s',
                    '%s',
                    '%d',
                    '%s'
                ]
            );
            $form->set_id( $wpdb->insert_id );

            if ( ! $insert ) {
                return false;
            } else {
                return $form;
            }
        } else {
            /**
             * If id is set
             * update db info about this user
             */
            $update = $wpdb->update( $table_name, 
                [
                    'title'       => $form->get_title(),
                    'fields'      => serialize( $form->get_fields() ),
                    'author_id'   => $form->get_author_id(),
                    'modified_at' => $form->get_modified_at()
                ],
                [ 'id' => $form->get_id() ]
            );

            if ( ! $update ) {
                return false;
            } else {
                return $form;
            }
        }
    }

    /**
     * Create 'matt_forms' table
     */
    public function create_table() : bool {
        $wpdb = $this->wpdb;
        $table_name = $this->table_name;

        $sql = "CREATE TABLE `{$table_name}` (
            `id` int(4) NOT NULL AUTO_INCREMENT,
            `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
            `fields` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
            `author_id` int(11) NOT NULL,
            `modified_at` datetime NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
          
        require_once( \ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        $table_exists = $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" );

        if ( \is_wp_error( $table_exists ) || \is_null( $table_exists ) ) {
            return false;
        }

        return true;
    }

    /**
     * Remove form by form_id
     * 
     * @param int $form_id
     * @return bool
     */
    public function purge( $form_id ) {
        $form = $this->get_form_by_id( intval( $form_id ) );

        if ( $form_id !== 0 && ! is_null( $form ) ) {
            $wpdb = $this->wpdb;
            $delete = $wpdb->delete( $wpdb->prefix . "matt_forms", [ 'id' => $form_id ], '%d' );

            if ( $delete ) {
                return true;
            }
        }

        return false;
    }
}