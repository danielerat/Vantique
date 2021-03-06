<?php

// is_blank('abcd')
// * validate data presence
// * uses trim() so empty spaces don't count
// * uses === to avoid false positives
// * better than empty() which considers "0" to be empty
function is_blank($value)
{
    return !isset($value) || trim($value) === '';
}

// has_presence('abcd')
// * validate data presence
// * reverse of is_blank()
// * I prefer validation names with "has_"
function has_presence($value)
{
    $trimmed_value = trim($value);
    return isset($trimmed_value) && $trimmed_value !== "";
}

// has_length_greater_than('abcd', 3)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_greater_than($value, $min)
{
    $length = strlen($value);
    return $length > $min;
}
function has_length_less_than($value, $max)
{
    $length = strlen($value);
    return $length < $max;
}
function has_length_exactly($value, $exact)
{
    $length = strlen($value);
    return $length == $exact;
}

// has_length('abcd', ['min' => 3, 'max' => 5])
// * validate string length
// * combines functions_greater_than, _less_than, _exactly
// * spaces count towards length
// * use trim() if spaces should not count
function has_length($value, $options)
{
    if (isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
        return false;
    } elseif (isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
        return false;
    } elseif (isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
        return false;
    } else {
        return true;
    }
}

// has_inclusion_of( 5, [1,3,5,7,9] )
// * validate inclusion in a set
function has_inclusion_of($value, $set)
{
    return in_array($value, $set);
}

// has_exclusion_of( 5, [1,3,5,7,9] )
// * validate exclusion from a set
function has_exclusion_of($value, $set)
{
    return !in_array($value, $set);
}

// has_string('nobody@nowhere.com', '.com')
// * validate inclusion of character(s)
// * strpos returns string start position or false
// * uses !== to prevent position 0 from being considered false
// * strpos is faster than preg_match()
function has_string($value, $required_string)
{
    return strpos($value, $required_string) !== false;
}

// has_valid_email_format('nobody@nowhere.com')
// * validate correct format for email addresses
// * format: [chars]@[chars].[2+ letters]
// * preg_match is helpful, uses a regular expression
//    returns 1 for a match, 0 for no match
//    http://php.net/manual/en/function.preg-match.php
function has_valid_email_format($value)
{
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
}



function has_unique_username($username, $current_id = "0")
{
    $admin = Admin::find_by_username($username);
    if ($admin === false || $admin->id == $current_id) {
        // Is unique
        return true;
    } else {
        // Not unique
        return false;
    }
}
function is_same_product($userId, $productId)
{
    $cart = Cart::find_existance($userId, $productId, $current_id = "0");
    if ($cart === false || $cart->id == $current_id) {
        // It is Unique
        return ['id' => 0, 'status' => false];
    } else {
        // Not unique
        return ['id' => $cart->id, 'status' => true];
    }
}


function user_has_unique_username($username, $current_id = "0")
{
    $admin = User::find_by_username($username);
    if ($admin === false || $admin->id == $current_id) {
        // Is unique
        return true;
    } else {
        // Not unique
        return false;
    }
}

function is_an_integer($int)
{
    if (filter_var($int, FILTER_VALIDATE_INT) === 0 || !filter_var($int, FILTER_VALIDATE_INT) === false) {
        return true;
    } else {
        return false;
    }
}