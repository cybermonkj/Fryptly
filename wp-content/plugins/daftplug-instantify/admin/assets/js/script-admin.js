'use strict';window.jscolor||(window.jscolor=function(){var e,t,n,r,o,i={register:function(){i.attachDOMReadyEvent(i.init),i.attachEvent(document,"mousedown",i.onDocumentMouseDown),i.attachEvent(document,"touchstart",i.onDocumentTouchStart),i.attachEvent(window,"resize",i.onWindowResize)},init:function(){i.jscolor.lookupClass&&i.jscolor.installByClassName(i.jscolor.lookupClass)},tryInstallOnElements:function(e,t){for(var n=new RegExp("(^|\\s)("+t+")(\\s*(\\{[^}]*\\})|\\s|$)","i"),r=0;r<e.length;r+=1){var o;if(void 0===e[r].type||"color"!=e[r].type.toLowerCase()||!i.isColorAttrSupported)if(!e[r].jscolor&&e[r].className&&(o=e[r].className.match(n))){var s=e[r],l=null,a=i.getDataAttr(s,"jscolor");null!==a?l=a:o[4]&&(l=o[4]);var d={};if(l)try{d=new Function("return ("+l+")")()}catch(e){i.warn("Error parsing jscolor options: "+e+":\n"+l)}s.jscolor=new i.jscolor(s,d)}}},isColorAttrSupported:(o=document.createElement("input"),!(!o.setAttribute||(o.setAttribute("type","color"),"color"!=o.type.toLowerCase()))),isCanvasSupported:function(){var e=document.createElement("canvas");return!(!e.getContext||!e.getContext("2d"))}(),fetchElement:function(e){return"string"==typeof e?document.getElementById(e):e},isElementType:function(e,t){return e.nodeName.toLowerCase()===t.toLowerCase()},getDataAttr:function(e,t){var n="data-"+t,r=e.getAttribute(n);return null!==r?r:null},attachEvent:function(e,t,n){e.addEventListener?e.addEventListener(t,n,!1):e.attachEvent&&e.attachEvent("on"+t,n)},detachEvent:function(e,t,n){e.removeEventListener?e.removeEventListener(t,n,!1):e.detachEvent&&e.detachEvent("on"+t,n)},_attachedGroupEvents:{},attachGroupEvent:function(e,t,n,r){i._attachedGroupEvents.hasOwnProperty(e)||(i._attachedGroupEvents[e]=[]),i._attachedGroupEvents[e].push([t,n,r]),i.attachEvent(t,n,r)},detachGroupEvents:function(e){if(i._attachedGroupEvents.hasOwnProperty(e)){for(var t=0;t<i._attachedGroupEvents[e].length;t+=1){var n=i._attachedGroupEvents[e][t];i.detachEvent(n[0],n[1],n[2])}delete i._attachedGroupEvents[e]}},attachDOMReadyEvent:function(e){var t=!1,n=function(){t||(t=!0,e())};if("complete"!==document.readyState){if(document.addEventListener)document.addEventListener("DOMContentLoaded",n,!1),window.addEventListener("load",n,!1);else if(document.attachEvent&&(document.attachEvent("onreadystatechange",function(){"complete"===document.readyState&&(document.detachEvent("onreadystatechange",arguments.callee),n())}),window.attachEvent("onload",n),document.documentElement.doScroll&&window==window.top)){var r=function(){if(document.body)try{document.documentElement.doScroll("left"),n()}catch(e){setTimeout(r,1)}};r()}}else setTimeout(n,1)},warn:function(e){window.console&&window.console.warn&&window.console.warn(e)},preventDefault:function(e){e.preventDefault&&e.preventDefault(),e.returnValue=!1},captureTarget:function(e){e.setCapture&&(i._capturedTarget=e,i._capturedTarget.setCapture())},releaseTarget:function(){i._capturedTarget&&(i._capturedTarget.releaseCapture(),i._capturedTarget=null)},fireEvent:function(e,t){if(e)if(document.createEvent)(n=document.createEvent("HTMLEvents")).initEvent(t,!0,!0),e.dispatchEvent(n);else if(document.createEventObject){var n=document.createEventObject();e.fireEvent("on"+t,n)}else e["on"+t]&&e["on"+t]()},classNameToList:function(e){return e.replace(/^\s+|\s+$/g,"").split(/\s+/)},hasClass:function(e,t){return!!t&&-1!=(" "+e.className.replace(/\s+/g," ")+" ").indexOf(" "+t+" ")},setClass:function(e,t){for(var n=i.classNameToList(t),r=0;r<n.length;r+=1)i.hasClass(e,n[r])||(e.className+=(e.className?" ":"")+n[r])},unsetClass:function(e,t){for(var n=i.classNameToList(t),r=0;r<n.length;r+=1){var o=new RegExp("^\\s*"+n[r]+"\\s*|\\s*"+n[r]+"\\s*$|\\s+"+n[r]+"(\\s+)","g");e.className=e.className.replace(o,"$1")}},getStyle:function(e){return window.getComputedStyle?window.getComputedStyle(e):e.currentStyle},setStyle:(t=document.createElement("div"),n=function(e){for(var n=0;n<e.length;n+=1)if(e[n]in t.style)return e[n]},r={borderRadius:n(["borderRadius","MozBorderRadius","webkitBorderRadius"]),boxShadow:n(["boxShadow","MozBoxShadow","webkitBoxShadow"])},function(e,t,n){switch(t.toLowerCase()){case"opacity":var o=Math.round(100*parseFloat(n));e.style.opacity=n,e.style.filter="alpha(opacity="+o+")";break;default:e.style[r[t]]=n}}),setBorderRadius:function(e,t){i.setStyle(e,"borderRadius",t||"0")},setBoxShadow:function(e,t){i.setStyle(e,"boxShadow",t||"none")},getElementPos:function(e,t){var n=0,r=0,o=e.getBoundingClientRect();if(n=o.left,r=o.top,!t){var s=i.getViewPos();n+=s[0],r+=s[1]}return[n,r]},getElementSize:function(e){return[e.offsetWidth,e.offsetHeight]},getAbsPointerPos:function(e){e||(e=window.event);var t=0,n=0;return void 0!==e.changedTouches&&e.changedTouches.length?(t=e.changedTouches[0].clientX,n=e.changedTouches[0].clientY):"number"==typeof e.clientX&&(t=e.clientX,n=e.clientY),{x:t,y:n}},getRelPointerPos:function(e){e||(e=window.event);var t=(e.target||e.srcElement).getBoundingClientRect(),n=0,r=0;return void 0!==e.changedTouches&&e.changedTouches.length?(n=e.changedTouches[0].clientX,r=e.changedTouches[0].clientY):"number"==typeof e.clientX&&(n=e.clientX,r=e.clientY),{x:n-t.left,y:r-t.top}},getViewPos:function(){var e=document.documentElement;return[(window.pageXOffset||e.scrollLeft)-(e.clientLeft||0),(window.pageYOffset||e.scrollTop)-(e.clientTop||0)]},getViewSize:function(){var e=document.documentElement;return[window.innerWidth||e.clientWidth,window.innerHeight||e.clientHeight]},redrawPosition:function(){if(i.picker&&i.picker.owner){var e,t,n=i.picker.owner;n.fixed?(e=i.getElementPos(n.targetElement,!0),t=[0,0]):(e=i.getElementPos(n.targetElement),t=i.getViewPos());var r,o,s,l=i.getElementSize(n.targetElement),a=i.getViewSize(),d=i.getPickerOuterDims(n);switch(n.position.toLowerCase()){case"left":r=1,o=0,s=-1;break;case"right":r=1,o=0,s=1;break;case"top":r=0,o=1,s=-1;break;default:r=0,o=1,s=1}var c=(l[o]+d[o])/2;if(n.smartPosition)h=[-t[r]+e[r]+d[r]>a[r]&&-t[r]+e[r]+l[r]/2>a[r]/2&&e[r]+l[r]-d[r]>=0?e[r]+l[r]-d[r]:e[r],-t[o]+e[o]+l[o]+d[o]-c+c*s>a[o]?-t[o]+e[o]+l[o]/2>a[o]/2&&e[o]+l[o]-c-c*s>=0?e[o]+l[o]-c-c*s:e[o]+l[o]-c+c*s:e[o]+l[o]-c+c*s>=0?e[o]+l[o]-c+c*s:e[o]+l[o]-c-c*s];else var h=[e[r],e[o]+l[o]-c+c*s];var p=h[r],u=h[o],m=n.fixed?"fixed":"absolute",v=(h[0]+d[0]>e[0]||h[0]<e[0]+l[0])&&h[1]+d[1]<e[1]+l[1];i._drawPosition(n,p,u,m,v)}},_drawPosition:function(e,t,n,r,o){var s=o?0:e.shadowBlur;i.picker.wrap.style.position=r,i.picker.wrap.style.left=t+"px",i.picker.wrap.style.top=n+"px",i.setBoxShadow(i.picker.boxS,e.shadow?new i.BoxShadow(0,s,e.shadowBlur,0,e.shadowColor):null)},getPickerDims:function(e){var t=!!i.getSliderComponent(e);return[2*e.insetWidth+2*e.padding+e.width+(t?2*e.insetWidth+i.getPadToSliderPadding(e)+e.sliderSize:0),2*e.insetWidth+2*e.padding+e.height+(e.closable?2*e.insetWidth+e.padding+e.buttonHeight:0)]},getPickerOuterDims:function(e){var t=i.getPickerDims(e);return[t[0]+2*e.borderWidth,t[1]+2*e.borderWidth]},getPadToSliderPadding:function(e){return Math.max(e.padding,1.5*(2*e.pointerBorderWidth+e.pointerThickness))},getPadYComponent:function(e){switch(e.mode.charAt(1).toLowerCase()){case"v":return"v"}return"s"},getSliderComponent:function(e){if(e.mode.length>2)switch(e.mode.charAt(2).toLowerCase()){case"s":return"s";case"v":return"v"}return null},onDocumentMouseDown:function(e){e||(e=window.event);var t=e.target||e.srcElement;t._jscLinkedInstance?t._jscLinkedInstance.showOnClick&&t._jscLinkedInstance.show():t._jscControlName?i.onControlPointerStart(e,t,t._jscControlName,"mouse"):i.picker&&i.picker.owner&&i.picker.owner.hide()},onDocumentTouchStart:function(e){e||(e=window.event);var t=e.target||e.srcElement;t._jscLinkedInstance?t._jscLinkedInstance.showOnClick&&t._jscLinkedInstance.show():t._jscControlName?i.onControlPointerStart(e,t,t._jscControlName,"touch"):i.picker&&i.picker.owner&&i.picker.owner.hide()},onWindowResize:function(e){i.redrawPosition()},onParentScroll:function(e){i.picker&&i.picker.owner&&i.picker.owner.hide()},_pointerMoveEvent:{mouse:"mousemove",touch:"touchmove"},_pointerEndEvent:{mouse:"mouseup",touch:"touchend"},_pointerOrigin:null,_capturedTarget:null,onControlPointerStart:function(e,t,n,r){var o=t._jscInstance;i.preventDefault(e),i.captureTarget(t);var s=function(o,s){i.attachGroupEvent("drag",o,i._pointerMoveEvent[r],i.onDocumentPointerMove(e,t,n,r,s)),i.attachGroupEvent("drag",o,i._pointerEndEvent[r],i.onDocumentPointerEnd(e,t,n,r))};if(s(document,[0,0]),window.parent&&window.frameElement){var l=window.frameElement.getBoundingClientRect(),a=[-l.left,-l.top];s(window.parent.window.document,a)}var d=i.getAbsPointerPos(e),c=i.getRelPointerPos(e);switch(i._pointerOrigin={x:d.x-c.x,y:d.y-c.y},n){case"pad":switch(i.getSliderComponent(o)){case"s":0===o.hsv[1]&&o.fromHSV(null,100,null);break;case"v":0===o.hsv[2]&&o.fromHSV(null,null,100)}i.setPad(o,e,0,0);break;case"sld":i.setSld(o,e,0)}i.dispatchFineChange(o)},onDocumentPointerMove:function(e,t,n,r,o){return function(e){var r=t._jscInstance;switch(n){case"pad":e||(e=window.event),i.setPad(r,e,o[0],o[1]),i.dispatchFineChange(r);break;case"sld":e||(e=window.event),i.setSld(r,e,o[1]),i.dispatchFineChange(r)}}},onDocumentPointerEnd:function(e,t,n,r){return function(e){var n=t._jscInstance;i.detachGroupEvents("drag"),i.releaseTarget(),i.dispatchChange(n)}},dispatchChange:function(e){e.valueElement&&i.isElementType(e.valueElement,"input")&&i.fireEvent(e.valueElement,"change")},dispatchFineChange:function(e){e.onFineChange&&("string"==typeof e.onFineChange?new Function(e.onFineChange):e.onFineChange).call(e)},setPad:function(e,t,n,r){var o=i.getAbsPointerPos(t),s=n+o.x-i._pointerOrigin.x-e.padding-e.insetWidth,l=r+o.y-i._pointerOrigin.y-e.padding-e.insetWidth,a=s*(360/(e.width-1)),d=100-l*(100/(e.height-1));switch(i.getPadYComponent(e)){case"s":e.fromHSV(a,d,null,i.leaveSld);break;case"v":e.fromHSV(a,null,d,i.leaveSld)}},setSld:function(e,t,n){var r=100-(n+i.getAbsPointerPos(t).y-i._pointerOrigin.y-e.padding-e.insetWidth)*(100/(e.height-1));switch(i.getSliderComponent(e)){case"s":e.fromHSV(null,r,null,i.leavePad);break;case"v":e.fromHSV(null,null,r,i.leavePad)}},_vmlNS:"jsc_vml_",_vmlCSS:"jsc_vml_css_",_vmlReady:!1,initVML:function(){if(!i._vmlReady){var e=document;if(e.namespaces[i._vmlNS]||e.namespaces.add(i._vmlNS,"urn:schemas-microsoft-com:vml"),!e.styleSheets[i._vmlCSS]){var t=["shape","shapetype","group","background","path","formulas","handles","fill","stroke","shadow","textbox","textpath","imagedata","line","polyline","curve","rect","roundrect","oval","arc","image"],n=e.createStyleSheet();n.owningElement.id=i._vmlCSS;for(var r=0;r<t.length;r+=1)n.addRule(i._vmlNS+"\\:"+t[r],"behavior:url(#default#VML);")}i._vmlReady=!0}},createPalette:function(){var e={elm:null,draw:null};if(i.isCanvasSupported){var t=document.createElement("canvas"),n=t.getContext("2d"),r=function(e,r,o){t.width=e,t.height=r,n.clearRect(0,0,t.width,t.height);var i=n.createLinearGradient(0,0,t.width,0);i.addColorStop(0,"#F00"),i.addColorStop(1/6,"#FF0"),i.addColorStop(2/6,"#0F0"),i.addColorStop(.5,"#0FF"),i.addColorStop(4/6,"#00F"),i.addColorStop(5/6,"#F0F"),i.addColorStop(1,"#F00"),n.fillStyle=i,n.fillRect(0,0,t.width,t.height);var s=n.createLinearGradient(0,0,0,t.height);switch(o.toLowerCase()){case"s":s.addColorStop(0,"rgba(255,255,255,0)"),s.addColorStop(1,"rgba(255,255,255,1)");break;case"v":s.addColorStop(0,"rgba(0,0,0,0)"),s.addColorStop(1,"rgba(0,0,0,1)")}n.fillStyle=s,n.fillRect(0,0,t.width,t.height)};e.elm=t,e.draw=r}else{i.initVML();var o=document.createElement("div");o.style.position="relative",o.style.overflow="hidden";var s=document.createElement(i._vmlNS+":fill");s.type="gradient",s.method="linear",s.angle="90",s.colors="16.67% #F0F, 33.33% #00F, 50% #0FF, 66.67% #0F0, 83.33% #FF0";var l=document.createElement(i._vmlNS+":rect");l.style.position="absolute",l.style.left="-1px",l.style.top="-1px",l.stroked=!1,l.appendChild(s),o.appendChild(l);var a=document.createElement(i._vmlNS+":fill");a.type="gradient",a.method="linear",a.angle="180",a.opacity="0";var d=document.createElement(i._vmlNS+":rect");d.style.position="absolute",d.style.left="-1px",d.style.top="-1px",d.stroked=!1,d.appendChild(a),o.appendChild(d);r=function(e,t,n){switch(o.style.width=e+"px",o.style.height=t+"px",l.style.width=d.style.width=e+1+"px",l.style.height=d.style.height=t+1+"px",s.color="#F00",s.color2="#F00",n.toLowerCase()){case"s":a.color=a.color2="#FFF";break;case"v":a.color=a.color2="#000"}};e.elm=o,e.draw=r}return e},createSliderGradient:function(){var e={elm:null,draw:null};if(i.isCanvasSupported){var t=document.createElement("canvas"),n=t.getContext("2d"),r=function(e,r,o,i){t.width=e,t.height=r,n.clearRect(0,0,t.width,t.height);var s=n.createLinearGradient(0,0,0,t.height);s.addColorStop(0,o),s.addColorStop(1,i),n.fillStyle=s,n.fillRect(0,0,t.width,t.height)};e.elm=t,e.draw=r}else{i.initVML();var o=document.createElement("div");o.style.position="relative",o.style.overflow="hidden";var s=document.createElement(i._vmlNS+":fill");s.type="gradient",s.method="linear",s.angle="180";var l=document.createElement(i._vmlNS+":rect");l.style.position="absolute",l.style.left="-1px",l.style.top="-1px",l.stroked=!1,l.appendChild(s),o.appendChild(l);r=function(e,t,n,r){o.style.width=e+"px",o.style.height=t+"px",l.style.width=e+1+"px",l.style.height=t+1+"px",s.color=n,s.color2=r};e.elm=o,e.draw=r}return e},leaveValue:1,leaveStyle:2,leavePad:4,leaveSld:8,BoxShadow:(e=function(e,t,n,r,o,i){this.hShadow=e,this.vShadow=t,this.blur=n,this.spread=r,this.color=o,this.inset=!!i},e.prototype.toString=function(){var e=[Math.round(this.hShadow)+"px",Math.round(this.vShadow)+"px",Math.round(this.blur)+"px",Math.round(this.spread)+"px",this.color];return this.inset&&e.push("inset"),e.join(" ")},e),jscolor:function(e,t){for(var n in this.value=null,this.valueElement=e,this.styleElement=e,this.required=!0,this.refine=!0,this.hash=!1,this.uppercase=!0,this.onFineChange=null,this.activeClass="jscolor-active",this.overwriteImportant=!1,this.minS=0,this.maxS=100,this.minV=0,this.maxV=100,this.hsv=[0,0,100],this.rgb=[255,255,255],this.width=181,this.height=101,this.showOnClick=!0,this.mode="HSV",this.position="bottom",this.smartPosition=!0,this.sliderSize=16,this.crossSize=8,this.closable=!1,this.closeText="Close",this.buttonColor="#000000",this.buttonHeight=18,this.padding=12,this.backgroundColor="#FFFFFF",this.borderWidth=1,this.borderColor="#BBBBBB",this.borderRadius=8,this.insetWidth=1,this.insetColor="#BBBBBB",this.shadow=!0,this.shadowBlur=15,this.shadowColor="rgba(0,0,0,0.2)",this.pointerColor="#4C4C4C",this.pointerBorderColor="#FFFFFF",this.pointerBorderWidth=1,this.pointerThickness=2,this.zIndex=1e3,this.container=null,t)t.hasOwnProperty(n)&&(this[n]=t[n]);function r(e,t,n){var r=n/100*255;if(null===e)return[r,r,r];e/=60,t/=100;var o=Math.floor(e),i=r*(1-t),s=r*(1-t*(o%2?e-o:1-(e-o)));switch(o){case 6:case 0:return[r,s,i];case 1:return[s,r,i];case 2:return[i,r,s];case 3:return[i,s,r];case 4:return[s,i,r];case 5:return[r,i,s]}}function o(){h._processParentElementsInDOM(),i.picker||(i.picker={owner:null,wrap:document.createElement("div"),box:document.createElement("div"),boxS:document.createElement("div"),boxB:document.createElement("div"),pad:document.createElement("div"),padB:document.createElement("div"),padM:document.createElement("div"),padPal:i.createPalette(),cross:document.createElement("div"),crossBY:document.createElement("div"),crossBX:document.createElement("div"),crossLY:document.createElement("div"),crossLX:document.createElement("div"),sld:document.createElement("div"),sldB:document.createElement("div"),sldM:document.createElement("div"),sldGrad:i.createSliderGradient(),sldPtrS:document.createElement("div"),sldPtrIB:document.createElement("div"),sldPtrMB:document.createElement("div"),sldPtrOB:document.createElement("div"),btn:document.createElement("div"),btnT:document.createElement("span")},i.picker.pad.appendChild(i.picker.padPal.elm),i.picker.padB.appendChild(i.picker.pad),i.picker.cross.appendChild(i.picker.crossBY),i.picker.cross.appendChild(i.picker.crossBX),i.picker.cross.appendChild(i.picker.crossLY),i.picker.cross.appendChild(i.picker.crossLX),i.picker.padB.appendChild(i.picker.cross),i.picker.box.appendChild(i.picker.padB),i.picker.box.appendChild(i.picker.padM),i.picker.sld.appendChild(i.picker.sldGrad.elm),i.picker.sldB.appendChild(i.picker.sld),i.picker.sldB.appendChild(i.picker.sldPtrOB),i.picker.sldPtrOB.appendChild(i.picker.sldPtrMB),i.picker.sldPtrMB.appendChild(i.picker.sldPtrIB),i.picker.sldPtrIB.appendChild(i.picker.sldPtrS),i.picker.box.appendChild(i.picker.sldB),i.picker.box.appendChild(i.picker.sldM),i.picker.btn.appendChild(i.picker.btnT),i.picker.box.appendChild(i.picker.btn),i.picker.boxB.appendChild(i.picker.box),i.picker.wrap.appendChild(i.picker.boxS),i.picker.wrap.appendChild(i.picker.boxB));var e,t,n=i.picker,r=!!i.getSliderComponent(h),o=i.getPickerDims(h),a=2*h.pointerBorderWidth+h.pointerThickness+2*h.crossSize,d=i.getPadToSliderPadding(h),c=Math.min(h.borderRadius,Math.round(h.padding*Math.PI));n.wrap.style.clear="both",n.wrap.style.width=o[0]+2*h.borderWidth+"px",n.wrap.style.height=o[1]+2*h.borderWidth+"px",n.wrap.style.zIndex=h.zIndex,n.box.style.width=o[0]+"px",n.box.style.height=o[1]+"px",n.boxS.style.position="absolute",n.boxS.style.left="0",n.boxS.style.top="0",n.boxS.style.width="100%",n.boxS.style.height="100%",i.setBorderRadius(n.boxS,c+"px"),n.boxB.style.position="relative",n.boxB.style.border=h.borderWidth+"px solid",n.boxB.style.borderColor=h.borderColor,n.boxB.style.background=h.backgroundColor,i.setBorderRadius(n.boxB,c+"px"),n.padM.style.background=n.sldM.style.background="#FFF",i.setStyle(n.padM,"opacity","0"),i.setStyle(n.sldM,"opacity","0"),n.pad.style.position="relative",n.pad.style.width=h.width+"px",n.pad.style.height=h.height+"px",n.padPal.draw(h.width,h.height,i.getPadYComponent(h)),n.padB.style.position="absolute",n.padB.style.left=h.padding+"px",n.padB.style.top=h.padding+"px",n.padB.style.border=h.insetWidth+"px solid",n.padB.style.borderColor=h.insetColor,n.padM._jscInstance=h,n.padM._jscControlName="pad",n.padM.style.position="absolute",n.padM.style.left="0",n.padM.style.top="0",n.padM.style.width=h.padding+2*h.insetWidth+h.width+d/2+"px",n.padM.style.height=o[1]+"px",n.padM.style.cursor="crosshair",n.cross.style.position="absolute",n.cross.style.left=n.cross.style.top="0",n.cross.style.width=n.cross.style.height=a+"px",n.crossBY.style.position=n.crossBX.style.position="absolute",n.crossBY.style.background=n.crossBX.style.background=h.pointerBorderColor,n.crossBY.style.width=n.crossBX.style.height=2*h.pointerBorderWidth+h.pointerThickness+"px",n.crossBY.style.height=n.crossBX.style.width=a+"px",n.crossBY.style.left=n.crossBX.style.top=Math.floor(a/2)-Math.floor(h.pointerThickness/2)-h.pointerBorderWidth+"px",n.crossBY.style.top=n.crossBX.style.left="0",n.crossLY.style.position=n.crossLX.style.position="absolute",n.crossLY.style.background=n.crossLX.style.background=h.pointerColor,n.crossLY.style.height=n.crossLX.style.width=a-2*h.pointerBorderWidth+"px",n.crossLY.style.width=n.crossLX.style.height=h.pointerThickness+"px",n.crossLY.style.left=n.crossLX.style.top=Math.floor(a/2)-Math.floor(h.pointerThickness/2)+"px",n.crossLY.style.top=n.crossLX.style.left=h.pointerBorderWidth+"px",n.sld.style.overflow="hidden",n.sld.style.width=h.sliderSize+"px",n.sld.style.height=h.height+"px",n.sldGrad.draw(h.sliderSize,h.height,"#000","#000"),n.sldB.style.display=r?"block":"none",n.sldB.style.position="absolute",n.sldB.style.right=h.padding+"px",n.sldB.style.top=h.padding+"px",n.sldB.style.border=h.insetWidth+"px solid",n.sldB.style.borderColor=h.insetColor,n.sldM._jscInstance=h,n.sldM._jscControlName="sld",n.sldM.style.display=r?"block":"none",n.sldM.style.position="absolute",n.sldM.style.right="0",n.sldM.style.top="0",n.sldM.style.width=h.sliderSize+d/2+h.padding+2*h.insetWidth+"px",n.sldM.style.height=o[1]+"px",n.sldM.style.cursor="default",n.sldPtrIB.style.border=n.sldPtrOB.style.border=h.pointerBorderWidth+"px solid "+h.pointerBorderColor,n.sldPtrOB.style.position="absolute",n.sldPtrOB.style.left=-(2*h.pointerBorderWidth+h.pointerThickness)+"px",n.sldPtrOB.style.top="0",n.sldPtrMB.style.border=h.pointerThickness+"px solid "+h.pointerColor,n.sldPtrS.style.width=h.sliderSize+"px",n.sldPtrS.style.height=u+"px",n.btn.style.display=h.closable?"block":"none",n.btn.style.position="absolute",n.btn.style.left=h.padding+"px",n.btn.style.bottom=h.padding+"px",n.btn.style.padding="0 15px",n.btn.style.height=h.buttonHeight+"px",n.btn.style.border=h.insetWidth+"px solid",e=h.insetColor.split(/\s+/),t=e.length<2?e[0]:e[1]+" "+e[0]+" "+e[0]+" "+e[1],n.btn.style.borderColor=t,n.btn.style.color=h.buttonColor,n.btn.style.font="12px sans-serif",n.btn.style.textAlign="center";try{n.btn.style.cursor="pointer"}catch(e){n.btn.style.cursor="hand"}n.btn.onmousedown=function(){h.hide()},n.btnT.style.lineHeight=h.buttonHeight+"px",n.btnT.innerHTML="",n.btnT.appendChild(document.createTextNode(h.closeText)),s(),l(),i.picker.owner&&i.picker.owner!==h&&i.unsetClass(i.picker.owner.targetElement,h.activeClass),i.picker.owner=h,i.isElementType(p,"body")?i.redrawPosition():i._drawPosition(h,0,0,"relative",!1),n.wrap.parentNode!=p&&p.appendChild(n.wrap),i.setClass(h.targetElement,h.activeClass)}function s(){switch(i.getPadYComponent(h)){case"s":var e=1;break;case"v":e=2}var t=Math.round(h.hsv[0]/360*(h.width-1)),n=Math.round((1-h.hsv[e]/100)*(h.height-1)),o=2*h.pointerBorderWidth+h.pointerThickness+2*h.crossSize,s=-Math.floor(o/2);switch(i.picker.cross.style.left=t+s+"px",i.picker.cross.style.top=n+s+"px",i.getSliderComponent(h)){case"s":var l=r(h.hsv[0],100,h.hsv[2]),a=r(h.hsv[0],0,h.hsv[2]),d="rgb("+Math.round(l[0])+","+Math.round(l[1])+","+Math.round(l[2])+")",c="rgb("+Math.round(a[0])+","+Math.round(a[1])+","+Math.round(a[2])+")";i.picker.sldGrad.draw(h.sliderSize,h.height,d,c);break;case"v":var p=r(h.hsv[0],h.hsv[1],100);d="rgb("+Math.round(p[0])+","+Math.round(p[1])+","+Math.round(p[2])+")",c="#000";i.picker.sldGrad.draw(h.sliderSize,h.height,d,c)}}function l(){var e=i.getSliderComponent(h);if(e){switch(e){case"s":var t=1;break;case"v":t=2}var n=Math.round((1-h.hsv[t]/100)*(h.height-1));i.picker.sldPtrOB.style.top=n-(2*h.pointerBorderWidth+h.pointerThickness)-Math.floor(u/2)+"px"}}function a(){return i.picker&&i.picker.owner===h}if(this.hide=function(){a()&&(i.unsetClass(h.targetElement,h.activeClass),i.picker.wrap.parentNode.removeChild(i.picker.wrap),delete i.picker.owner)},this.show=function(){o()},this.redraw=function(){a()&&o()},this.importColor=function(){this.valueElement&&i.isElementType(this.valueElement,"input")?this.refine?!this.required&&/^\s*$/.test(this.valueElement.value)?(this.valueElement.value="",this.styleElement&&(this.styleElement.style.backgroundImage=this.styleElement._jscOrigStyle.backgroundImage,this.styleElement.style.backgroundColor=this.styleElement._jscOrigStyle.backgroundColor,this.styleElement.style.color=this.styleElement._jscOrigStyle.color),this.exportColor(i.leaveValue|i.leaveStyle)):this.fromString(this.valueElement.value)||this.exportColor():this.fromString(this.valueElement.value,i.leaveValue)||(this.styleElement&&(this.styleElement.style.backgroundImage=this.styleElement._jscOrigStyle.backgroundImage,this.styleElement.style.backgroundColor=this.styleElement._jscOrigStyle.backgroundColor,this.styleElement.style.color=this.styleElement._jscOrigStyle.color),this.exportColor(i.leaveValue|i.leaveStyle)):this.exportColor()},this.exportColor=function(e){if(!(e&i.leaveValue)&&this.valueElement){var t=this.toString();this.uppercase&&(t=t.toUpperCase()),this.hash&&(t="#"+t),i.isElementType(this.valueElement,"input")?this.valueElement.value=t:this.valueElement.innerHTML=t}if(!(e&i.leaveStyle)&&this.styleElement){var n="#"+this.toString(),r=this.isLight()?"#000":"#FFF";this.styleElement.style.backgroundImage="none",this.styleElement.style.backgroundColor=n,this.styleElement.style.color=r,this.overwriteImportant&&this.styleElement.setAttribute("style","background: "+n+" !important; color: "+r+" !important;")}e&i.leavePad||!a()||s(),e&i.leaveSld||!a()||l()},this.fromHSV=function(e,t,n,o){if(null!==e){if(isNaN(e))return!1;e=Math.max(0,Math.min(360,e))}if(null!==t){if(isNaN(t))return!1;t=Math.max(0,Math.min(100,this.maxS,t),this.minS)}if(null!==n){if(isNaN(n))return!1;n=Math.max(0,Math.min(100,this.maxV,n),this.minV)}this.rgb=r(null===e?this.hsv[0]:this.hsv[0]=e,null===t?this.hsv[1]:this.hsv[1]=t,null===n?this.hsv[2]:this.hsv[2]=n),this.exportColor(o)},this.fromRGB=function(e,t,n,o){if(null!==e){if(isNaN(e))return!1;e=Math.max(0,Math.min(255,e))}if(null!==t){if(isNaN(t))return!1;t=Math.max(0,Math.min(255,t))}if(null!==n){if(isNaN(n))return!1;n=Math.max(0,Math.min(255,n))}var i=function(e,t,n){e/=255,t/=255,n/=255;var r=Math.min(Math.min(e,t),n),o=Math.max(Math.max(e,t),n),i=o-r;if(0===i)return[null,0,100*o];var s=e===r?3+(n-t)/i:t===r?5+(e-n)/i:1+(t-e)/i;return[60*(6===s?0:s),i/o*100,100*o]}(null===e?this.rgb[0]:e,null===t?this.rgb[1]:t,null===n?this.rgb[2]:n);null!==i[0]&&(this.hsv[0]=Math.max(0,Math.min(360,i[0]))),0!==i[2]&&(this.hsv[1]=null===i[1]?null:Math.max(0,this.minS,Math.min(100,this.maxS,i[1]))),this.hsv[2]=null===i[2]?null:Math.max(0,this.minV,Math.min(100,this.maxV,i[2]));var s=r(this.hsv[0],this.hsv[1],this.hsv[2]);this.rgb[0]=s[0],this.rgb[1]=s[1],this.rgb[2]=s[2],this.exportColor(o)},this.fromString=function(e,t){var n;if(n=e.match(/^\W*([0-9A-F]{3}([0-9A-F]{3})?)\W*$/i))return 6===n[1].length?this.fromRGB(parseInt(n[1].substr(0,2),16),parseInt(n[1].substr(2,2),16),parseInt(n[1].substr(4,2),16),t):this.fromRGB(parseInt(n[1].charAt(0)+n[1].charAt(0),16),parseInt(n[1].charAt(1)+n[1].charAt(1),16),parseInt(n[1].charAt(2)+n[1].charAt(2),16),t),!0;if(n=e.match(/^\W*rgba?\(([^)]*)\)\W*$/i)){var r,o,i,s=n[1].split(","),l=/^\s*(\d*)(\.\d+)?\s*$/;if(s.length>=3&&(r=s[0].match(l))&&(o=s[1].match(l))&&(i=s[2].match(l))){var a=parseFloat((r[1]||"0")+(r[2]||"")),d=parseFloat((o[1]||"0")+(o[2]||"")),c=parseFloat((i[1]||"0")+(i[2]||""));return this.fromRGB(a,d,c,t),!0}}return!1},this.toString=function(){return(256|Math.round(this.rgb[0])).toString(16).substr(1)+(256|Math.round(this.rgb[1])).toString(16).substr(1)+(256|Math.round(this.rgb[2])).toString(16).substr(1)},this.toHEXString=function(){return"#"+this.toString().toUpperCase()},this.toRGBString=function(){return"rgb("+Math.round(this.rgb[0])+","+Math.round(this.rgb[1])+","+Math.round(this.rgb[2])+")"},this.isLight=function(){return.213*this.rgb[0]+.715*this.rgb[1]+.072*this.rgb[2]>127.5},this._processParentElementsInDOM=function(){if(!this._linkedElementsProcessed){this._linkedElementsProcessed=!0;var e=this.targetElement;do{var t=i.getStyle(e);t&&"fixed"===t.position.toLowerCase()&&(this.fixed=!0),e!==this.targetElement&&(e._jscEventsAttached||(i.attachEvent(e,"scroll",i.onParentScroll),e._jscEventsAttached=!0))}while((e=e.parentNode)&&!i.isElementType(e,"body"))}},"string"==typeof e){var d=e,c=document.getElementById(d);c?this.targetElement=c:i.warn("Could not find target element with ID '"+d+"'")}else e?this.targetElement=e:i.warn("Invalid target element: '"+e+"'");if(this.targetElement._jscLinkedInstance)i.warn("Cannot link jscolor twice to the same element. Skipping.");else{this.targetElement._jscLinkedInstance=this,this.valueElement=i.fetchElement(this.valueElement),this.styleElement=i.fetchElement(this.styleElement);var h=this,p=this.container?i.fetchElement(this.container):document.getElementsByTagName("body")[0],u=3;if(i.isElementType(this.targetElement,"button"))if(this.targetElement.onclick){var m=this.targetElement.onclick;this.targetElement.onclick=function(e){return m.call(this,e),!1}}else this.targetElement.onclick=function(){return!1};if(this.valueElement&&i.isElementType(this.valueElement,"input")){var v=function(){h.fromString(h.valueElement.value,i.leaveValue),i.dispatchFineChange(h)};i.attachEvent(this.valueElement,"keyup",v),i.attachEvent(this.valueElement,"input",v),i.attachEvent(this.valueElement,"blur",function(){h.importColor()}),this.valueElement.setAttribute("autocomplete","off")}this.styleElement&&(this.styleElement._jscOrigStyle={backgroundImage:this.styleElement.style.backgroundImage,backgroundColor:this.styleElement.style.backgroundColor,color:this.styleElement.style.color}),this.value?this.fromString(this.value)||this.exportColor():this.importColor()}}};return i.jscolor.lookupClass="jscolor",i.jscolor.installByClassName=function(e){var t=document.getElementsByTagName("input"),n=document.getElementsByTagName("button");i.tryInstallOnElements(t,e),i.tryInstallOnElements(n,e)},i.register(),i.jscolor}());

