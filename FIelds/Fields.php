<?php
require("./FetchApi/FetchApi.php");

/**
 * Create a class of fields.
 */
class Field
{
    /**
     * @param string.
     *   Store the field image url.
     */
    private $fieldImage;

    /**
     * @param string. 
     *   Store the title of field.
     */
    private $fieldTitle;

    /**
     * @param string.
     *   Store the link of self explornation.
     */
    private $alias;

    /**
     * @param string.
     *   Store the services links of the field in the format of HTML.
     */
    private $fieldService;

    /**
     * @param string.
     *   Store the icons links of the field.
     */
    private $fieldIcons;

    /**
     * 
     * Create the constructor for setting the values.
     * 
     * @param string fieldImage.
     *   Store the image URL for a particular service field.
     * @param string fieldTitle.
     *   Store the title for a particular service in the format of html.
     * @param string alias.
     *   Store the URL for more detail about a particular service. 
     * @param string fieldService. 
     *   Store the services URLs for the particular service in the format of html. 
     * @param string fieldIcons.
     *   Store the Icons URL for the particular service.
     */
    function __construct($fieldImage, $fieldTitle, $alias, $fieldService, $fieldIcons)
    {

        $this->fieldImage = $fieldImage;
        $this->fieldTitle = $fieldTitle;
        $this->alias = $alias;
        $this->fieldService = $fieldService;
        $this->fieldIcons = $fieldIcons;
    }

    /**
     * To get the image of sevice field.
     * 
     * @return string.
     *   Returns the image URL of the service field.
     */
    function getFieldImage()
    {
        return $this->fieldImage;
    }

    /**
     * To get the title of the service field.
     * 
     * @return string.
     *   Returns the title of the service field.
     */
    function getFieldTitle()
    {
        return $this->fieldTitle;
    }

    /**
     * To get the URL for more details about a service field.
     * 
     * @return string.
     *   Returns the icons URL of the service field.
     */
    function getAlias()
    {
        return $this->alias;
    }

    /**
     * To get the URLs of different sevices.
     * 
     * @return string.
     *   Returns the icons URL of the service field in the form of HTML.
     */
    function getFieldService()
    {
        return $this->fieldService;
    }

    /**
     * To get the icons of sevice field.
     * 
     * @return string.
     *   Returns the icons URL of the service field.
     */
    function getFieldIcons()
    {
        return $this->fieldIcons;
    }

    /**
     * To get the length of field icons.
     * 
     * @return int.
     *   Returns the length of field icons.
     */
    function getFieldIconsLen()
    {
        return count($this->fieldIcons);
    }
}
