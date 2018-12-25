<?php

/**
 * HTML Form Parser Example
 *
 * @package HtmlFormParser
 * @version $Id 1.0
 * @author Peter Valicek <Sonny2@gmx.DE>
 * @copyright 2004 Peter Valicek Peter Valicek <Sonny2@gmx.DE>
 */

require_once 'HtmlFormParser.php';

$parser =& new HtmlFormParser( file_get_contents('http://de.php.net') );
$result = $parser->parseForms();

print_r($result);

?>