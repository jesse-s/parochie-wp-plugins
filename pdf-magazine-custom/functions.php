<?php

function splitTextIntoColumns($text, $maxCharsPerColumn, $maxCharsFirstColumn) {
    $textLength = strlen($text);
    $currentColumn = 1;
    $currentCharCount = 0;
    $output = [''];

    for ($i = 0; $i < $textLength; $i++) {
        $char = $text[$i];
        $output[$currentColumn - 1] .= $char;

        if ($char === '<') {
            // Opening tag found
            $closingTagPosition = strpos($text, '>', $i + 1);
            $tagContent = substr($text, $i + 1, $closingTagPosition - $i - 1);
            $output[$currentColumn - 1] .= $tagContent . '>';
            $i = $closingTagPosition;

            if (in_array(strtolower($tagContent), ['p', 'quote']) && $currentColumn !== 1) {
                // Add 40 characters to the current column for <p> or <quote> tag
                $currentCharCount += 40;
            }
        }

        $currentCharCount++;

        if ($currentCharCount === $maxCharsFirstColumn && $currentColumn === 1) {
            $currentColumn++;
            $currentCharCount = 0;
            $output[$currentColumn - 1] = '';
        } elseif ($currentCharCount === $maxCharsPerColumn) {
            // Check if the last character in the current column is a space
            if ($text[$i] !== ' ' && $text[$i + 1] !== ' ') {
                // Find the last space in the current column and move it to the next column
                $lastSpacePos = strrpos($output[$currentColumn - 1], ' ');
                $output[$currentColumn] = substr($output[$currentColumn - 1], $lastSpacePos + 1);
                $output[$currentColumn - 1] = substr($output[$currentColumn - 1], 0, $lastSpacePos);
                $currentCharCount = strlen($output[$currentColumn]);
            }

            $currentColumn++;
            $currentCharCount = 0;
            $output[$currentColumn - 1] = '';
        }
    }

    return $output;
}

function insertPdfSides($content, $color) {
    $side = '<div class="pdf-side pdf-left" style="background-color: ' . $color . '"></div>';

    return str_replace(
        '</p>',
        '</p>' . $side,
        $content
    );
}