<?php

namespace MattForms\App\Model;

use \MattForms\App\Abstract\Model;

class Form extends Model {

    protected int $id;
    protected string $title;
    protected array $fields;
    protected int|\WP_User $author;
    protected string $modified_at;

    public function __construct(
        string $title,
        array $fields,
        int|\WP_User $author,
        string $date = '2024-01-01 00:00:01'
    ) {
        $this->id = 0;
        $this->title = $title;
        $this->fields = $fields;

        if ( gettype( $author ) === 'integer' ) { 
            $user = get_user_by( 'ID', $author );
            $this->author = gettype( $user ) === 'object' ? $user : new \WP_User();
        } else if ( gettype( $author ) === 'object' ) {
            $this->author = $author;
        } else {
            $this->author = new \WP_User();
        }

        $this->modified_at = $date;
    }

    public function set_id( int $id ) : int {
        return $this->id = $id;
    }

    public function get_id() : int {
        return $this->id;
    }

    public function get_title() : string {
        return esc_html( $this->title );
    }

    public function get_fields() : array {
        return $this->fields;
    }

    public function get_author_id() : int {
        if ( gettype( $this->author ) === 'integer' ) {
            return $this->author;
        } else if ( gettype( $this->author ) === 'object' ) {
            return $this->author->ID;
        } else {
            return 0;
        }
    }

    public function get_author() : \WP_User {
        return $this->author;
    }

    public function get_modified_at() : string {
        return $this->modified_at;
    }

}