<?php

if (!function_exists('create_slug')) {
    function create_slug($text)
    {
        $text = strtolower($text);
        // Replace spaces and special characters with a hyphen
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        // Remove leading and trailing hyphens
        $text = trim($text, '-');
        // Remove consecutive hyphens
        $text = preg_replace('/-+/', '-', $text);
        // Return the generated slug
        return $text;
    }
}

if (!function_exists('capitalize_text')) {
    function capitalize_text($text)
    {
        $text = strtolower($text);
        $text = ucfirst($text);
        return $text;
    }
}

if (!function_exists('sanitize_string')) {
    function sanitize_string($text,$format = "lower")
    {
        $text = trim($text);
        switch ($format) {
            case 'lower':
                $text = strtolower($text);
            break;
            case 'upper':
                $text = strtoupper($text);
            break;
            case 'capitalize':
                $text = ucfirst($text);
            break;
            case "none":
            break;
        }
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        return $text;
    }
}