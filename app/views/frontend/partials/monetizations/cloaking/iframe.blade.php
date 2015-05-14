<div id="page-loader-loaderDiv" style="z-index:100;display:block; position: fixed; top:0; left:0; background:#FFFFFF;height:100%; width:100%; margin:0 auto 0 auto;">
	<div id="page-loader-loader-logo" style="background:url(/images/page-loader/logo-02.png);background-attachment: scroll; background-clip: border-box;background-origin: padding-box; background-size: cover;margin:14% auto auto auto;background-repeat:none;width:233px;height:79px"></div>
	<div id="page-loader-loading-image" style="background:url(/images/page-loader/loading-03.gif);background-attachment: scroll; background-clip: border-box; background-origin: padding-box; background-size: cover; width: 64px; height: 64px;margin:10px auto auto auto;"></div>
</div>
<div id="overlay"></div>
<div id="popup" class="fullscreen">
	<div id="popupMain" class="not-closeable">
		<iframe style="display:none" onload="pageLoader()" src="{{ route('project/page-loader', [$project->slug, $project->tld]) }}"></iframe>
		<iframe style="display:none" id="page-loader-frame" src="{{ $project->getOption('monetization.cloaking.cloaked_url') }}"></iframe>
	</div>
</div>