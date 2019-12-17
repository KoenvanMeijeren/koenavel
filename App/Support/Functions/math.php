<?php
declare(strict_types=1);

if (!function_exists('sampling')) {
    function sampling(array $chars, int $size, array $combinations = array())
    {
        // if it's the first iteration, the first set
        // of combinations is the same as the set of characters
        if (empty($combinations)) {
            $combinations = $chars;
        }

        // we're done if we're at size 1
        if ($size === 1) {
            return $combinations;
        }

        // initialise array to put new values in
        $new_combinations = array();

        // loop through existing combinations and
        // character set to create strings
        foreach ($combinations as $combination) {
            foreach ($chars as $char) {
                $new_combinations[] = $combination . $char;
            }
        }

        // call same function again for the next iteration
        return sampling($chars, $size - 1, $new_combinations);
    }
}

if (!function_exists('samplingWithOnlyOneUsedCharPerString')) {
    function samplingWithOnlyOneUsedCharPerString(array $values, int $size)
    {
        $generator = generateCombinations($values, $size);
        $string = '';

        foreach ($generator as $value) {
            if (count($value) !== 6) {
                continue;
            }

            foreach ($value as $item) {
                $string .= $item . ' ';
            }

            $string .= '<br>';
        }

        return $string;
    }
}

if (!function_exists('generateCombinations')) {
    function generateCombinations(array $values, int $count = 0)
    {
        // Figure out how many combinations are possible:
        $permCount = count($values) ** $count;

        // Iterate and yield:
        for ($i = 0; $i < $permCount; $i++) {
            yield getCombination($values, $count, $i);
        }
    }
}

if (!function_exists('getCombination')) {
// State-based way of generating combinations:
    function getCombination($values, $count, $index)
    {
        $result = array();
        for ($i = 0; $i < $count; $i++) {
            // Figure out where in the array to start from,
            // given the external state and the internal loop state
            $pos = $index % count($values);

            // Append and continue
            if (!in_array($values[$pos], $result, true)) {
                $result[] = $values[$pos];
            }

            $index = ($index - $pos) / count($values);
        }

        return $result;
    }
}
