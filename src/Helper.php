<?php

// reference  : https://gist.github.com/kid-icarus/8661319


namespace nicdamours\Validator {
    class Helper {
        /**
         * Returns true if the given predicate is true for all elements.
         */
        public static function array_every(callable $callback, array $arr) {
            foreach ($arr as $element) {
                if (!$callback($element)) {
                    return FALSE;
                }
            }
            return TRUE;
        }

        /**
         * Returns true if the given predicate is true for at least one element.
         */
        public static function array_some(callable $callback, array $arr) {
            foreach ($arr as $element) {
                if ($callback($element)) {
                    return TRUE;
                }
            }
            return FALSE;
        }
    }
}