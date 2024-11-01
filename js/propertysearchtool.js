window.onload=function() {
    var $j = jQuery.noConflict();
    function getInternetExplorerVersion() {
        var rv = -1; // Return value assumes failure.
        if (navigator.appName == 'Microsoft Internet Explorer') {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        }
        return rv;
    }
    $j(document).ready(function(){
        $j('#close-modal,#modal-close').click(function(e){
            e.stopPropagation();
            e.preventDefault();           
        $j("#ptool-modal-link-content,#modal-background").removeClass("active");
            $j('#modal-link-iframe').attr('src', '');
        });
        $j('.property118-property-research-tool').click(function(e){
            e.stopPropagation();
            e.preventDefault();
            var ver = getInternetExplorerVersion();
            var url = 'http://www.property118.com/property-search-embed/?hostidentifier='+location.hostname;
            $j('#ptool-modal-link-iframe').attr('src', url);
            var modalBg = $('#ptool-modal-background');
            $('body').append(modalBg);
            $j("#ptool-modal-link-content,#modal-background").addClass("active"); 
            $j('#ptool-modal-link-content').css('height',($j(window).height())*0.90);
        });        
    });
}