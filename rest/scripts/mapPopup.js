$(document).ready(function() {
	//Made to allow all buttons to pull up maps, but not at the same time
	var uglyString = ".pop2, .pop3, .pop4, .pop5, .pop6, .pop7, .pop8, .pop9, .pop10, .pop11, .pop12, .pop13, .pop14, .pop15, .pop16, .pop17, .pop18, .pop20, .pop21, .pop22, .pop23, .pop24, .pop25, .pop26, .pop27, .pop28, .pop29, .pop30, .pop31, .pop32, .pop33, .pop34, .pop35, .pop36, .pop37, .pop38, .pop39, .pop40, .pop41, .pop42, .pop43, .pop44, .pop45, .pop46, .pop47, .pop48, .pop49, .pop50, .pop51, .pop52, .pop53, .pop55, .pop56, .pop57, .pop58, .pop59, .pop60, .pop61, .pop62, .pop63, .pop64, .pop65, .pop66, .pop67, .pop68, .pop69, .pop70, .pop71, .pop72";
	$(uglyString).magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,

		fixedContentPos: false
	});
});