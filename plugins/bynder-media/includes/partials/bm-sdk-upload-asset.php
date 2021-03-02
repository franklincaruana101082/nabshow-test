<?php
/**
 * Upload Asset to Bynder.
 */

try {

	$assetBankManager = $this->bynder->getAssetBankManager();

	// Get Brands. Returns a Promise.
	$brandsListPromise = $assetBankManager->getBrands();
	// Wait for the promise to be resolved.
	$brandsList = $brandsListPromise->wait();

	// Upload a file and create an Asset.
	$data = [
		'name'     => $this->args['image_name'],
		'filePath' => $this->args['image_url'],
		'brandId'  => $brandsList[0]['id']
	];

	// Add metas.
	if ( count( $this->args['metas'] ) ) {
		foreach ( $this->args['metas'] as $meta_key => $meta_value ) {
			if ( is_array( $meta_value ) && 0 !== count( $meta_value ) ) {
				$meta_value = implode( ',', $meta_value );
			}
			if ( ! empty( $meta_value ) ) {
				$data["metaproperty.$meta_key"] = $meta_value;
			}
		}
	}

	$filePromise    = $assetBankManager->uploadFileAsync( $data );
	$this->response = $filePromise->wait();

	/*echo '<pre>';
	print_r( get_defined_vars() );
	print_r( $this );
	die( '<br><---died here' );*/

} catch ( Exception $e ) {
	$this->response = $e->getMessage();
}
