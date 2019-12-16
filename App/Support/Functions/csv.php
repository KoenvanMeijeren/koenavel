<?php

declare(strict_types=1);

/**
 * Convert an array to csv.
 *
 * @param array $inputArray The array to convert
 *
 * @return string
 */
function arrayToCSV(array $inputArray)
{
    $csvFieldRow = [];
    foreach ($inputArray as $CSBRow) {
        $csvFieldRow[] = strPutCSV($CSBRow);
    }

    return implode("\n", $csvFieldRow);
}

/**
 * Put a string into csv.
 *
 * @param array  $input     The input
 * @param string $delimiter The delimiter
 * @param string $enclosure The enclosure
 *
 * @return string
 */
function strPutCSV(
    array $input,
    string $delimiter = ',',
    string $enclosure = '"'
) {
    // Open a memory "file" for read/write
    $fp = fopen('php://temp', 'rb+');

    if (is_resource($fp)) {
        // Write the array to the target file using fputcsv()
        fputcsv($fp, $input, $delimiter, $enclosure);
        // Rewind the file
        rewind($fp);
        // File Read
        $data = fread($fp, 1048576);
        fclose($fp);
        // Ad line break and return the data
        return rtrim((string) $data, "\n");
    }

    return '';
}

/**
 * Takes in a filename and an array associative data array and outputs a csv file.
 *
 * @param string $fileName       The filename
 * @param array  $assocDataArray The assoc data array
 */
function outputCsv(string $fileName, array $assocDataArray)
{
    ob_clean();
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename='.$fileName.'.csv');

    if (is_array($assocDataArray) && sizeof($assocDataArray) > 0) {
        $fp = fopen('php://output', 'wb');

        if (is_resource($fp)) {
            foreach ($assocDataArray as $values) {
                fputcsv($fp, $values);
            }
            fclose($fp);
        }
    }
    ob_flush();
}
