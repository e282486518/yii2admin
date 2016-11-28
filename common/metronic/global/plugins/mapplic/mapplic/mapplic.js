/*
 * Mapplic - Custom Interactive Map Plugin by @sekler
 * Version 3.1
 * http://www.mapplic.com
 */

(function($) {

	var Mapplic = function() {
		var self = this;

		self.o = {
			source: 'locations.json',
			selector: '[id^=landmarks] > *',
			landmark: null,
			mapfill: false,
			height: 420,
			markers: true,
			minimap: true,
			sidebar: true,
			search: true,
			deeplinking: true,
			clearbutton: true,
			zoombuttons: true,
			hovertip: true,
			smartip: true,
			fullscreen: false,
			developer: false,
			maxscale: 4,
			skin: '',
			zoom: true
		};

		self.init = function(el, params) {
			// Extend options
			self.o = $.extend(self.o, params);

			self.x = 0;
			self.y = 0;
			self.scale = 1;

			self.el = el.addClass('mapplic-element mapplic-loading').addClass(self.o.skin).height(self.o.height);

			// Disable modules when landmark mode is active
			if (self.o.landmark) {
				self.o.sidebar = false;
				self.o.zoombuttons = false;
				self.o.deeplinking = false;
			}

			if (typeof self.o.source === 'string') {
				// Loading .json file with AJAX
				$.getJSON(self.o.source, function(data) { // Success
					processData(data);
					self.el.removeClass('mapplic-loading');

				}).fail(function() { // Failure: couldn't load JSON file, or it is invalid.
					console.error('Couldn\'t load map data. (Make sure you are running the script through a server and not just opening the html file with your browser)');
					self.el.removeClass('mapplic-loading').addClass('mapplic-error');
					alert('Data file missing or invalid!');
				});
			}
			else {
				// Inline json object
				processData(self.o.source);
				self.el.removeClass('mapplic-loading');
			}

			return self;
		}

		// Tooltip
		function Tooltip() {
			this.el = null;
			this.shift = 6;
			this.drop = 0;
			this.location = null;

			this.init = function() {
				var s = this;

				// Construct
				this.el = $('<div></div>').addClass('mapplic-tooltip');
				this.close = $('<a></a>').addClass('mapplic-tooltip-close').attr('href', '#').appendTo(this.el);
				this.close.on('click touchend', function(e) {
					e.preventDefault();
					$('.mapplic-active', self.el).attr('class', 'mapplic-clickable');
					if (self.deeplinking) self.deeplinking.clear();
					if (!self.o.zoom) zoomTo(0.5, 0.5, 1, 600, 'easeInOutCubic');
					s.hide();
				});
				this.image = $('<img>').addClass('mapplic-tooltip-image').hide().appendTo(this.el);
				this.title = $('<h4></h4>').addClass('mapplic-tooltip-title').appendTo(this.el);
				this.content = $('<div></div>').addClass('mapplic-tooltip-content').appendTo(this.el);
				this.desc = $('<div></div>').addClass('mapplic-tooltip-description').appendTo(this.content);
				this.link = $('<a>More</a>').addClass('mapplic-tooltip-link').attr('href', '#').hide().appendTo(this.el);
				this.triangle = $('<div></div>').addClass('mapplic-tooltip-triangle').prependTo(this.el);

				// Append
				self.map.append(this.el);
			}

			this.set = function(location) {
				if (location) {
					var s = this;

					if (location.image) this.image.attr('src', location.image).show();
					else this.image.hide();

					if (location.link) this.link.attr('href', location.link).show();
					else this.link.hide();

					this.title.text(location.title);
					this.desc.html(location.description);
					this.content[0].scrollTop = 0;

					this.position(location);
				}
			}

			this.show = function(location) {
				if (location) {
					if (location.action == 'none') {
						this.el.stop().fadeOut(300);
						return;
					}

					var s = this;

					this.location = location;
					self.hovertip.hide();

					if (location.image) this.image.attr('src', location.image).show();
					else this.image.hide();

					if (location.link) this.link.attr('href', location.link).show();
					else this.link.hide();

					this.title.text(location.title);
					this.desc.html(location.description);

					// Shift
					var pinselect = $('.mapplic-pin[data-location="' + location.id + '"]');
					if (pinselect.length == 0) {
						this.shift = 20;
					}
					else this.shift = pinselect.height() + 10;

					// Loading & positioning
					$('img', this.el).load(function() {
						s.position();
					});
					this.position();
				
					// Making it visible
					this.el.stop().show();
				}
			}

			this.position = function() {
				if (this.location) {
					var cx = self.map.offset().left + self.map.width() * this.location.x - self.container.offset().left,
						cy = self.map.offset().top + self.map.height() * this.location.y - self.container.offset().top;

					var x = this.location.x * 100,
						y = this.location.y * 100,
						mt = -this.el.outerHeight() - this.shift,
						ml = -this.el.outerWidth() / 2;

					if (self.o.smartip) {
						var verticalPos = 0.5;

						// Top check
						if (Math.abs(mt) > cy) {
							mt = 8 + 2;
							this.el.addClass('mapplic-bottom');
						}
						else this.el.removeClass('mapplic-bottom');

						// Left-right check
						if (this.el.outerWidth()/2 > cx)
							verticalPos = 0.5 - (this.el.outerWidth()/2 - cx)/this.el.outerWidth();
						else if ((self.container.width() - cx - this.el.outerWidth()/2) < 0)
							verticalPos = 0.5 + (cx + this.el.outerWidth()/2 - self.container.width())/this.el.outerWidth(); 

						verticalPos = Math.max(0, Math.min(1, verticalPos));
						ml = -this.el.outerWidth() * verticalPos;
						this.triangle.css('left', Math.max(5, Math.min(95, verticalPos * 100)) + '%');
					}

					this.el.css({
						left: x + '%',
						top: y + '%',
						marginTop: mt,
						marginLeft: ml
					});
					this.drop = /*this.el.outerHeight()*/ 240 + this.shift;
				}
			}

			this.hide = function() {
				var s = this;

				this.location = null;
				
				this.el.stop().fadeOut(300, function() {
					s.desc.empty();
				});
			}
		}

		// HoverTooltip
		function HoverTooltip() {
			this.el = null;
			this.shift = 6;

			this.init = function() {
				var s = this;

				// Construct
				this.el = $('<div></div>').addClass('mapplic-tooltip mapplic-hovertip');
				this.title = $('<h4></h4>').addClass('mapplic-tooltip-title').appendTo(this.el);
				this.triangle = $('<div></div>').addClass('mapplic-tooltip-triangle').appendTo(this.el);

				// Events 
				// pins + old svg
				$(self.map).on('mouseover', '.mapplic-layer a', function() {
					var id = '';
					if ($(this).hasClass('mapplic-pin')) {
						id = $(this).data('location');
						s.shift = $(this).height() + 10;
					}
					else {
						id = $(this).attr('xlink:href').slice(1);
						s.shift = 20;
					}

					var location = getLocationData(id);
					if (location) s.show(location);
				}).on('mouseout', function() {
					s.hide();
				});

				// new svg
				if (self.o.selector) {
					$(self.map).on('mouseover', self.o.selector, function() {
						var location = getLocationData($(this).attr('id'));
						s.shift = 20;
						if (location) s.show(location);
					}).on('mouseout', function() {
						s.hide();
					});
				}

				self.map.append(this.el);
			}

			this.show = function(location) {
				if (self.tooltip.location != location) {
					this.title.text(location.title);

					this.position(location);

					this.el.stop().fadeIn(100);
				}
			}

			this.position = function(location) {
				var cx = self.map.offset().left + self.map.width() * location.x - self.container.offset().left,
					cy = self.map.offset().top + self.map.height() * location.y - self.container.offset().top;

				var x = location.x * 100,
					y = location.y * 100,
					mt = -this.el.outerHeight() - this.shift,
					ml = 0;

				var verticalPos = 0.5;

				// Top check
				if (Math.abs(mt) > cy) {
					mt = 8 + 2;
					this.el.addClass('mapplic-bottom');
				}
				else this.el.removeClass('mapplic-bottom');

				// Left-right check
				if (this.el.outerWidth()/2 > cx)
					verticalPos = 0.5 - (this.el.outerWidth()/2 - cx)/this.el.outerWidth();
				else if ((self.container.width() - cx - this.el.outerWidth()/2) < 0)
					verticalPos = 0.5 + (cx + this.el.outerWidth()/2 - self.container.width())/this.el.outerWidth(); 

				ml = -this.el.outerWidth() * verticalPos;
				this.triangle.css('left', Math.max(10, Math.min(90, verticalPos * 100)) + '%');
				this.el.css({
					left: x + '%',
					top: y + '%',
					marginTop: mt,
					marginLeft: ml
				});
			}

			this.hide = function() {
				this.el.stop().fadeOut(200);
			}
		}

		// Deeplinking
		function Deeplinking() {
			this.param = 'location';

			this.init = function() {
				var s = this;
				this.check(0);

				window.onpopstate = function(e) {
					if (e.state) {
						s.check(600);
					}
					return false;
				}
			}

			this.check = function(ease) {
				var id = this.getUrlParam(this.param);
				showLocation(id, ease, true);
			}

			this.getUrlParam = function(name) {
				name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
				var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
					results = regex.exec(location.search);
				return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
			}

			this.update = function(id) {
				var url = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + this.param + '=' + id;
				window.history.pushState({path: url}, '', url);
			}

			// Clear
			this.clear = function() {
				history.pushState('', document.title, window.location.pathname);
			}
		}

		// Old hash deeplinking method for old browsers
		function DeeplinkingHash() {
			this.param = 'location';

			this.init = function() {
				var s = this;
				this.check(0);

				$(window).on('hashchange', function() {
					s.check(600);
				});
			}

			this.check = function(ease) {
				var id = location.hash.slice(this.param.length + 2);
				showLocation(id, ease, true);
			}

			this.update = function(id) {
				window.location.hash = this.param + '-' + id;
			}

			this.clear = function() {
				window.location.hash = this.param;
			}
		}

		// Minimap
		function Minimap() {
			this.el = null;
			this.opacity = null;

			this.init = function() {
				this.el = $('<div></div>').addClass('mapplic-minimap').appendTo(self.container);
				this.el.css('height', this.el.width() * self.hw_ratio);
				this.el.click(function(e) {
					e.preventDefault();

					var x = (e.pageX - $(this).offset().left) / $(this).width(),
						y = (e.pageY - $(this).offset().top) / $(this).height();

					zoomTo(x, y, self.scale / self.fitscale, 100);
				});
			}

			this.addLayer = function(data) {
				var layer = $('<div></div>').addClass('mapplic-minimap-layer').addClass(data.id).appendTo(this.el);
				$('<img>').attr('src', data.minimap).addClass('mapplic-minimap-background').appendTo(layer);
				$('<div></div>').addClass('mapplic-minimap-overlay').appendTo(layer);
				$('<img>').attr('src', data.minimap).addClass('mapplic-minimap-active').appendTo(layer);
			}

			this.show = function(target) {
				$('.mapplic-minimap-layer', this.el).hide();
				$('.mapplic-minimap-layer.' + target, this.el).show();
			}

			this.update = function(x, y) {
				var active = $('.mapplic-minimap-active', this.el);

				if (x === undefined) x = self.x;
				if (y === undefined) y = self.y;

				var width = Math.round(self.container.width() / self.contentWidth / self.scale * this.el.width()),
					height = Math.round(self.container.height() / self.contentHeight / self.scale * this.el.height()),
					top = Math.round(-y / self.contentHeight / self.scale * this.el.height()),
					left = Math.round(-x / self.contentWidth / self.scale * this.el.width()),
					right = left + width,
					bottom = top + height;

				active.each(function() {
					$(this)[0].style.clip = 'rect(' + top + 'px, ' + right + 'px, ' + bottom + 'px, ' + left + 'px)';
				});


				var s = this;
				this.el.show();
				this.el.css('opacity', 1.0);
				clearTimeout(this.opacity);
				this.opacity = setTimeout(function() {
					s.el.css('opacity', 0);
					setTimeout(function() { s.el.hide(); }, 600);
				}, 2000);
			}
		}

		// Sidebar
		function Sidebar() {
			this.el = null;
			this.list = null;

			this.init = function() {
				var s = this;

				this.el = $('<div></div>').addClass('mapplic-sidebar').appendTo(self.el);

				if (self.o.search) {
					var form = $('<form></form>').addClass('mapplic-search-form').submit(function() {
						return false;
					}).appendTo(this.el);
					self.clear = $('<button></button>').addClass('mapplic-search-clear').click(function() {
						input.val('');
						input.keyup();
					}).appendTo(form);
					var input = $('<input>').attr({'type': 'text', 'spellcheck': 'false', 'placeholder': 'Search...'}).addClass('mapplic-search-input').keyup(function() {
						var keyword = $(this).val();
						s.search(keyword);
					}).prependTo(form);
				}

				var listContainer = $('<div></div>').addClass('mapplic-list-container').appendTo(this.el);
				this.list = $('<ol></ol>').addClass('mapplic-list').appendTo(listContainer);
				this.notfound = $('<p></p>').addClass('mapplic-not-found').text('Nothing found. Please try a different search.').appendTo(listContainer);

				if (!self.o.search) listContainer.css('padding-top', '0');
			}

			this.addCategories = function(categories) {
				var list = this.list;

				if (categories) {
					$.each(categories, function(index, category) {
						var item = $('<li></li>').addClass('mapplic-list-category').attr('data-category', category.id);
						var ol = $('<ol></ol>').css('border-color', category.color).appendTo(item);
						if (category.show == 'false') ol.hide();
						else item.addClass('mapplic-opened');
						var link = $('<a></a>').attr('href', '#').attr('title', category.title).css('background-color', category.color).text(category.title).prependTo(item);
						link.on('click', function(e) {
							e.preventDefault();
							item.toggleClass('mapplic-opened');
							ol.slideToggle(200);
						});
						if (category.icon) $('<img>').attr('src', category.icon).addClass('mapplic-list-thumbnail').prependTo(link);
						$('<span></span>').text('0').addClass('mapplic-list-count').prependTo(link);
						list.append(item);
					});
					}
			}

			this.addLocation = function(data) {
				var item = $('<li></li>').addClass('mapplic-list-location').addClass('mapplic-list-shown');
				var link = $('<a></a>').attr('href', '#').click(function(e) {
					e.preventDefault();
					showLocation(data.id, 600);

					// Scroll back to map on mobile
					if ($(window).width() < 668) {
						$('html, body').animate({
							scrollTop: self.container.offset().top
						}, 400);
					}
				}).appendTo(item);

				if (data.thumbnail) $('<img>').attr('src', data.thumbnail).addClass('mapplic-list-thumbnail').appendTo(link);
				$('<h4></h4>').text(data.title).appendTo(link)
				$('<span></span>').html(data.about).appendTo(link);
				var category = $('.mapplic-list-category[data-category="' + data.category + '"]');

				if (category.length) $('ol', category).append(item);
				else this.list.append(item);

				// Count
				$('.mapplic-list-count', category).text($('.mapplic-list-shown', category).length);
			}

			this.search = function(keyword) {
				if (keyword) self.clear.fadeIn(100);
				else self.clear.fadeOut(100);

				$('.mapplic-list li', self.el).each(function() {
					if ($(this).text().search(new RegExp(keyword, "i")) < 0) {
						$(this).removeClass('mapplic-list-shown');
						$(this).slideUp(200);
					} else {
						$(this).addClass('mapplic-list-shown');
						$(this).show();
					}
				});

				$('.mapplic-list > li', self.el).each(function() {
					var count = $('.mapplic-list-shown', this).length;
					$('.mapplic-list-count', this).text(count);
				});

				// Show not-found text
				if ($('.mapplic-list > li.mapplic-list-shown').length > 0) this.notfound.fadeOut(200);
				else this.notfound.fadeIn(200);
			}
		}

		// Developer tools
		function DevTools() {
			this.el = null;

			this.init = function() {
				this.el = $('<div></div>').addClass('mapplic-coordinates').appendTo(self.container);
				this.el.append('x: ');
				$('<code></code>').addClass('mapplic-coordinates-x').appendTo(this.el);
				this.el.append(' y: ');
				$('<code></code>').addClass('mapplic-coordinates-y').appendTo(this.el);

				$('.mapplic-layer', self.map).on('mousemove', function(e) {
					var x = (e.pageX - self.map.offset().left) / self.map.width(),
						y = (e.pageY - self.map.offset().top) / self.map.height();
					$('.mapplic-coordinates-x').text(parseFloat(x).toFixed(4));
					$('.mapplic-coordinates-y').text(parseFloat(y).toFixed(4));
				});
			}
		}

		// Clear Button
		function ClearButton() {
			this.el = null;
			
			this.init = function() {
				this.el = $('<a></a>').attr('href', '#').addClass('mapplic-clear-button').appendTo(self.container);

				this.el.on('click touchstart', function(e) {
					e.preventDefault();
					if (self.deeplinking) self.deeplinking.clear();
					$('.mapplic-active', self.el).attr('class', 'mapplic-clickable');
					self.tooltip.hide();
					zoomTo(0.5, 0.5, 1, 400, 'easeInOutCubic');
				});
			}
		}

		// Zoom Buttons
		function ZoomButtons() {
			this.el = null;
		
			this.init = function() {
				this.el = $('<div></div>').addClass('mapplic-zoom-buttons').appendTo(self.container);

				this.zoomin = $('<a></ha>').attr('href', '#').addClass('mapplic-zoomin-button').appendTo(this.el);

				this.zoomin.on('click touchstart', function(e) {
					e.preventDefault();

					var scale = self.scale;
					self.scale = normalizeScale(scale + scale * 0.8);

					self.x = normalizeX(self.x - (self.container.width()/2 - self.x) * (self.scale/scale - 1));
					self.y = normalizeY(self.y - (self.container.height()/2 - self.y) * (self.scale/scale - 1));

					moveTo(self.x, self.y, self.scale, 400, 'easeInOutCubic');
				});

				this.zoomout = $('<a></ha>').attr('href', '#').addClass('mapplic-zoomout-button').appendTo(this.el);

				this.zoomout.on('click touchstart', function(e) {
					e.preventDefault();

					var scale = self.scale;
					self.scale = normalizeScale(scale - scale * 0.4);

					self.x = normalizeX(self.x - (self.container.width()/2 - self.x) * (self.scale/scale - 1));
					self.y = normalizeY(self.y - (self.container.height()/2 - self.y) * (self.scale/scale - 1));

					moveTo(self.x, self.y, self.scale, 400, 'easeInOutCubic');
				});
			}

			this.update = function(scale) {
				this.zoomin.removeClass('mapplic-disabled');
				this.zoomout.removeClass('mapplic-disabled');
				if (scale == self.fitscale) this.zoomout.addClass('mapplic-disabled');
				else if (scale == self.o.maxscale) this.zoomin.addClass('mapplic-disabled');
			}
		}

		// Full Screen
		function FullScreen() {
			this.el = null;

			this.init = function() {
				var s = this;
				this.element = self.el[0];

				$('<a></a>').attr('href', '#').attr('href', '#').addClass('mapplic-fullscreen-button').click(function(e) {
					e.preventDefault();

					if (s.isFull()) s.exitFull();
					else s.goFull();

				}).appendTo(self.container);
			}

			this.goFull = function() {
				if (this.element.requestFullscreen) this.element.requestFullscreen();
				else if(this.element.mozRequestFullScreen) this.element.mozRequestFullScreen();
				else if(this.element.webkitRequestFullscreen) this.element.webkitRequestFullscreen();
				else if(this.element.msRequestFullscreen) this.element.msRequestFullscreen();
			}

			this.exitFull = function() {
				if (document.exitFullscreen) document.exitFullscreen();
				else if(document.mozCancelFullScreen) document.mozCancelFullScreen();
				else if(document.webkitExitFullscreen) document.webkitExitFullscreen();
			}

			this.isFull = function() {
				if (window.innerHeight == screen.height) {
					return true;
				} else {
					return false;
				}
			}
		}

		// Functions
		var processData = function(data) {
			self.data = data;
			var nrlevels = 0;
			var shownLevel;

			self.container = $('<div></div>').addClass('mapplic-container').appendTo(self.el);
			self.map = $('<div></div>').addClass('mapplic-map').appendTo(self.container);
			if (self.o.zoom) self.map.addClass('mapplic-zoomable');

			self.levelselect = $('<select></select>').addClass('mapplic-levels-select');

			if (!self.o.sidebar) self.container.css('width', '100%');

			self.contentWidth = parseInt(data.mapwidth);
			self.contentHeight = parseInt(data.mapheight);

			self.hw_ratio = data.mapheight / data.mapwidth;

			self.map.css({
				'width': data.mapwidth,
				'height': data.mapheight
			});

			// Create minimap
			if (self.o.minimap) {
				self.minimap = new Minimap();
				self.minimap.init();
			}

			// Create sidebar
			if (self.o.sidebar) {
				self.sidebar = new Sidebar();
				self.sidebar.init();
				self.sidebar.addCategories(data.categories);
			}

			// Iterate through levels
			if (data.levels) {
				$.each(data.levels, function(index, value) {
					var source = value.map;
					var extension = source.substr((source.lastIndexOf('.') + 1)).toLowerCase();

					// Create new map layer
					var layer = $('<div></div>').addClass('mapplic-layer').addClass(value.id).hide().appendTo(self.map);
					switch (extension) {

						// Image formats
						case 'jpg': case 'jpeg': case 'png': case 'gif':
							$('<img>').attr('src', source).addClass('mapplic-map-image').appendTo(layer);
							break;

						// Vector format
						case 'svg':
							$('<div></div>').addClass('mapplic-map-image').load(source, function() {
								// setting up the location on the map
								$(self.o.selector, this).each(function() {
									var location = getLocationData($(this).attr('id')); 
									if (location) {
										$(this).attr('class', 'mapplic-clickable');
										location.onmap = $(this);

										if (location.fill) {
											$(this).css('fill', location.fill);
											$('path', this).css('fill', location.fill);
										}

										// Landmark mode
										if (self.o.landmark === location.id) $(this).attr('class', 'mapplic-active'); 
									}
								});

								// click event
								$(self.o.selector).on('click touchend', function() {
									if (!self.dragging) {
										var id = $(this).attr('id');
										showLocation(id, 600);
									}
								});

								// Support for the old map format
								$('svg a', this).each(function() {
									var location = getLocationData($(this).attr('xlink:href').substr(1)); 
									if (location) {
										$(this).attr('class', 'mapplic-clickable');
										location.onmap = $(this);
									}
								});

								$('svg a', this).click(function(e) {
									var id = $(this).attr('xlink:href').substr(1);
									showLocation(id, 600);
									e.preventDefault();
								});
							}).appendTo(layer);
							break;

						// Other 
						default:
							alert('File type ' + extension + ' is not supported!');
					}

					// Create new minimap layer
					if (self.minimap) self.minimap.addLayer(value);

					// Build layer control
					self.levelselect.prepend($('<option></option>').attr('value', value.id).text(value.title));

					if (!shownLevel || value.show) {
						shownLevel = value.id;
					}
					
					// Iterate through locations
					$.each(value.locations, function(index, value) {
						var top = value.y * 100;
						var left = value.x * 100;

						if (value.pin != 'hidden') {
							if (self.o.markers) {
								var target = '#';
								if (value.action == 'redirect') target = value.link;

								var pin = $('<a></a>').attr('href', target).addClass('mapplic-pin').css({'top': top + '%', 'left': left + '%'}).appendTo(layer);
								pin.on('click touchend', function(e) {
									e.preventDefault();
									showLocation(value.id, 600);
								});
								if (value.fill) pin.css('background-color', value.fill);
								pin.attr('data-location', value.id);
								pin.addClass(value.pin);
							}
						}

						if (self.sidebar) self.sidebar.addLocation(value);
					});

					nrlevels++;
				});
			}

			// COMPONENTS

			// Tooltip
			self.tooltip = new Tooltip();
			self.tooltip.init();

			// Hover Tooltip
			if (self.o.hovertip) {
				self.hovertip = new HoverTooltip();
				self.hovertip.init();
			}
			
			// Developer tools
			if (self.o.developer) self.devtools = new DevTools().init();

			// Clear button
			if (self.o.clearbutton) self.clearbutton = new ClearButton().init();

			// Zoom buttons
			if (self.o.zoombuttons) {
				self.zoombuttons = new ZoomButtons();
				self.zoombuttons.init();
				if (!self.o.clearbutton) self.zoombuttons.el.css('bottom', '0');
			}

			// Fullscreen
			if (self.o.fullscreen) self.fullscreen = new FullScreen().init();

			// Levels
			if (nrlevels > 1) {
				self.levels = $('<div></div>').addClass('mapplic-levels');
				var up = $('<a href="#"></a>').addClass('mapplic-levels-up').appendTo(self.levels);
				self.levelselect.appendTo(self.levels);
				var down = $('<a href="#"></a>').addClass('mapplic-levels-down').appendTo(self.levels);
				self.container.append(self.levels);
			
				self.levelselect.change(function() {
					var value = $(this).val();
					switchLevel(value);
				});
			
				up.click(function(e) {
					e.preventDefault();
					if (!$(this).hasClass('mapplic-disabled')) switchLevel('+');
				});

				down.click(function(e) {
					e.preventDefault();
					if (!$(this).hasClass('mapplic-disabled')) switchLevel('-');
				});
			}
			switchLevel(shownLevel);

			// Browser resize
			$(window).resize(function() {				
				// Mobile
				if ($(window).width() < 668) {
					self.container.height($(window).height() - 66);
				}
				else self.container.height('100%');

				var wr = self.container.width() / self.contentWidth,
					hr = self.container.height() / self.contentHeight;

				if (self.o.mapfill) {
					if (wr > hr) self.fitscale = wr;
					else self.fitscale = hr;
				}
				else {
					if (wr < hr) self.fitscale = wr;
					else self.fitscale = hr;
				}

				self.scale = normalizeScale(self.scale);
				self.x = normalizeX(self.x);
				self.y = normalizeY(self.y);

				moveTo(self.x, self.y, self.scale, 100);

			}).resize();

			// Landmark mode
			if (self.o.landmark) {
				showLocation(self.o.landmark, 0);
			}
			else {
				zoomTo(0.5, 0.5, 1, 0);
			}

			// Deeplinking
			if (self.o.deeplinking) {
				if (history.pushState) self.deeplinking = new Deeplinking();
				else self.deeplinking = new DeeplinkingHash();

				self.deeplinking.init();
			}

			// Controls
			if (self.o.zoom) addControls();
		}

		var addControls = function() {
			var map = self.map,
				mapbody = $('.mapplic-map-image', self.map);

			document.ondragstart = function() { return false; } // IE drag fix

			// Drag & drop
			mapbody.on('mousedown', function(event) {
				self.dragging = false;
				map.stop();

				map.data('mouseX', event.pageX);
				map.data('mouseY', event.pageY);
				map.data('lastX', self.x);
				map.data('lastY', self.y);

				map.addClass('mapplic-dragging');

				self.map.on('mousemove', function(event) {
					self.dragging = true;

					var x = event.pageX - map.data('mouseX') + self.x;
						y = event.pageY - map.data('mouseY') + self.y;

					x = normalizeX(x);
					y = normalizeY(y);

					moveTo(x, y);
					map.data('lastX', x);
					map.data('lastY', y);
				});
			
				$(document).on('mouseup', function(event) {
					self.x = map.data('lastX');
					self.y = map.data('lastY');

					self.map.off('mousemove');
					$(document).off('mouseup');

					map.removeClass('mapplic-dragging');
				});
			});

			// Double click
			$(document).on('dblclick', '.mapplic-map-image', function(event) {
				event.preventDefault();

				var scale = self.scale;
				self.scale = normalizeScale(scale * 2);

				self.x = normalizeX(self.x - (event.pageX - self.container.offset().left - self.x) * (self.scale/scale - 1));
				self.y = normalizeY(self.y - (event.pageY - self.container.offset().top - self.y) * (self.scale/scale - 1));

				moveTo(self.x, self.y, self.scale, 400, 'easeInOutCubic');
			});

			// Mousewheel
			$('.mapplic-layer', self.el).bind('mousewheel DOMMouseScroll', function(event, delta) {
				event.preventDefault();

				var scale = self.scale;
				self.scale = normalizeScale(scale + scale * delta/5);

				self.x = normalizeX(self.x - (event.pageX - self.container.offset().left - self.x) * (self.scale/scale - 1));
				self.y = normalizeY(self.y - (event.pageY - self.container.offset().top - self.y) * (self.scale/scale - 1));

				moveTo(self.x, self.y, self.scale, 200, 'easeOutCubic');
			});

			// Touch support
			if (!('ontouchstart' in window || 'onmsgesturechange' in window)) return true;
			mapbody.on('touchstart', function(e) {
				self.dragging = false;

				var orig = e.originalEvent,
					pos = map.position();

				map.data('touchY', orig.changedTouches[0].pageY - pos.top);
				map.data('touchX', orig.changedTouches[0].pageX - pos.left);

				mapbody.on('touchmove', function(e) {
					e.preventDefault();
					self.dragging = true;

					var orig = e.originalEvent;
					var touches = orig.touches.length;

					if (touches == 1) {
						self.x = normalizeX(orig.changedTouches[0].pageX - map.data('touchX'));
						self.y = normalizeY(orig.changedTouches[0].pageY - map.data('touchY'));

						moveTo(self.x, self.y, self.scale, 50);
					}
					else {
						mapbody.off('touchmove');
					}
				});

				mapbody.on('touchend', function(e) {
					mapbody.off('touchmove touchend');
				});
			});
			
			// Pinch zoom
			var hammer = new Hammer(self.map[0], {
				transform_always_block: true,
				drag_block_horizontal: true,
				drag_block_vertical: true
			});

			/* hammer fix */
			self.map.on('touchstart', function(e) {
				if (e.originalEvent.touches.length > 1) hammer.get('pinch').set({ enable: true });
			});

			self.map.on('touchend', function(e) {
				hammer.get('pinch').set({ enable: false });
			});
			/* hammer fix ends */

			var scale=1, last_scale;
			hammer.on('pinchstart', function(e) {
				self.dragging = false;

				scale = self.scale / self.fitscale;
				last_scale = scale;
			});

			hammer.on('pinch', function(e) {
				self.dragging = true;

				if (e.scale != 1) scale = Math.max(1, Math.min(last_scale * e.scale, 100));
				
				var oldscale = self.scale;
				self.scale = normalizeScale(scale * self.fitscale);

				self.x = normalizeX(self.x - (e.center.x - self.container.offset().left - self.x) * (self.scale/oldscale - 1));
				self.y = normalizeY(self.y - (e.center.y - self.y) * (self.scale/oldscale - 1)); // - self.container.offset().top

				moveTo(self.x, self.y, self.scale, 100);
			});
		}

		var switchLevel = function(target, tooltip) {
			switch (target) {
				case '+':
					target = $('option:selected', self.levelselect).removeAttr('selected').prev().prop('selected', 'selected').val();
					break;
				case '-':
					target = $('option:selected', self.levelselect).removeAttr('selected').next().prop('selected', 'selected').val();
					break;
				default:
					$('option[value="' + target + '"]', self.levelselect).prop('selected', 'selected');
			}

			var layer = $('.mapplic-layer.' + target, self.map);

			// Target layer is active
			if (layer.is(':visible')) return;

			// Hide Tooltip
			if (!tooltip) self.tooltip.hide();

			// Show target layer
			$('.mapplic-layer:visible', self.map).hide();
			layer.show();

			// Show target minimap layer
			if (self.minimap) self.minimap.show(target);

			// Update control
			var index = self.levelselect.get(0).selectedIndex,
				up = $('.mapplic-levels-up', self.levels),
				down = $('.mapplic-levels-down', self.levels);

			up.removeClass('mapplic-disabled');
			down.removeClass('mapplic-disabled');
			if (index == 0) {
				up.addClass('mapplic-disabled');
			}
			else if (index == self.levelselect.get(0).length - 1) {
				down.addClass('mapplic-disabled');
			}
		}

		var getLocationData = function(id) {
			var data = null;
			$.each(self.data.levels, function(index, layer) {
				$.each(layer.locations, function(index, value) {
					if (value.id == id) {
						data = value;
					}
				});
			});
			return data;
		}

		var showLocation = function(id, duration, check) {
			$.each(self.data.levels, function(index, layer) {
				if (layer.id == id) {
					switchLevel(layer.id, false);

					return false;
				}
				$.each(layer.locations, function(index, location) {
					if (location.id == id) {
						var ry = 0.5;

						if (!self.o.landmark) {
							self.tooltip.set(location);
							self.tooltip.show(location);
							ry = ((self.container.height() - self.tooltip.drop) / 2 + self.tooltip.drop) / self.container.height();
						}
						var zoom = typeof location.zoom !== 'undefined' ? location.zoom : 4;

						switchLevel(layer.id, true);

						zoomTo(location.x, location.y, zoom, duration, 'easeInOutCubic', ry);

						$('.mapplic-active', self.el).attr('class', 'mapplic-clickable');
						if (location.onmap) location.onmap.attr('class', 'mapplic-active');

						if ((self.o.deeplinking) && (!check)) self.deeplinking.update(id);

						return false;
					}
				});
			});
		};

		var normalizeX = function(x) {
			var minX = self.container.width() - self.contentWidth * self.scale;

			if (minX < 0) {
				if (x > 0) x = 0;
				else if (x < minX) x = minX;
			}
			else x = minX/2;

			return x;
		}

		var normalizeY = function(y) {
			var minY = self.container.height() - self.contentHeight * self.scale;

			if (minY < 0) {
				if (y >= 0) y = 0;
				else if (y < minY) y = minY;
			}
			else y = minY/2;

			return y;
		}

		var normalizeScale = function(scale) {
			if (scale < self.fitscale) scale = self.fitscale;
			else if (scale > self.o.maxscale) scale = self.o.maxscale;

			if (self.zoombuttons) self.zoombuttons.update(scale);

			return scale;
		}

		var zoomTo = function(x, y, s, duration, easing, ry) {
			duration = typeof duration !== 'undefined' ? duration : 400;
			ry = typeof ry !== 'undefined' ? ry : 0.5;

			self.scale = normalizeScale(self.fitscale * s);

			self.x = normalizeX(self.container.width() * 0.5 - self.scale * self.contentWidth * x);
			self.y = normalizeY(self.container.height() * ry - self.scale * self.contentHeight * y);

			moveTo(self.x, self.y, self.scale, duration, easing);
		}

		var moveTo = function(x, y, scale, d, easing) {
			if (scale !== undefined) {
				self.map.stop().animate({
					'left': x,
					'top': y,
					'width': self.contentWidth * scale,
					'height': self.contentHeight * scale
				}, d, easing, function() {
					if (self.tooltip) self.tooltip.position();
				});
			}
			else {
				self.map.css({
					'left': x,
					'top': y
				});
			}
			if (self.tooltip) self.tooltip.position();
			if (self.minimap) self.minimap.update(x, y);
		}
	};

	//  Create a jQuery plugin
	$.fn.mapplic = function(params) {
		var len = this.length;

		return this.each(function(index) {
			var me = $(this),
				key = 'mapplic' + (len > 1 ? '-' + ++index : ''),
				instance = (new Mapplic).init(me, params);
		});
	};

})(jQuery);