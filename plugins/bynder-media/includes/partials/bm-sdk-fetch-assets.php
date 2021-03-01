<?php
/**
 * Fetch Assets from Bynder.
 */

try {

	$assetBankManager = $this->bynder->getAssetBankManager();

	// Get Media Items list.
	// Optional filter.
	$query = [
		'total'             => 1,
		'limit'             => $this->assets_limit,
		'page'              => $this->assets_page,
		'type'              => 'image',
		'versions'          => 1,
		'includeMediaItems' => 1,
	];

	// Include collection ID if available.
	if ( isset( $this->args['collectionId'] ) && ! empty( $this->args['collectionId'] ) ) {
		$query['collectionId'] = $this->args['collectionId'];
	}

	$mediaListPromise = $assetBankManager->getMediaList( $query );
	$this->response   = $mediaListPromise->wait();


} catch ( Exception $e ) {
	$this->response = $e->getMessage();
}
