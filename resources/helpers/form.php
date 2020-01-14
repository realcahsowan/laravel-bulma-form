<?php

/* FORM FUNCTIONS - moved from master.blade */

function extra_attribute($options) {
    $extra = ['disabled', 'required'];
    $text = '';

    foreach ($extra as $item) {
        $text .= Arr::has($options, $item) ? ' ' . $item : '';
    }

    return $text;
}

// SELECTED OPTION OF DROPDOWN
function selected_status($value, $selected) {
    if (is_array($selected)) {
        return in_array($value, $selected) ? 'selected' : '';
    } else {
        return $value == $selected ? 'selected' : '';
    }
}

// CHECKBOX
function checked_status($value, $selected) {
    if (is_array($selected)) {
        return in_array($value, $selected) ? 'checked' : '';
    } else {
        return $value == $selected ? 'checked' : '';
    }
}

// RADIO
function checked_radio_status($value, $selected) {
    return $value == $selected ? 'checked' : '';
}

// is array is assosiative?
function isAssoc(array $arr)
{
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}

// CHECK if there is INPUT file
function hasInputFile($inputs) {
    return array_filter($inputs, function ($item) {
        return Arr::has($item, 'type') && Arr::get($item, 'type') == 'file';
    });
}

/* END OF FORM FUNCTIONS */
