/**
 * jQuery Plugin: Sticky Tabs
 *
 * @author Aidan Lister <aidan@php.net>
 * @version 1.0.1
 */
(function ( $ ) {
    $.fn.stickyTabs = function() {
        context = this

        // Show the tab corresponding with the hash in the URL, or the first tab.
        var showTabFromHash = function() {
          var hash = window.location.hash;
          var selector = hash ? 'a[href="' + hash + '"]' : 'li.active > a';
          $(selector, context).tab('show');
        }

        // Set the correct tab when the page loads
        showTabFromHash(context)

        // Set the correct tab when a user uses their back/forward button
        //(jQuery will implement the correct event handler per browser)
        $(window).on('hashchange', showTabFromHash);
        
        //window.addEventListener('hashchange', showTabFromHash, false);

        // Change the URL when tabs are clicked
        $('a', context).on('click', function(e) {
		
			// fall-back to hash update if pushState isn't supported by browser (e.g. IE8).
			if(history.pushState) {
				history.pushState(null, null, this.href);
			}
			else {
				var href = this.href;
				var hash = href.substring(href.indexOf('#'));
				window.location.hash = hash;
			}		
                  	
		
		});

        return this;
    };
}( jQuery ));


