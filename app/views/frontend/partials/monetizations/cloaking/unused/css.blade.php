<style>
html,body{overflow:hidden !important;}
iframe{width: 100%;height: 100%;min-height: 100%;min-width: 100%;border: none;background: #fffff;display: block;margin:0px;height: expression(document.body.clientHeight-90);}
#overlay {
	display: none;
	width: 100%;
	height: 100%;
	z-index: 2;
	position: absolute;
	top: 0;
	left: 0;
	background: url('/images/page-loader/background.png') top left repeat;
}
#popup {
	display: none;
	z-index: 99;
	width: 70%;
	height: 70%;
	top: 15%;
	left: 15%;
	border: none;
	position: fixed;
}
.fullscreen {
	width: 100% !important;
	height: 100% !important;
	top: 0% !important;
	left: 0% !important;
}
#popup #popupMain {
	float: left;
	width: 100%;
	height: 100%;
	margin: 0;
	background: #fff;
}
#popup #popupMain iframe {
	float: left;
	border: none;
	width: 100%;
	height: 100%;
}
</style>