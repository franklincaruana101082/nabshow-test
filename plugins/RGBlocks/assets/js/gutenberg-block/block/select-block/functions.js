export function fetchReusableBlock(fetchBlock, data) {
  document.body.classList.remove('select-modal-open');
  const clientId = data.clientId;
  const block = wp.blocks.createBlock('core/freeform', {
    content: fetchBlock.content.raw
  });
  setTimeout(function(){
    wp.data
        .dispatch('core/editor')
        .replaceBlocks(
            clientId,
            wp.blocks.rawHandler({ HTML: wp.blocks.getBlockContent(block) })
        );
  });
}
