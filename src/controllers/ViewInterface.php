<?php

/**
 * @author Luis Pardiñas
 *
 */
interface ViewInterface
{
    /**
     * Set the view
     */
    public function set();
    
    
    /**
     * Validate the information submitted by the user
     */
    public function validate();
}
