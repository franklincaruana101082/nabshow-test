<?php
/**
 * Configuration for Bynder.
 */

use Bynder\Api\BynderClient;
use Bynder\Api\Impl\PermanentTokens;

$this->bm_domain = $this->bm_get_meta( 'bm_domain' );
$this->bm_token  = $this->bm_get_meta( 'bm_token' );

$configuration = new PermanentTokens\Configuration(
    $this->bm_domain,
    $this->bm_token,
    ['timeout' => 10] // Guzzle HTTP request options
);

$this->bynder = new BynderClient($configuration);
