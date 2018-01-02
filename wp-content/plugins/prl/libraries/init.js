jQuery( document ).ready(function( $ ) {

	/* Semantic UI initializations */
	$('.ui.dropdown').dropdown();
	$('.ui.checkbox').checkbox();

	/* TinyMCE initializations */
	tinymce.init({
		selector: '.wysiwyg-class',
		height: 300,
		theme: 'modern',
		plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
		toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
		image_advtab: true,
		templates: [
			{ title: 'PRL Template 1', content: 'PRL 1' },
			{ title: 'PRL Template 2', content: 'PRL 2' }
		],
		content_css: [
			'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
			'//www.tinymce.com/css/codepen.min.css'
		]
	});

	/* Dropzone */
	Dropzone.autoDiscover = false;
	$(".dropzone-class").dropzone({
		url: "http://aleximbir.wpjobster.net/subdomains/prl",
		addRemoveLinks: true,
		success: function (file, response) {
			file.previewElement.classList.add("dz-success");
		},
		error: function (file, response) {
			file.previewElement.classList.add("dz-error");
		}
	});

});