/**
 * @name InfoBox
 * @version 1.1.13 [March 19, 2014]
 * @author Gary Little (inspired by proof-of-concept code from Pamela Fox of Google)
 * @copyright Copyright 2010 Gary Little [gary at luxcentral.com]
 * @fileoverview InfoBox extends the Google Maps JavaScript API V3 <tt>OverlayView</tt> class.
 *  <p>
 *  An InfoBox behaves like a <tt>google.maps.InfoWindow</tt>, but it supports several
 *  additional properties for advanced styling. An InfoBox can also be used as a map label.
 *  <p>
 *  An InfoBox also fires the same events as a <tt>google.maps.InfoWindow</tt>.
 */

/*!
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *       http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/*jslint browser:true */
/*global google */

/**
 * @name InfoBoxOptions
 * @class This class represents the optional parameter passed to the {@link InfoBox} constructor.
 * @property {string|Node} content The content of the InfoBox (plain text or an HTML DOM node).
 * @property {boolean} [disableAutoPan=false] Disable auto-pan on <tt>open</tt>.
 * @property {number} maxWidth The maximum width (in pixels) of the InfoBox. Set to 0 if no maximum.
 * @property {Size} pixelOffset The offset (in pixels) from the top left corner of the InfoBox
 *  (or the bottom left corner if the <code>alignBottom</code> property is <code>true</code>)
 *  to the map pixel corresponding to <tt>position</tt>.
 * @property {LatLng} position The geographic location at which to display the InfoBox.
 * @property {number} zIndex The CSS z-index style value for the InfoBox.
 *  Note: This value overrides a zIndex setting specified in the <tt>boxStyle</tt> property.
 * @property {string} [boxClass="infoBox"] The name of the CSS class defining the styles for the InfoBox container.
 * @property {Object} [boxStyle] An object literal whose properties define specific CSS
 *  style values to be applied to the InfoBox. Style values defined here override those that may
 *  be defined in the <code>boxClass</code> style sheet. If this property is changed after the
 *  InfoBox has been created, all previously set styles (except those defined in the style sheet)
 *  are removed from the InfoBox before the new style values are applied.
 * @property {string} closeBoxMargin The CSS margin style value for the close box.
 *  The default is "2px" (a 2-pixel margin on all sides).
 * @property {string} closeBoxURL The URL of the image representing the close box.
 *  Note: The default is the URL for Google's standard close box.
 *  Set this property to "" if no close box is required.
 * @property {Size} infoBoxClearance Minimum offset (in pixels) from the InfoBox to the
 *  map edge after an auto-pan.
 * @property {boolean} [isHidden=false] Hide the InfoBox on <tt>open</tt>.
 *  [Deprecated in favor of the <tt>visible</tt> property.]
 * @property {boolean} [visible=true] Show the InfoBox on <tt>open</tt>.
 * @property {boolean} alignBottom Align the bottom left corner of the InfoBox to the <code>position</code>
 *  location (default is <tt>false</tt> which means that the top left corner of the InfoBox is aligned).
 * @property {string} pane The pane where the InfoBox is to appear (default is "floatPane").
 *  Set the pane to "mapPane" if the InfoBox is being used as a map label.
 *  Valid pane names are the property names for the <tt>google.maps.MapPanes</tt> object.
 * @property {boolean} enableEventPropagation Propagate mousedown, mousemove, mouseover, mouseout,
 *  mouseup, click, dblclick, touchstart, touchend, touchmove, and contextmenu events in the InfoBox
 *  (default is <tt>false</tt> to mimic the behavior of a <tt>google.maps.InfoWindow</tt>). Set
 *  this property to <tt>true</tt> if the InfoBox is being used as a map label.
 */

/**
 * Creates an InfoBox with the options specified in {@link InfoBoxOptions}.
 *  Call <tt>InfoBox.open</tt> to add the box to the map.
 * @constructor
 * @param {InfoBoxOptions} [opt_opts]
 */
function InfoBox(opt_opts) {

  opt_opts = opt_opts || {};

  google.maps.OverlayView.apply(this, arguments);

  // Standard options (in common with google.maps.InfoWindow):
  //
  this.content_ = opt_opts.content || "";
  this.disableAutoPan_ = opt_opts.disableAutoPan || false;
  this.maxWidth_ = opt_opts.maxWidth || 0;
  this.pixelOffset_ = opt_opts.pixelOffset || new google.maps.Size(0, 0);
  this.position_ = opt_opts.position || new google.maps.LatLng(0, 0);
  this.zIndex_ = opt_opts.zIndex || null;

  // Additional options (unique to InfoBox):
  //
  this.boxClass_ = opt_opts.boxClass || "infoBox";
  this.boxStyle_ = opt_opts.boxStyle || {};
  this.closeBoxMargin_ = opt_opts.closeBoxMargin || "2px";
  this.closeBoxURL_ = opt_opts.closeBoxURL || "https://www.google.com/intl/en_us/mapfiles/close.gif";
  if (opt_opts.closeBoxURL === "") {
    this.closeBoxURL_ = "";
  }
  this.infoBoxClearance_ = opt_opts.infoBoxClearance || new google.maps.Size(1, 1);

  if (typeof opt_opts.visible === "undefined") {
    if (typeof opt_opts.isHidden === "undefined") {
      opt_opts.visible = true;
    } else {
      opt_opts.visible = !opt_opts.isHidden;
    }
  }
  this.isHidden_ = !opt_opts.visible;

  this.alignBottom_ = opt_opts.alignBottom || false;
  this.pane_ = opt_opts.pane || "floatPane";
  this.enableEventPropagation_ = opt_opts.enableEventPropagation || false;

  this.div_ = null;
  this.closeListener_ = null;
  this.moveListener_ = null;
  this.contextListener_ = null;
  this.eventListeners_ = null;
  this.fixedWidthSet_ = null;
}

