<?php

namespace LaravelLb;

use LaravelLb\LogicBoxes;

class LogicBoxesActions extends LogicBoxes {

    public $resource;

    public function __construct()
    {
        parent::__construct();

        $this->resource = "actions";
    }

    /**
     * Gets the Current Actions based on the criteria specified.
     * http://manage.logicboxes.com/kb/answer/908
     * @return LogicboxesCommon 
     */
    public function searchCurrentActions($variables = [], $pageNo = 1, $noOfRecords = 500)
    {
        $method = 'search-current';

        $variables = array_merge($variables, [
            'page-no' => $pageNo,
            'no-of-records' => $noOfRecords,
        ]);

        $response = $this->get($this->resource, $method, $variables);

        return $this;
    }

    /**
     * Searches the Archived Actions based on the criteria specified.
     * http://manage.logicboxes.com/kb/answer/909
     * @return LogicboxesCommon
     */
    public function searchArchivedActions($variables = [], $pageNo = 1, $noOfRecords = 500)
    {
        $method = 'search-archived';

        $variables = array_merge($variables, [
            'page-no' => $pageNo,
            'no-of-records' => $noOfRecords,
        ]);

        $response = $this->get($this->resource, $method, $variables);
        
        return $this;
    }

}
