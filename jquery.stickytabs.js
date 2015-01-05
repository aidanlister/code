/**
 * jQuery Plugin: Sticky Tabs
 *
 * @author Aidan Lister <aidan@php.net>
 * @version 1.0.1
 */
 
 //added a global: URLcallback
 //allows to change the url before sending to pushstate 
 //if set, we can do this: correct an url like "http://host/evalv3#logs" to "http://host/evalv3#/logs"
 //$.fn.stickyTabs.URLcallback=function(location){ return location.search('#/')==-1?location.replace(/#/, '#/'):location; }
 //needed to work with a router like flatiron director

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
        window.addEventListener('hashchange', showTabFromHash, false);

        // Change the URL when tabs are clicked
        $('a', context).on('click', function(e) {
            href=this.href;
            if($.fn.stickyTabs.URLcallback) href=$.fn.stickyTabs.URLcallback(this.href)
            //history.pushState(null, null, href);
            
          parts=href.split("#")
          parts.shift()
          if(parts.length)
          window.location.hash="#"+parts.join('#')
          
        });

        return this;
    };
}( jQuery ));