/* InfoBox extends OverlayView in the Google Maps API v3.
 */
if (typeof google !== 'undefined') {
	InfoBox.prototype = new google.maps.OverlayView();

	/**
	 * Creates the DIV representing the InfoBox.
	 * @private
	 */
	InfoBox.prototype.createInfoBoxDiv_ = function(){

		var i;
		var events;
		var bw;
		var me = this;

		// This handler prevents an event in the InfoBox from being passed on to the map.
		//
		var cancelHandler = function(e){
			e.cancelBubble = true;
			if (e.stopPropagation) {
				e.stopPropagation();
			}
		};

		// This handler ignores the current event in the InfoBox and conditionally prevents
		// the event from being passed on to the map. It is used for the contextmenu event.
		//
		var ignoreHandler = function(e){

			e.returnValue = false;

			if (e.preventDefault) {

				e.preventDefault();
			}

			if (!me.enableEventPropagation_) {

				cancelHandler(e);
			}
		};

		if (!this.div_) {

			this.div_ = document.createElement("div");

			this.setBoxStyle_();

			if (typeof this.content_.nodeType === "undefined") {
				this.div_.innerHTML = this.getCloseBoxImg_() + this.content_;
			}
			else {
				this.div_.innerHTML = this.getCloseBoxImg_();
				this.div_.appendChild(this.content_);
			}

			// Add the InfoBox DIV to the DOM
			this.getPanes()[this.pane_].appendChild(this.div_);

			this.addClickHandler_();

			if (this.div_.style.width) {

				this.fixedWidthSet_ = true;

			}
			else {

				if (this.maxWidth_ !== 0 && this.div_.offsetWidth > this.maxWidth_) {

					this.div_.style.width = this.maxWidth_;
					this.div_.style.overflow = "auto";
					this.fixedWidthSet_ = true;

				}
				else { // The following code is needed to overcome problems with MSIE
					bw = this.getBoxWidths_();

					this.div_.style.width = (this.div_.offsetWidth - bw.left - bw.right) + "px";
					this.fixedWidthSet_ = false;
				}
			}

			this.panBox_(this.disableAutoPan_);

			if (!this.enableEventPropagation_) {

				this.eventListeners_ = [];

				// Cancel event propagation.
				//
				// Note: mousemove not included (to resolve Issue 152)
				events = ["mousedown", "mouseover", "mouseout", "mouseup", "click", "dblclick", "touchstart", "touchend", "touchmove"];

				for (i = 0; i < events.length; i++) {

					this.eventListeners_.push(google.maps.event.addDomListener(this.div_, events[i], cancelHandler));
				}

				// Workaround for Google bug that causes the cursor to change to a pointer
				// when the mouse moves over a marker underneath InfoBox.
				this.eventListeners_.push(google.maps.event.addDomListener(this.div_, "mouseover", function(e){
					this.style.cursor = "default";
				}));
			}

			this.contextListener_ = google.maps.event.addDomListener(this.div_, "contextmenu", ignoreHandler);

			/**
			 * This event is fired when the DIV containing the InfoBox's content is attached to the DOM.
			 * @name InfoBox#domready
			 * @event
			 */
			google.maps.event.trigger(this, "domready");
		}
	};

	/**
	 * Returns the HTML <IMG> tag for the close box.
	 * @private
	 */
	InfoBox.prototype.getCloseBoxImg_ = function(){

		var img = "";

		if (this.closeBoxURL_ !== "") {

			img = "<img";
			img += " src='" + this.closeBoxURL_ + "'";
			img += " align=right"; // Do this because Opera chokes on style='float: right;'
			img += " style='";
			img += " position: relative;"; // Required by MSIE
			img += " cursor: pointer;";
			img += " margin: " + this.closeBoxMargin_ + ";";
			img += "'>";
		}

		return img;
	};

	/**
	 * Adds the click handler to the InfoBox close box.
	 * @private
	 */
	InfoBox.prototype.addClickHandler_ = function(){

		var closeBox;

		if (this.closeBoxURL_ !== "") {

			closeBox = this.div_.firstChild;
			this.closeListener_ = google.maps.event.addDomListener(closeBox, "click", this.getCloseClickHandler_());

		}
		else {

			this.closeListener_ = null;
		}
	};

	/**
	 * Returns the function to call when the user clicks the close box of an InfoBox.
	 * @private
	 */
	InfoBox.prototype.getCloseClickHandler_ = function(){

		var me = this;

		return function(e){

			// 1.0.3 fix: Always prevent propagation of a close box click to the map:
			e.cancelBubble = true;

			if (e.stopPropagation) {

				e.stopPropagation();
			}

			/**
			 * This event is fired when the InfoBox's close box is clicked.
			 * @name InfoBox#closeclick
			 * @event
			 */
			google.maps.event.trigger(me, "closeclick");

			me.close();
		};
	};

	/**
	 * Pans the map so that the InfoBox appears entirely within the map's visible area.
	 * @private
	 */
	InfoBox.prototype.panBox_ = function(disablePan){

		var map;
		var bounds;
		var xOffset = 0, yOffset = 0;

		if (!disablePan) {

			map = this.getMap();

			if (map instanceof google.maps.Map) { // Only pan if attached to map, not panorama
				if (!map.getBounds().contains(this.position_)) {
					// Marker not in visible area of map, so set center
					// of map to the marker position first.
					map.setCenter(this.position_);
				}

				bounds = map.getBounds();

				var mapDiv = map.getDiv();
				var mapWidth = mapDiv.offsetWidth;
				var mapHeight = mapDiv.offsetHeight;
				var iwOffsetX = this.pixelOffset_.width;
				var iwOffsetY = this.pixelOffset_.height;
				var iwWidth = this.div_.offsetWidth;
				var iwHeight = this.div_.offsetHeight;
				var padX = this.infoBoxClearance_.width;
				var padY = this.infoBoxClearance_.height;
				var pixPosition = this.getProjection().fromLatLngToContainerPixel(this.position_);

				if (pixPosition.x < (-iwOffsetX + padX)) {
					xOffset = pixPosition.x + iwOffsetX - padX;
				}
				else
					if ((pixPosition.x + iwWidth + iwOffsetX + padX) > mapWidth) {
						xOffset = pixPosition.x + iwWidth + iwOffsetX + padX - mapWidth;
					}
				if (this.alignBottom_) {
					if (pixPosition.y < (-iwOffsetY + padY + iwHeight)) {
						yOffset = pixPosition.y + iwOffsetY - padY - iwHeight;
					}
					else
						if ((pixPosition.y + iwOffsetY + padY) > mapHeight) {
							yOffset = pixPosition.y + iwOffsetY + padY - mapHeight;
						}
				}
				else {
					if (pixPosition.y < (-iwOffsetY + padY)) {
						yOffset = pixPosition.y + iwOffsetY - padY;
					}
					else
						if ((pixPosition.y + iwHeight + iwOffsetY + padY) > mapHeight) {
							yOffset = pixPosition.y + iwHeight + iwOffsetY + padY - mapHeight;
						}
				}

				if (!(xOffset === 0 && yOffset === 0)) {

					// Move the map to the shifted center.
					//
					var c = map.getCenter();
					map.panBy(xOffset, yOffset);
				}
			}
		}
	};

	/**
	 * Sets the style of the InfoBox by setting the style sheet and applying
	 * other specific styles requested.
	 * @private
	 */
	InfoBox.prototype.setBoxStyle_ = function(){

		var i, boxStyle;

		if (this.div_) {

			// Apply style values from the style sheet defined in the boxClass parameter:
			this.div_.className = this.boxClass_;

			// Clear existing inline style values:
			this.div_.style.cssText = "";

			// Apply style values defined in the boxStyle parameter:
			boxStyle = this.boxStyle_;
			for (i in boxStyle) {

				if (boxStyle.hasOwnProperty(i)) {

					this.div_.style[i] = boxStyle[i];
				}
			}

			// Fix for iOS disappearing InfoBox problem.
			// See http://stackoverflow.com/questions/9229535/google-maps-markers-disappear-at-certain-zoom-level-only-on-iphone-ipad
			this.div_.style.WebkitTransform = "translateZ(0)";

			// Fix up opacity style for benefit of MSIE:
			//
			if (typeof this.div_.style.opacity !== "undefined" && this.div_.style.opacity !== "") {
				// See http://www.quirksmode.org/css/opacity.html
				this.div_.style.MsFilter = "\"progid:DXImageTransform.Microsoft.Alpha(Opacity=" + (this.div_.style.opacity * 100) + ")\"";
				this.div_.style.filter = "alpha(opacity=" + (this.div_.style.opacity * 100) + ")";
			}

			// Apply required styles:
			//
			this.div_.style.position = "absolute";
			this.div_.style.visibility = 'hidden';
			if (this.zIndex_ !== null) {

				this.div_.style.zIndex = this.zIndex_;
			}
		}
	};

	/**
	 * Get the widths of the borders of the InfoBox.
	 * @private
	 * @return {Object} widths object (top, bottom left, right)
	 */
	InfoBox.prototype.getBoxWidths_ = function(){

		var computedStyle;
		var bw = {
			top: 0,
			bottom: 0,
			left: 0,
			right: 0
		};
		var box = this.div_;

		if (document.defaultView && document.defaultView.getComputedStyle) {

			computedStyle = box.ownerDocument.defaultView.getComputedStyle(box, "");

			if (computedStyle) {

				// The computed styles are always in pixel units (good!)
				bw.top = parseInt(computedStyle.borderTopWidth, 10) || 0;
				bw.bottom = parseInt(computedStyle.borderBottomWidth, 10) || 0;
				bw.left = parseInt(computedStyle.borderLeftWidth, 10) || 0;
				bw.right = parseInt(computedStyle.borderRightWidth, 10) || 0;
			}

		}
		else
			if (document.documentElement.currentStyle) { // MSIE
				if (box.currentStyle) {

					// The current styles may not be in pixel units, but assume they are (bad!)
					bw.top = parseInt(box.currentStyle.borderTopWidth, 10) || 0;
					bw.bottom = parseInt(box.currentStyle.borderBottomWidth, 10) || 0;
					bw.left = parseInt(box.currentStyle.borderLeftWidth, 10) || 0;
					bw.right = parseInt(box.currentStyle.borderRightWidth, 10) || 0;
				}
			}

		return bw;
	};

	/**
	 * Invoked when <tt>close</tt> is called. Do not call it directly.
	 */
	InfoBox.prototype.onRemove = function(){

		if (this.div_) {

			this.div_.parentNode.removeChild(this.div_);
			this.div_ = null;
		}
	};

	/**
	 * Draws the InfoBox based on the current map projection and zoom level.
	 */
	InfoBox.prototype.draw = function(){

		this.createInfoBoxDiv_();

		var pixPosition = this.getProjection().fromLatLngToDivPixel(this.position_);

		this.div_.style.left = (pixPosition.x + this.pixelOffset_.width) + "px";

		if (this.alignBottom_) {
			this.div_.style.bottom = -(pixPosition.y + this.pixelOffset_.height) + "px";
		}
		else {
			this.div_.style.top = (pixPosition.y + this.pixelOffset_.height) + "px";
		}

		if (this.isHidden_) {

			this.div_.style.visibility = "hidden";

		}
		else {

			this.div_.style.visibility = "visible";
		}
	};

	/**
	 * Sets the options for the InfoBox. Note that changes to the <tt>maxWidth</tt>,
	 *  <tt>closeBoxMargin</tt>, <tt>closeBoxURL</tt>, and <tt>enableEventPropagation</tt>
	 *  properties have no affect until the current InfoBox is <tt>close</tt>d and a new one
	 *  is <tt>open</tt>ed.
	 * @param {InfoBoxOptions} opt_opts
	 */
	InfoBox.prototype.setOptions = function(opt_opts){
		if (typeof opt_opts.boxClass !== "undefined") { // Must be first
			this.boxClass_ = opt_opts.boxClass;
			this.setBoxStyle_();
		}
		if (typeof opt_opts.boxStyle !== "undefined") { // Must be second
			this.boxStyle_ = opt_opts.boxStyle;
			this.setBoxStyle_();
		}
		if (typeof opt_opts.content !== "undefined") {

			this.setContent(opt_opts.content);
		}
		if (typeof opt_opts.disableAutoPan !== "undefined") {

			this.disableAutoPan_ = opt_opts.disableAutoPan;
		}
		if (typeof opt_opts.maxWidth !== "undefined") {

			this.maxWidth_ = opt_opts.maxWidth;
		}
		if (typeof opt_opts.pixelOffset !== "undefined") {

			this.pixelOffset_ = opt_opts.pixelOffset;
		}
		if (typeof opt_opts.alignBottom !== "undefined") {

			this.alignBottom_ = opt_opts.alignBottom;
		}
		if (typeof opt_opts.position !== "undefined") {

			this.setPosition(opt_opts.position);
		}
		if (typeof opt_opts.zIndex !== "undefined") {

			this.setZIndex(opt_opts.zIndex);
		}
		if (typeof opt_opts.closeBoxMargin !== "undefined") {

			this.closeBoxMargin_ = opt_opts.closeBoxMargin;
		}
		if (typeof opt_opts.closeBoxURL !== "undefined") {

			this.closeBoxURL_ = opt_opts.closeBoxURL;
		}
		if (typeof opt_opts.infoBoxClearance !== "undefined") {

			this.infoBoxClearance_ = opt_opts.infoBoxClearance;
		}
		if (typeof opt_opts.isHidden !== "undefined") {

			this.isHidden_ = opt_opts.isHidden;
		}
		if (typeof opt_opts.visible !== "undefined") {

			this.isHidden_ = !opt_opts.visible;
		}
		if (typeof opt_opts.enableEventPropagation !== "undefined") {

			this.enableEventPropagation_ = opt_opts.enableEventPropagation;
		}

		if (this.div_) {

			this.draw();
		}
	};

	/**
	 * Sets the content of the InfoBox.
	 *  The content can be plain text or an HTML DOM node.
	 * @param {string|Node} content
	 */
	InfoBox.prototype.setContent = function(content){
		this.content_ = content;

		if (this.div_) {

			if (this.closeListener_) {

				google.maps.event.removeListener(this.closeListener_);
				this.closeListener_ = null;
			}

			// Odd code required to make things work with MSIE.
			//
			if (!this.fixedWidthSet_) {

				this.div_.style.width = "";
			}

			if (typeof content.nodeType === "undefined") {
				this.div_.innerHTML = this.getCloseBoxImg_() + content;
			}
			else {
				this.div_.innerHTML = this.getCloseBoxImg_();
				this.div_.appendChild(content);
			}

			// Perverse code required to make things work with MSIE.
			// (Ensures the close box does, in fact, float to the right.)
			//
			if (!this.fixedWidthSet_) {
				this.div_.style.width = this.div_.offsetWidth + "px";
				if (typeof content.nodeType === "undefined") {
					this.div_.innerHTML = this.getCloseBoxImg_() + content;
				}
				else {
					this.div_.innerHTML = this.getCloseBoxImg_();
					this.div_.appendChild(content);
				}
			}

			this.addClickHandler_();
		}

		/**
		 * This event is fired when the content of the InfoBox changes.
		 * @name InfoBox#content_changed
		 * @event
		 */
		google.maps.event.trigger(this, "content_changed");
	};

	/**
	 * Sets the geographic location of the InfoBox.
	 * @param {LatLng} latlng
	 */
	InfoBox.prototype.setPosition = function(latlng){

		this.position_ = latlng;

		if (this.div_) {

			this.draw();
		}

		/**
		 * This event is fired when the position of the InfoBox changes.
		 * @name InfoBox#position_changed
		 * @event
		 */
		google.maps.event.trigger(this, "position_changed");
	};

	/**
	 * Sets the zIndex style for the InfoBox.
	 * @param {number} index
	 */
	InfoBox.prototype.setZIndex = function(index){

		this.zIndex_ = index;

		if (this.div_) {

			this.div_.style.zIndex = index;
		}

		/**
		 * This event is fired when the zIndex of the InfoBox changes.
		 * @name InfoBox#zindex_changed
		 * @event
		 */
		google.maps.event.trigger(this, "zindex_changed");
	};

	/**
	 * Sets the visibility of the InfoBox.
	 * @param {boolean} isVisible
	 */
	InfoBox.prototype.setVisible = function(isVisible){

		this.isHidden_ = !isVisible;
		if (this.div_) {
			this.div_.style.visibility = (this.isHidden_ ? "hidden" : "visible");
		}
	};

	/**
	 * Returns the content of the InfoBox.
	 * @returns {string}
	 */
	InfoBox.prototype.getContent = function(){

		return this.content_;
	};

	/**
	 * Returns the geographic location of the InfoBox.
	 * @returns {LatLng}
	 */
	InfoBox.prototype.getPosition = function(){

		return this.position_;
	};

	/**
	 * Returns the zIndex for the InfoBox.
	 * @returns {number}
	 */
	InfoBox.prototype.getZIndex = function(){

		return this.zIndex_;
	};

	/**
	 * Returns a flag indicating whether the InfoBox is visible.
	 * @returns {boolean}
	 */
	InfoBox.prototype.getVisible = function(){

		var isVisible;

		if ((typeof this.getMap() === "undefined") || (this.getMap() === null)) {
			isVisible = false;
		}
		else {
			isVisible = !this.isHidden_;
		}
		return isVisible;
	};

	/**
	 * Shows the InfoBox. [Deprecated; use <tt>setVisible</tt> instead.]
	 */
	InfoBox.prototype.show = function(){

		this.isHidden_ = false;
		if (this.div_) {
			this.div_.style.visibility = "visible";
		}
	};

	/**
	 * Hides the InfoBox. [Deprecated; use <tt>setVisible</tt> instead.]
	 */
	InfoBox.prototype.hide = function(){

		this.isHidden_ = true;
		if (this.div_) {
			this.div_.style.visibility = "hidden";
		}
	};

	/**
	 * Adds the InfoBox to the specified map or Street View panorama. If <tt>anchor</tt>
	 *  (usually a <tt>google.maps.Marker</tt>) is specified, the position
	 *  of the InfoBox is set to the position of the <tt>anchor</tt>. If the
	 *  anchor is dragged to a new location, the InfoBox moves as well.
	 * @param {Map|StreetViewPanorama} map
	 * @param {MVCObject} [anchor]
	 */
	InfoBox.prototype.open = function(map, anchor){

		var me = this;

		if (anchor) {

			this.position_ = anchor.getPosition();
			this.moveListener_ = google.maps.event.addListener(anchor, "position_changed", function(){
				me.setPosition(this.getPosition());
			});
		}

		this.setMap(map);

		if (this.div_) {

			this.panBox_();
		}
	};

	/**
	 * Removes the InfoBox from the map.
	 */
	InfoBox.prototype.close = function(){

		var i;

		if (this.closeListener_) {

			google.maps.event.removeListener(this.closeListener_);
			this.closeListener_ = null;
		}

		if (this.eventListeners_) {

			for (i = 0; i < this.eventListeners_.length; i++) {

				google.maps.event.removeListener(this.eventListeners_[i]);
			}
			this.eventListeners_ = null;
		}

		if (this.moveListener_) {

			google.maps.event.removeListener(this.moveListener_);
			this.moveListener_ = null;
		}

		if (this.contextListener_) {

			google.maps.event.removeListener(this.contextListener_);
			this.contextListener_ = null;
		}

		this.setMap(null);
	};
}

