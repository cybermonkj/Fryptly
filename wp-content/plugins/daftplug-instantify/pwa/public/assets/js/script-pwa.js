jQuery(function() {
    'use strict';
    var daftplugPublic = jQuery('.daftplugPublic[data-daftplug-plugin="daftplug_instantify"]');
    var optionName = daftplugPublic.attr('data-daftplug-plugin');
    var objectName = window[optionName + '_public_js_vars'];
    var client = new ClientJS();
    var pushButton = daftplugPublic.find('.daftplugPublicPushButton');
    var pushPrompt = daftplugPublic.find('.daftplugPublicPushPrompt');
    var navigationTabBar = daftplugPublic.find('.daftplugPublicNavigationTabBar');
    var webShareButton = daftplugPublic.find('.daftplugPublicWebShareButton');
    var isMobilePad = client.isMobile() || client.isIpad();
    var isAndroidChrome = client.isMobileAndroid() && client.isChrome();
    var isAndroidFirefox = client.isMobileAndroid() && client.isFirefox();
    var isIosSafari = client.isMobileIOS() && client.isSafari();
    var isAndroidPwa = client.isMobileAndroid() && isPwa();
    var isIosPwa = client.isMobileIOS() && isPwa();
    var isFullscreenOverlayShown = getCookie('fullscreenOverlay');
    var isHeaderOverlayShown = getCookie('headerOverlay');
    var isMenuOverlayShown = getCookie('menuOverlay');
    var isCheckoutOverlayShown = getCookie('checkoutOverlay');
    var isPostOverlayShown = getCookie('postOverlay');
    var isPushPromptShown = getCookie('pushPrompt');
    var fullscreenOverlay = daftplugPublic.find('.daftplugPublicFullscreenOverlay');
    var chromeFullscreenOverlay = fullscreenOverlay.filter('.-chrome');
    var chrome2FullscreenOverlay = fullscreenOverlay.filter('.-chrome2');
    var firefoxFullscreenOverlay = fullscreenOverlay.filter('.-firefox');
    var safariFullscreenOverlay = fullscreenOverlay.filter('.-safari');
    var headerOverlay = daftplugPublic.find('.daftplugPublicHeaderOverlay');
    var menuOverlay = daftplugPublic.find('.daftplugPublicMenuOverlay');
    var checkoutOverlay = daftplugPublic.find('.daftplugPublicCheckoutOverlay');
    var postOverlay = daftplugPublic.find('.daftplugPublicPostOverlay');
    var installButton = daftplugPublic.find('.daftplugPublicInstallButton');
    var rotateNotice = daftplugPublic.find('.daftplugPublicRotateNotice');

    // Check if PWA
    function isPwa() {
        return ['fullscreen', 'standalone', 'minimal-ui'].some(
            (displayMode) => window.matchMedia('(display-mode: '+displayMode+')').matches
        );
    }
    
    // Set cookie
    function setCookie(name, value, days) {
        var expires = '';
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = '; expires=' + date.toUTCString();
        }
        document.cookie = name + '=' + (value || '') + expires + '; path=/';
    }
    
    // Get cookie
    function getCookie(name) {
        var nameEQ = name + '=';
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    // Change push button states
    function changePushButtonState(state) {
        switch (state) {
            case 'enabled':
                pushButton.removeClass('-loading').removeClass('-on').addClass('-off');
                break;
            case 'disabled':
                pushButton.removeClass('-loading').removeClass('-off').addClass('-on');
                break;
            case 'computing':
                pushButton.removeClass('-on').removeClass('-off').addClass('-loading');
                break;
            case 'incompatible':
                pushButton.removeClass('-loading').removeClass('-off').addClass('-on').addClass('-disabled');
                break;
            case 'hidden':
                pushButton.removeClass('-loading').removeClass('-off').removeClass('-on').addClass('-hidden');
                break;
            default:
                console.error('Unhandled push button state', state);
                break;
        }
    }

    // Base 64 to Unit8Array
    function urlBase64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - (base64String.length % 4)) % 4);
        const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);
        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }
        return outputArray;
    }

    // Check notification permission
    function checkNotificationPermission() {
        return new Promise((resolve, reject) => {
            if (Notification.permission === 'denied') {
                return reject(new Error('Push messages are blocked.'));
            }
            if (Notification.permission === 'granted') {
                return resolve();
            }
            if (Notification.permission === 'default') {
                return Notification.requestPermission().then(result => {
                    if (result !== 'granted') {
                        reject(new Error('Bad permission result'));
                    }
                    resolve();
                });
            }
        });
    }

    // Register push device
    function registerPushDevice() {
        changePushButtonState('computing');
        return checkNotificationPermission()
            .then(() => navigator.serviceWorker.ready)
            .then(serviceWorkerRegistration =>
                serviceWorkerRegistration.pushManager.subscribe({
                    userVisibleOnly: true,
                    applicationServerKey: urlBase64ToUint8Array(objectName.pwaPublicKey),
                })
            )
            .then(subscription => {
                jQuery.toast({
                    title: objectName.pwaSubscribeOnMsg,
                    duration: 2500,
                    position: 'bottom',
                });
                return handleSubscription(subscription, 'add');
            })
            .then(subscription => subscription && changePushButtonState('enabled'))
            .catch(e => {
                if (Notification.permission === 'denied') {
                    console.warn('Notifications are denied by the user.');
                    changePushButtonState('incompatible');
                } else {
                    console.error('Impossible to subscribe to push notifications', e);
                    changePushButtonState('disabled');
                }
            });
    }

	// Update push device
	function updatePushDevice() {
	    navigator.serviceWorker.ready
    	.then(serviceWorkerRegistration => serviceWorkerRegistration.pushManager.getSubscription())
    	.then(subscription => {
    		changePushButtonState('disabled');
	        if (!subscription) {
		        return;
	        }
        	return handleSubscription(subscription, 'update');
      	})
      	.then(subscription => subscription && changePushButtonState('enabled'))
      	.catch(e => {
        	console.error('Error when updating the subscription', e);
      	});
	}

    // Deregister push device
    function deregisterPushDevice() {
        changePushButtonState('computing');
        navigator.serviceWorker.ready
        .then(serviceWorkerRegistration => serviceWorkerRegistration.pushManager.getSubscription())
        .then(subscription => {
            if (!subscription) {
                changePushButtonState('disabled');
                return;
            }
            jQuery.toast({
                title: objectName.pwaSubscribeOffMsg,
                duration: 2500,
                position: 'bottom',
            });
            return handleSubscription(subscription, 'remove');
        })
        .then(subscription => subscription.unsubscribe())
        .then(() => changePushButtonState('disabled'))
        .catch(e => {
            console.error('Error when unsubscribing the user', e);
            changePushButtonState('disabled');
        });
    }

    // Handle subscription
    function handleSubscription(subscription, method) {
        const action = optionName + '_handle_subscription';
        const endpoint = subscription.endpoint;
        const userKey = subscription.getKey('p256dh');
        const userAuth = subscription.getKey('auth');
        const deviceInfo = client.getBrowser() + ' ' + client.getBrowserMajorVersion() + ' on ' + client.getOS() + ' ' + client.getOSVersion();
        const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0];

        return jQuery.ajax({
            url: objectName.ajaxUrl,
            type: 'POST',
            data: {
                method: method,
                action: action,
                endpoint: endpoint,
                userKey: userKey ? btoa(String.fromCharCode.apply(null, new Uint8Array(userKey))) : null,
                userAuth: userAuth ? btoa(String.fromCharCode.apply(null, new Uint8Array(userAuth))) : null,
                deviceInfo: deviceInfo,
                contentEncoding,
            },
            beforeSend: function() {

            },
            success: function(response, textStatus, jqXhr) {

            },
            complete: function() {

            },
            error: function(jqXhr, textStatus, errorThrown) {

            }
        }).then(() => subscription);
    }

    // Handle push
    if ('serviceWorker' in navigator && 'PushManager' in window && !jQuery('meta[name="onesignal"]').length) {
        navigator.serviceWorker.ready.then(function(registration) {
	        registration.pushManager.getSubscription().then(function(subscription) {
	            updatePushDevice();
	            // Handle push prompt
	            if (objectName.settings.pwaPushPrompt == 'on') {
	                if (!subscription && Notification.permission !== 'denied' && isPushPromptShown == null && pushPrompt.length) {
	                    setTimeout(function() {
	                        pushPrompt.addClass('-show').on('click', '.daftplugPublicPushPrompt_allow', function(e) {
	                            pushPrompt.addClass('-hide').one("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(){
	                                pushPrompt.remove();
	                            });
	                            registerPushDevice();
	                        }).on('click', '.daftplugPublicPushPrompt_dismiss', function(e) {
	                            pushPrompt.addClass('-hide').one("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function(){
	                                pushPrompt.remove();
	                            });
	                            setCookie('pushPrompt', 'shown', 1);
	                        });
	                    }, 2000);
	                }
	            }

	            // Handle push button
	            if (objectName.settings.pwaPushButton == 'on') {    
	                if (subscription) {
                        if (objectName.settings.pwaPushButtonBehavior == 'shown') {
                            changePushButtonState('enabled');
                            pushButton.css('display', 'flex').on('click', function(e) {
                                deregisterPushDevice();
                            });
                        }
	                } else {
                        changePushButtonState('disabled');
	                    pushButton.css('display', 'flex').on('click', function(e) {
                            if (objectName.settings.pwaPushButtonBehavior == 'hidden') {
                                registerPushDevice().then(() => changePushButtonState('hidden'));
                            } else {
                                registerPushDevice();
                            }
	                    });
	                }
	            }
	        });
        });
    }

    // Handle offline forms
    if (objectName.settings.pwaOfflineForms == 'on') {
        Array.from(document.querySelectorAll('form')).forEach(form => {
            new OfflineForm(form);
        })
    };

    // Handle ajaxify
    if (objectName.settings.pwaAjaxify == 'on') {
        if (objectName.settings.pwaAjaxifySelectors == '') {
            var additionalSelectors = 'a:not(.no-ajaxy)';
        } else {
            var additionalSelectors = 'a:not(.no-ajaxy),' + objectName.settings.pwaAjaxifySelectors;
        }
        
        if (objectName.settings.pwaAjaxifyForms == 'on') {
            var formsSelector = 'form:not(.no-ajaxy)';
        } else {
            var formsSelector = false;
        }

        jQuery('body').ajaxify({
            selector: additionalSelectors,
            forms: formsSelector,
            refresh: true,
            deltas: false,
            alwayshints: 'daftplug-instantify',
        });
    }

    // Handle preloader
    if (objectName.settings.pwaPreloader == 'on') {
        var perfData = window.performance.timing,
        EstimatedTime = -(perfData.loadEventEnd - perfData.navigationStart),
        time = parseInt((EstimatedTime / 1000) % 60) * 100,
        start = 0,
        end = 70,
        duration = time,
        range = end - start,
        current = start,
        increment = end > start ? 1 : -1,
        stepTime = Math.abs(Math.floor(duration / range));
        
        jQuery(window).on('beforeunload pronto.request', function(e) {
            e.returnValue = '';
            jQuery('.daftplugPublicPreloader').css('display', 'flex').hide().fadeIn(200);
        });

        if (objectName.settings.pwaPreloaderStyle == 'percent') {
            var progressFill = jQuery('.daftplugPublicPreloader_fill');
            var counter = jQuery('.daftplugPublicPreloader_counter');
            var timer = setInterval(function() {
                if (current < end) {
                    current += increment;
                }
                progressFill.css({
                    'transition-duration': '0.001s',
                    'width': current + '%',
                });
                counter.text(current + '%');
                if ((current == end && perfData.loadEventEnd > 0) || perfData.loadEventEnd > 0) {
                    var endLoading = setInterval(function() {
                        current += increment;
                        progressFill.css('width', current + '%');
                        counter.text(current + '%');
                        if (current == 100) {
                            setTimeout(function() {
                                jQuery('.daftplugPublicPreloader').fadeOut(500, function(e) {
                                    progressFill.css('width', '0');
                                    counter.text('0%');
                                });
                            }, 300);
                            clearInterval(endLoading);
                        }
                    }, 1)
                    clearInterval(timer);
                }
            }, stepTime);
        } else if (objectName.settings.pwaPreloaderStyle == 'skeleton') {
            var timer = setInterval(function() {
                if (current < end) {
                    current += increment;
                }
                jQuery('.daftplugPublicPreloader').hide();
                jQuery('a, svg, i, input, select, button, video').addClass('-daftplugPublicSkeletonLoad');
                jQuery('img:visible').each(function(e) {
                    jQuery(this).wrap(`<div class="${jQuery(this).attr('class')} -daftplugPublicSkeletonLoad -image" style="width: ${jQuery(this).width()}px; height: ${jQuery(this).height()}px;"></div>`).hide();
                });
                jQuery('*:visible').filter(function() {
                    if (this.currentStyle) {
                        return this.currentStyle['backgroundImage'] !== 'none';
                    } else if (window.getComputedStyle) {
                        return document.defaultView.getComputedStyle(this,null).getPropertyValue('background-image') !== 'none';
                    }
                }).addClass('-daftplugPublicSkeletonLoad');
                jQuery('*:visible').filter(function() {
                    return jQuery(this).children().length == 0 && jQuery.trim(jQuery(this).text()).length > 0;
                }).addClass('-daftplugPublicSkeletonLoad');
                jQuery('*').not('iframe, .-daftplugPublicSkeletonLoad').contents().each(function() {
                    if (this.nodeType == 3 && jQuery.trim(this.nodeValue) != '') {
                        jQuery(this).wrap('<ins class="-daftplugPublicSkeletonLoad"/>');
                    }
                });
                if ((current == end && perfData.loadEventEnd > 0) || perfData.loadEventEnd > 0) {
                    var endLoading = setInterval(function() {
                        current += increment;
                        if (current == 100) {
                            jQuery('.-daftplugPublicSkeletonLoad.-image').contents().unwrap().show();
                            jQuery('ins[class="-daftplugPublicSkeletonLoad"]').contents().unwrap();
                            jQuery('*').removeClass('-daftplugPublicSkeletonLoad');
                            jQuery('#daftplugPublicSkeletonLoadCss').remove();
                            clearInterval(endLoading);
                        }
                    }, 1)
                    clearInterval(timer);
                }
            }, stepTime);
        } else {
            var timer = setInterval(function() {
                if (current < end) {
                    current += increment;
                }
                if ((current == end && perfData.loadEventEnd > 0) || perfData.loadEventEnd > 0) {
                    var endLoading = setInterval(function() {
                        current += increment;
                        if (current == 100) {
                            setTimeout(function() {
                                jQuery('.daftplugPublicPreloader').fadeOut(500);
                            }, 300);
                            clearInterval(endLoading);
                        }
                    }, 1)
                    clearInterval(timer);
                }
            }, stepTime);
        }
    }

    // Handle persistent storage
    if (objectName.settings.pwaPersistentStorage == 'on') {
        if (navigator.storage && navigator.storage.persist) {
            (async function() {
                var isPersisted = await navigator.storage.persisted();
                if (!isPersisted) {
                    await navigator.storage.persist();
                }
            })();
        }
    }

    // Handle mobile staff
    if (isMobilePad) {
        // Handle navigation tab bar
        if (objectName.settings.pwaNavigationTabBar == 'on') {
        	if (navigationTabBar.find('li').length == 0) {
        		navigationTabBar.hide();
            } else {
                if (navigationTabBar.is(':visible')) {
                    setInterval(function(e) {
                        jQuery('#daftplugPublicToastMessage').css('bottom', '85px');
                    }, 10);
    
                    if (objectName.settings.pwaPushButton == 'on' && objectName.settings.pwaPushButtonPosition.indexOf('bottom') >= 0 && pushButton.length) {
                        pushButton.css('bottom', '75px');
                    }
    
                    if (objectName.settings.pwaWebShareButton == 'on' && objectName.settings.pwaWebShareButtonPosition.indexOf('bottom') >= 0 && webShareButton.length) {
                        webShareButton.css('bottom', '75px');
                    }
                }
                
                var directSearchItem = navigationTabBar.find('.daftplugPublicNavigationTabBar_item.-directSearch');
                var directSearchLink = directSearchItem.find('.daftplugPublicNavigationTabBar_link');
                directSearchLink.click(function(e) {
                    e.preventDefault();
                    var self = jQuery(this);
                    var searchContainer = self.prev();
                    var searchForm = searchContainer.find('.daftplugPublicNavigationTabBar_searchForm');
                    var searchField = searchForm.find('.daftplugPublicNavigationTabBar_searchField');
                    searchContainer.fadeIn('fast', function(e) {
                        searchField.focus().blur(function(e) {
                            searchForm[0].reset();
                            searchContainer.fadeOut('fast');
                        });
                    });
                });
            }
        }

        // Handle web share button
        if (objectName.settings.pwaWebShareButton == 'on' && navigator.share) {
            webShareButton.css('display', 'flex').on('click', function(e) {
                navigator.share({
                    title: document.title,
                    url: document.querySelector('link[rel=canonical]') ? document.querySelector('link[rel=canonical]').href : document.location.href,
                }).catch(console.error);
            });
        }

        // Handle pull down navigation
        if (objectName.settings.pwaPullDownNavigation == 'on') {
            PullToNavigate();
            jQuery('#daftplugPublicPullDownNavigation').css('background', objectName.settings.pwaPullDownNavigationBgColor);
        }

        // Handle swipe navigation
        if (objectName.settings.pwaSwipeNavigation == 'on') {
            jQuery('body').attr('data-xthreshold', '111').swipeleft(function() { 
                window.history.back();
                jQuery.toast({
                    title: objectName.settings.pwaSwipeBackMsg,
                    duration: 3000,
                    position: 'bottom',
                });
            }).swiperight(function() { 
                window.history.forward(); 
                jQuery.toast({
                    title: objectName.settings.pwaSwipeForwardMsg,
                    duration: 3000,
                    position: 'bottom',
                });
            });
        }

        // Handle shake to refresh
        if (objectName.settings.pwaShakeToRefresh == 'on') {
            var shakeEvent = new Shake({threshold: 15});
            shakeEvent.start();
            window.addEventListener('shake', function() {
                location.reload();
            }, false);
        }

        // Handle screen wake lock
        if (objectName.settings.pwaScreenWakeLock == 'on') {
            if ('wakeLock' in navigator) {
                var wakeLock = null;
                var requestWakeLock = async function requestWakeLock() {
                    wakeLock = await navigator.wakeLock.request('screen');
                };
                var handleVisibilityChange = function handleVisibilityChange() {
                    if (wakeLock !== null && document.visibilityState === 'visible') {
                        requestWakeLock();
                    }
                };
                requestWakeLock();                 
                document.addEventListener('visibilitychange', handleVisibilityChange);
                document.addEventListener('fullscreenchange', handleVisibilityChange);
            }
        }

        // Handle vibration
        if (objectName.settings.pwaVibration == 'on') {
            jQuery('body').vibrate();
        }

        // Handle installation overlays
        if (objectName.settings.pwaOverlays == 'on') {
            // Handle fullscreen installation overlays
            if (objectName.settings.pwaOverlaysTypes.includes('fullscreen') && isAndroidPwa == false && isIosPwa == false && isFullscreenOverlayShown == null && fullscreenOverlay.length) {
			    if (objectName.settings.pwaOverlaysBrowsers.includes('chrome') && isAndroidChrome && chromeFullscreenOverlay.length && chrome2FullscreenOverlay.length) {
			        var isFullBeforeinstallprompt = false;
			        var isFullscreenOverlayFired = false;
			        var installPromptEvent = void 0;
			        window.addEventListener('beforeinstallprompt', function(event) {
			            event.preventDefault();
			            isFullBeforeinstallprompt = true;
			            installPromptEvent = event;
			            if (!isFullscreenOverlayFired) {
			                setTimeout(function() {
			                    chromeFullscreenOverlay.fadeIn('fast', function(e) {
			                        isFullscreenOverlayFired = true;
			                        chromeFullscreenOverlay.on('click', '.daftplugPublicFullscreenOverlay_button', function(e) {
			                            chromeFullscreenOverlay.fadeOut('fast', function(e) {
			                                setCookie('fullscreenOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
			                                installPromptEvent.prompt();
			                                installPromptEvent = null;
			                            });
			                        });
			                    });
			                }, 5000);
			            }
			        });
			        setTimeout(function() {
			            if (isFullBeforeinstallprompt == false) {
			                chrome2FullscreenOverlay.fadeIn('fast');
			            }
			        }, 5000);
			    } else if (objectName.settings.pwaOverlaysBrowsers.includes('firefox') && isAndroidFirefox && firefoxFullscreenOverlay.length) {
			        setTimeout(function() {
			            firefoxFullscreenOverlay.fadeIn('fast');
			        }, 5000);
			    } else if (objectName.settings.pwaOverlaysBrowsers.includes('safari') && isIosSafari && safariFullscreenOverlay.length) {
			        setTimeout(function() {
			            safariFullscreenOverlay.fadeIn('fast');
			        }, 5000);
			    }
				
                fullscreenOverlay.on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
					fullscreenOverlay.fadeOut('fast', function(e) {
                    	setCookie('fullscreenOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
					});
				});
            }

            // Handle header installation overlay
            if (objectName.settings.pwaOverlaysTypes.includes('header') && isAndroidPwa == false && isIosPwa == false && isHeaderOverlayShown == null && headerOverlay.length) {
                if (objectName.settings.pwaOverlaysBrowsers.includes('chrome') && isAndroidChrome && chrome2FullscreenOverlay.length) {
                   	var isHeaderBeforeinstallprompt = false;
                   	var isHeaderOverlayFired = false;
                    var installPromptEvent = void 0;
                    window.addEventListener('beforeinstallprompt', function(event) {
                        event.preventDefault();
                        isHeaderBeforeinstallprompt = true;
                        installPromptEvent = event;
                        if (!isHeaderOverlayFired) {
                            setTimeout(function() {
                                headerOverlay.css('display', 'flex').hide().fadeIn('fast', function(e) {
                                	isHeaderOverlayFired = true;
                                	headerOverlay.on('click', '.daftplugPublicHeaderOverlay_button', function(e) {
                                    	headerOverlay.fadeOut('fast', function(e) {
                                            setCookie('headerOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                            installPromptEvent.prompt();
                                            installPromptEvent = null;
                                        });
                                    });
                                });
                            }, 5000);
                        }
                    });
			        setTimeout(function() {
			            if (isHeaderBeforeinstallprompt == false) {
                            headerOverlay.css('display', 'flex').hide().fadeIn('fast').on('click', '.daftplugPublicHeaderOverlay_button', function(e) {
                                headerOverlay.fadeOut('fast', function(e) {
                                    setCookie('headerOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                    chrome2FullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                        chrome2FullscreenOverlay.fadeOut('fast');
                                    });
                                });
                            });
			            }
			        }, 5000);
                } else if (objectName.settings.pwaOverlaysBrowsers.includes('firefox') && isAndroidFirefox && firefoxFullscreenOverlay.length) {
                    setTimeout(function() {
                        headerOverlay.css('display', 'flex').hide().fadeIn('fast').on('click', '.daftplugPublicHeaderOverlay_button', function(e) {
                            headerOverlay.fadeOut('fast', function(e) {
                                setCookie('headerOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                firefoxFullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                    firefoxFullscreenOverlay.fadeOut('fast');
                                });
                            });
                        });
                    }, 5000);
                } else if (objectName.settings.pwaOverlaysBrowsers.includes('safari') && isIosSafari && safariFullscreenOverlay.length) {
                    setTimeout(function() {
                        headerOverlay.css('display', 'flex').hide().fadeIn('fast').on('click', '.daftplugPublicHeaderOverlay_button', function(e) {
                            headerOverlay.fadeOut('fast', function(e) {
                                setCookie('headerOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                safariFullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                    safariFullscreenOverlay.fadeOut('fast');
                                });
                            });
                        });
                    }, 5000);
                }

                headerOverlay.on('click', '.daftplugPublicHeaderOverlay_dismiss', function(e) {
                    headerOverlay.fadeOut('fast', function(e) {
                        setCookie('headerOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                    });
                });
            }

            // Handle menu installation overlay
            if (objectName.settings.pwaOverlaysTypes.includes('menu') && isAndroidPwa == false && isIosPwa == false && isMenuOverlayShown == null && menuOverlay.length) {
                if (objectName.settings.pwaOverlaysBrowsers.includes('chrome') && isAndroidChrome && chrome2FullscreenOverlay.length) {
                    var isMenuBeforeinstallprompt = false;
                    var installPromptEvent = void 0;
                    var isMenuOverlayFired = false;
                    window.addEventListener('beforeinstallprompt', function(event) {
                        event.preventDefault();
                        isMenuBeforeinstallprompt = true;
                        installPromptEvent = event;
                        setTimeout(function() {
                            if (!isMenuOverlayFired) {
                                menuOverlay.css('display', 'flex').hide().fadeIn('fast', function(e) {
                                	isMenuOverlayFired = true;
                                	menuOverlay.on('click', '.daftplugPublicMenuOverlay_install', function(e) {
                                        menuOverlay.fadeOut('fast', function(e) {
                                            setCookie('menuOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                            installPromptEvent.prompt();
                                            installPromptEvent = null;
                                        });
                                    });
                                });
                            }
                        }, 3000);
                    });
			        setTimeout(function() {
			            if (isMenuBeforeinstallprompt == false) {
                            menuOverlay.css('display', 'flex').hide().fadeIn('fast').on('click', '.daftplugPublicMenuOverlay_install', function(e) {
                                menuOverlay.fadeOut('fast', function(e) {
                                    setCookie('menuOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                    chrome2FullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                        chrome2FullscreenOverlay.fadeOut('fast');
                                    });
                                });
                            });
			            }
			        }, 3000);
                } else if (objectName.settings.pwaOverlaysBrowsers.includes('firefox') && isAndroidFirefox && firefoxFullscreenOverlay.length) {
                	setTimeout(function() {
                        menuOverlay.css('display', 'flex').hide().fadeIn('fast').on('click', '.daftplugPublicMenuOverlay_install', function(e) {
                            menuOverlay.fadeOut('fast', function(e) {
                                setCookie('menuOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                firefoxFullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                    firefoxFullscreenOverlay.fadeOut('fast');
                                });
                            });
                        });
                    }, 3000);
                } else if (objectName.settings.pwaOverlaysBrowsers.includes('safari') && isIosSafari && safariFullscreenOverlay.length) {
                	setTimeout(function() {
                        menuOverlay.css('display', 'flex').hide().fadeIn('fast').on('click', '.daftplugPublicMenuOverlay_install', function(e) {
                            menuOverlay.fadeOut('fast', function(e) {
                                setCookie('menuOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                safariFullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                    safariFullscreenOverlay.fadeOut('fast');
                                });
                            });
                        });
                    }, 3000);
                }

                menuOverlay.on('click', '.daftplugPublicMenuOverlay_dismiss', function(e) {
                    menuOverlay.fadeOut('fast', function(e) {
                        setCookie('menuOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                    });
                });
            }

            // Handle checkout installation overlay
            if (objectName.settings.pwaOverlaysTypes.includes('checkout') && isAndroidPwa == false && isIosPwa == false && isCheckoutOverlayShown == null && checkoutOverlay.length) {
                if (objectName.settings.pwaOverlaysBrowsers.includes('chrome') && isAndroidChrome && chrome2FullscreenOverlay.length) {
                    var isCheckoutBeforeinstallprompt = false;
                    var installPromptEvent = void 0;
                    var isCheckoutOverlayFired = false;
                    window.addEventListener('beforeinstallprompt', function(event) {
                        event.preventDefault();
                        isCheckoutBeforeinstallprompt = true;
                        installPromptEvent = event;
                        setTimeout(function() {
                            if (!isCheckoutOverlayFired) {
                                checkoutOverlay.css('display', 'flex').hide().fadeIn('fast', function(e) {
                                	isCheckoutOverlayFired = true;
                                	checkoutOverlay.on('click', '.daftplugPublicCheckoutOverlay_install', function(e) {
                                        checkoutOverlay.fadeOut('fast', function(e) {
                                            setCookie('checkoutOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                            installPromptEvent.prompt();
                                            installPromptEvent = null;
                                        });
                                    });
                                });
                            }
                        }, 3000);
                    });
			        setTimeout(function() {
			            if (isCheckoutBeforeinstallprompt == false) {
                            checkoutOverlay.css('display', 'flex').hide().fadeIn('fast').on('click', '.daftplugPublicCheckoutOverlay_install', function(e) {
                                checkoutOverlay.fadeOut('fast', function(e) {
                                    setCookie('checkoutOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                    chrome2FullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                        chrome2FullscreenOverlay.fadeOut('fast');
                                    });
                                });
                            });
			            }
			        }, 3000);
                } else if (objectName.settings.pwaOverlaysBrowsers.includes('firefox') && isAndroidFirefox && firefoxFullscreenOverlay.length) {
                    setTimeout(function() {
                        checkoutOverlay.css('display', 'flex').hide().fadeIn('fast').on('click', '.daftplugPublicCheckoutOverlay_install', function(e) {
                            checkoutOverlay.fadeOut('fast', function(e) {
                                setCookie('checkoutOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                firefoxFullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                    firefoxFullscreenOverlay.fadeOut('fast');
                                });
                            });
                        });
                    }, 3000);
                } else if (objectName.settings.pwaOverlaysBrowsers.includes('safari') && isIosSafari && safariFullscreenOverlay.length) {
                    setTimeout(function() {
                        checkoutOverlay.css('display', 'flex').hide().fadeIn('fast').on('click', '.daftplugPublicCheckoutOverlay_install', function(e) {
                            checkoutOverlay.fadeOut('fast', function(e) {
                                setCookie('checkoutOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                safariFullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                    safariFullscreenOverlay.fadeOut('fast');
                                });
                            });
                        });
                    }, 3000);
                }

                checkoutOverlay.on('click', '.daftplugPublicCheckoutOverlay_dismiss', function(e) {
                    checkoutOverlay.fadeOut('fast', function(e) {
                        setCookie('checkoutOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                    });
                });
            }

            // Handle post installation overlay
            if (objectName.settings.pwaOverlaysTypes.includes('post') && isAndroidPwa == false && isIosPwa == false && isPostOverlayShown == null && postOverlay.length) {
                if (objectName.settings.pwaOverlaysBrowsers.includes('chrome') && isAndroidChrome && chrome2FullscreenOverlay.length) {
            		var isPostBeforeinstallprompt = false;
                    var installPromptEvent = void 0;
                    var isPostOverlayFired = false;
                    window.addEventListener('beforeinstallprompt', function(event) {
                        event.preventDefault();
                        isPostBeforeinstallprompt = true;
                        installPromptEvent = event;
                        setTimeout(function() {
                            if (!isPostOverlayFired) {
                                postOverlay.fadeIn('fast', function(e) {
                                	isPostOverlayFired = true;
                                	postOverlay.on('click', '.daftplugPublicPostOverlayAction_button.-install', function(e) {
                                        postOverlay.fadeOut('fast', function(e) {
                                            setCookie('postOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                            installPromptEvent.prompt();
                                            installPromptEvent = null;
                                        });
                                    });
                                });
                            }
                        }, 5000);
                    });
                    setTimeout(function() {
                    	if (isPostBeforeinstallprompt == false) {
                            postOverlay.fadeIn('fast').on('click', '.daftplugPublicPostOverlayAction_button.-install', function(e) {
                                postOverlay.fadeOut('fast', function(e) {
                                    setCookie('postOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                    chrome2FullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                        chrome2FullscreenOverlay.fadeOut('fast');
                                    });
                                });
                            });
                        }
                    }, 5000);
                } else if (objectName.settings.pwaOverlaysBrowsers.includes('firefox') && isAndroidFirefox && firefoxFullscreenOverlay.length) {
                    setTimeout(function() {
                        postOverlay.fadeIn('fast').on('click', '.daftplugPublicPostOverlayAction_button.-install', function(e) {
                            postOverlay.fadeOut('fast', function(e) {
                                setCookie('postOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                firefoxFullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                    firefoxFullscreenOverlay.fadeOut('fast');
                                });
                            });
                        });
                    }, 5000);
                } else if (objectName.settings.pwaOverlaysBrowsers.includes('safari') && isIosSafari && safariFullscreenOverlay.length) {
                    setTimeout(function() {
                        postOverlay.fadeIn('fast').on('click', '.daftplugPublicPostOverlayAction_button.-install', function(e) {
                            postOverlay.fadeOut('fast', function(e) {
                                setCookie('postOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                                safariFullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                    safariFullscreenOverlay.fadeOut('fast');
                                });
                            });
                        });
                    }, 5000);
                }

                postOverlay.on('click', '.daftplugPublicPostOverlayAction_button.-dismiss', function(e) {
                    postOverlay.fadeOut('fast', function(e) {
                        setCookie('postOverlay', 'shown', objectName.settings.pwaOverlaysShowAgain);
                    });
                });
            }
        }

        // Handle installation button
        if (objectName.settings.pwaInstallButton == 'on') {
            if (isAndroidPwa == false && isIosPwa == false && installButton.length) {
                if (objectName.settings.pwaInstallButtonBrowsers.includes('chrome') && isAndroidChrome && chrome2FullscreenOverlay.length) {
                    var isButtonBeforeinstallprompt = false;
                    var installPromptEvent = void 0;
                    window.addEventListener('beforeinstallprompt', function(event) {
                    	isButtonBeforeinstallprompt = true;
                        event.preventDefault();
                        installPromptEvent = event;
                        setTimeout(function() {
                            installButton.css('display', 'inline-block').on('click', function(e) {
                                installPromptEvent.prompt();
                                installPromptEvent = null;
                            });
                        }, 1000);
                    });
			        setTimeout(function() {
			            if (isMenuBeforeinstallprompt == false) {
                            installButton.css('display', 'inline-block').on('click', function(e) {
                                chrome2FullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                    chrome2FullscreenOverlay.fadeOut('fast');
                                });
                            });
			            }
			        }, 1000);
                } else if (objectName.settings.pwaInstallButtonBrowsers.includes('firefox') && isAndroidFirefox && firefoxFullscreenOverlay.length) {
                	setTimeout(function() {
                        installButton.css('display', 'inline-block').on('click', function(e) {
                            firefoxFullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                firefoxFullscreenOverlay.fadeOut('fast');
                            });
                        });
                    }, 1000);
                } else if (objectName.settings.pwaInstallButtonBrowsers.includes('safari') && isIosSafari && safariFullscreenOverlay.length) {
                	setTimeout(function() {
                        installButton.css('display', 'inline-block').on('click', function(e) {
                            safariFullscreenOverlay.fadeIn('fast').on('click', '.daftplugPublicFullscreenOverlay_close', function(e) {
                                safariFullscreenOverlay.fadeOut('fast');
                            });
                        });
                    }, 1000);
                }
            }
        }

        // Handle iOS pwa stuff
        if (isIosPwa) {
            //Stop link clicks out of the iOS pwa
            var noddy, remotes = false;
            document.addEventListener('click', function(event) {
                noddy = event.target;
                if (noddy.tagName.toLowerCase() !== 'a' || noddy.hostname !== window.location.hostname || noddy.pathname !== window.location.pathname || !/#/.test(noddy.href)) return;

                while (noddy.nodeName !== 'A' && noddy.nodeName !== 'HTML') {
                    noddy = noddy.parentNode;
                }

                if ('href' in noddy && noddy.href.indexOf('http') !== -1 && (noddy.href.indexOf(document.location.host) !== -1 || remotes)) {
                    event.preventDefault();
                    document.location.href = noddy.href;
                }
            }, false);

            // Display rotate device notice based on orientation
            setInterval(function() {
                if ((objectName.settings.pwaOrientation == 'portrait' && window.matchMedia('(orientation: landscape)').matches) || (objectName.settings.pwaOrientation == 'landscape' && window.matchMedia('(orientation: portrait)').matches)) {
                    rotateNotice.css('display', 'flex');
                    window.onorientationchange = function(e) {
                        rotateNotice.hide();
                    };
                }
            }, 100);
        }

        // Handle both pwa stuff
        if (isPwa()) {
            if (jQuery('form').length) {
                jQuery('form').attr('data-persist', 'garlic');
            }
        }
    }

    // Handle PWA installation analytics
    window.onappinstalled = function(e) { 
        jQuery.ajax({
            url: objectName.ajaxUrl,
            dataType: 'text',
            type: 'POST',
            data: {
                action: optionName + '_save_installation_analytics',
            },
            beforeSend: function() {
                console.log('saving');
            },
            success: function(response, textStatus, jqXhr) {
                console.log('saved');
            },
            complete: function() {

            },
            error: function(jqXhr, textStatus, errorThrown) {
                console.log(jqXhr);
            }
        }); 
    };
});