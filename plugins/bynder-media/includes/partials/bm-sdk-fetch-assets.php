<?php
/**
 * Fetch Assets from Bynder.
 */

try {

	$assetBankManager = $this->bynder->getAssetBankManager();

	$mediaListPromise = $assetBankManager->getMediaList( $this->query );
	$this->response   = $mediaListPromise->wait();


} catch ( Exception $e ) {
	$this->response = $e->getMessage();
}
