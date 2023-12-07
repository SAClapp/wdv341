<?php
class Events {

    /*  This class will define an event object based upon the data from the wdv341_events table
        -change history

        define properties that class will store
        define the constructor method
        define the setters/getters aka accessors/mutators methods
            setters/mutators - set an input into the property of the object/class 
            getters/accessors - return the value of a property og an object/class
        define processing methods

    */

    public $event_description;
    public $event_name;
    public $event_presenter;
    public $event_date;
    public $event_time;

    //constructor method - PHP format
    function __construct(){
        //will set default values to properties
        $this->set_event_description("");       //set default empty string to property
        $this->set_event_name("");
        $this->set_event_presenter("");
        $this->set_event_date("");
        $this->set_event_time("");
    }

    //setters and getters
    function set_event_description($inDesc){
        $this->event_description = $inDesc;
    }

    function get_event_description(){
        return $this->event_description;
    }

    function set_event_name($inName){
        $this->event_name = $inName;
    }

    function get_event_name(){
        return $this->event_name;
    }

    function set_event_presenter($inPresenter){
        $this->event_presenter= $inPresenter;
    }

    function get_event_presenter(){
        return $this->event_presenter;
    }

    function set_event_date($inDate){
        $this->event_date = $inDate;
    }

    function get_event_date(){
        return $this->event_date;
    }

    function set_event_time($inTime){
        $this->event_time = $inTime;
    }

    function get_event_time(){
        return $this->event_time;
    }
    
    //processing methods

    //function that will turn our PHP object into a JSON object and return it

    //function convertJSON(){

    //}

}//end Events Class
?>