//
;(function() {
  var showMsg = false;
  var msg = document.querySelector(".map-note");

  var Marker = (function() {
    'use strict';

    function Marker(data, map) {
      var self = this;

      self._gmap = map;
      self.data = data;
	  self.data.searchDistance = 0;
      self.guid = guid();

      self._gmarker = new google.maps.Marker({
        position: data.position,
        title: data.name,
        icon: '/wp-content/themes/globallymealliance/images/pin.svg'
      });

      google.maps.event.addListener(self._gmarker, 'click', ()=>{
      	jQuery('#group-locations-list li').removeClass('item-active');
      	var activeEl  = jQuery('[data-marker-guid="' + self.guid + '"]');
      	activeEl.addClass('item-active');
      	activeEl.closest('.jcf-scrollable').scrollTop(0);
          activeEl.closest('.jcf-scrollable').animate({scrollTop: activeEl.position().top}, 700);

      	this.showInfoWindow.bind(this)()

      });
    }

    Marker._infowindow = new InfoBox({
      boxClass: 'details-popup',
      boxStyle: {
        width: '278'
      },
      alignBottom: true,
      pixelOffset: {
        width: -139,
        height: -7
      },
      content: ''
    });
    Marker.createInfoWindow = function(item) {
		var returnString = '<div class="map-popup">';
			returnString +=		'<div class="description">';
			returnString += 			'<div class="title-holder">';
			item.name ? returnString += 		'<span class="title"><strong>' + item.name + '</strong><br></span>' : '';
			returnString += 					'<address>';
			item.address ? returnString +=         	item.address + '<br>' : '';
			item.dates ? returnString +=         	'<strong>Date:</strong> '+item.dates + '<br>' : '';
			item.time ? returnString +=         	'<strong>Time:</strong> '+item.time + '<br>' : '';
			item.contact ? returnString +=         	'<strong>Contact:</strong>'+item.contact + '<br>' : '';
			item.website ? returnString +=         	'<strong>Website:</strong> <a href="'+item.website+'" target="_blank">'+item.website + '<br>' : '';
			returnString += 					'</address>';
			returnString += 			'</div>';
			returnString += 			'<div class="txt">';
			returnString += 				'<a class="btn btn-default btn-sm" target="_blank" href="https://maps.google.com/maps?saddr=New%20York&amp;daddr=' + item.address + ' ' + item.city + ' ' + item.state + ' ' + item.zip + '">Get Directions</a>';
			returnString +=			'</div>';
			returnString +=		'</div>';
			returnString +=	'</div>';

		return returnString;
    };

    Marker.closeInfoWindow = function() {
      Marker._infowindow.close();
    };

    Marker.prototype.show = function(map) {
      map = map || this._gmap;
      this._gmarker.setMap(map);
    };

    Marker.prototype.hide = function() {
      this._gmarker.setMap(null);
    };

    Marker.prototype.getMap = function() {
      return this._gmarker.getMap();
    };

    Marker.prototype.getPosition = function() {
      return this._gmarker.getPosition();
    };

    Marker.prototype.showInfoWindow = function() {
      Marker._infowindow.close();
      Marker._infowindow.setContent(Marker.createInfoWindow(this.data));
      Marker._infowindow.open(this._gmarker.getMap(), this._gmarker);
    };

    function guid() {
      function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
          .toString(16)
          .substring(1);
      }
      return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
    }

    return Marker;
  }());

  var Map = (function () {
    'use strict';

    function Map(mapNode, options) {
      this.options = options;
      this.mapNode = typeof mapNode === 'string' ? document.getElementById(mapNode) : mapNode;
      this.markers = [];
      this.currentFilter = '';
      this.currentPosition = new google.maps.LatLng(options.center.lat, options.center.lng);
      this.geocoder = new google.maps.Geocoder();

      this._marker = null;

      this._gmap = new google.maps.Map(mapNode, {
        scrollwheel: false,
        center: this.currentPosition,
        mapTypeId: options.mapTypeId,
        zoom: options.zoom,
        maxZoom: 17,
		mapTypeControl: false
      });
    }

    Map.prototype.setMarkerFactory = function(markerFactory) {
      this._marker = markerFactory;
    }

    Map.prototype.hideAllMarkers = function() {
      if (this.markers.length) {
        for (var i = 0; i <= this.markers.length - 1; i++) {
          this.markers[i].hide();
        }
      }
    };

    Map.prototype.showAllMarkers = function() {
      if (this.markers.length) {
        for (var i = 0; i <= this.markers.length - 1; i++) {
          this.markers[i].show();
        }
      }
    };

    Map.prototype.showMarker = function(marker) {
      marker.show();
    };

    Map.prototype.hideMarker = function(marker) {
      marker.hide();
    };

    Map.prototype.addMarkers = function(markersData, immediatelyShow) {
      immediatelyShow = immediatelyShow || false;
      var self = this;

      function addMarker(data) {
        var position = new google.maps.LatLng(data.lat, data.lng);
        var distance = google.maps.geometry.spherical.computeDistanceBetween(self.currentPosition, position);

        distance = distance * 0.00062137; // convert to miles
        distance = Math.round(distance * 100) / 100;

        data.distance = distance;
        data.position = position;

        var marker = new self._marker(data, self._gmap);
        self.markers.push(marker);
        if (immediatelyShow) {
          self.showMarker(marker);
        }
      }

      if (Array.isArray(markersData)) {
        for (var i = 0; i <= markersData.length - 1; i++) {
          addMarker(markersData[i]);
        }
      } else {
        addMarker(markersData);
      }

      this.fitBounds();
    };

    Map.prototype.filterMarkers = function(filter) {
      this._marker.closeInfoWindow();

      var isVisible;
      var distance, center;

      if (filter.center) {
        center = new google.maps.LatLng(filter.center.lat, filter.center.lng);
      }

      for (var i = 0; i <= this.markers.length - 1; i++) {
        isVisible = true;

        for (var filterKey in filter) {
          if (filterKey === 'distance') {

            if (center) {
              var distance = google.maps.geometry.spherical.computeDistanceBetween(center, this.markers[i].data.position);
              distance = distance * 0.00062137; // convert to miles
              distance = Math.round(distance * 100) / 100;
			  this.markers[i].data.searchDistance = distance;
            } else {
              distance = parseInt(this.markers[i].data.distance, 10)
            }

            if (distance > filter.distance) {
              isVisible = false;
            }
          }

          if (filterKey === 'distribution' && filter.distribution !== '' && filter.distribution !== this.markers[i].data.distribution) {
            isVisible = false;
          }
        }

        if (isVisible) {
          this.showMarker(this.markers[i]);
        } else {
          this.hideMarker(this.markers[i]);
        }
      }

      this.fitBounds();
    };

    Map.prototype.setCurrentPosition = function(position) {
      this.currentPosition = new google.maps.LatLng(position.lat, position.lng);

      for (var i = 0; i <= this.markers.length - 1; i++) {
        var distance = google.maps.geometry.spherical.computeDistanceBetween(
          this.currentPosition,
          this.markers[i].data.position
        );
        this.markers[i].data.distance = distance;
      }

    };

    Map.prototype.fitBounds = function() {
      var bounds = new google.maps.LatLngBounds();
      var visibleMarkersCount = 0;

      for (var i = 0; i <= this.markers.length - 1; i++) {
        if (this.markers[i].getMap() === this._gmap) {
          visibleMarkersCount++;
          bounds.extend(this.markers[i].getPosition());
        }
      }

      if (visibleMarkersCount) {
        this._gmap.fitBounds(bounds);
        showMsg = true;

        if (msg.style.display === "block") {
            msg.style.display = "none";
        }
      } else {
        this._gmap.setCenter(this.options.center);
        this._gmap.setZoom(this.options.zoom);

        if (showMsg && msg.style.display === "none") {
          showMsg = true;
          msg.style.display = "block";
        }
      }
    }

    Map.prototype.getVisibleMarkers = function() {
      var markers = [];
      for (var i = 0; i <= this.markers.length - 1; i++) {
        if (this.markers[i].getMap() === this._gmap) {
          markers.push(this.markers[i]);
        }
      }
      return markers;
    };

    return Map;
  } ());

  var FinderGroup = (function() {
    'use strict';

    var api = {};

    var locationService = null;
    var filterForm = null;
    var addressAutocomplete = null;

    try {
      if (typeof navigator.geolocation === 'undefined') {
        if (google.gears) {
          locationService = google.gears.factory.create('beta.geolocation');
        }
      } else {
        locationService = navigator.geolocation;
      }
    } catch (e) {}

    api.Marker = Marker;
    api.Map = Map;

    api.currentLocation = function(callback, errorCallback) {
      var timeout;
      if (locationService) {
        timeout = setTimeout(errorCallback, 5000);

        locationService.getCurrentPosition(
          function(loc) {
            clearTimeout(timeout);
            callback(loc);
          },
          errorCallback,
          {
            maximumAge: 60000,
            timeout: 5000,
            enableHighAccuracy: true
          }
        );
      } else {
        errorCallback();
      }
    };

    api.initMap = function(mapNodeSelector, center) {
      var mapNode = document.querySelector(mapNodeSelector);

      if (!mapNode) {
        throw('Element with selector "' + mapNodeSelector + '" not found')
      }

      api.map = new api.Map(mapNode, {
        center: center,
        zoom: 6,
        mapTypeId: 'roadmap'
      });

      api.map.setMarkerFactory(api.Marker);
		// Use the below content to load the Map data from a JSON external file
		/*
      var dataPath = mapNode.dataset.markers;
      var xhr = new XMLHttpRequest();
      xhr.open('GET', dataPath, true);
      xhr.addEventListener('readystatechange', function() {
        var data;

        if (this.readyState != 4) return;

        if (xhr.status != 200) {
          console.warn(xhr.status + ': ' + xhr.statusText);
          return;
        }
		*/
		var data;
        try {
		  // Use the below line to load the Map data from a JSON external file
          //data = JSON.parse(xhr.responseText);
		  data = JSON.parse(support_groups_json_data);
        } catch (e) {
          console.error(e);
        }

        if (data && data.response) {
          api.map.addMarkers(data.response, true);

          if (api.sidebar) {
            api.drawSidebar();
          }
        }
      //});

      //xhr.send();
    };

    api.initSidebar = function(sidebarSelector) {
      api.sidebar = document.querySelector(sidebarSelector);

      if (!api.sidebar) {
        throw('Element with selector "' + sidebarSelector + '" not found')
      }

      api.drawSidebar();

      api.sidebar.addEventListener('click', function(e) {
        var li = closestChild(e.target);
		  jQuery(li).parent().find('li').removeClass('item-active');
          jQuery(li).addClass('item-active');
        if (li) {
          var guid = li.dataset.markerGuid;
          var markers = api.map.getVisibleMarkers();

          for (var i = 0; i <= markers.length - 1; i++) {
            if (markers[i].guid === guid) {
              markers[i].showInfoWindow();
              break;
            }
          }
        }

        function closestChild(node) {
          while (node) {
            if (node === api.sidebar) {
              return null;
            } else if (node.parentElement === api.sidebar) {
              return node;
            } else {
              node = node.parentElement;
            }
          }
          return null;
        }
      });
    };

    api.drawSidebar = function() {
      var markers = api.map.getVisibleMarkers();
      var html = '',
          htmlItem = function(marker) {
            var item = marker.data;
            var returnString = '<li data-marker-guid="' + marker.guid + '">';
                //returnString += '<div class="col">';
                item.name ? returnString += '<span class="location_name"><strong>' + item.name + '</strong></span><br>' : '';
                //returnString += '</div>';
                //returnString += '<div class="col">';
                item.address ? returnString += '<span class="slp_result_address slp_result_street">' + item.address + '</span><br>' : '';
                //returnString += '<span class="slp_result_address slp_result_citystatezip">' + item.city + '' + item.state + ' ' + item.zip + '</span>';
                //returnString += '<span class="slp_result_address slp_result_country">' + item.country + '</span>';
                //returnString += '<span class="slp_result_address slp_result_phone">' + item.phone + '</span>';
				item.dates ? returnString +=         	'<span class="slp_result_address slp_result_street"><strong>Date:</strong> '+item.dates + '</span><br>' : '';
				item.time ? returnString +=         	'<span class="slp_result_address slp_result_street"><strong>Time:</strong> '+item.time + '</span><br>' : '';
				item.contact ? returnString +=         	'<span class="slp_result_address slp_result_street"><strong>Contact:</strong>'+item.contact + '</span><br>' : '';
				item.website ? returnString +=         	'<span class="slp_result_address slp_result_street"><strong>Website:</strong> <a href="'+item.website+'" target="_blank">'+item.website + '</span><br>' : '';
                //returnString += '</div>';
                //returnString += '<div class="col">';
                returnString += '<span class="slp_result_contact slp_result_directions">';
                returnString += '<a class="btn btn-default btn-sm" target="_blank" href="https://maps.google.com/maps?saddr=New%20York&amp;daddr=' + item.address + ' ' + item.city + ' ' + item.state + ' ' + item.zip + '">Get Directions</a>';
                returnString += '</span>';
                //returnString += '</div>';
				returnString += '</li>';

			return returnString;
          };

	  var sortMapMarkerDistArr = [];
      for (var i = 0; i <= markers.length - 1; i++) {
		  console.log(markers[i].data.searchDistance);
		  sortMapMarkerDistArr.push({'distance': markers[i].data.searchDistance,'marker': markers[i]});
        //html += htmlItem(markers[i]);
      }

	  sortMapMarkerDistArr = sortMapMarkerDistArr.sort(function(a, b) {
		    return a.distance - b.distance;
		});
		
		sortMapMarkerDistArr.forEach(function(sortedMarker) {
			html += htmlItem(sortedMarker.marker);
		});

      api.sidebar.innerHTML = html;
    };

    api.filter = function() {
      var place, location, center;
      if (filterForm) {
        place = addressAutocomplete.getPlace();

        if (filterForm.address.value.trim() && place) {
          location = addressAutocomplete.getPlace().geometry.location;
          center = {
            lat: location.lat(),
            lng: location.lng()
          };
        }
        api.map.filterMarkers({
          // distribution: filterForm.distribution.value,
          distance: filterForm.distance.value,
          center: center
        });
        api.drawSidebar();
      }
    };

    api.initFilter = function(formSelector) {
      filterForm = document.querySelector(formSelector);
      filterForm.addEventListener('submit', function(e) {
        e.preventDefault();

        api.filter();
          document.querySelector('.locations-box').style.cssText = 'opacity: 1; visiblity: visible;';

          jcf.refreshAll();
      });

      addressAutocomplete = new google.maps.places.Autocomplete(filterForm.address, {
        types: ['geocode']
      });
      google.maps.event.addDomListener(filterForm.address, 'keydown', function(event) {
        if (event.keyCode === 13) {
          event.preventDefault();
        }
      });
    };

    api.setCurrentPosition = function(postion) {
      api.map.setCurrentPosition(postion);
      api.filter();
    };

    return api;
  }());

  FinderGroup.initMap('#group-map', { lat: 40.7267625, lng: -73.9260743 });
  FinderGroup.initSidebar('#group-locations-list');
  FinderGroup.initFilter('#group-search-form');

  FinderGroup.currentLocation(
    function(location) {

      FinderGroup.setCurrentPosition({
        lat: location.coords.latitude,
        lng: location.coords.longitude
      });
    },
    function() {
      console.log('error');
    }
  );

}());
