<?
require('stripe-php-master/init.php');

$publishableKey="pk_test_51NQp35EpXHO1ecaodeLpjCY0V9tYmL2YPH0MqHlemXm90ghH9JfYDXycdQ7NWXsEPmYvrMetX5Jceb8QW97LjyzK00fWUOsKKV";

$secretKey="sk_test_51NQp35EpXHO1ecaofDKqq0b5pyDQgCyjIvVxaMCavvsg2hhecTIafma2g1iHLQkSpZjxPEMK1Z8a48xXwVUobSBZ00yleZqv8B";

\Stripe\Stripe::setApiKey($secretKey);
?>