<?php
/**
 * Make a user class to perform all the functionality.
 */

class User {
    public $fname; //First name of user.
    public $lname; //Last name of user.
    public $phone; //Phone name of user.

    /**
     * Create a custructor.
     * Setting first name, last name and phone.
     */
    function __construct($fname, $lname, $phone)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->phone = $phone;
    }

    /**
     * Create functions to return the first name, last name and phone number.
     */
    function getFirstName()
    {
        return $this->fname;
    }

    function getLastName()
    {
        return $this->lname;
    }

    function getPhone()
    {
        return $this->phone;
    }
}
?>