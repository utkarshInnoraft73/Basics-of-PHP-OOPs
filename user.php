<?php
/**
 * Make a user class to perform all the functionality.
 */

class User {
    public $fname; //First name of user.
    public $lname; //Last name of user.

    /**
     * Create a custructor.
     * Setting first name and last name.
     */
    function __construct($fname, $lname)
    {
        $this->fname = $fname;
        $this->lname = $lname;
    }


    
    /**
     * Create functions to return the first name and last name.
     */
    function getFirstName()
    {
        return $this->fname;
    }

    function getLastName()
    {
        return $this->lname;
    }
}