<?php

if (!function_exists('get_phrase')) {
    function get_phrase($key) {
        // Assuming this function fetches a phrase based on a key, for example:
        $phrases = [
            'add_new_category' => 'Add New Category',
            'sub_categories' => 'Sub Categories',
            'edit' => 'Edit',
            'delete' => 'Delete',
            // Add other phrases as needed
        ];

        return $phrases[$key] ?? $key;
    }
}
