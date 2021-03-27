<?php
/**
 * Fetch Metas from Bynder.
 */

try {

	$assetBankManager = $this->bynder->getAssetBankManager();

	// Get Metaproperties.
	$metapropertiesListPromise = $assetBankManager->getMetaproperties( [ 'type' => 'image' ] );
	$this->response            = $metapropertiesListPromise->wait();


} catch ( Exception $e ) {
	$this->response = $e->getMessage();
}
