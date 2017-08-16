<?php


namespace LaravelLb;


use DateTime;
use Exception;

class Logger
{

    /**
     * Set whether to log the api or not
     *
     * @var bool
     */
    private $isLog;

    /**
     * Folder path to save the log files
     *
     * @var string
     */
    private $path;

    /**
     * Log file extension
     *
     * @var string
     */
    private $extension;

    function __construct()
    {
        if (function_exists('config')) {
            $this->isLog = config('logicboxes.log.log_api');
            $this->path = config('logicboxes.log.log_path');
        }

        $this->extension = '.log';
    }

    /**
     * Set log path, log files will goes here
     *
     * @param string $path
     * @return $this
     */
    public function setLogPath(string $path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Log the request
     *
     * @param Request $request
     * @throws Exception
     */
    public function log(Request $request)
    {
        if(!$this->isLog) return;

        // If folder doesn't exit, give the exception
        if(!file_exists($this->path)) {
            mkdir($this->path);
        }

        // Concat the path into a variable
        $path = $this->path . '/' . $this->getLogFileName();

        // Check if file has been created before
        $fileExists = file_exists($path);

        // Open a file
        $file = fopen($path, 'a+');

        // Log file content
        $this->logContent($file, $request);

        // Close and change file mode
        fclose($file);

        // If it's the first time after file has been created, we set it's permission to 0666 so everyone can write it
        if(!$fileExists) {
            chmod($file, 0666);
        }
    }

    /**
     * Get log file name
     */
    public function getLogFileName()
    {
        return (new DateTime)->format('Ymd') . $this->extension;
    }

    /**
     * Set log file extension
     *
     * @param string $extension
     * @return $this
     */
    public function setExtension(string $extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Log request connect using given file and content
     *
     * @param $file
     * @param $request
     */
    private function logContent($file, Request $request)
    {
        $data = [
            'time' => (new DateTime)->format('d-m-Y H:i:s'),
            'method' => $request->getMethod(),
            'request' => $request->getRequest(),
            'response' => $request->getResponse(),
        ];

        fwrite($file, json_encode($data) . ", ");
    }

    /**
     * Set isLog attribute
     *
     * @param bool $isLog
     * @return $this
     */
    public function setIsLog(bool $isLog)
    {
        $this->isLog = $isLog;

        return $this;
    }
}
