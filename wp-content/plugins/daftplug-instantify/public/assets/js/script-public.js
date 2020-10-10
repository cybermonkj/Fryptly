jQuery(function() {
    'use strict';
    var daftplugPublic = jQuery('.daftplugPublic[data-daftplug-plugin="daftplug_instantify"]');
    var optionName = daftplugPublic.attr('data-daftplug-plugin');
	var objectName = window[optionName+'_public_js_vars'];

    // Handle tooltips
    daftplugPublic.on('mouseenter mouseleave', '[data-tooltip]', function(e) {
        var self = jQuery(this);
        var tooltip = self.attr('data-tooltip');

        if (e.type === 'mouseenter') {
            self.append(`<span class="daftplugPublicTooltip">`+tooltip+`</span>`);
        }

        if (e.type === 'mouseleave') {
            self.find('.daftplugPublicTooltip').remove();
        }
    });
});