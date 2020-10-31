<?php


namespace nicDamours\Validator;


class I18n {
    const DEFAULT_TEXT = [
        "not_found" => "property <property> was not found but it is required",
        "invalid" => "property <property> was invalid: <error_message>",
        "notInArray" => "not in array (<values>)",
        "notAnArrayOfInteger" => "not an array of integers",
        "notAnArrayOfStrings" => "not an array of strings",
        "notABoolean" => "not a boolean"
    ];

    private $i18n;

    /**
     * @var I18n;
     */
    private static $instance;

    /**
     * I18n constructor.
     * @param $i18n
     */
    private function __construct() {}

    /**
     * @return I18n
     */
    public static function getInstance(): I18n {
        if(!isset(self::$instance)) {
            self::$instance = new I18n();
        }
        return self::$instance;
    }

    public static function defineI18n($i18n) {
        self::getInstance()->setI18n($i18n);
    }

    /**
     * @param string[] $i18n
     */
    public function setI18n(array $i18n): void {
        $this->i18n = $i18n;
    }

    /**
     * @param string $key
     * @return string
     */
    private function getI18n(string $key) : ?string{
        return $this->i18n[$key];
    }

    /**
     * Returns a formatted message from it's key.
     * @param string $key
     * @param array $data
     * @return string
     */
    public static function getMessage(string $key, $data = []) : string {
        $instance = self::getInstance();
        $rawMessage = key_exists($key, $instance->i18n) ? $instance->getI18n($key) : self::DEFAULT_TEXT[$key];
        return $instance->formatMessage($rawMessage, $data);
    }

    private function formatMessage($message, $data) {
        foreach($data as $key => $value) {
            $message = str_replace("<$key>", $value, $message);
        }

        return $message;
    }
}
