<?php

/***********************************************************************
 * File: page.php
 * Author: PK
 * Date: 20/11/13 11:28
 *
 * Description: page class, handles what the user sees on the page
 *********************************************************************/

class page
{
    private $templates;
    private $array;

    public function __construct()
    {
        $this->methods = array();
        $this->templates = array();
        $this->array = array();
    }

    /**
     * Adds a template file to be rendered later on
     * @param $template - name of file without .php
     * @param $array (optional) - An array of data to insert into template
     */
    public function addTemplate($template,$array = null)
    {
        $this->templates[] = array( "name" => $template, "array" => $array);
    }

    /**
     *  Renders the page
     */
    public function render()
    {
        if(!empty($this->templates))
        {
            foreach($this->templates as $template)
            {
                ${$template['name']} = $template['array'];
                include PROTECTED_ROOT."/templates/".$template['name'].".php";
            }
        }
    }

}
?>