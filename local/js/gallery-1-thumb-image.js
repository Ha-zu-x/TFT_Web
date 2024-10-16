(function($, window, document, undefined) {
		'use strict';
		// init cubeportfolio
		$('#js-grid-full-width').cubeportfolio({
			filters: '#js-filters-full-width',
			loadMore: '#js-loadMore-full-width',
			loadMoreAction: 'click',
			layoutMode: 'mosaic',
			sortToPreventGaps: true,
			defaultFilter: '*',
			animationType: 'fadeOutTop',
			gapHorizontal: 0,
			gapVertical: 0,
			gridAdjustment: 'responsive',
			mediaQueries: [{
				width: 1500,
				cols: 1
			}, {
				width: 1100,
				cols: 1
			}, {
				width: 800,
				cols: 1
			}, {
				width: 480,
				cols: 1
			}, {
				width: 320,
				cols: 1
			}],
			caption: 'zoom',
			displayType: 'lazyLoading',
			displayTypeSpeed: 100,

			// lightbox
			lightboxDelegate: '.cbp-lightbox',
			lightboxGallery: true,
			lightboxTitleSrc: 'data-title',
			lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
		});
})(jQuery, window, document);