jQuery(function() {
    'use strict';
    var daftplugAdmin = jQuery('.daftplugAdmin[data-daftplug-plugin="daftplug_instantify"]');
    var optionName = daftplugAdmin.attr('data-daftplug-plugin');
    var objectName = window[optionName + '_admin_js_vars'];

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

    // Handle URLs
    if (daftplugAdmin.find('.daftplugAdminPage.-activation').length) {
        window.location.hash = '#/activation/';
        daftplugAdmin.find('.daftplugAdminPage.-activation').addClass('-active');
        daftplugAdmin.find('.daftplugAdminHeader').css('justify-content', 'center');
        daftplugAdmin.find('.daftplugAdminHeader_versionText, .daftplugAdminHeader_support').hide();
    } else {
        if (window.location.hash) {
            var hash = window.location.hash.replace(/#|\//g, '').split('-');
            var pageId = hash[0];
            var subPageId = hash[1];
            var page = daftplugAdmin.find('.daftplugAdminPage.-' + pageId);
            var menuItem = daftplugAdmin.find('.daftplugAdminMenu_item.-' + pageId);
            var subPage = daftplugAdmin.find('.daftplugAdminPage_subpage.-' + subPageId);
            var subMenuItem = daftplugAdmin.find('.daftplugAdminSubmenu_item.-' + subPageId);
            var hasSubPages = page.find('.daftplugAdminPage_subpage').length;
            var firstSubPage = page.find('.daftplugAdminPage_subpage').first();
            var firstSubPageId = firstSubPage.attr('data-subpage');
            var firstSubMenuItem = page.find('.daftplugAdminSubmenu_item').first();
            var errorPage = daftplugAdmin.find('.daftplugAdminPage.-error');

            if (page.length) {
                page.addClass('-active');
                menuItem.addClass('-active');

                if (hasSubPages) {
                    if (hash.includes(subPageId)) {
                        if (subPage.length) {
                            subPage.addClass('-active');
                            subMenuItem.addClass('-active');
                        } else {
                            page.removeClass('-active');
                            menuItem.removeClass('-active');
                            errorPage.addClass('-active');
                        }
                    } else {
                        firstSubPage.addClass('-active');
                        firstSubMenuItem.addClass('-active');
                        window.location.hash = '#/'+pageId+'-'+firstSubPageId+'/';
                    }
                }
            } else {
                errorPage.addClass('-active');
            }
        } else {
            window.location.hash = '#/overview/';
            daftplugAdmin.find('.daftplugAdminPage.-overview').addClass('-active');
            daftplugAdmin.find('.daftplugAdminMenu_item.-overview').addClass('-active');
        }
    }

    // Handle navigation
    daftplugAdmin.on('click', 'a[data-page]', function(e) {
        var self = jQuery(this);
        var pageId = self.attr('data-page');
        var page = daftplugAdmin.find('.daftplugAdminPage.-' + pageId);
        var menuItem = daftplugAdmin.find('.daftplugAdminMenu_item.-' + pageId);
        var subPage = page.find('.daftplugAdminPage_subpage');
        var hasSubPages = subPage.length;
        var firstSubPage = subPage.first();
        var firstSubPageId = firstSubPage.attr('data-subpage');
        var subMenuItem = page.find('.daftplugAdminSubmenu_item');
        var firstSubMenuItem = subMenuItem.first();

        daftplugAdmin.find('.daftplugAdminPage').removeClass('-active');
        page.addClass('-active');

        daftplugAdmin.find('.daftplugAdminMenu_item').removeClass('-active');
        menuItem.addClass('-active');

        if (hasSubPages) {
            subPage.add(subMenuItem).removeClass('-active');
            firstSubPage.add(firstSubMenuItem).addClass('-active');
        } 
    });

    // Handle subnavigation
    daftplugAdmin.on('click', 'a[data-subpage]', function(e) {
        var self = jQuery(this);
        var subPageId = self.attr('data-subpage');
        var subPage = daftplugAdmin.find('.daftplugAdminPage_subpage.-' + subPageId);
        var subMenuItem = daftplugAdmin.find('.daftplugAdminSubmenu_item.-' + subPageId);

        daftplugAdmin.find('.daftplugAdminPage_subpage').removeClass('-active');
        subPage.addClass('-active');

        daftplugAdmin.find('.daftplugAdminSubmenu_item').removeClass('-active');
        subMenuItem.addClass('-active');
    });

    // Handle FAQ
    daftplugAdmin.find('.daftplugAdminFaq_item').each(function(e) {
        var self = jQuery(this);
        var question = self.find('.daftplugAdminFaq_question');

        question.click(function(e) {
            if (self.hasClass('-active')) {
                self.removeClass('-active');
            } else {
                daftplugAdmin.find('.daftplugAdminFaq_item').removeClass('-active');
                self.addClass('-active');
            }
        });
    });

    // Handle submit button
    daftplugAdmin.find('.daftplugAdminButton.-submit').each(function(e) {
        var self = jQuery(this);
        var submitText = self.attr('data-submit');
        var waitingText = self.attr('data-waiting');
        var submittedText = self.attr('data-submitted');
        var failedText = self.attr('data-failed');

        self.html(`<span class="daftplugAdminButton_iconset">
                       <svg class="daftplugAdminButton_icon -iconSubmit">
                           <use href="#iconSubmit"></use>
                       </svg>
                       <svg class="daftplugAdminButton_icon -iconLoading">
                           <use href="#iconLoading"></use>
                       </svg>
                       <svg class="daftplugAdminButton_icon -iconSuccess">
                           <use href="#iconSuccess"></use>
                       </svg>
                       <svg class="daftplugAdminButton_icon -iconFail">
                           <use href="#iconFail"></use>
                       </svg>
                   </span>
                   <ul class="daftplugAdminButton_textset">
                       <li class="daftplugAdminButton_text -submit">
                           ${submitText}
                       </li>
                       <li class="daftplugAdminButton_text -waiting">
                           ${waitingText}
                       </li>
                       <li class="daftplugAdminButton_text -submitted">
                           ${submittedText}
                       </li>
                       <li class="daftplugAdminButton_text -submitFailed">
                           ${failedText}
                       </li>
                   </ul>`);

        var buttonTexts = self.find('.daftplugAdminButton_textset');
        var buttonText = buttonTexts.find('.daftplugAdminButton_text');
        var buttonIcons = self.find('.daftplugAdminButton_iconset');
        var buttonIcon = self.find('.daftplugAdminButton_icon');
        var longestButtonTextChars = '';

        buttonText.each(function(e) {
            var self = jQuery(this);
			var buttonTextChars = self.text();
			if (buttonTextChars.length > longestButtonTextChars.length) {
				longestButtonTextChars = buttonTextChars;
			}
        });

        buttonTexts.css('width', jQuery.trim(longestButtonTextChars).length * 7.5 +'px');

        if (self.hasClass('-confirm')) {
            var sureText = self.attr('data-sure');
            var confirmDuration = self.attr('data-duration');
            var clickDuration = 0;

            self.attr('style', `--confirmDuration:${confirmDuration};`);
            self.on('mousedown touchstart', function(e) {
                e.preventDefault();
                buttonText.filter('.-waiting').text(sureText);
                self.addClass('-loading -progress');
                clickDuration = setTimeout(function(e) {
                    buttonText.filter('.-waiting').text(waitingText);
                    self.removeClass('-loading -progress').trigger('submit');
                }, parseInt(confirmDuration));
            }).on('mouseup touchend', function(e) {
                self.removeClass('-loading -progress');
                clearTimeout(clickDuration);
            });
        }
    });

    // Handle add field button
    daftplugAdmin.find('.daftplugAdminButton.-addField').each(function(e) {
        var self = jQuery(this);
        var addTarget = self.attr('data-add');
        var miniFieldset = daftplugAdmin.find('.-miniFieldset[class*="-'+addTarget+'"]');
        var i = 0;

        miniFieldset.each(function(e) {
            var self = jQuery(this);
            var miniFieldsetCheckbox = self.find('.daftplugAdminInputCheckbox.-hidden');
            var miniFieldsetCheckboxField = miniFieldsetCheckbox.find('.daftplugAdminInputCheckbox_field');
            self.find('.daftplugAdminField').addClass('-'+miniFieldsetCheckboxField.attr('id')+'DependentHideD');
            if (miniFieldsetCheckboxField.is(':checked')) {
                self.show();
                i++;
            } else {
                self.hide();
            }
        });

        miniFieldset.prepend(`
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="daftplugAdminMiniFieldset_close -iconClose">
                <g stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="10" cy="10" r="10" id="circle"></circle>
                    <path d="M7,7 L13,13" id="line"></path>
                    <path d="M7,13 L13,7" id="line"></path>
                </g>
            </svg>
        `);

        var close = miniFieldset.find('.daftplugAdminMiniFieldset_close');

        self.click(function(e) {  
            i++;
            miniFieldset.filter('.-miniFieldset[class*="-'+addTarget+i+'"]').show();
            miniFieldset.find('.daftplugAdminInputCheckbox_field[id="'+addTarget+i+'"]').prop('checked', true).change();
            if (!miniFieldset.filter('.-miniFieldset[class*="-'+addTarget+(i+1)+'"]').length) {
                self.hide();
            }
        });

        close.click(function(e) {
            self.show();
            miniFieldset.filter('.-miniFieldset[class*="-'+addTarget+i+'"]').hide();
            miniFieldset.find('.daftplugAdminInputCheckbox_field[id="'+addTarget+i+'"]').prop('checked', false).change();
            if (i != 0) {
                i--;
            }
        });
    });

    // Handle tooltips
    daftplugAdmin.on('mouseenter mouseleave', '[data-tooltip]', function(e) {
        var self = jQuery(this);
        var tooltip = self.attr('data-tooltip');
        var flow = self.attr('data-tooltip-flow');

        if (e.type === 'mouseenter') {
            self.append(`<span class="daftplugAdminTooltip">${tooltip}</span>`);
            var tooltipEl = self.find('.daftplugAdminTooltip');
            switch (flow) {
                case 'top':
                    tooltipEl.css({
                        'bottom': 'calc(100% + 5px)',
                        'left': '50%',
                        '-webkit-transform': 'translate(-50%, -.5em)',
                        'transform': 'translate(-50%, -.5em)',
                    });
                    break;
                case 'right':
                    tooltipEl.css({
                        'top': '50%',
                        'left': 'calc(100% + 5px)',
                        '-webkit-transform': 'translate(.5em, -50%)',
                        'transform': 'translate(.5em, -50%)',
                    });
                    break;
                case 'bottom':
                    tooltipEl.css({
                        'top': 'calc(100% + 5px)',
                        'left': '50%',
                        '-webkit-transform': 'translate(-50%, .5em)',
                        'transform': 'translate(-50%, .5em)',
                    });
                    break;
                case 'left':
                    tooltipEl.css({
                        'top': '50%',
                        'right': 'calc(100% + 5px)',
                        '-webkit-transform': 'translate(-.5em, -50%)',
                        'transform': 'translate(-.5em, -50%)',
                    });
                    break;
                default:
                    
            }
        }

        if (e.type === 'mouseleave') {
            self.find('.daftplugAdminTooltip').remove();
        }
    });

    // Handle loader
    daftplugAdmin.find('.daftplugAdminLoader').each(function(e) {
        var self = jQuery(this);
        var size = self.attr('data-size');
        var duration = self.attr('data-duration');

        self.html(`
            <div class="daftplugAdminLoader_box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="daftplugAdminLoader_box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="daftplugAdminLoader_box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="daftplugAdminLoader_box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        `).attr('style', `--size:${size};--duration:${duration}`);
    });

    // Handle feature pills
    daftplugAdmin.find('.daftplugAdminFieldset[data-feature-type]').each(function(e) {
        var self = jQuery(this);
        var featureType = self.attr('data-feature-type');
        var title = self.find('.daftplugAdminFieldset_title');

        switch(featureType) {
            case 'new':
                title.append(`<span class="daftplugAdminFeaturePill" style="background-color: #F44336;">${featureType}</span>`);
                break;
            case 'beta':
                title.append(`<span class="daftplugAdminFeaturePill" style="background-color: #FFB13E;">${featureType}</span>`);
                break;
            default:
                title.append(`<span class="daftplugAdminFeaturePill">${featureType}</span>`);
        }
    });

    // Handle popup
    daftplugAdmin.find('.daftplugAdminPopup').each(function(e) {
        var self = jQuery(this);
        var openPopup = self.attr('data-popup');
        var popupContainer = self.find('.daftplugAdminPopup_container');

        daftplugAdmin.find('[data-open-popup="'+openPopup+'"]').on('click', function(e) {
            self.addClass('-active');
        });

        popupContainer.on('click', function(e) {
            e.stopPropagation();
        }).find('fieldset').css('border', 'none');

        self.on('click', function(e) {
            self.removeClass('-active');
        });
    });

    // Handle input has value
    daftplugAdmin.find('.daftplugAdminInputText, .daftplugAdminInputNumber, .daftplugAdminInputTextarea, .daftplugAdminInputColor').each(function(e) {
        var self = jQuery(this);
        var field = self.find('.daftplugAdminInputText_field, .daftplugAdminInputNumber_field, .daftplugAdminInputTextarea_field, .daftplugAdminInputColor_field');

        field.on('change keyup paste', function() {
            field.val().length ? field.addClass('-hasValue') : field.removeClass('-hasValue');
        }).change();
    });

    // Handle text input
    daftplugAdmin.find('.daftplugAdminInputText').each(function(e) {
        var self = jQuery(this);
        var field = self.find('.daftplugAdminInputText_field');
        var placeholder = field.attr('data-placeholder');

        field.after('<span class="daftplugAdminInputText_placeholder">' + placeholder + '</span>');

        field.on('invalid', function(e) {
            self.addClass('-invalid');
            setTimeout(function(e) {
                self.removeClass('-invalid');
            }, 2300);
        });
    });

    // Handle textarea
    daftplugAdmin.find('.daftplugAdminInputTextarea').each(function(e) {
        var self = jQuery(this);
        var field = self.find('.daftplugAdminInputTextarea_field');
        var placeholder = field.attr('data-placeholder');

        field.after('<span class="daftplugAdminInputTextarea_placeholder">' + placeholder + '</span>');

        field.on('change keydown keyup paste', function(e) {
            field.height(0).height(field.prop('scrollHeight') - parseInt(field.css('padding-bottom')) - 5);
        }).change();

        field.on('invalid', function(e) {
            self.addClass('-invalid');
            setTimeout(function(e) {
                self.removeClass('-invalid');
            }, 2300);
        });
    });

    // Handle checkbox
    daftplugAdmin.find('.daftplugAdminInputCheckbox').each(function(e) {
        var self = jQuery(this);
        var field = self.find('.daftplugAdminInputCheckbox_field');
        var dependentDisableD = daftplugAdmin.find('.-' + field.attr('id') + 'DependentDisableD');
        var dependentHideD = daftplugAdmin.find('.-' + field.attr('id') + 'DependentHideD');
        var dependentDisableE = daftplugAdmin.find('.-' + field.attr('id') + 'DependentDisableE');
        var dependentHideE = daftplugAdmin.find('.-' + field.attr('id') + 'DependentHideE');
        var dependentDisableDField = dependentDisableD.find('[class*="_field"]');
        var dependentDisableEField = dependentDisableE.find('[class*="_field"]');
        var dependentHideDField = dependentHideD.find('[class*="_field"]');
        var dependentHideEField = dependentHideE.find('[class*="_field"]');

        dependentDisableDField.add(dependentDisableEField).add(dependentHideDField).add(dependentHideEField).each(function(e) {
        	if (jQuery(this).is('[required]')) {
        		jQuery(this).attr('data-required', 'true');
        	}
        });

        field.after(`<span class="daftplugAdminInputCheckbox_background"></span>
                     <span class="daftplugAdminInputCheckbox_grabholder"></span>`);

        field.change(function(e) {
        	if (field.is(':checked')) {
        		dependentDisableD.removeClass('-disabled');
                dependentDisableE.addClass('-disabled');
                dependentHideD.show();
                dependentHideE.hide();
                dependentDisableEField.add(dependentHideEField).prop('required', false);
                dependentDisableDField.add(dependentHideDField).each(function(e) {
	        		if (jQuery(this).attr('data-required') == 'true') {
	        			jQuery(this).prop('required', true);
	        		} else {
	        			jQuery(this).prop('required', false);
	        		}
                });
        	} else {
				dependentDisableD.addClass('-disabled');
                dependentDisableE.removeClass('-disabled');
                dependentHideD.hide();
                dependentHideE.show();
        		dependentDisableDField.add(dependentHideDField).prop('required', false);
                dependentDisableEField.add(dependentHideEField).each(function(e) {
	        		if (jQuery(this).attr('data-required') == 'true') {
	        			jQuery(this).prop('required', true);
	        		} else {
	        			jQuery(this).prop('required', false);
	        		}
                });
        	}
        }).change();
    });

    // Handle number input
    daftplugAdmin.find('.daftplugAdminInputNumber').each(function(e) {
        var self = jQuery(this);
        var field = self.find('.daftplugAdminInputNumber_field');
        var placeholder = field.attr('data-placeholder');
        var step = parseFloat(field.attr('step'));
        var min = parseFloat(field.attr('min'));
        var max = parseFloat(field.attr('max'));

        field.before('<svg class="daftplugAdminInputNumber_icon -iconMinus"><use href="#iconMinus"></use></svg>')
             .after(`<span class="daftplugAdminInputNumber_placeholder" style="left: 42px;">${placeholder}</span>
                     <svg class="daftplugAdminInputNumber_icon -iconPlus"><use href="#iconPlus"></use></svg>`);

        var icon = self.find('.daftplugAdminInputNumber_icon');

        field.on('focus blur', function(e) {
            if(e.type == 'focus' || e.type == 'focusin') { 
              icon.addClass('-focused');
            } else{
              icon.removeClass('-focused');
            }
        });

        self.find('.daftplugAdminInputNumber_icon.-iconMinus').click(function(e) {
            var value = parseFloat(field.val());
            if (value > min) {
                field.val(value - step).change();
            }
        });

        self.find('.daftplugAdminInputNumber_icon.-iconPlus').click(function(e) {
            var value = parseFloat(field.val());
            if (field.val().length) {
                if (value < max) {
                    field.val(value + step).change();
                }
            } else {
                field.val(step).change(); 
            }
        });

        field.on('invalid', function(e) {
            self.add(icon).addClass('-invalid');
            setTimeout(function(e) {
                self.add(icon).removeClass('-invalid');
            }, 2300);
        });
    });

    // Handle select input
    daftplugAdmin.find('.daftplugAdminInputSelect').each(function(e) {
        var self = jQuery(this);
        var field = self.find('.daftplugAdminInputSelect_field');
        var fieldOption = field.find('option');
        var label = jQuery('label[for="'+field.attr('id')+'"]');
        var placeholder = field.attr('data-placeholder');
        var maxSelections = field.attr('data-max');

        field.after(`<div class="daftplugAdminInputSelect_dropdown"></div>
                     <span class="daftplugAdminInputSelect_placeholder">${placeholder}</span>
                     <ul class="daftplugAdminInputSelect_list"></ul>
                     <span class="daftplugAdminInputSelect_arrow"></span>`);

        fieldOption.each(function(e) {
            self.find('.daftplugAdminInputSelect_list').append(`<li class="daftplugAdminInputSelect_option" data-value="${jQuery(this).val().trim()}">
                                                                    <a class="daftplugAdminInputSelect_text">${jQuery(this).text().trim()}</a>
                                                                </li>`);
        });

        var dropdown = self.find('.daftplugAdminInputSelect_dropdown');
        var list = self.find('.daftplugAdminInputSelect_list');
        var option = self.find('.daftplugAdminInputSelect_option');

        dropdown.add(list).attr('data-name', field.attr('name'));

        if (field.is('[multiple]')) {
        	dropdown.attr('data-multiple', 'true');
        	if (!field.find('option:selected').length) {
                fieldOption.first().prop('selected', true);
            }
            field.find('option:selected').each(function(e) {
                var self = jQuery(this);
        		dropdown.append(function(e) {
        			return jQuery('<span class="daftplugAdminInputSelect_choice" data-value="'+self.val()+'">'+self.text()+'<svg class="daftplugAdminInputSelect_deselect -iconX"><use href="#iconX"></use></svg></span>').click(function(e) {
		            	var self = jQuery(this);
		                e.stopPropagation();
		                self.remove();
		                list.find('.daftplugAdminInputSelect_option[data-value="'+self.attr('data-value')+'"]').removeClass('-selected').show();
		                list.css('top', dropdown.height() + 5).find('.daftplugAdminInputSelect_noselections').remove();
		                field.find('option[value="'+self.attr('data-value')+'"]').prop('selected', false);
			            if (dropdown.children(':visible').length === 0) {
			            	dropdown.removeClass('-hasValue');
                        }
                        if (dropdown.children().length < maxSelections) {
                            option.not('.-selected').show();
                        }
        			});
        		}).addClass('-hasValue');
                list.find('.daftplugAdminInputSelect_option[data-value="'+self.val()+'"]').addClass('-selected').hide();
            });
            if (!option.not('.-selected').length) {
                list.append('<h5 class="daftplugAdminInputSelect_noselections">No Selections</h5>');
            }
            if (option.filter('.-selected').length >= maxSelections) {
                option.not('.-selected').hide();
                list.append('<h5 class="daftplugAdminInputSelect_noselections">No Selections</h5>');
            }
        	list.css('top', dropdown.height() + 5);
        	option.click(function(e) {
        		var self = jQuery(this);
				e.stopPropagation();
	        	self.addClass('-selected').hide();
	        	field.find('option[value="'+self.attr('data-value')+'"]').prop('selected', true);
        		dropdown.append(function(e) {
        			return jQuery('<span class="daftplugAdminInputSelect_choice" data-value="'+self.attr('data-value')+'">'+self.children().text()+'<svg class="daftplugAdminInputSelect_deselect -iconX"><use href="#iconX"></use></svg></span>').click(function(e) {
		            	var self = jQuery(this);
		                e.stopPropagation();
                        self.remove();
		                list.find('.daftplugAdminInputSelect_option[data-value="'+self.attr('data-value')+'"]').removeClass('-selected').show();
		                list.css('top', dropdown.height() + 5).find('.daftplugAdminInputSelect_noselections').remove();
		                field.find('option[value="'+self.attr('data-value')+'"]').prop('selected', false);
			            if (dropdown.children(':visible').length === 0) {
			            	dropdown.removeClass('-hasValue');
                        }
                        if (dropdown.children().length < maxSelections) {
                            option.not('.-selected').show();
                        }
        			});
        		}).addClass('-hasValue');
	        	list.css('top', dropdown.height() + 5);
	            if (!option.not('.-selected').length) {
	            	list.append('<h5 class="daftplugAdminInputSelect_noselections">No Selections</h5>');
                }
                if (option.filter('.-selected').length >= maxSelections) {
                    option.not('.-selected').hide();
                    list.append('<h5 class="daftplugAdminInputSelect_noselections">No Selections</h5>');
                }
        	});
	        dropdown.add(label).click(function(e) {
	            e.stopPropagation();
	            e.preventDefault();
	            dropdown.toggleClass('-open');
	            list.toggleClass('-open').scrollTop(0).css('top', dropdown.height() + 5);
	        });
        } else {
	        if (field.find('option:selected').length) {
	            dropdown.attr('data-value', jQuery(this).find('option:selected').val()).text(jQuery(this).find('option:selected').text()).addClass('-hasValue');
	            list.find('.daftplugAdminInputSelect_option[data-value="'+jQuery(this).find('option:selected').val()+'"]').addClass('-selected').hide();
	        }
	        option.click(function(e) {
	        	var self = jQuery(this);
	        	option.removeClass('-selected').show();
            	self.addClass('-selected').hide();
            	fieldOption.prop('selected', false);
            	field.find('option[value="'+self.attr('data-value')+'"]').prop('selected', true);
            	dropdown.text(self.children().text()).addClass('-hasValue');
	        });
	        dropdown.add(label).click(function(e) {
	            e.stopPropagation();
	            e.preventDefault();
	            dropdown.toggleClass('-open');
	            list.toggleClass('-open').scrollTop(0);
	        });
        }

        jQuery(document).add(daftplugAdmin.find('.daftplugAdminPopup_container')).on('click touch', function(e) {
            if (dropdown.hasClass('-open')) {
                dropdown.toggleClass('-open');
                list.removeClass('-open');
            }
        });

        field.on('invalid', function(e) {
        	self.addClass('-invalid');
            setTimeout(function(e) {
                self.removeClass('-invalid');
            }, 2300);
        });
    });

    // Handle range input
    daftplugAdmin.find('.daftplugAdminInputRange').each(function(e) {
        var self = jQuery(this);
        var field = self.find('.daftplugAdminInputRange_field');
        var val = parseFloat(field.val());
        var min = parseFloat(field.attr('min'));
        var max = parseFloat(field.attr('max'));

        field.after('<output class="daftplugAdminInputRange_output">' + val + '</output>');
        var output = self.find('.daftplugAdminInputRange_output');

        field.on('input change', function(e) {
            var val = parseFloat(field.val());
            var fillPercent = (100 * (val - min)) / (max - min);
            field.css('background', 'linear-gradient(to right, #4073ff 0%, #4073ff ' + fillPercent + '%, #d9dbde ' + fillPercent + '%)');
            output.text(val);
        }).change();
    });

    // Handle color input
    daftplugAdmin.find('.daftplugAdminInputColor').each(function(e) {
        var self = jQuery(this);
        var field = self.find('.daftplugAdminInputColor_field');
        var label = self.prev('.daftplugAdminField_label');
        var color = field.val();
        var placeholder = field.attr('data-placeholder');

        field.addClass('jscolor {hash:true, required:false}');

        field.after('<span class="daftplugAdminInputColor_placeholder" style="background: '+color+'">' + placeholder + '</span>');
        var elmPlaceholder = self.find('.daftplugAdminInputColor_placeholder');

        label.click(function(e) {
        	document.getElementById(field.attr('id')).jscolor.show();
        });

        field.on('input change', function(e) {
            var color = field.val();
            elmPlaceholder.css('background', color);
        });

        field.on('invalid', function(e) {
            self.addClass('-invalid');
            setTimeout(function(e) {
                self.removeClass('-invalid');
            }, 2300);
        });
    });

    // Handle upload input
    daftplugAdmin.find('.daftplugAdminInputUpload').each(function(e) {
        var self = jQuery(this);
        var field = self.find('.daftplugAdminInputUpload_field');
        var label = jQuery('label[for="'+field.attr('id')+'"]');
        var mimes = field.attr('data-mimes');
        var maxWidth = field.attr('data-max-width');
        var minWidth = field.attr('data-min-width');
        var maxHeight = field.attr('data-max-height');
        var minHeight = field.attr('data-min-height');
        var imageSrc = field.attr('data-attach-url');
        var frame;

        if (imageSrc) {
            jQuery.ajax({
                url: imageSrc,
                type: 'HEAD',
                error: function() {
                    field.val('');
                    field.removeAttr('data-attach-url');
                },
                success: function() {
                    field.addClass('-hasFile');
                }
            });
        }

        field.after(`<div class="daftplugAdminInputUpload_attach">
                        <div class="daftplugAdminInputUpload_upload">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="daftplugAdminInputUpload_icon -iconUpload">
                                <g stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M32,1 L32,1 C49.1208272,1 63,14.8791728 63,32 L63,32 C63,49.1208272 49.1208272,63 32,63 L32,63 C14.8791728,63 1,49.1208272 1,32 L1,32 C1,14.8791728 14.8791728,1 32,1 Z" id="circleActive"></path>
                                    <path d="M22,26 L22,38 C22,42.418278 25.581722,46 30,46 C34.418278,46 38,42.418278 38,38 L38,20 L36,20 L36,38 C36,41.3137085 33.3137085,44 30,44 C26.6862915,44 24,41.3137085 24,38 L24,26 C24,25.4477153 23.5522847,25 23,25 C22.4477153,25 22,25.4477153 22,26 Z" id="clipBack"></path>
                                    <g id="preview"><image preserveAspectRatio="none" width="30px" height="30px" href=\'${imageSrc}\'></image></g>
                                    <path d="M32,25 C32,24.4477153 32.4477153,24 33,24 C33.5522847,24 34,24.4477153 34,25 L34,38 C34,40.209139 32.209139,42 30,42 C27.790861,42 26,40.209139 26,38 L26,20 C26,16.6862915 28.6862915,14 32,14 C35.3137085,14 38,16.6862915 38,20 L36,20 C36,17.790861 34.209139,16 32,16 C29.790861,16 28,17.790861 28,20 L28,38 C28,39.1045695 28.8954305,40 30,40 C31.1045695,40 32,39.1045695 32,38 L32,25 Z" id="clipFront"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="daftplugAdminInputUpload_undo">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="daftplugAdminInputUpload_icon -iconUndo">
                                <g stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="10" cy="10" r="10" id="circle"></circle>
                                    <path d="M7,7 L13,13" id="line"></path>
                                    <path d="M7,13 L13,7" id="line"></path>
                                </g>
                            </svg>
                        </div>
                    </div>`);

        var upload = self.find('.daftplugAdminInputUpload_upload');
        var undo = self.find('.daftplugAdminInputUpload_undo');
        var preview = self.find('#preview');

        upload.add(label).click(function(e) {
            if (frame) {
                frame.open();
                return;
            }

            frame = wp.media({
                title: 'Select or upload a file',
                button: {
                    text: 'Select File'
                },
                multiple: false
            });

            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                var errors = [];

                if (mimes !== '') {
                    var mimesArray = mimes.split(',');
                    var fileMime = attachment.subtype;
                    if (jQuery.inArray(fileMime, mimesArray) === -1) {
                        errors.push('This file should be one of the following file types:\n' + mimes);
                    }
                }

                if (maxHeight !== '' && attachment.height > maxHeight) {
                    errors.push('Image can\'t be higher than ' + maxHeight + 'px.');
                }

                if (minHeight !== '' && attachment.height < minHeight) {
                    errors.push('Image should be at least ' + minHeight + 'px high.');
                }

                if (maxWidth !== '' && attachment.width > maxWidth) {
                    errors.push('Image can\'t be wider than ' + maxWidth + 'px.');
                }

                if (minWidth !== '' && attachment.width < minWidth) {
                    errors.push('Image should be at least ' + minWidth + 'px wide.');
                }

                if (errors.length) {
                    alert(errors.join('\n\n'));
                    return;
                }

                if (attachment.type === 'image') {
                    var imageSrc = attachment.url;
                    var image = '<image preserveAspectRatio="none" width="30px" height="30px" href=\'' + imageSrc + '\'></image>';
                } else {
                    var imageSrc = objectName.fileIcon;
                    var image = '<image preserveAspectRatio="none" width="30px" height="30px" href=\'' + imageSrc + '\'></image>';
                }

                field.val(attachment.id).addClass('-active -hasFile');
                field.attr('data-attach-url', imageSrc);
                setTimeout(function() {
                    field.removeClass('-active');
                }, 1000);

                preview.html(image);
            });

            frame.open();
        });

        undo.click(function(e) {
            field.val('').removeClass('-hasFile');
            field.removeAttr('data-attach-url');
        });

        field.on('invalid', function(e) {
            self.addClass('-invalid');
            setTimeout(function(e) {
                self.removeClass('-invalid');
            }, 2300);
        });
    });

    // Activate license
    daftplugAdmin.find('.daftplugAdminActivateLicense_form').submit(function(e) {
        e.preventDefault();
        var self = jQuery(this);
        var action = optionName + '_activate_license';
        var nonce = self.attr('data-nonce');
        var purchaseCode = self.find('#purchaseCode').val();
        var button = self.find('.daftplugAdminButton.-submit');
        var responseText = self.find('.daftplugAdminField_response');

        jQuery.ajax({
            url: ajaxurl,
            dataType: 'text',
            type: 'POST',
            data: {
                action: action,
                nonce: nonce,
                purchaseCode: purchaseCode
            },
            beforeSend: function() {
                button.addClass('-loading');
            },
            success: function(response, textStatus, jqXhr) {
                if (response == 1) {
                    button.addClass('-success');
                    setTimeout(function() {
                        button.removeClass('-loading -success');
                        daftplugAdmin.find('.daftplugAdminPage.-activation').addClass('-disabled');
                        daftplugAdmin.find('.daftplugAdminLoader').fadeIn('fast');
                        window.location.hash = '#/overview/';
                        window.location.reload();
                    }, 1500);
                } else {
                    button.addClass('-fail');
                    setTimeout(function() {
                        button.removeClass('-loading -fail');
                    }, 1500);
                    responseText.css({
                        'color': '#FF3A3A',
                        'padding-left': '15px'
                    }).html(response).fadeIn('fast');
                }
            },
            complete: function() {},
            error: function(jqXhr, textStatus, errorThrown) {
                button.addClass('-fail');
                setTimeout(function() {
                    button.removeClass('-loading -fail');
                }, 1500);
                responseText.css({
                    'color': '#FF3A3A',
                    'padding-left': '15px'
                }).html('An unexpected error occurred!').fadeIn('fast');
            }
        });
    });

    // Deactivate license
    daftplugAdmin.find('.daftplugAdminButton.-deactivateLicense').submit(function(e) {
        e.preventDefault();
        var self = jQuery(this);
        var action = optionName + '_deactivate_license';
        var nonce = self.attr('data-nonce');

        jQuery.ajax({
            url: ajaxurl,
            dataType: 'text',
            type: 'POST',
            data: {
                action: action,
                nonce: nonce
            },
            beforeSend: function() {
                self.addClass('-loading');
                daftplugAdmin.find('.daftplugAdminButton').not(self).add('.daftplugAdminInputCheckbox.-featuresCheckbox').add('.daftplugAdminMenu').addClass('-disabled');
            },
            success: function(response, textStatus, jqXhr) {
                if (response == 1) {
                    self.addClass('-success');
                    setTimeout(function() {
                        self.removeClass('-loading -success');
                        daftplugAdmin.find('.daftplugAdminHeader').add('.daftplugAdminMain').add('.daftplugAdminFooter').addClass('-disabled');
                        daftplugAdmin.find('.daftplugAdminLoader').fadeIn('fast');
                        window.location.hash = '#/activation/';
                        window.location.reload();
                    }, 1500);
                } else {
                    self.addClass('-fail');
                    setTimeout(function() {
                        self.removeClass('-loading -fail');
                        daftplugAdmin.find('.daftplugAdminButton').not(self).add('.daftplugAdminInputCheckbox.-featuresCheckbox').add('.daftplugAdminMenu').removeClass('-disabled');
                    }, 1500);
                }
            },
            complete: function() {},
            error: function(jqXhr, textStatus, errorThrown) {
                self.addClass('-fail');
                setTimeout(function() {
                    self.removeClass('-loading -fail');
                    daftplugAdmin.find('.daftplugAdminButton').not(self).add('.daftplugAdminInputCheckbox.-featuresCheckbox').add('.daftplugAdminMenu').removeClass('-disabled');
                }, 1500);
            }
        });
    });

    // Submit ticket 
    daftplugAdmin.find('.daftplugAdminSupportTicket_form').submit(function(e) {
        e.preventDefault();
        var self = jQuery(this);
        var action = optionName + '_send_ticket';
        var nonce = self.attr('data-nonce');
        var purchaseCode = self.find('#purchaseCode').val();
        var firstName = self.find('#firstName').val();
        var contactEmail = self.find('#contactEmail').val();
        var problemDescription = self.find('#problemDescription').val();
        var wordpressUsername = self.find('#wordpressUsername').val();
        var wordpressPassword = self.find('#wordpressPassword').val();
        var button = self.find('.daftplugAdminButton.-submit');
        var responseText = self.find('.daftplugAdminField_response');

        jQuery.ajax({
            url: ajaxurl,
            dataType: 'text',
            type: 'POST',
            data: {
                action: action,
                nonce: nonce,
                purchaseCode: purchaseCode,
                firstName: firstName,
                contactEmail: contactEmail,
                problemDescription: problemDescription,
                wordpressUsername: wordpressUsername,
                wordpressPassword: wordpressPassword
            },
            beforeSend: function() {
                button.addClass('-loading');
            },
            success: function(response, textStatus, jqXhr) {
                if (response == 1) {
                    self.trigger("reset");
                    button.addClass('-success');
                    setTimeout(function() {
                        button.removeClass('-loading -success');
                    }, 1500);
                    responseText.css({
                        'color': '#4073FF',
                        'padding-left': '15px'
                    }).html('Thank you! We will send our response as soon as possible to your email address.').fadeIn('fast');
                } else {
                    button.addClass('-fail');
                    setTimeout(function() {
                        button.removeClass('-loading -fail');
                    }, 1500);
                    responseText.css('color', '#FF3A3A').html('Submission failed. Please use the <a target="_blank" href="https://codecanyon.net/user/daftplug#contact">Contact Form</a> found on our Codecanyon profile page instead.').fadeIn('fast');
                }

                console.log(response);
            },
            complete: function() {},
            error: function(jqXhr, textStatus, errorThrown) {
                button.addClass('-fail');
                setTimeout(function() {
                    button.removeClass('-loading -fail');
                }, 1500);
                responseText.css('color', '#FF3A3A').html('Submission failed. Please use the <a target="_blank" href="https://codecanyon.net/user/daftplug#contact">Contact Form</a> found on our Codecanyon profile page instead.').fadeIn('fast');
            }
        });
    });

    // Save settings
    daftplugAdmin.find('.daftplugAdminSettings_form').submit(function(e) {
        e.preventDefault();
        var self = jQuery(this);
        var button = self.find('.daftplugAdminButton.-submit');
        var action = optionName + '_save_settings';
        var nonce = self.attr('data-nonce');
        var settings = self.daftplugSerialize();

        jQuery.ajax({
            url: ajaxurl,
            dataType: 'text',
            type: 'POST',
            data: {
                action: action,
                nonce: nonce,
                settings: settings
            },
            beforeSend: function() {
                button.addClass('-loading');
            },
            success: function(response, textStatus, jqXhr) {
                if (response == 1) {
                    button.addClass('-success');
                    setTimeout(function() {
                        button.removeClass('-loading -success');
                    }, 1500);
                } else {
                    button.addClass('-fail');
                    setTimeout(function() {
                        button.removeClass('-loading -fail');
                    }, 1500);
                }
            },
            complete: function() {
            },
            error: function(jqXhr, textStatus, errorThrown) {
                button.addClass('-fail');
                setTimeout(function() {
                    button.removeClass('-loading -fail');
                }, 1500);
            }
        });
    });

    // Save plugin features settings
    daftplugAdmin.find('.daftplugAdminInputCheckbox.-featuresCheckbox').each(function(e) {
        var self = jQuery(this);
        var field = self.find('.daftplugAdminInputCheckbox_field');
        var fieldset = jQuery('.daftplugAdminPluginFeatures');

        field.on('click', function(e) {
            e.preventDefault();
            var action = optionName + '_save_settings';
            var nonce = self.attr('data-nonce');
            var settings = fieldset.daftplugSerialize();

            jQuery.ajax({
                url: ajaxurl,
                dataType: 'text',
                type: 'POST',
                data: {
                    action: action,
                    nonce: nonce,
                    settings: settings
                },
                beforeSend: function() {
                    self.addClass('-loading');
                    daftplugAdmin.find('.daftplugAdminInputCheckbox.-featuresCheckbox').not(self).parent().add('.daftplugAdminButton').add('.daftplugAdminMenu').addClass('-disabled');
                },
                success: function(response, textStatus, jqXhr) {
                    if (response == 1) {
	                    setTimeout(function() {
	                        self.removeClass('-loading');
	                        daftplugAdmin.find('.daftplugAdminInputCheckbox.-featuresCheckbox').not(self).parent().removeClass('-disabled');
	                        if (field.is(':checked')) {
	                        	field.prop('checked', false);
	                        } else {
	                        	field.prop('checked', true);
	                        }
	                        daftplugAdmin.find('.daftplugAdminHeader').add('.daftplugAdminMain').add('.daftplugAdminFooter').addClass('-disabled');
                            daftplugAdmin.find('.daftplugAdminLoader').fadeIn('fast');
	                        window.location.reload();
	                    }, 1500);
                    } else {
	                    setTimeout(function() {
	                        self.removeClass('-loading');
	                        daftplugAdmin.find('.daftplugAdminInputCheckbox.-featuresCheckbox').not(self).parent().add('.daftplugAdminButton').add('.daftplugAdminMenu').removeClass('-disabled');
	                        if (field.is(':checked')) {
	                        	field.prop('checked', true);
	                        } else {
	                        	field.prop('checked', false);
	                        }
                        }, 1500);
                    }
                },
                complete: function() {
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    setTimeout(function() {
                        self.removeClass('-loading');
                        daftplugAdmin.find('.daftplugAdminInputCheckbox.-featuresCheckbox').not(self).parent().add('.daftplugAdminButton').add('.daftplugAdminMenu').removeClass('-disabled');
                        if (field.is(':checked')) {
                        	field.prop('checked', true);
                        } else {
                        	field.prop('checked', false);
                        }
                    }, 1500);
                }
            });
        });
    });

    // Generate PWA installs area chart
    jQuery.ajax({
        url: ajaxurl,
        dataType: 'json',
        type: 'POST',
        data: {
            action: optionName + '_get_installation_analytics',
        },
        beforeSend: function() {

        },
        success: function(response, textStatus, jqXhr) {
            var ctx = document.getElementById("daftplugAdminInstallationAnalytics_chart");
            var labels = response.dates;
            var data = response.data;
            var reactionsAreaChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Installs",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: data,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            top: 10
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7,
                                padding: 10
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                beginAtZero: true,
                                callback: function(value) {if (value % 1 === 0) {return value;}}
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10
                    }
                }
            });
        },
        complete: function() {

        },
        error: function(jqXhr, textStatus, errorThrown) {

        }
    });

	// Handle review modal
	daftplugAdmin.find('[data-popup="reviewModal"]').each(function(e) {
		var self = jQuery(this);
		var secondsSpent = Number(localStorage.getItem('secondsSpent'));
		setInterval(function() {
		    localStorage.setItem('secondsSpent', ++secondsSpent);
		    if (secondsSpent == 400) {
		        self.addClass('-active');
		    }
		}, 1000);
	});

	// Helpers
	jQuery.fn.daftplugSerialize = function() {
	    var o = {};
	    var a = this.serializeArray();
	    jQuery.each(a, function() {
	        if (o[this.name] !== undefined) {
	            if (!o[this.name].push) {
	                o[this.name] = [o[this.name]];
	            }
	            o[this.name].push(this.value || '');
	        } else {
	            o[this.name] = this.value || '';
	        }
	    });
	    var radioCheckbox = jQuery('input[type=radio], input[type=checkbox]', this);
	    jQuery.each(radioCheckbox, function() {
	        if(!o.hasOwnProperty(this.name)) {
	            o[this.name] = 'off';
	        }
	    });

	    return JSON.stringify(o);
	};
});