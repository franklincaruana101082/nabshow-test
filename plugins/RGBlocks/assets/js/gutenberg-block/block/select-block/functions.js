export function fetchReusableBlock(fetchBlock, data, reusableType) {
  document.body.classList.remove('select-modal-open');
  const clientId = data.clientId;
  const blockId = fetchBlock.id;
  const reusableContent = 'normal' === reusableType ? fetchBlock.content.raw : '<!-- wp:block {"ref":' + blockId + '} /-->';
  const block = wp.blocks.createBlock('core/freeform', {
    content: reusableContent
  });
  setTimeout(function () {
    wp.data
      .dispatch('core/editor')
      .replaceBlocks(
        clientId,
        wp.blocks.rawHandler({ HTML: wp.blocks.getBlockContent(block) })
      );
  });
}
