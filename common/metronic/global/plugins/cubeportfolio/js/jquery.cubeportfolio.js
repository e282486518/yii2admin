/*!
 * Cube Portfolio - Responsive jQuery Grid Plugin
 *
 * version: 3.5.2 (11 February, 2016)
 * require: jQuery v1.7+
 *
 * Copyright 2013-2016, Mihai Buricea (http://scriptpie.com/cubeportfolio/live-preview/)
 * Licensed under CodeCanyon License (http://codecanyon.net/licenses)
 *
 */

(function($, window, document, undefined) {
    'use strict';

    function CubePortfolio(obj, options, callback) {
        /*jshint validthis: true */
        var t = this,
            initialCls = 'cbp',
            children;

        if ($.data(obj, 'cubeportfolio')) {
            throw new Error('cubeportfolio is already initialized. Destroy it before initialize again!');
        }

        // attached this instance to obj
        $.data(obj, 'cubeportfolio', t);

        // extend options
        t.options = $.extend({}, $.fn.cubeportfolio.options, options);

        // store the state of the animation used for filters
        t.isAnimating = true;

        // default filter for plugin
        t.defaultFilter = t.options.defaultFilter;

        // registered events (observator & publisher pattern)
        t.registeredEvents = [];

        // queue for this plugin
        t.queue = [];

        // has wrapper
        t.addedWrapp = false;

        // register callback function
        if ($.isFunction(callback)) {
            t.registerEvent('initFinish', callback, true);
        }

        // js element
        t.obj = obj;

        // jquery element
        t.$obj = $(obj);

        // when there are no .cbp-item
        children = t.$obj.children();

        // if caption is active
        if (t.options.caption) {
            if (t.options.caption !== 'expand' && !CubePortfolio.private.modernBrowser) {
                t.options.caption = 'minimal';
            }

            // .cbp-caption-active is used only for css
            // so it will not generate a big css from sass if a caption is set
            initialCls += ' cbp-caption-active cbp-caption-' + t.options.caption;
        }

        t.$obj.addClass(initialCls);

        if (children.length === 0 || children.first().hasClass('cbp-item')) {
            t.wrapInner(t.obj, 'cbp-wrapper');
            t.addedWrapp = true;
        }

        // jquery wrapper element
        t.$ul = t.$obj.children().addClass('cbp-wrapper');

        // wrap the $ul in a outside wrapper
        t.wrapInner(t.obj, 'cbp-wrapper-outer');

        t.wrapper = t.$obj.children('.cbp-wrapper-outer');

        t.blocks = t.$ul.children('.cbp-item');
        t.blocksOn = t.blocks;

        // wrap .cbp-item-wrap div inside .cbp-item
        t.wrapInner(t.blocks, 'cbp-item-wrapper');

        // register and initialize plugins
        t.plugins = $.map(CubePortfolio.plugins, function(pluginName) {
            return pluginName(t);
        });

        // used by the filters plugin. @todo - remove from here and create proper API with position for plugins
        t.triggerEvent('afterPlugins');

        // wait to load all images and then go further
        t.loadImages(t.$obj, t.display);
    }


    $.extend(CubePortfolio.prototype, {
        storeData: function(blocks, indexStart) {
            var t = this;

            indexStart = indexStart || 0; // used by loadMore

            blocks.each(function(index, el) {
                var item = $(el),
                    width = item.width(),
                    height = item.height();

                item.data('cbp', {
                    index: indexStart + index, // used when I sort the items and I need them to revert that sorting
                    wrapper: item.children('.cbp-item-wrapper'),

                    widthInitial: width,
                    heightInitial: height,

                    width: width, // used by drag & drop wp @todo - maybe I will use widthAndGap
                    height: height,

                    widthAndGap: width + t.options.gapVertical,
                    heightAndGap: height + t.options.gapHorizontal,

                    left: null,
                    leftNew: null,
                    top: null,
                    topNew: null,

                    pack: false,
                });
            });
        },


        // http://bit.ly/pure-js-wrap
        wrapInner: function(items, classAttr) {
            var t = this,
                item, i, div;

            classAttr = classAttr || '';

            if (items.length && items.length < 1) {
                return; // there are no .cbp-item
            } else if (items.length === undefined) {
                items = [items];
            }

            for (i = items.length - 1; i >= 0; i--) {
                item = items[i];

                div = document.createElement('div');

                div.setAttribute('class', classAttr);

                while (item.childNodes.length) {
                    div.appendChild(item.childNodes[0]);
                }

                item.appendChild(div);
            }
        },

        removeAttrImage: function(img) {
            img.removeAttribute('width');
            img.removeAttribute('height');
            img.removeAttribute('style');
        },


        /**
         * Wait to load all images
         */
        loadImages: function(elems, callback) {
            var t = this;

            // wait a frame (Safari bug)
            requestAnimationFrame(function() {
                var src = elems.find('img').map(function(index, el) {
                    // don't wait for images that have a width & height defined
                    if (el.hasAttribute('width') && el.hasAttribute('height')) {
                        el.style.width = el.getAttribute('width') + 'px';
                        el.style.height = el.getAttribute('height') + 'px';

                        if (el.hasAttribute('data-cbp-src')) {
                            return null;
                        }

                        if (t.checkSrc(el.src) === null) {
                            t.removeAttrImage(el);
                        } else {
                            $('<img>').on('load.cbp error.cbp', function() {
                                t.removeAttrImage(el);
                            }).attr('src', el.src); // for ie8
                        }

                        return null;
                    } else {
                        return t.checkSrc(el.src);
                    }
                });

                var srcLength = src.length;

                if (srcLength === 0) {
                    callback.call(t);
                    return;
                }

                $.each(src, function(i, el) {
                    $('<img>').on('load.cbp error.cbp', function() {
                        srcLength--;

                        if (srcLength === 0) {
                            callback.call(t);
                        }
                    }).attr('src', el); // for ie8
                });
            });
        },


        checkSrc: function(src) {
            if (src === '') {
                return null;
            }

            var img = new Image();
            img.src = src;

            if (img.complete && img.naturalWidth !== undefined && img.naturalWidth !== 0) {
                return null;
            }

            return src;
        },


        /**
         * Show the plugin
         */
        display: function() {
            var t = this;

            // store main container width
            t.width = t.$obj.outerWidth();

            // store to data values of t.blocks
            t.storeData(t.blocks);

            t.triggerEvent('initStartRead');
            t.triggerEvent('initStartWrite');

            // make layout
            t.layoutAndAdjustment();

            t.triggerEvent('initEndRead');
            t.triggerEvent('initEndWrite');

            // plugin is ready to show and interact
            t.$obj.addClass('cbp-ready');

            t.runQueue('delayFrame', t.delayFrame);
        },


        delayFrame: function() {
            var t = this;

            requestAnimationFrame(function() {
                t.resizeEvent();

                t.triggerEvent('initFinish');

                // animating is now false
                t.isAnimating = false;

                // trigger public event initComplete
                t.$obj.trigger('initComplete.cbp');
            });
        },


        /**
         * Add resize event when browser width changes
         */
        resizeEvent: function() {
            var t = this,
                gridWidth;

            CubePortfolio.private.initResizeEvent({
                instance: t,
                fn: function() {
                    var tt = this;

                    // used by wp fullWidth force option
                    tt.triggerEvent('beforeResizeGrid');

                    gridWidth = tt.$obj.outerWidth();

                    if (tt.width !== gridWidth) {

                        if (tt.options.gridAdjustment === 'alignCenter') {
                            tt.wrapper[0].style.maxWidth = '';
                        }

                        // update the current grid width
                        tt.width = gridWidth;

                        // reposition the blocks with gridAdjustment set to true
                        tt.layoutAndAdjustment();

                        tt.triggerEvent('resizeGrid');
                    }

                    tt.triggerEvent('resizeWindow');
                }
            });
        },


        gridAdjust: function() {
            var t = this;

            // if responsive
            if (t.options.gridAdjustment === 'responsive') {
                t.responsiveLayout();
            } else {
                // reset the style attribute for all blocks so I can read a new width & height
                // for the current grid width. This is usefull for the styles defined in css
                // to create a custom responsive system.
                // Note: reset height if it was set for addHeightToBlocks
                t.blocks.removeAttr('style');

                t.blocks.each(function(index, el) {
                    var data = $(el).data('cbp'),
                        bound = el.getBoundingClientRect(),
                        width = t.columnWidthTruncate(bound.right - bound.left),
                        height = Math.round(bound.bottom - bound.top);

                    data.height = height;
                    data.heightAndGap = height + t.options.gapHorizontal;

                    data.width = width;
                    data.widthAndGap = width + t.options.gapVertical;
                });

                t.widthAvailable = t.width + t.options.gapVertical;
            }

            // used by slider layoutMode
            t.triggerEvent('gridAdjust');
        },


        layoutAndAdjustment: function() {
            var t = this;

            t.gridAdjust();

            t.layout();
        },


        /**
         * Build the layout
         */
        layout: function() {
            var t = this;

            t.computeBlocks(t.filterConcat(t.defaultFilter));

            if (t.options.layoutMode === 'slider') {
                t.sliderLayoutReset();
                t.sliderLayout();
            } else {
                t.mosaicLayoutReset();
                t.mosaicLayout();
            }


            // positionate the blocks
            t.positionateItems();

            // resize main container height
            t.resizeMainContainer();
        },


        computeFilter: function(expression) {
            var t = this;

            t.computeBlocks(expression);

            t.mosaicLayoutReset();
            t.mosaicLayout();

            // filter call layout
            t.filterLayout();
        },


        /**
         *  Default filter layout if nothing overrides
         */
        filterLayout: function() {
            var t = this;

            t.blocksOff.addClass('cbp-item-off');

            t.blocksOn.removeClass('cbp-item-off')
                .each(function(index, el) {
                    var data = $(el).data('cbp');

                    data.left = data.leftNew;
                    data.top = data.topNew;

                    el.style.left = data.left + 'px';
                    el.style.top = data.top + 'px';
                });

            // resize main container height
            t.resizeMainContainer();

            t.filterFinish();
        },


        /**
         *  Trigger when a filter is finished
         */
        filterFinish: function() {
            var t = this;

            // if blocks are sorted (the index ascending is broken) revert
            // this state so the index is ascending again
            if (t.blocksAreSorted) {
                t.sortBlocks(t.blocks, 'index');
            }

            t.isAnimating = false;

            t.$obj.trigger('filterComplete.cbp');
            t.triggerEvent('filterFinish');
        },


        computeBlocks: function(expression) {
            var t = this;

            // blocks that are visible before applying the filter
            t.blocksOnInitial = t.blocksOn;

            // blocks visible after applying the filter
            t.blocksOn = t.blocks.filter(expression);

            // blocks off after applying the filter
            t.blocksOff = t.blocks.not(expression);

            t.triggerEvent('computeBlocksFinish', expression);
        },


        /**
         * Make this plugin responsive
         */
        responsiveLayout: function() {
            var t = this;

            // calculate numbers of cols
            t.cols = t[($.isArray(t.options.mediaQueries) ? 'getColumnsBreakpoints' : 'getColumnsAuto')]();

            t.columnWidth = t.columnWidthTruncate((t.width + t.options.gapVertical) / t.cols);

            t.widthAvailable = t.columnWidth * t.cols;

            if (t.options.layoutMode === 'mosaic') {
                t.getMosaicWidthReference();
            }

            t.blocks.each(function(index, el) {
                var data = $(el).data('cbp'),
                    cols = 1, // grid & slider layoutMode must be 1
                    width;

                if (t.options.layoutMode === 'mosaic') {
                    cols = t.getColsMosaic(data.widthInitial);
                }

                width = t.columnWidth * cols - t.options.gapVertical;

                el.style.width = width + 'px';
                data.width = width;
                data.widthAndGap = width + t.options.gapVertical;

                // reset height if it was set for addHeightToBlocks
                el.style.height = '';
            });

            var imgs = [];

            t.blocks.each(function(index, el) {
                var block = $(el),
                    width = block.data('cbp').width;

                $.each(block.find('img').filter('[width][height]'), function(index, el) {
                    var procent = width / parseInt(el.getAttribute('width'), 10);

                    imgs.push({
                        el: el,
                        width: width,
                        height: Math.floor(parseInt(el.getAttribute('height'), 10) * procent),
                    });
                });
            });

            $.each(imgs, function(index, item) {
                 item.el.width = item.width;
                 item.el.height = item.height;
                 item.el.style.width = item.width + 'px';
                 item.el.style.height = item.height + 'px';
            });

            t.blocks.each(function(index, el) {
                var data = $(el).data('cbp'),
                    bound = el.getBoundingClientRect(),
                    height = Math.round(bound.bottom - bound.top);

                data.height = height;
                data.heightAndGap = height + t.options.gapHorizontal;
            });
        },


        getMosaicWidthReference: function() {
            var t = this,
                arrWidth = [];

            t.blocks.each(function(index, el) {
                var data = $(el).data('cbp');
                arrWidth.push(data.widthInitial);
            });

            arrWidth.sort(function(a, b) {
                return a - b;
            });

            if (arrWidth[0]) {
                t.mosaicWidthReference = arrWidth[0];
            } else {
                t.mosaicWidthReference = t.columnWidth;
            }
        },


        getColsMosaic: function(widthInitial) {
            var t = this;

            if (widthInitial === t.width) {
                return t.cols;
            }

            var ratio = widthInitial / t.mosaicWidthReference;

            if (ratio % 1 >= 0.79) {
                ratio = Math.ceil(ratio);
            } else {
                ratio = Math.floor(ratio);
            }

            return Math.min(Math.max(ratio, 1), t.cols);
        },


        /**
         * Get numbers of columns when t.options.mediaQueries is not an array
         */
        getColumnsAuto: function() {
            var t = this;

            if (t.blocks.length === 0) {
                return 1;
            }

            var columnWidth = t.blocks.first().data('cbp').widthInitial + t.options.gapVertical;

            return Math.max(Math.round(t.width / columnWidth), 1);
        },


        /**
         * Get numbers of columns if t.options.mediaQueries is an array
         */
        getColumnsBreakpoints: function() {
            var t = this,
                gridWidth = t.width,
                columns;

            $.each(t.options.mediaQueries, function(index, val) {
                if (gridWidth >= val.width) {
                    columns = val.cols;
                    return false;
                }
            });

            if (columns === undefined) {
                columns = t.options.mediaQueries[t.options.mediaQueries.length - 1].cols;
            }

            return columns;
        },


        /**
         *  Defines how the columns dimension & position (width, left) will be truncated
         *
         *  If you use `Math.*` there could be some issues with the items on the right side
         *  that can have some pixels hidden(1 or 2, depends on the number of columns)
         *  but this is a known limitation.
         *
         *  If you don't use the built-in captions effects (overlay at hover over an item) returning
         *  the possibly floated values may be a solution for the pixels hidden on the right side.
         *
         *  The column width must be an integer because browsers have some visual issues
         *  with transform properties for caption effects.
         *
         *  The initial behaviour was return Math.floor
         *
         */
        columnWidthTruncate: function(value) {
            return Math.floor(value);
        },


        positionateItems: function() {
            var t = this,
                data;

            t.blocksOn.removeClass('cbp-item-off')
                .each(function(index, el) {
                    data = $(el).data('cbp');

                    data.left = data.leftNew;
                    data.top = data.topNew;

                    el.style.left = data.left + 'px';
                    el.style.top = data.top + 'px';
                });

            t.blocksOff.addClass('cbp-item-off');

            // if blocks are sorted (the index ascending is broken) revert
            // this state so the index is ascending again
            if (t.blocksAreSorted) {
                t.sortBlocks(t.blocks, 'index');
            }
        },


        /**
         * Resize main container vertically
         */
        resizeMainContainer: function() {
            var t = this,
                height = Math.max(t.freeSpaces.slice(-1)[0].topStart - t.options.gapHorizontal, 0),
                maxWidth;

            // set max-width to center the grid if I need to
            if (t.options.gridAdjustment === 'alignCenter') {
                maxWidth = 0;

                t.blocksOn.each(function(index, el) {
                    var data = $(el).data('cbp'),
                        rightEdge = data.left + data.width;

                    if (rightEdge > maxWidth) {
                        maxWidth = rightEdge;
                    }
                });

                t.wrapper[0].style.maxWidth = maxWidth + 'px';
            }

            // set container height for `overflow: hidden` to be applied
            if (height === t.height) {
                t.triggerEvent('resizeMainContainer');
                return;
            }

            t.obj.style.height = height + 'px';

            // if resizeMainContainer is called for the first time skip this event trigger
            if (t.height !== undefined) {
                if (CubePortfolio.private.modernBrowser) {
                    t.$obj.one(CubePortfolio.private.transitionend, function() {
                        t.$obj.trigger('pluginResize.cbp');
                    });
                } else {
                    t.$obj.trigger('pluginResize.cbp');
                }
            }

            t.height = height;

            t.triggerEvent('resizeMainContainer');
        },


        filterConcat: function(filter) {
            return filter.replace(/\|/gi, '');
        },


        pushQueue: function(name, deferred) {
            var t = this;

            t.queue[name] = t.queue[name] || [];
            t.queue[name].push(deferred);
        },


        runQueue: function(name, fn) {
            var t = this,
                queue = t.queue[name] || [];

            $.when.apply($, queue).then($.proxy(fn, t));
        },


        clearQueue: function(name) {
            var t = this;

            t.queue[name] = [];
        },


        /**
         *  Register event
         */
        registerEvent: function(name, callbackFunction, oneTime) {
            var t = this;

            if (!t.registeredEvents[name]) {
                t.registeredEvents[name] = [];
            }

            t.registeredEvents[name].push({
                func: callbackFunction,
                oneTime: oneTime || false
            });
        },


        /**
         *  Trigger event
         */
        triggerEvent: function(name, param) {
            var t = this,
                i, len;

            if (t.registeredEvents[name]) {
                for (i = 0, len = t.registeredEvents[name].length; i < len; i++) {
                    t.registeredEvents[name][i].func.call(t, param);

                    if (t.registeredEvents[name][i].oneTime) {
                        t.registeredEvents[name].splice(i, 1);
                        // function splice change the t.registeredEvents[name] array
                        // if event is one time you must set the i to the same value
                        // next time and set the length lower
                        i--;
                        len--;
                    }
                }
            }
        },


        addItems: function(items, callback) {
            var t = this;

            // wrap .cbp-item-wrap div inside .cbp-item
            t.wrapInner(items, 'cbp-item-wrapper');

            items.addClass('cbp-item-loading').css({
                top: '100%',
                left: 0
            }).appendTo(t.$ul);

            if (CubePortfolio.private.modernBrowser) {
                items.last().one(CubePortfolio.private.animationend, function() {
                    t.addItemsFinish(items, callback);
                });
            } else {
                t.addItemsFinish(items, callback); // @todo - on ie8 & ie9 callback trigger to early
            }

            t.loadImages(items, function() {
                t.$obj.addClass('cbp-addItems');

                // push to data values of items
                t.storeData(items, t.blocks.length);

                // push the new items to t.blocks
                $.merge(t.blocks, items);

                t.triggerEvent('addItemsToDOM', items);

                t.layoutAndAdjustment();

                // if show count was actived, call show count function again
                if (t.elems) {
                    CubePortfolio.public.showCounter.call(t.obj, t.elems);
                }

                t.triggerEvent('appendItemsFinish');
            });
        },


        addItemsFinish: function(items, callback) {
            var t = this;

            t.isAnimating = false;

            t.$obj.removeClass('cbp-addItems');
            items.removeClass('cbp-item-loading');

            if ($.isFunction(callback)) {
                callback.call(t, items);
            }
        }
    });


    /**
     * jQuery plugin initializer
     */
    $.fn.cubeportfolio = function(method, options, callback) {
        return this.each(function() {
            if (typeof method === 'object' || !method) {
                return CubePortfolio.public.init.call(this, method, options);
            } else if (CubePortfolio.public[method]) {
                return CubePortfolio.public[method].call(this, options, callback);
            }

            throw new Error('Method ' + method + ' does not exist on jquery.cubeportfolio.js');
        });
    };

    CubePortfolio.plugins = {};
    $.fn.cubeportfolio.constructor = CubePortfolio;
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    $.extend(CubePortfolio.prototype, {
        mosaicLayoutReset: function() {
            var t = this;

            // flag to be set after the blocks sorting is done
            t.blocksAreSorted = false;

            // when I start layout all blocks must not be positionated
            t.blocksOn.each(function(index, el) {
                $(el).data('cbp').pack = false;
            });
        },


        mosaicLayout: function() {
            var t = this,
                blocksLen = t.blocksOn.length,
                i, spaceIndexAndBlock = {},
                leftEnd;

            // array of objects where I keep the spaces available in the grid
            t.freeSpaces = [{
                leftStart: 0,
                leftEnd: t.widthAvailable,
                topStart: 0,
                topEnd: Math.pow(2, 18) // @todo - optimize
            }];

            for (i = 0; i < blocksLen; i++) {
                spaceIndexAndBlock = t.getSpaceIndexAndBlock();

                // if space or block are null then the sorting must be done
                if (spaceIndexAndBlock === null) {
                    // sort blocks
                    t.sortBlocksToPreventGaps();

                    // after the sort is done start the layout again
                    t.mosaicLayout();

                    return;
                }

                t.generateF1F2(spaceIndexAndBlock.spaceIndex, spaceIndexAndBlock.dataBlock);

                t.generateG1G2G3G4(spaceIndexAndBlock.dataBlock);

                t.cleanFreeSpaces();

                t.addHeightToBlocks();
            }

            // sort the blocks from top to bottom to add properly displayAnimation and animationType
            if (t.blocksAreSorted) {
                t.sortBlocks(t.blocksOn, 'topNew');
            }
        },


        /**
         * Chose from freeSpaces the best space available
         * Find block by verifying if it can fit in bestSpace(top-left space available)
         * If block don't fit in the first space available & t.options.sortToPreventGaps
         * is set to true then sort the blocks and start the layout once again
         * Decide the free rectangle Fi from F to pack the rectangle R into.
         */
        getSpaceIndexAndBlock: function() {
            var t = this,
                spaceIndexAndBlock = null;

            $.each(t.freeSpaces, function(index1, space) {
                var widthSpace = space.leftEnd - space.leftStart,
                    heightSpace = space.topEnd - space.topStart;

                t.blocksOn.each(function(index2, block) {
                    var data = $(block).data('cbp');

                    if (data.pack === true) {
                        return;
                    }

                    if (data.widthAndGap <= widthSpace && data.heightAndGap <= heightSpace) {
                        // now the rectagle can be positioned
                        data.pack = true;

                        spaceIndexAndBlock = {
                            spaceIndex: index1,
                            dataBlock: data
                        };

                        data.leftNew = space.leftStart;
                        data.topNew = space.topStart;

                        // if the block is founded => return from this loop
                        return false;
                    }
                });

                // if first space don't have a block and sortToPreventGaps is true => return from loop
                if (!t.blocksAreSorted && t.options.sortToPreventGaps && index1 > 0) {
                    spaceIndexAndBlock = null;

                    return false;
                }

                // if space & block is founded => return from loop
                if (spaceIndexAndBlock !== null) {
                    return false;
                }
            });

            return spaceIndexAndBlock;
        },


        /**
         * Use the MAXRECTS split scheme to subdivide Fi(space) into F1 and F2 and
         * then remove that space from spaces
         * Insert F1 & F2 in F in place of Fi
         */
        generateF1F2: function(spaceIndex, block) {
            var t = this,
                space = t.freeSpaces[spaceIndex];

            var F1 = {
                leftStart: space.leftStart + block.widthAndGap,
                leftEnd: space.leftEnd,
                topStart: space.topStart,
                topEnd: space.topEnd
            };

            var F2 = {
                leftStart: space.leftStart,
                leftEnd: space.leftEnd,
                topStart: space.topStart + block.heightAndGap,
                topEnd: space.topEnd
            };

            // remove Fi from F
            t.freeSpaces.splice(spaceIndex, 1);

            if (F1.leftEnd > F1.leftStart && F1.topEnd > F1.topStart) {
                t.freeSpaces.splice(spaceIndex, 0, F1);
                spaceIndex++;
            }

            if (F2.leftEnd > F2.leftStart && F2.topEnd > F2.topStart) {
                t.freeSpaces.splice(spaceIndex, 0, F2);
            }
        },


        /**
         * Generate G1, G2, G3, G4 from intersaction of t.freeSpaces with block
         */
        generateG1G2G3G4: function(block) {
            var t = this;

            var spaces = [];

            $.each(t.freeSpaces, function(index, space) {
                var intersectSpace = t.intersectSpaces(space, block);

                // if block & space are the same push space in spaces and return
                if (intersectSpace === null) {
                    spaces.push(space);
                    return;
                }

                t.generateG1(space, intersectSpace, spaces);
                t.generateG2(space, intersectSpace, spaces);
                t.generateG3(space, intersectSpace, spaces);
                t.generateG4(space, intersectSpace, spaces);
            });

            t.freeSpaces = spaces;
        },


        /**
         * Return the intersected rectagle of Fi and block
         * If the two spaces don't intersect or are the same return null
         */
        intersectSpaces: function(space1, block) {
            var t = this,
                space2 = {
                    leftStart: block.leftNew,
                    leftEnd: block.leftNew + block.widthAndGap,
                    topStart: block.topNew,
                    topEnd: block.topNew + block.heightAndGap,
                };

            if (space1.leftStart === space2.leftStart &&
                space1.leftEnd === space2.leftEnd &&
                space1.topStart === space2.topStart &&
                space1.topEnd === space2.topEnd) {
                return null;
            }

            var leftStart = Math.max(space1.leftStart, space2.leftStart),
                leftEnd = Math.min(space1.leftEnd, space2.leftEnd),
                topStart = Math.max(space1.topStart, space2.topStart),
                topEnd = Math.min(space1.topEnd, space2.topEnd);

            if (leftEnd <= leftStart || topEnd <= topStart) {
                return null;
            }

            return {
                leftStart: leftStart,
                leftEnd: leftEnd,
                topStart: topStart,
                topEnd: topEnd
            };
        },


        /**
         * The top subdivide space
         */
        generateG1: function(space, intersectSpace, spaces) {
            if (space.topStart === intersectSpace.topStart) {
                return;
            }

            spaces.push({
                leftStart: space.leftStart,
                leftEnd: space.leftEnd,
                topStart: space.topStart,
                topEnd: intersectSpace.topStart
            });
        },


        /**
         * The right subdivide space
         */
        generateG2: function(space, intersectSpace, spaces) {
            if (space.leftEnd === intersectSpace.leftEnd) {
                return;
            }

            spaces.push({
                leftStart: intersectSpace.leftEnd,
                leftEnd: space.leftEnd,
                topStart: space.topStart,
                topEnd: space.topEnd
            });
        },


        /**
         * The bottom subdivide space
         */
        generateG3: function(space, intersectSpace, spaces) {
            if (space.topEnd === intersectSpace.topEnd) {
                return;
            }

            spaces.push({
                leftStart: space.leftStart,
                leftEnd: space.leftEnd,
                topStart: intersectSpace.topEnd,
                topEnd: space.topEnd
            });
        },


        /**
         * The left subdivide space
         */
        generateG4: function(space, intersectSpace, spaces) {
            if (space.leftStart === intersectSpace.leftStart) {
                return;
            }

            spaces.push({
                leftStart: space.leftStart,
                leftEnd: intersectSpace.leftStart,
                topStart: space.topStart,
                topEnd: space.topEnd
            });
        },


        /**
         * For every Fi check if is another Fj so Fj contains Fi
         * @todo - refactor
         */
        cleanFreeSpaces: function() {
            var t = this;

            // sort space from top to bottom and left to right
            t.freeSpaces.sort(function(space1, space2) {
                if (space1.topStart > space2.topStart) {
                    return 1;
                } else if (space1.topStart < space2.topStart) {
                    return -1;
                } else {
                    if (space1.leftStart > space2.leftStart) {
                        return 1;
                    } else if (space1.leftStart < space2.leftStart) {
                        return -1;
                    } else {
                        return 0;
                    }
                }
            });

            t.correctSubPixelValues();

            t.removeNonMaximalFreeSpaces();
        },


        /**
         * If topStart values for spaces are <= 1px then align those spaces
         */
        correctSubPixelValues: function() {
            var t = this,
                i, len, diff, space1, space2;

            for (i = 0, len = t.freeSpaces.length - 1; i < len; i++) {
                space1 = t.freeSpaces[i];
                space2 = t.freeSpaces[i + 1];

                if ((space2.topStart - space1.topStart) <= 1) {
                    space2.topStart = space1.topStart;
                }
            }
        },


        /**
         * Remove spaces that are not maximal
         * If Fi contains Fj then remove Fj from F
         */
        removeNonMaximalFreeSpaces: function() {
            var t = this;

            t.uniqueFreeSpaces();

            t.freeSpaces = $.map(t.freeSpaces, function(space1, index1) {
                $.each(t.freeSpaces, function(index2, space2) {
                    // don't compare the same free spaces
                    if (index1 === index2) {
                        return;
                    }

                    if (space2.leftStart <= space1.leftStart &&
                        space2.leftEnd >= space1.leftEnd &&
                        space2.topStart <= space1.topStart &&
                        space2.topEnd >= space1.topEnd) {

                        space1 = null;
                        return false;
                    }
                });

                return space1;
            });
        },


        /**
         * Remove duplicates spaces from freeSpaces
         */
        uniqueFreeSpaces: function() {
            var t = this,
                result = [];

            $.each(t.freeSpaces, function(index1, space1) {
                $.each(result, function(index2, space2) {
                    if (space2.leftStart === space1.leftStart &&
                        space2.leftEnd === space1.leftEnd &&
                        space2.topStart === space1.topStart &&
                        space2.topEnd === space1.topEnd) {

                        space1 = null;
                        return false;
                    }
                });

                if (space1 !== null) {
                    result.push(space1);
                }
            });

            t.freeSpaces = result;
        },


        /**
         * If freeSpaces have only one space and that space overlap the
         * height of the bottom blocks with 1px cut those blocks
         */
        addHeightToBlocks: function() {
            var t = this;

            if (t.freeSpaces.length > 1) {
                return;
            }

            var topStart = t.freeSpaces[0].topStart;

            t.blocksOn.each(function(index, block) {
                var data = $(block).data('cbp');

                if (data.pack !== true) {
                    return;
                }

                var diff = topStart - data.topNew - data.heightAndGap;

                if (diff < 0) {
                    block.style.height = (data.height + diff) + 'px';
                }
            });
        },


        /**
         * Sort by the longer width first, followed by a comparison of the shorter height
         */
        sortBlocksToPreventGaps: function() {
            var t = this;

            t.blocksAreSorted = true;

            // sort based on timestamp attribute
            t.blocksOn.sort(function(block1, block2) {
                var data1 = $(block1).data('cbp'),
                    data2 = $(block2).data('cbp');

                // order desc by width
                if (data1.widthAndGap < data2.widthAndGap) {
                    return 1;
                } else if (data1.widthAndGap > data2.widthAndGap) {
                    return -1;
                } else {
                    // order desc by height
                    if (data1.heightAndGap < data2.heightAndGap) {
                        return 1;
                    } else if (data1.heightAndGap > data2.heightAndGap) {
                        return -1;
                    } else {
                        // order asc by index
                        if (data1.index > data2.index) {
                            return 1;
                        } else if (data1.index < data2.index) {
                            return -1;
                        }
                    }
                }
            });

            // when I start the layout again all blocks must not be positionated
            // reset height if it was set for addHeightToBlocks
            t.blocksOn.each(function(index, el) {
                $(el).data('cbp').pack = false;
                el.style.height = '';
            });
        },


        /**
         * Generic sort block function from lower to highest values
         */
        sortBlocks: function(blocks, compare) {
            var t = this;

            blocks.sort(function(block1, block2) {
                var data1 = $(block1).data('cbp'),
                    data2 = $(block2).data('cbp');

                // if the items are equally order them from left to right
                if (data1[compare] > data2[compare]) {
                    return 1;
                } else if (data1[compare] < data2[compare]) {
                    return -1;
                } else {
                    if (data1.leftNew > data2.leftNew) {
                        return 1;
                    } else if (data1.leftNew < data2.leftNew) {
                        return -1;
                    } else {
                        return 0;
                    }
                }
            });
        }
    });
})(jQuery, window, document);

// Plugin default options
jQuery.fn.cubeportfolio.options = {
    /**
     *  Define the wrapper for filters
     *  Values: strings that represent the elements in the document (DOM selector).
     */
    filters: '',

    /**
     *  Define the wrapper for loadMore
     *  Values: strings that represent the elements in the document (DOM selector).
     */
    loadMore: '',

    /**
     *  How the loadMore functionality should behave. Load on click on the button or
     *  automatically when you scroll the page
     *  Values: - click
     *          - auto
     */
    loadMoreAction: 'click',

    /**
     *  Define the search input element
     *  Values: strings that represent the element in the document (DOM selector).
     */
    search: '',

    /**
     *  Layout Mode for this instance
     *  Values: 'grid', 'mosaic' or 'slider'
     */
    layoutMode: 'grid',

    /**
     *  Sort the items (bigger to smallest) if there are gaps in grid
     *  Option available only for `layoutMode: 'mosaic'`
     *  Values: true or false
     */
    sortToPreventGaps: false,

    /**
     *  Mouse and touch drag support
     *  Option available only for `layoutMode: 'slider'`
     *  Values: true or false
     */
    drag: true,

    /**
     *  Autoplay the slider
     *  Option available only for `layoutMode: 'slider'`
     *  Values: true or false
     */
    auto: false,

    /**
     *  Autoplay interval timeout. Time is set in milisecconds
     *  1000 milliseconds equals 1 second.
     *  Option available only for `layoutMode: 'slider'`
     *  Values: only integers (ex: 1000, 2000, 5000)
     */
    autoTimeout: 5000,

    /**
     *  Stops autoplay when user hover the slider
     *  Option available only for `layoutMode: 'slider'`
     *  Values: true or false
     */
    autoPauseOnHover: true,

    /**
     *  Show `next` and `prev` buttons for slider
     *  Option available only for `layoutMode: 'slider'`
     *  Values: true or false
     */
    showNavigation: true,

    /**
     *  Show pagination for slider
     *  Option available only for `layoutMode: 'slider'`
     *  Values: true or false
     */
    showPagination: true,

    /**
     *  Enable slide to first item (last item)
     *  Option available only for `layoutMode: 'slider'`
     *  Values: true or false
     */
    rewindNav: true,

    /**
     *  Scroll by page and not by item. This option affect next/prev buttons and drag support
     *  Option available only for `layoutMode: 'slider'`
     *  Values: true or false
     */
    scrollByPage: false,

    /**
     *  Default filter for plugin
     *  Option available only for `layoutMode: 'grid'`
     *  Values: strings that represent the filter name(ex: *, .logo, .web-design, .design)
     */
    defaultFilter: '*',

    /**
     *  Enable / disable the deeplinking feature when you click on filters
     *  Option available only for `layoutMode: 'grid'`
     *  Values: true or false
     */
    filterDeeplinking: false,

    /**
     *  Defines which animation to use for items that will be shown or hidden after a filter has been activated.
     *  Option available only for `layoutMode: 'grid'`
     *  The plugin use the best browser features available (css3 transitions and transform, GPU acceleration).
     *  Values: - fadeOut
     *          - quicksand
     *          - bounceLeft
     *          - bounceTop
     *          - bounceBottom
     *          - moveLeft
     *          - slideLeft
     *          - fadeOutTop
     *          - sequentially
     *          - skew
     *          - slideDelay
     *          - rotateSides
     *          - flipOutDelay
     *          - flipOut
     *          - unfold
     *          - foldLeft
     *          - scaleDown
     *          - scaleSides
     *          - frontRow
     *          - flipBottom
     *          - rotateRoom
     */
    animationType: 'fadeOut',

    /**
     *  Adjust the layout grid
     *  Values: - default (no adjustment applied)
     *          - alignCenter (align the grid on center of the page)
     *          - responsive (use a fluid algorithm to resize the grid)
     */
    gridAdjustment: 'responsive',

    /**
     * Define `media queries` for columns layout.
     * Format: [{width: a, cols: d}, {width: b, cols: e}, {width: c, cols: f}],
     * where a, b, c are the grid width and d, e, f are the columns displayed.
     * e.g. [{width: 1100, cols: 4}, {width: 800, cols: 3}, {width: 480, cols: 2}] means
     * if (gridWidth >= 1100) => show 4 columns,
     * if (gridWidth >= 800 && gridWidth < 1100) => show 3 columns,
     * if (gridWidth >= 480 && gridWidth < 800) => show 2 columns,
     * if (gridWidth < 480) => show 2 columns
     * Keep in mind that a > b > c
     * This option is available only when `gridAdjustment: 'responsive'`
     * Values:  - array of objects of format: [{width: a, cols: d}, {width: b, cols: e}]
     *          - you can define as many objects as you want
     *          - if this option is `false` Cube Portfolio will adjust the items
     *            width automatically (default option for backward compatibility)
     */
    mediaQueries: false,

    /**
     *  Horizontal gap between items
     *  Values: only integers (ex: 1, 5, 10)
     */
    gapHorizontal: 10,

    /**
     *  Vertical gap between items
     *  Values: only integers (ex: 1, 5, 10)
     */
    gapVertical: 10,

    /**
     *  Caption - the overlay that is shown when you put the mouse over an item
     *  NOTE: If you don't want to have captions set this option to an empty string ( caption: '')
     *  Values: - pushTop
     *          - pushDown
     *          - revealBottom
     *          - revealTop
     *          - revealLeft
     *          - moveRight
     *          - overlayBottom
     *          - overlayBottomPush
     *          - overlayBottomReveal
     *          - overlayBottomAlong
     *          - overlayRightAlong
     *          - minimal
     *          - fadeIn
     *          - zoom
     *          - opacity
     *          - ''
     */
    caption: 'pushTop',

    /**
     *  The plugin will display his content based on the following values.
     *  Values: - default (the content will be displayed without any animation)
     *          - fadeIn (the plugin will fully preload the images before displaying the items with a fadeIn effect)
     *          - fadeInToTop (the plugin will fully preload the images before displaying the items with a fadeIn effect from bottom to top)
     *          - sequentially (the plugin will fully preload the images before displaying the items with a sequentially effect)
     *          - bottomToTop (the plugin will fully preload the images before displaying the items with an animation from bottom to top)
     */
    displayType: 'fadeIn',

    /**
     *  Defines the speed of displaying the items (when `displayType == default` this option will have no effect)
     *  Values: only integers, values in ms (ex: 200, 300, 500)
     */
    displayTypeSpeed: 400,

    /**
     *  This is used to define any clickable elements you wish to use to trigger lightbox popup on click.
     *  Values: strings that represent the elements in the document (DOM selector)
     */
    lightboxDelegate: '.cbp-lightbox',

    /**
     *  Enable / disable gallery mode
     *  Values: true or false
     */
    lightboxGallery: true,

    /**
     *  Attribute of the delegate item that contains caption for lightbox
     *  Values: html atributte
     */
    lightboxTitleSrc: 'data-title',

    /**
     *  Markup of the lightbox counter
     *  Values: html markup
     */
    lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',

    /**
     *  This is used to define any clickable elements you wish to use to trigger singlePage popup on click.
     *  Values: strings that represent the elements in the document (DOM selector)
     */
    singlePageDelegate: '.cbp-singlePage',

    /**
     *  Enable / disable the deeplinking feature for singlePage popup
     *  Values: true or false
     */
    singlePageDeeplinking: true,

    /**
     *  Enable / disable the sticky navigation for singlePage popup
     *  Values: true or false
     */
    singlePageStickyNavigation: true,

    /**
     *  Markup of the singlePage counter
     *  Values: html markup
     */
    singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',

    /**
     *  Defines which animation to use when singlePage appear
     *  Values: - left
     *          - fade
     *          - right
     */
    singlePageAnimation: 'left',

    /**
     *  Use this callback to update singlePage content.
     *  The callback will trigger after the singlePage popup will open.
     *  @param url = the href attribute of the item clicked
     *  @param element = the item clicked
     *  Values: function
     */
    singlePageCallback: function(url, element) {
        // to update singlePage content use the following method: this.updateSinglePage(yourContent)
    },

    /**
     *  This is used to define any clickable elements you wish to use to trigger singlePage Inline on click.
     *  Values: strings that represent the elements in the document (DOM selector)
     */
    singlePageInlineDelegate: '.cbp-singlePageInline',

    /**
     *  Enable / disable the deeplinking feature for singlePageInline
     *  Values: true or false
     */
    singlePageInlineDeeplinking: false,

    /**
     *  This is used to define the position of singlePage Inline block
     *  Values: - above ( above current element )
     *          - below ( below current elemnet)
     *          - top ( positon top )
     *          - bottom ( positon bottom )
     */
    singlePageInlinePosition: 'top',

    /**
     *  Push the open panel in focus and at close go back to the former stage
     *  Values: true or false
     */
    singlePageInlineInFocus: true,

    /**
     *  Use this callback to update singlePage Inline content.
     *  The callback will trigger after the singlePage Inline will open.
     *  @param url = the href attribute of the item clicked
     *  @param element = the item clicked
     *  Values: function
     */
    singlePageInlineCallback: function(url, element) {
        // to update singlePage Inline content use the following method: this.updateSinglePageInline(yourContent)
    },

    /**
     *  Used by the plugins registered to set local options for the current instance
     *  Values: object
     */
    plugins: {},
};

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    CubePortfolio.private = {
        // array or objects: {instance: instance, fn: fn}
        resizeEventArray: [],

        initResizeEvent: function(obj) {
            var t = CubePortfolio.private;

            if (t.resizeEventArray.length === 0) {
                t.resizeEvent();
            }

            t.resizeEventArray.push(obj);
        },

        destroyResizeEvent: function(instance) {
            var t = CubePortfolio.private;

            var newResizeEvent = $.map(t.resizeEventArray, function(val, index) {
                if (val.instance !== instance) {
                    return val;
                }
            });

            t.resizeEventArray = newResizeEvent;

            if (t.resizeEventArray.length === 0) {
                // remove off resize event
                $(window).off('resize.cbp');
            }
        },

        resizeEvent: function() {
            var t = CubePortfolio.private,
                timeout;

            // resize
            $(window).on('resize.cbp', function() {
                clearTimeout(timeout);

                timeout = setTimeout(function() {
                    if (window.innerHeight == screen.height) {
                        // this is fulll screen mode. don't need to trigger a resize
                        return;
                    }

                    $.each(t.resizeEventArray, function(index, val) {
                        val.fn.call(val.instance);
                    });
                }, 50);
            });
        },

        /**
         * Check if cubeportfolio instance exists on current element
         */
        checkInstance: function(method) {
            var t = $.data(this, 'cubeportfolio');

            if (!t) {
                throw new Error('cubeportfolio is not initialized. Initialize it before calling ' + method + ' method!');
            }

            t.triggerEvent('publicMethod');

            return t;
        },

        /**
         * Get info about client browser
         */
        browserInfo: function() {
            var t = CubePortfolio.private,
                appVersion = navigator.appVersion,
                transition, animation, perspective;

            if (appVersion.indexOf('MSIE 8.') !== -1) { // ie8
                t.browser = 'ie8';
            } else if (appVersion.indexOf('MSIE 9.') !== -1) { // ie9
                t.browser = 'ie9';
            } else if (appVersion.indexOf('MSIE 10.') !== -1) { // ie10
                t.browser = 'ie10';
            } else if (window.ActiveXObject || 'ActiveXObject' in window) { // ie11
                t.browser = 'ie11';
            } else if ((/android/gi).test(appVersion)) { // android
                t.browser = 'android';
            } else if ((/iphone|ipad|ipod/gi).test(appVersion)) { // ios
                t.browser = 'ios';
            } else if ((/chrome/gi).test(appVersion)) {
                t.browser = 'chrome';
            } else {
                t.browser = '';
            }

            // check if perspective is available
            perspective = t.styleSupport('perspective');

            // if perspective is not available => no modern browser
            if (typeof perspective === undefined) {
                return;
            }

            transition = t.styleSupport('transition');

            t.transitionend = {
                WebkitTransition: 'webkitTransitionEnd',
                transition: 'transitionend'
            }[transition];

            animation = t.styleSupport('animation');

            t.animationend = {
                WebkitAnimation: 'webkitAnimationEnd',
                animation: 'animationend'
            }[animation];

            t.animationDuration = {
                WebkitAnimation: 'webkitAnimationDuration',
                animation: 'animationDuration'
            }[animation];

            t.animationDelay = {
                WebkitAnimation: 'webkitAnimationDelay',
                animation: 'animationDelay'
            }[animation];

            t.transform = t.styleSupport('transform');

            if (transition && animation && t.transform) {
                t.modernBrowser = true;
            }

        },


        /**
         * Feature testing for css3
         */
        styleSupport: function(prop) {
            var supportedProp,
                // capitalize first character of the prop to test vendor prefix
                webkitProp = 'Webkit' + prop.charAt(0).toUpperCase() + prop.slice(1),
                div = document.createElement('div');

            // browser supports standard CSS property name
            if (prop in div.style) {
                supportedProp = prop;
            } else if (webkitProp in div.style) {
                supportedProp = webkitProp;
            }

            // avoid memory leak in IE
            div = null;

            return supportedProp;
        },

    };

    CubePortfolio.private.browserInfo();

})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    CubePortfolio.public = {

        /*
         * Init the plugin
         */
        init: function(options, callback) {
            new CubePortfolio(this, options, callback);
        },

        /*
         * Destroy the plugin
         */
        destroy: function(callback) {
            var t = CubePortfolio.private.checkInstance.call(this, 'destroy');

            t.triggerEvent('beforeDestroy');

            // remove data
            $.removeData(this, 'cubeportfolio');

            // remove data from blocks
            t.blocks.removeData('cbp');

            // remove loading class and .cbp on container
            t.$obj.removeClass('cbp-ready').removeAttr('style');

            // remove class from ul
            t.$ul.removeClass('cbp-wrapper');

            // remove resize event
            CubePortfolio.private.destroyResizeEvent(t);

            t.$obj.off('.cbp');

            // reset blocks
            t.blocks.removeClass('cbp-item-off').removeAttr('style');

            t.blocks.find('.cbp-item-wrapper').children().unwrap();

            if (t.options.caption) {
                t.$obj.removeClass('cbp-caption-active cbp-caption-' + t.options.caption);
            }

            t.destroySlider();

            // remove .cbp-wrapper-outer
            t.$ul.unwrap();

            // remove .cbp-wrapper
            if (t.addedWrapp) {
                t.blocks.unwrap();
            }

            $.each(t.plugins, function(i, item) {
                if (typeof item.destroy === 'function') {
                    item.destroy();
                }
            });

            if ($.isFunction(callback)) {
                callback.call(t);
            }

            t.triggerEvent('afterDestroy');
        },

        /*
         * Filter the plugin by filterName
         */
        filter: function(param, callback) {
            var t = CubePortfolio.private.checkInstance.call(this, 'filter'),
                expression;

            if (t.isAnimating) {
                return;
            }

            t.isAnimating = true;

            // register callback function
            if ($.isFunction(callback)) {
                t.registerEvent('filterFinish', callback, true);
            }

            if ($.isFunction(param)) {
                expression = param.call(t, t.blocks);

                if(expression === undefined) {
                    throw new Error('When you call cubeportfolio API `filter` method with a param of type function you must return the blocks that will be visible.');
                }
            } else {
                if (t.options.filterDeeplinking) {
                    var url = location.href.replace(/#cbpf=(.*?)([#\?&]|$)/gi, '');
                    location.href = url + '#cbpf=' + encodeURIComponent(param);

                    if (t.singlePage && t.singlePage.url) {
                        t.singlePage.url = location.href;
                    }
                }

                t.defaultFilter = param;
                expression = t.filterConcat(t.defaultFilter);
            }

            if (t.singlePageInline && t.singlePageInline.isOpen) {
                t.singlePageInline.close('promise', {
                    callback: function() {
                        t.computeFilter(expression);
                    }
                });
            } else {
                t.computeFilter(expression);
            }
        },

        /*
         * Show counter for filters
         */
        showCounter: function(elems, callback) {
            var t = CubePortfolio.private.checkInstance.call(this, 'showCounter');

            // register callback function
            if ($.isFunction(callback)) {
                t.registerEvent('showCounterFinish', callback, true);
            }

            t.elems = elems;

            elems.each(function() {
                var el = $(this);

                var count = t.blocks.filter(el.data('filter')).length;
                el.find('.cbp-filter-counter').text(count);
            });

            t.triggerEvent('showCounterFinish', elems);
        },

        /*
         * ApendItems elements
         */
        appendItems: function(els, callback) {
            var t = CubePortfolio.private.checkInstance.call(this, 'appendItems'),
                items = $(els).filter('.cbp-item');

            if (t.isAnimating || items.length < 1) {
                if ($.isFunction(callback)) {
                    callback.call(t, items);
                }

                return;
            }

            t.isAnimating = true;

            if (t.singlePageInline && t.singlePageInline.isOpen) {
                t.singlePageInline.close('promise', {
                    callback: function() {
                        t.addItems(items, callback);
                    }
                });
            } else {
                t.addItems(items, callback);
            }
        },

    };

})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    // @todo - gandit cum ar trebui sa fac aici ca nu prea ar merge un plugin
    // pt slider ca as extinde pe CubePortfolio.prototype la fiecare initializare
    $.extend(CubePortfolio.prototype, {
        updateSliderPagination: function() {
            var t = this,
                pages,
                i;

            if (t.options.showPagination) {
                // get number of pages
                pages = Math.ceil(t.blocksOn.length / t.cols);
                t.navPagination.empty();

                for (i = pages - 1; i >= 0; i--) {
                    $('<div/>', {
                        'class': 'cbp-nav-pagination-item',
                        'data-slider-action': 'jumpTo'
                    }).appendTo(t.navPagination);
                }

                t.navPaginationItems = t.navPagination.children();
            }

            // enable disable the nav
            t.enableDisableNavSlider();
        },

        destroySlider: function() {
            var t = this;

            if (t.options.layoutMode !== 'slider') {
                return;
            }

            t.$obj.removeClass('cbp-mode-slider');

            t.$ul.removeAttr('style');

            t.$ul.off('.cbp');

            $(document).off('.cbp'); // @todo - don't interfer with the lightbox

            if (t.options.auto) {
                t.stopSliderAuto();
            }
        },

        nextSlider: function(el) {
            var t = this;

            if (t.isEndSlider()) {
                if (t.isRewindNav()) {
                    t.sliderActive = 0;
                } else {
                    return;
                }
            } else {
                if (t.options.scrollByPage) {
                    t.sliderActive = Math.min(t.sliderActive + t.cols, t.blocksOn.length - t.cols);
                } else {
                    t.sliderActive += 1;
                }
            }

            t.goToSlider();
        },

        prevSlider: function(el) {
            var t = this;

            if (t.isStartSlider()) {
                if (t.isRewindNav()) {
                    t.sliderActive = t.blocksOn.length - t.cols;
                } else {
                    return;
                }
            } else {
                if (t.options.scrollByPage) {
                    t.sliderActive = Math.max(0, t.sliderActive - t.cols);
                } else {
                    t.sliderActive -= 1;
                }
            }

            t.goToSlider();
        },

        jumpToSlider: function(el) {
            var t = this,
                index = Math.min(el.index() * t.cols, t.blocksOn.length - t.cols);

            if (index === t.sliderActive) {
                return;
            }

            t.sliderActive = index;

            t.goToSlider();
        },

        jumpDragToSlider: function(pos) {
            var t = this,
                jumpWidth,
                offset,
                condition,
                index,
                dragLeft = (pos > 0) ? true : false;

            if (t.options.scrollByPage) {
                jumpWidth = t.cols * t.columnWidth;
                offset = t.cols;
            } else {
                jumpWidth = t.columnWidth;
                offset = 1;
            }

            pos = Math.abs(pos);
            index = Math.floor(pos / jumpWidth) * offset;

            if (pos % jumpWidth > 20) {
                index += offset;
            }

            if (dragLeft) { // drag to left
                t.sliderActive = Math.min(t.sliderActive + index, t.blocksOn.length - t.cols);
            } else { // drag to right
                t.sliderActive = Math.max(0, t.sliderActive - index);
            }

            t.goToSlider();
        },

        isStartSlider: function() {
            return this.sliderActive === 0;
        },

        isEndSlider: function() {
            var t = this;
            return (t.sliderActive + t.cols) > t.blocksOn.length - 1;
        },

        goToSlider: function() {
            var t = this;

            // enable disable the nav
            t.enableDisableNavSlider();

            t.updateSliderPosition();
        },

        startSliderAuto: function() {
            var t = this;

            if (t.isDrag) {
                t.stopSliderAuto();
                return;
            }

            t.timeout = setTimeout(function() {
                // go to next slide
                t.nextSlider();

                // start auto
                t.startSliderAuto();

            }, t.options.autoTimeout);
        },

        stopSliderAuto: function() {
            clearTimeout(this.timeout);
        },

        enableDisableNavSlider: function() {
            var t = this,
                page,
                method;

            if (!t.isRewindNav()) {
                method = (t.isStartSlider()) ? 'addClass' : 'removeClass';
                t.navPrev[method]('cbp-nav-stop');

                method = (t.isEndSlider()) ? 'addClass' : 'removeClass';
                t.navNext[method]('cbp-nav-stop');
            }

            if (t.options.showPagination) {
                if (t.options.scrollByPage) {
                    page = Math.ceil(t.sliderActive / t.cols);
                } else {
                    if (t.isEndSlider()) {
                        page = t.navPaginationItems.length - 1;
                    } else {
                        page = Math.floor(t.sliderActive / t.cols);
                    }
                }

                // add class active on pagination's items
                t.navPaginationItems.removeClass('cbp-nav-pagination-active')
                    .eq(page)
                    .addClass('cbp-nav-pagination-active');
            }

            if (t.customPagination) {
                if (t.options.scrollByPage) {
                    page = Math.ceil(t.sliderActive / t.cols);
                } else {
                    if (t.isEndSlider()) {
                        page = t.customPaginationItems.length - 1;
                    } else {
                        page = Math.floor(t.sliderActive / t.cols);
                    }
                }

                // add class active on pagination's items
                t.customPaginationItems.removeClass(t.customPaginationClass)
                    .eq(page)
                    .addClass(t.customPaginationClass);
            }
        },

        /**
         * If slider loop is enabled don't add classes to `next` and `prev` buttons
         */
        isRewindNav: function() {
            var t = this;

            if (!t.options.showNavigation) {
                return true;
            }

            if (t.blocksOn.length <= t.cols) {
                return false;
            }

            if (t.options.rewindNav) {
                return true;
            }

            return false;
        },

        sliderItemsLength: function() {
            return this.blocksOn.length <= this.cols;
        },

        /**
         * Arrange the items in a slider layout
         */
        sliderLayout: function() {
            var t = this;

            t.blocksOn.each(function(index, el) {
                var data = $(el).data('cbp');

                // update the values with the new ones
                data.leftNew = t.columnWidth * index;
                data.topNew = 0;

                t.sliderFreeSpaces.push({
                    topStart: data.heightAndGap
                });
            });

            t.getFreeSpacesForSlider();

            t.$ul.width(t.columnWidth * t.blocksOn.length - t.options.gapVertical);
        },

        getFreeSpacesForSlider: function() {
            var t = this;

            t.freeSpaces = t.sliderFreeSpaces.slice(t.sliderActive, t.sliderActive + t.cols);

            t.freeSpaces.sort(function(space1, space2) {
                if (space1.topStart > space2.topStart) {
                    return 1;
                } else if (space1.topStart < space2.topStart) {
                    return -1;
                }
            });
        },

        updateSliderPosition: function() {
            var t = this,
                value = -t.sliderActive * t.columnWidth;

            if (CubePortfolio.private.modernBrowser) {
                t.$ul[0].style[CubePortfolio.private.transform] = 'translate3d(' + value + 'px, 0px, 0)';
            } else {
                t.$ul[0].style.left = value + 'px';
            }

            t.getFreeSpacesForSlider();

            t.resizeMainContainer();
        },

        dragSlider: function() {
            var t = this,
                $document = $(document),
                posInitial,
                pos,
                target,
                ulPosition,
                ulMaxWidth,
                isAnimating = false,
                events = {},
                isTouch = false,
                touchStartEvent,
                isHover = false;

            t.isDrag = false;

            if (('ontouchstart' in window) ||
                (navigator.maxTouchPoints > 0) ||
                (navigator.msMaxTouchPoints > 0)) {

                events = {
                    start: 'touchstart.cbp',
                    move: 'touchmove.cbp',
                    end: 'touchend.cbp'
                };

                isTouch = true;
            } else {
                events = {
                    start: 'mousedown.cbp',
                    move: 'mousemove.cbp',
                    end: 'mouseup.cbp'
                };
            }

            function dragStart(e) {
                if (t.sliderItemsLength()) {
                    return;
                }

                if (!isTouch) {
                    e.preventDefault();
                } else {
                    touchStartEvent = e;
                }

                if (t.options.auto) {
                    t.stopSliderAuto();
                }

                if (isAnimating) {
                    $(target).one('click.cbp', function() {
                        return false;
                    });
                    return;
                }

                target = $(e.target);
                posInitial = pointerEventToXY(e).x;
                pos = 0;
                ulPosition = -t.sliderActive * t.columnWidth;
                ulMaxWidth = t.columnWidth * (t.blocksOn.length - t.cols);

                $document.on(events.move, dragMove);
                $document.on(events.end, dragEnd);

                t.$obj.addClass('cbp-mode-slider-dragStart');
            }

            function dragEnd(e) {
                t.$obj.removeClass('cbp-mode-slider-dragStart');

                // put the state to animate
                isAnimating = true;

                if (pos !== 0) {
                    target.one('click.cbp', function(e) {
                        return false;
                    });

                    // wait a frame to be sure the .cbp-mode-slider-dragStart is removed from the dom
                    requestAnimationFrame(function() {
                        t.jumpDragToSlider(pos);
                        t.$ul.one(CubePortfolio.private.transitionend, afterDragEnd);
                    });
                } else {
                    afterDragEnd.call(t);
                }

                $document.off(events.move);
                $document.off(events.end);
            }

            function dragMove(e) {
                pos = posInitial - pointerEventToXY(e).x;

                if (pos > 8 || pos < -8) {
                    e.preventDefault();
                }

                t.isDrag = true;

                var value = ulPosition - pos;

                if (pos < 0 && pos < ulPosition) { // to right
                    value = (ulPosition - pos) / 5;
                } else if (pos > 0 && (ulPosition - pos) < -ulMaxWidth) { // to left
                    value = -ulMaxWidth + (ulMaxWidth + ulPosition - pos) / 5;
                }

                if (CubePortfolio.private.modernBrowser) {
                    t.$ul[0].style[CubePortfolio.private.transform] = 'translate3d(' + value + 'px, 0px, 0)';
                } else {
                    t.$ul[0].style.left = value + 'px';
                }
            }

            function afterDragEnd() {
                isAnimating = false;
                t.isDrag = false;

                if (t.options.auto) {
                    if (t.mouseIsEntered) {
                        return;
                    }

                    t.startSliderAuto();
                }
            }

            function pointerEventToXY(e) {
                if (e.originalEvent !== undefined && e.originalEvent.touches !== undefined) {
                    e = e.originalEvent.touches[0];
                }

                return {
                    x: e.pageX,
                    y: e.pageY
                };
            }

            t.$ul.on(events.start, dragStart);
        },

        /**
         * Reset the slider layout
         */
        sliderLayoutReset: function() {
            var t = this;

            t.freeSpaces = [];

            t.sliderFreeSpaces = [];
        },
    });
})(jQuery, window, document);

if (typeof Object.create !== 'function') {
    Object.create = function(obj) {
        function F() {}
        F.prototype = obj;
        return new F();
    };
}

// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating

// requestAnimationFrame polyfill by Erik M�ller. fixes from Paul Irish and Tino Zijdel

// MIT license

(function() {
    var lastTime = 0;
    var vendors = ['moz', 'webkit'];

    for (var x = 0; x < vendors.length && !window.requestAnimationFrame; x++) {
        window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] || window[vendors[x] + 'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame) {
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() {
                    callback(currTime + timeToCall);
                },
                timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };
    }

    if (!window.cancelAnimationFrame) {
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
    }
}());

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var t = this;

        t.parent = parent;

        parent.filterLayout = t.filterLayout;

        parent.registerEvent('computeBlocksFinish', function(expression) {
            parent.blocksOn2On = parent.blocksOnInitial.filter(expression);
            parent.blocksOn2Off = parent.blocksOnInitial.not(expression);
        });
    }

    // here this value point to parent grid
    Plugin.prototype.filterLayout = function() {
        var t = this;

        t.$obj.addClass('cbp-animation-' + t.options.animationType);

        // [1] - blocks that are only moving with translate
        t.blocksOn2On.addClass('cbp-item-on2on')
            .each(function(index, el) {
                var data = $(el).data('cbp');
                el.style[CubePortfolio.private.transform] = 'translate3d(' + (data.leftNew - data.left) + 'px, ' + (data.topNew - data.top) + 'px, 0)';
            });

        // [2] - blocks than intialy are on but after applying the filter are off
        t.blocksOn2Off.addClass('cbp-item-on2off');

        // [3] - blocks that are off and it will be on
        t.blocksOff2On = t.blocksOn
            .filter('.cbp-item-off')
            .removeClass('cbp-item-off')
            .addClass('cbp-item-off2on')
            .each(function(index, el) {
                var data = $(el).data('cbp');

                el.style.left = data.leftNew + 'px';
                el.style.top = data.topNew + 'px';
            });

        if (t.blocksOn2Off.length) {
            t.blocksOn2Off.last().data('cbp').wrapper.one(CubePortfolio.private.animationend, animationend);
        } else if (t.blocksOff2On.length) {
            t.blocksOff2On.last().data('cbp').wrapper.one(CubePortfolio.private.animationend, animationend);
        } else {
            animationend();
        }

        // resize main container height
        t.resizeMainContainer();

        function animationend() {
            t.blocks.removeClass('cbp-item-on2off cbp-item-off2on cbp-item-on2on')
                .each(function(index, el) {
                    var data = $(el).data('cbp');

                    data.left = data.leftNew;
                    data.top = data.topNew;

                    el.style.left = data.left + 'px';
                    el.style.top = data.top + 'px';

                    el.style[CubePortfolio.private.transform] = '';
                });

            t.blocksOff.addClass('cbp-item-off');

            t.$obj.removeClass('cbp-animation-' + t.options.animationType);

            t.filterFinish();
        }
    };

    Plugin.prototype.destroy = function() {
        var parent = this.parent;
        parent.$obj.removeClass('cbp-animation-' + parent.options.animationType);
    };

    CubePortfolio.plugins.animationClassic = function(parent) {
        if (!CubePortfolio.private.modernBrowser || $.inArray(parent.options.animationType, ['boxShadow', 'fadeOut', 'flipBottom', 'flipOut', 'quicksand', 'scaleSides', 'skew']) < 0) {
            return null;
        }

        return new Plugin(parent);
    };
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var t = this;

        t.parent = parent;

        parent.filterLayout = t.filterLayout;
    }

    // here this value point to parent grid
    Plugin.prototype.filterLayout = function() {
        var t = this,
            ulClone = t.$ul[0].cloneNode(true);

        ulClone.setAttribute('class', 'cbp-wrapper-helper');
        t.wrapper[0].insertBefore(ulClone, t.$ul[0]);

        requestAnimationFrame(function() {
            t.$obj.addClass('cbp-animation-' + t.options.animationType);

            t.blocksOff.addClass('cbp-item-off');

            t.blocksOn.removeClass('cbp-item-off')
                .each(function(index, el) {
                    var data = $(el).data('cbp');

                    data.left = data.leftNew;
                    data.top = data.topNew;

                    el.style.left = data.left + 'px';
                    el.style.top = data.top + 'px';

                    if (t.options.animationType === 'sequentially') {
                        data.wrapper[0].style[CubePortfolio.private.animationDelay] = (index * 60) + 'ms';
                    }
                });

            if (t.blocksOn.length) {
                t.blocksOn.last().data('cbp').wrapper.one(CubePortfolio.private.animationend, animationend);
            } else if (t.blocksOnInitial.length) {
                t.blocksOnInitial.last().data('cbp').wrapper.one(CubePortfolio.private.animationend, animationend);
            } else {
                animationend();
            }

            // resize main container height
            t.resizeMainContainer();
        });

        function animationend() {
            t.wrapper[0].removeChild(ulClone);

            if (t.options.animationType === 'sequentially') {
                t.blocksOn.each(function(index, el) {
                    $(el).data('cbp').wrapper[0].style[CubePortfolio.private.animationDelay] = '';
                });
            }

            t.$obj.removeClass('cbp-animation-' + t.options.animationType);

            t.filterFinish();
        }
    };

    Plugin.prototype.destroy = function() {
        var parent = this.parent;
        parent.$obj.removeClass('cbp-animation-' + parent.options.animationType);
    };

    CubePortfolio.plugins.animationClone = function(parent) {
        if (!CubePortfolio.private.modernBrowser || $.inArray(parent.options.animationType, ['fadeOutTop', 'slideLeft', 'sequentially']) < 0) {
            return null;
        }

        return new Plugin(parent);
    };
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var t = this;

        t.parent = parent;

        parent.filterLayout = t.filterLayout;
    }

    // here this value point to parent grid
    Plugin.prototype.filterLayout = function() {
        var t = this,
            ulClone = t.$ul.clone(true, true);

        ulClone[0].setAttribute('class', 'cbp-wrapper-helper');
        t.wrapper[0].insertBefore(ulClone[0], t.$ul[0]);

        // hack for safari osx because it doesn't want to work if I set animationDelay
        // on cbp-item-wrapper before I clone the t.$ul
        var items = ulClone.find('.cbp-item').not('.cbp-item-off');
        t.sortBlocks(items, 'top');
        items.children('.cbp-item-wrapper').each(function(index, el) {
            el.style[CubePortfolio.private.animationDelay] = (index * 50) + 'ms';
        });

        requestAnimationFrame(function() {
            t.$obj.addClass('cbp-animation-' + t.options.animationType);

            t.blocksOff.addClass('cbp-item-off');

            t.blocksOn.removeClass('cbp-item-off')
                .each(function(index, el) {
                    var data = $(el).data('cbp');

                    data.left = data.leftNew;
                    data.top = data.topNew;

                    el.style.left = data.left + 'px';
                    el.style.top = data.top + 'px';

                    data.wrapper[0].style[CubePortfolio.private.animationDelay] = (index * 50) + 'ms';
                });

            var onLength = t.blocksOn.length,
                offLength = items.length;

            if (onLength === 0 && offLength === 0) {
                animationend();
            } else if (onLength < offLength) {
                items.last().children('.cbp-item-wrapper').one(CubePortfolio.private.animationend, animationend);
            } else {
                t.blocksOn.last().data('cbp').wrapper.one(CubePortfolio.private.animationend, animationend);
            }

            // resize main container height
            t.resizeMainContainer();
        });

        function animationend() {
            t.wrapper[0].removeChild(ulClone[0]);

            t.$obj.removeClass('cbp-animation-' + t.options.animationType);

            t.blocks.each(function(index, el) {
                $(el).data('cbp').wrapper[0].style[CubePortfolio.private.animationDelay] = '';
            });

            t.filterFinish();
        }
    };

    Plugin.prototype.destroy = function() {
        var parent = this.parent;
        parent.$obj.removeClass('cbp-animation-' + parent.options.animationType);
    };

    CubePortfolio.plugins.animationCloneDelay = function(parent) {
        if (!CubePortfolio.private.modernBrowser || $.inArray(parent.options.animationType, ['3dflip', 'flipOutDelay', 'foldLeft', 'frontRow', 'rotateRoom', 'rotateSides', 'scaleDown', 'slideDelay', 'unfold']) < 0) {
            return null;
        }

        return new Plugin(parent);
    };
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var t = this;

        t.parent = parent;

        parent.filterLayout = t.filterLayout;
    }

    // here this value point to parent grid
    Plugin.prototype.filterLayout = function() {
        var t = this,
            ulClone = t.$ul[0].cloneNode(true);

        ulClone.setAttribute('class', 'cbp-wrapper-helper');
        t.wrapper[0].insertBefore(ulClone, t.$ul[0]);

        requestAnimationFrame(function() {
            t.$obj.addClass('cbp-animation-' + t.options.animationType);

            t.blocksOff.addClass('cbp-item-off');

            t.blocksOn.removeClass('cbp-item-off')
                .each(function(index, el) {
                    var data = $(el).data('cbp');

                    data.left = data.leftNew;
                    data.top = data.topNew;

                    el.style.left = data.left + 'px';
                    el.style.top = data.top + 'px';
                });

            if (t.blocksOn.length) {
                t.$ul.one(CubePortfolio.private.animationend, animationend);
            } else if (t.blocksOnInitial.length) {
                $(ulClone).one(CubePortfolio.private.animationend, animationend);
            } else {
                animationend();
            }

            // resize main container height
            t.resizeMainContainer();
        });

        function animationend() {
            t.wrapper[0].removeChild(ulClone);

            t.$obj.removeClass('cbp-animation-' + t.options.animationType);

            t.filterFinish();
        }
    };

    Plugin.prototype.destroy = function() {
        var parent = this.parent;
        parent.$obj.removeClass('cbp-animation-' + parent.options.animationType);
    };

    CubePortfolio.plugins.animationWrapper = function(parent) {
        if (!CubePortfolio.private.modernBrowser || $.inArray(parent.options.animationType, ['bounceBottom', 'bounceLeft', 'bounceTop', 'moveLeft']) < 0) {
            return null;
        }

        return new Plugin(parent);
    };
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var t = this;

        t.parent = parent;

        parent.registerEvent('initFinish', function() {
            parent.$obj.on('click.cbp', '.cbp-caption-defaultWrap', function(e) {
                e.preventDefault();

                if (parent.isAnimating) {
                    return;
                }

                parent.isAnimating = true;

                var defaultWrap = $(this),
                    activeWrap = defaultWrap.next(),
                    caption = defaultWrap.parent(),
                    endStyle = {
                        position: 'relative',
                        height: activeWrap.outerHeight(true)
                    },
                    startStyle = {
                        position: 'relative',
                        height: 0
                    };

                parent.$obj.addClass('cbp-caption-expand-active');

                // swap endStyle & startStyle
                if (caption.hasClass('cbp-caption-expand-open')) {
                    var temp = startStyle;
                    startStyle = endStyle;
                    endStyle = temp;
                    caption.removeClass('cbp-caption-expand-open');
                }

                activeWrap.css(endStyle);

                parent.$obj.one('pluginResize.cbp', function() {
                    parent.isAnimating = false;
                    parent.$obj.removeClass('cbp-caption-expand-active');

                    if (endStyle.height === 0) {
                        caption.removeClass('cbp-caption-expand-open');
                        activeWrap.attr('style', '');
                    }
                });

                // reposition the blocks
                parent.layoutAndAdjustment();

                // set activeWrap to 0 so I can start animation in the next frame
                activeWrap.css(startStyle);

                // delay animation
                requestAnimationFrame(function() {
                    caption.addClass('cbp-caption-expand-open');

                    activeWrap.css(endStyle);

                    // used by slider layoutMode
                    parent.triggerEvent('gridAdjust');

                    parent.triggerEvent('resizeGrid');
                });
            });
        }, true);
    }

    Plugin.prototype.destroy = function() {
        this.parent.$obj.find('.cbp-caption-defaultWrap').off('click.cbp').parent().removeClass('cbp-caption-expand-active');
    };

    CubePortfolio.plugins.captionExpand = function(parent) {

        if (parent.options.caption !== 'expand') {
            return null;
        }

        return new Plugin(parent);
    };

})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var deferred = $.Deferred();

        parent.pushQueue('delayFrame', deferred);

        parent.registerEvent('initEndWrite', function() {
            parent.blocksOn.each(function(index, el) {
                el.style[CubePortfolio.private.animationDelay] = (index * parent.options.displayTypeSpeed) + 'ms';
            });

            parent.$obj.addClass('cbp-displayType-bottomToTop');

            // get last element
            parent.blocksOn.last().one(CubePortfolio.private.animationend, function() {
                parent.$obj.removeClass('cbp-displayType-bottomToTop');

                parent.blocksOn.each(function(index, el) {
                    el.style[CubePortfolio.private.animationDelay] = '';
                });

                // resolve event after the animation is finished
                deferred.resolve();
            });
        }, true);
    }

    CubePortfolio.plugins.displayBottomToTop = function(parent) {
        if (!CubePortfolio.private.modernBrowser || parent.options.displayType !== 'bottomToTop' || parent.blocksOn.length === 0) {
            return null;
        }

        return new Plugin(parent);
    };
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var deferred = $.Deferred();

        parent.pushQueue('delayFrame', deferred);

        parent.registerEvent('initEndWrite', function() {
            parent.obj.style[CubePortfolio.private.animationDuration] = parent.options.displayTypeSpeed + 'ms';

            parent.$obj.addClass('cbp-displayType-fadeIn');

            parent.$obj.one(CubePortfolio.private.animationend, function() {
                parent.$obj.removeClass('cbp-displayType-fadeIn');

                parent.obj.style[CubePortfolio.private.animationDuration] = '';

                // resolve event after the animation is finished
                deferred.resolve();
            });
        }, true);
    }

    CubePortfolio.plugins.displayFadeIn = function(parent) {
        if (!CubePortfolio.private.modernBrowser || (parent.options.displayType !== 'lazyLoading' && parent.options.displayType !== 'fadeIn') || parent.blocksOn.length === 0) {
            return null;
        }

        return new Plugin(parent);
    };
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var deferred = $.Deferred();

        parent.pushQueue('delayFrame', deferred);

        parent.registerEvent('initEndWrite', function() {
            parent.obj.style[CubePortfolio.private.animationDuration] = parent.options.displayTypeSpeed + 'ms';

            parent.$obj.addClass('cbp-displayType-fadeInToTop');

            parent.$obj.one(CubePortfolio.private.animationend, function() {
                parent.$obj.removeClass('cbp-displayType-fadeInToTop');

                parent.obj.style[CubePortfolio.private.animationDuration] = '';

                // resolve event after the animation is finished
                deferred.resolve();
            });
        }, true);
    }

    CubePortfolio.plugins.displayFadeInToTop = function(parent) {
        if (!CubePortfolio.private.modernBrowser || parent.options.displayType !== 'fadeInToTop' || parent.blocksOn.length === 0) {
            return null;
        }

        return new Plugin(parent);
    };
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var deferred = $.Deferred();

        parent.pushQueue('delayFrame', deferred);

        parent.registerEvent('initEndWrite', function() {
            parent.blocksOn.each(function(index, el) {
                el.style[CubePortfolio.private.animationDelay] = (index * parent.options.displayTypeSpeed) + 'ms';
            });

            parent.$obj.addClass('cbp-displayType-sequentially');

            // get last element
            parent.blocksOn.last().one(CubePortfolio.private.animationend, function() {
                parent.$obj.removeClass('cbp-displayType-sequentially');

                parent.blocksOn.each(function(index, el) {
                    el.style[CubePortfolio.private.animationDelay] = '';
                });

                // resolve event after the animation is finished
                deferred.resolve();
            });
        }, true);
    }

    CubePortfolio.plugins.displaySequentially = function(parent) {
        if (!CubePortfolio.private.modernBrowser || parent.options.displayType !== 'sequentially' || parent.blocksOn.length === 0) {
            return null;
        }

        return new Plugin(parent);
    };
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var t = this;

        t.parent = parent;

        t.filters = $(parent.options.filters);
        t.filterData = [];

        parent.registerEvent('afterPlugins', function(elems) {
            // set default filter if it's present in url
            t.filterFromUrl();
            t.registerFilter();
        });

    }

    Plugin.prototype.registerFilter = function() {
        var t = this,
            parent = t.parent,
            filtersCallback,
            arr = parent.defaultFilter.split('|');

        t.wrap = t.filters.find('.cbp-l-filters-dropdownWrap')
            .on({
                'mouseover.cbp': function() {
                    $(this).addClass('cbp-l-filters-dropdownWrap-open');
                },
                'mouseleave.cbp': function() {
                    $(this).removeClass('cbp-l-filters-dropdownWrap-open');
                }
            });

        t.filters.each(function(index, el) {
            var filter = $(el),
                filterName = '*',
                items = filter.find('.cbp-filter-item'),
                dropdown = {};

            if (filter.hasClass('cbp-l-filters-dropdown')) {
                dropdown.wrap = filter.find('.cbp-l-filters-dropdownWrap');
                dropdown.header = filter.find('.cbp-l-filters-dropdownHeader');
                dropdown.headerText = dropdown.header.text();
            }

            // activate counter for filters
            parent.$obj.cubeportfolio('showCounter', items);

            $.each(arr, function(index, val) {
                if (items.filter('[data-filter="' + val + '"]').length) {
                    filterName = val;
                    arr.splice(index, 1);
                    return false;
                }
            });

            $.data(el, 'filterName', filterName);
            t.filterData.push(el);

            t.filtersCallback(dropdown, items.filter('[data-filter="' + filterName + '"]'));

            items.on('click.cbp', function() {
                var item = $(this);

                if (item.hasClass('cbp-filter-item-active') || parent.isAnimating) {
                    return;
                }

                t.filtersCallback(dropdown, item);

                $.data(el, 'filterName', item.data('filter'));

                var name = $.map(t.filterData, function(el, index) {
                    var f = $.data(el, 'filterName');
                    return (f !== "" && f !== '*') ? f : null;
                });

                if (name.length < 1) {
                    name = ['*'];
                }

                var filterJoin = name.join('|');

                if (parent.defaultFilter !== filterJoin) {
                    // filter the items
                    parent.$obj.cubeportfolio('filter', filterJoin);
                }
            });
        });
    };

    Plugin.prototype.filtersCallback = function(dropdown, item) {
        if (!$.isEmptyObject(dropdown)) {
            dropdown.wrap.trigger('mouseleave.cbp');

            if (dropdown.headerText) {
                dropdown.headerText = '';
            } else {
                dropdown.header.html(item.html());
            }
        }

        item.addClass('cbp-filter-item-active').siblings().removeClass('cbp-filter-item-active');
    };

    /**
     * Check if filters are present in url
     */
    Plugin.prototype.filterFromUrl = function() {
        var match = /#cbpf=(.*?)([#\?&]|$)/gi.exec(location.href);

        if (match !== null) {
            this.parent.defaultFilter = decodeURIComponent(match[1]);
        }
    };

    Plugin.prototype.destroy = function() {
        var t = this;

        t.filters.find('.cbp-filter-item').off('.cbp');
        t.wrap.off('.cbp');
    };

    CubePortfolio.plugins.filters = function(parent) {
        if (parent.options.filters === '') {
            return null;
        }

        return new Plugin(parent);
    };
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var options = {};

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var t = this;

        t.parent = parent;

        t.options = $.extend({}, options, t.parent.options.plugins.inlineSlider);

        t.runInit();

        parent.registerEvent('addItemsToDOM', function() {
            t.runInit();
        });

    }

    function InitSlider(slider) {
        var t = this;

        if (slider.hasClass('cbp-slider-inline-ready')) {
            return;
        }

        slider.addClass('cbp-slider-inline-ready');

        t.items = slider.find('.cbp-slider-wrapper').children('.cbp-slider-item');

        t.active = t.items.filter('.cbp-slider-item--active').index();
        t.total = t.items.length - 1;

        t.updateLeft();

        slider.find('.cbp-slider-next').on('click.cbp', function(e) {
            e.preventDefault();

            if (t.active < t.total) {
                t.active++;
                t.updateLeft();
            } else if (t.active === t.total) {
                t.active = 0;
                t.updateLeft();
            }
        });

        slider.find('.cbp-slider-prev').on('click.cbp', function(e) {
            e.preventDefault();

            if (t.active > 0) {
                t.active--;
                t.updateLeft();
            } else if (t.active === 0) {
                t.active = t.total;
                t.updateLeft();
            }
        });
    };

    InitSlider.prototype.updateLeft = function() {
        var t = this;

        t.items.removeClass('cbp-slider-item--active');
        t.items.eq(t.active).addClass('cbp-slider-item--active');

        t.items.each(function(index, el) {
            el.style.left = (index - t.active) + '00%';
        });
    };

    Plugin.prototype.runInit = function() {
        var t = this;

        t.parent.$obj.find('.cbp-slider-inline').not('.cbp-slider-inline-ready').each(function(index, el) {
            var slider = $(el);
            var activeImage = slider.find('.cbp-slider-item--active').find('img')[0];

            if (activeImage.hasAttribute('data-cbp-src')) {
                t.parent.$obj.on('lazyLoad.cbp', function(e, image) {
                    if (image.src === activeImage.src) {
                        new InitSlider(slider);
                    }
                });
            } else {
                new InitSlider(slider);
            }
        });
    };

    Plugin.prototype.destroy = function() {
        var t = this;

        t.parent.$obj.find('.cbp-slider-next').off('click.cbp');
        t.parent.$obj.find('.cbp-slider-prev').off('click.cbp');

        t.parent.$obj.off('lazyLoad.cbp');

        t.parent.$obj.find('.cbp-slider-inline').each(function(index, el) {
            var slider = $(el);

            slider.removeClass('cbp-slider-inline-ready');

            var items = slider.find('.cbp-slider-item');
            items.removeClass('cbp-slider-item--active');

            items.removeAttr('style');

            items.eq(0).addClass('cbp-slider-item--active');
        });
    };

    CubePortfolio.plugins.inlineSlider = function(parent) {
        return new Plugin(parent);
    };
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var options = {
        loadingClass: 'cbp-lazyload',
        threshold: 0, // loads images 150px before they're visible
    };

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var t = this;

        t.window = $(window);

        t.parent = parent;

        t.options = $.extend({}, options, t.parent.options.plugins.lazyLoad);

        parent.registerEvent('initEndWrite', function() {
            var timeout;

            t.triggerImg();

            parent.registerEvent('resizeMainContainer', function() {
                t.triggerImg();
            });

            // scroll event. @todo - this must be done like the global resize event
            t.window.on('scroll.cbp', function() {
                clearTimeout(timeout);

                timeout = setTimeout(function() {
                    t.triggerImg();
                }, 300);
            });
        }, true);
    }

    Plugin.prototype.triggerImg = function() {
        var t = this;

        var imgs = t.parent.$obj.find('img').filter('[data-cbp-src]');

        if (imgs.length === 0) {
            return;
        }

        t.screenHeight = t.window.height();

        imgs.each(function(index, el) {
            var parentNode = $(el.parentNode);

            if (!t.isElementInScreen(el)) {
                parentNode.addClass(t.options.loadingClass);
                return;
            }

            var dataSrc = el.getAttribute('data-cbp-src');

            if (t.parent.checkSrc(dataSrc) === null) {
                t.removeLazy(el, dataSrc);
                parentNode.removeClass(t.options.loadingClass);
            } else {
                parentNode.addClass(t.options.loadingClass);
                $('<img>').on('load.cbp error.cbp', function() {
                    t.removeLazy(el, dataSrc, parentNode);
                }).attr('src', dataSrc); // for ie8
            }
        });
    };

    Plugin.prototype.removeLazy = function(el, dataSrc, parentNode) {
        var t = this;

        el.src = dataSrc;
        el.removeAttribute('data-cbp-src');
        t.parent.removeAttrImage(el);

        // trigger public event
        t.parent.$obj.trigger('lazyLoad.cbp', el);

        if (parentNode) {
            if (CubePortfolio.private.modernBrowser) {
                $(el).one(CubePortfolio.private.transitionend, function() {
                    parentNode.removeClass(t.options.loadingClass);
                });
            } else {
                parentNode.removeClass(t.options.loadingClass);
            }
        }
    };

    Plugin.prototype.isElementInScreen = function(el) {
        var t = this;

        var bound = el.getBoundingClientRect();
        var bottom = bound.bottom + t.options.threshold;
        var screenHeight = t.screenHeight + bottom - (bound.top - t.options.threshold);

        return bottom >= 0 && bottom <= screenHeight;
    };

    Plugin.prototype.destroy = function() {
        var t = this;

        t.window.off('scroll.cbp');
    };

    CubePortfolio.plugins.lazyLoad = function(parent) {
        return new Plugin(parent);
    };
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var t = this;

        t.parent = parent;

        t.loadMore = $(parent.options.loadMore).find('.cbp-l-loadMore-link');

        // load click or auto action
        if (t.loadMore.length) {
            t[parent.options.loadMoreAction]();
        }

    }

    Plugin.prototype.click = function() {
        var t = this,
            numberOfClicks = 0;

        t.loadMore.on('click.cbp', function(e) {
            var button = $(this);

            e.preventDefault();

            if (t.parent.isAnimating || button.hasClass('cbp-l-loadMore-stop')) {
                return;
            }

            // set loading status
            button.addClass('cbp-l-loadMore-loading');

            numberOfClicks++;

            // perform ajax request
            $.ajax({
                url: t.loadMore.attr('href') + '?block=' + numberOfClicks,
                type: 'GET',
                dataType: 'HTML'
            }).done(function(result) {
                var items = result.replace(/(\r\n|\n|\r)/gm,"");

                var startBlock = items.indexOf('cbp-loadMore-block' + numberOfClicks);

                // stop the loadMore because the block doesn't exist
                if (startBlock === -1) {
                    button.addClass('cbp-l-loadMore-stop');
                    return;
                }

                // set start from where I will substring
                var start = items.indexOf('>', startBlock) + 1;

                var endBlock = items.indexOf('cbp-loadMore-block' + (numberOfClicks + 1));
                var end;

                // if endBlock doesn't exist
                if (endBlock === -1) {
                    end = items.lastIndexOf('</');
                } else {
                    end = items.lastIndexOf('</', endBlock);
                }

                t.parent.$obj.cubeportfolio('appendItems', items.substring(start, end), function() {
                    // remove class from button
                    button.removeClass('cbp-l-loadMore-loading');

                    // check if we have more works
                    if (endBlock === -1) {
                        button.addClass('cbp-l-loadMore-stop');
                    }
                });

            }).fail(function() {
                // error
            });

        });
    };


    Plugin.prototype.auto = function() {
        var t = this;

        t.parent.$obj.on('initComplete.cbp', function() {
            Object.create({
                init: function() {
                    var self = this;

                    // the job inactive
                    self.isActive = false;

                    self.numberOfClicks = 0;

                    // set loading status
                    t.loadMore.addClass('cbp-l-loadMore-loading');

                    // cache window selector
                    self.window = $(window);

                    // add events for scroll
                    self.addEvents();

                    // trigger method on init
                    self.getNewItems();
                },

                addEvents: function() {
                    var self = this,
                        timeout;

                    t.loadMore.on('click.cbp', function(e) {
                        e.preventDefault();
                    });

                    self.window.on('scroll.loadMoreObject', function() {

                        clearTimeout(timeout);

                        timeout = setTimeout(function() {
                            if (!t.parent.isAnimating) {
                                // get new items on scroll
                                self.getNewItems();
                            }
                        }, 80);

                    });

                    // when the filter is completed
                    t.parent.$obj.on('filterComplete.cbp', function() {
                        self.getNewItems();
                    });
                },

                getNewItems: function() {
                    var self = this,
                        topLoadMore, topWindow;

                    if (self.isActive || t.loadMore.hasClass('cbp-l-loadMore-stop')) {
                        return;
                    }

                    // add a treshold
                    topLoadMore = t.loadMore.offset().top - 200;
                    topWindow = self.window.scrollTop() + self.window.height();

                    if (topLoadMore > topWindow) {
                        return;
                    }

                    // this job is now busy
                    self.isActive = true;

                    // increment number of clicks
                    self.numberOfClicks++;

                    // perform ajax request
                    $.ajax({
                            url: t.loadMore.attr('href') + '?block=' + self.numberOfClicks,
                            type: 'GET',
                            dataType: 'HTML',
                            cache: true
                        })
                        .done(function(result) {
                            var items = result.replace(/(\r\n|\n|\r)/gm,"");

                            var startBlock = items.indexOf('cbp-loadMore-block' + self.numberOfClicks);

                            // stop the loadMore because the block doesn't exist
                            if (startBlock === -1) {
                                t.loadMore.addClass('cbp-l-loadMore-stop');
                                return;
                            }

                            // set start from where I will substring
                            var start = items.indexOf('>', startBlock) + 1;

                            var endBlock = items.indexOf('cbp-loadMore-block' + (self.numberOfClicks + 1));
                            var end;

                            // if endBlock doesn't exist
                            if (endBlock === -1) {
                                end = items.lastIndexOf('</');
                            } else {
                                end = items.lastIndexOf('</', endBlock);
                            }

                            t.parent.$obj.cubeportfolio('appendItems', items.substring(start, end), function() {
                                if (endBlock === -1) {
                                    t.loadMore.addClass('cbp-l-loadMore-stop');

                                    // remove events
                                    self.window.off('scroll.loadMoreObject');
                                    t.parent.$obj.off('filterComplete.cbp');
                                } else {
                                    // make the job inactive
                                    self.isActive = false;

                                    self.window.trigger('scroll.loadMoreObject');
                                }
                            });
                        })
                        .fail(function() {
                            // make the job inactive
                            self.isActive = false;
                        });
                }
            }).init();
        });

    };


    Plugin.prototype.destroy = function() {
        var t = this;

        t.loadMore.off('.cbp');

        $(window).off('scroll.loadMoreObject');
    };

    CubePortfolio.plugins.loadMore = function(parent) {
        if (parent.options.loadMore === '') {
            return null;
        }

        return new Plugin(parent);
    };

})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    var popup = {

        /**
         * init function for popup
         * @param cubeportfolio = cubeportfolio instance
         * @param type =  'lightbox' or 'singlePage'
         */
        init: function(cubeportfolio, type) {
            var t = this,
                currentBlock;

            // remember cubeportfolio instance
            t.cubeportfolio = cubeportfolio;

            // remember if this instance is for lightbox or for singlePage
            t.type = type;

            // remember if the popup is open or not
            t.isOpen = false;

            t.options = t.cubeportfolio.options;

            if (type === 'lightbox') {
                t.cubeportfolio.registerEvent('resizeWindow', function() {
                    t.resizeImage();
                });
            }

            if (type === 'singlePageInline') {
                t.height = 0;

                // create markup, css and add events for SinglePageInline
                t.createMarkupSinglePageInline();

                t.cubeportfolio.registerEvent('resizeGrid', function() {
                    if (t.isOpen) {
                        // @todo must add support for this features in the future
                        t.close(); // workaround
                    }
                });

                if (t.options.singlePageInlineDeeplinking) {
                    t.url = location.href;

                    if (t.url.slice(-1) === '#') {
                        t.url = t.url.slice(0, -1);
                    }

                    var links = t.url.split('#cbpi=');
                    var url = links.shift(); // remove first item

                    $.each(links, function(index, link) {
                        t.cubeportfolio.blocksOn.each(function(index1, el) {
                            var singlePageInline = $(el).find(t.options.singlePageInlineDelegate + '[href="' + link + '"]');

                            if (singlePageInline.length) {
                                currentBlock = singlePageInline;
                                return false;
                            }
                        });

                        if (currentBlock) {
                            return false;
                        }
                    });

                    if (currentBlock) {
                        t.cubeportfolio.registerEvent('initFinish', function() {
                            t.openSinglePageInline(t.cubeportfolio.blocksOn, currentBlock[0]);
                        }, true);
                    }
                }

                return;
            }

            // create markup, css and add events for lightbox and singlePage
            t.createMarkup();

            if (type === 'singlePage') {
                t.cubeportfolio.registerEvent('resizeWindow', function() {
                    if (t.options.singlePageStickyNavigation) {

                        var width = t.wrap[0].clientWidth;

                        if (width > 0) {
                            t.navigationWrap.width(width);

                            // set navigation width='window width' to center the divs
                            t.navigation.width(width);
                        }

                    }
                });

                if (t.options.singlePageDeeplinking) {
                    t.url = location.href;

                    if (t.url.slice(-1) === '#') {
                        t.url = t.url.slice(0, -1);
                    }

                    var links = t.url.split('#cbp=');
                    var url = links.shift(); // remove first item

                    $.each(links, function(index, link) {
                        t.cubeportfolio.blocksOn.each(function(index1, el) {
                            var singlePage = $(el).find(t.options.singlePageDelegate + '[href="' + link + '"]');

                            if (singlePage.length) {
                                currentBlock = singlePage;
                                return false;
                            }
                        });

                        if (currentBlock) {
                            return false;
                        }
                    });

                    if (currentBlock) {
                        t.url = url;

                        var self = currentBlock,
                            gallery = self.attr('data-cbp-singlePage'),
                            blocks = [];

                        if (gallery) {
                            blocks = self.closest($('.cbp-item')).find('[data-cbp-singlePage="' + gallery + '"]');
                        } else {
                            t.cubeportfolio.blocksOn.each(function(index, el) {
                                var item = $(el);

                                if (item.not('.cbp-item-off')) {
                                    item.find(t.options.singlePageDelegate).each(function(index2, el2) {
                                        if (!$(el2).attr('data-cbp-singlePage')) {
                                            blocks.push(el2);
                                        }
                                    });
                                }
                            });
                        }

                        t.openSinglePage(blocks, currentBlock[0]);
                    } else if (links.length) { // @todo - hack to load items from loadMore
                        var fakeLink = document.createElement('a');
                        fakeLink.setAttribute('href', links[0]);
                        t.openSinglePage([fakeLink], fakeLink);
                    }
                }
            }
        },

        /**
         * Create markup, css and add events
         */
        createMarkup: function() {
            var t = this,
                animationCls = '';

            if (t.type === 'singlePage') {
                if (t.options.singlePageAnimation !== 'left') {
                    animationCls = ' cbp-popup-singlePage-' + t.options.singlePageAnimation;
                }
            }

            // wrap element
            t.wrap = $('<div/>', {
                'class': 'cbp-popup-wrap cbp-popup-' + t.type + animationCls,
                'data-action': (t.type === 'lightbox') ? 'close' : ''
            }).on('click.cbp', function(e) {
                if (t.stopEvents) {
                    return;
                }

                var action = $(e.target).attr('data-action');

                if (t[action]) {
                    t[action]();
                    e.preventDefault();
                }
            });

            // content element
            t.content = $('<div/>', {
                'class': 'cbp-popup-content'
            }).appendTo(t.wrap);

            // append loading div
            $('<div/>', {
                'class': 'cbp-popup-loadingBox'
            }).appendTo(t.wrap);

            // add background only for ie8
            if (CubePortfolio.private.browser === 'ie8') {
                t.bg = $('<div/>', {
                    'class': 'cbp-popup-ie8bg',
                    'data-action': (t.type === 'lightbox') ? 'close' : ''
                }).appendTo(t.wrap);
            }

            // create navigation wrap
            t.navigationWrap = $('<div/>', {
                'class': 'cbp-popup-navigation-wrap'
            }).appendTo(t.wrap);

            // create navigation block
            t.navigation = $('<div/>', {
                'class': 'cbp-popup-navigation'
            }).appendTo(t.navigationWrap);

            // close
            t.closeButton = $('<div/>', {
                'class': 'cbp-popup-close',
                'title': 'Close (Esc arrow key)',
                'data-action': 'close'
            }).appendTo(t.navigation);

            // next
            t.nextButton = $('<div/>', {
                'class': 'cbp-popup-next',
                'title': 'Next (Right arrow key)',
                'data-action': 'next'
            }).appendTo(t.navigation);


            // prev
            t.prevButton = $('<div/>', {
                'class': 'cbp-popup-prev',
                'title': 'Previous (Left arrow key)',
                'data-action': 'prev'
            }).appendTo(t.navigation);


            if (t.type === 'singlePage') {
                if (t.options.singlePageCounter) {
                    // counter for singlePage
                    t.counter = $(t.options.singlePageCounter).appendTo(t.navigation);
                    t.counter.text('');
                }

                t.content.on('click.cbp', t.options.singlePageDelegate, function(e) {
                    e.preventDefault();

                    var i,
                        len = t.dataArray.length,
                        href = this.getAttribute('href');

                    for (i = 0; i < len; i++) {
                        if (t.dataArray[i].url === href) {
                            break;
                        }
                    }

                    t.singlePageJumpTo(i - t.current);
                });

                // if there are some events than overrides the default scroll behaviour don't go to them
                t.wrap.on('mousewheel.cbp' + ' DOMMouseScroll.cbp', function(e) {
                    e.stopImmediatePropagation();
                });
            }

            $(document).on('keydown.cbp', function(e) {
                // if is not open => return
                if (!t.isOpen) {
                    return;
                }

                // if all events are stopped => return
                if (t.stopEvents) {
                    return;
                }

                if (e.keyCode === 37) { // prev key
                    t.prev();
                } else if (e.keyCode === 39) { // next key
                    t.next();
                } else if (e.keyCode === 27) { //esc key
                    t.close();
                }
            });
        },

        createMarkupSinglePageInline: function() {
            var t = this;

            // wrap element
            t.wrap = $('<div/>', {
                'class': 'cbp-popup-singlePageInline'
            }).on('click.cbp', function(e) {
                if (t.stopEvents) {
                    return;
                }

                var action = $(e.target).attr('data-action');

                if (action && t[action]) {
                    t[action]();
                    e.preventDefault();
                }
            });

            // content element
            t.content = $('<div/>', {
                'class': 'cbp-popup-content'
            }).appendTo(t.wrap);

            // append loading div
            // $('<div/>', {
            //     'class': 'cbp-popup-loadingBox'
            // }).appendTo(t.wrap);

            // create navigation block
            t.navigation = $('<div/>', {
                'class': 'cbp-popup-navigation'
            }).appendTo(t.wrap);

            // close
            t.closeButton = $('<div/>', {
                'class': 'cbp-popup-close',
                'title': 'Close (Esc arrow key)',
                'data-action': 'close'
            }).appendTo(t.navigation);

        },

        destroy: function() {
            var t = this,
                body = $('body');

            // remove off key down
            $(document).off('keydown.cbp');

            // external lightbox and singlePageInline
            body.off('click.cbp', t.options.lightboxDelegate);
            body.off('click.cbp', t.options.singlePageDelegate);

            t.content.off('click.cbp', t.options.singlePageDelegate);

            t.cubeportfolio.$obj.off('click.cbp', t.options.singlePageInlineDelegate);
            t.cubeportfolio.$obj.off('click.cbp', t.options.lightboxDelegate);
            t.cubeportfolio.$obj.off('click.cbp', t.options.singlePageDelegate);

            t.cubeportfolio.$obj.removeClass('cbp-popup-isOpening');

            t.cubeportfolio.$obj.find('.cbp-item').removeClass('cbp-singlePageInline-active');

            t.wrap.remove();
        },

        openLightbox: function(blocks, currentBlock) {
            var t = this,
                i = 0,
                currentBlockHref, tempHref = [],
                element;

            if (t.isOpen) {
                return;
            }

            // remember that the lightbox is open now
            t.isOpen = true;

            // remember to stop all events after the lightbox has been shown
            t.stopEvents = false;

            // array with elements
            t.dataArray = [];

            // reset current
            t.current = null;

            currentBlockHref = currentBlock.getAttribute('href');
            if (currentBlockHref === null) {
                throw new Error('HEI! Your clicked element doesn\'t have a href attribute.');
            }

            $.each(blocks, function(index, item) {
                var href = item.getAttribute('href'),
                    src = href, // default if element is image
                    type = 'isImage', // default if element is image
                    videoLink;

                if ($.inArray(href, tempHref) === -1) {
                    if (currentBlockHref === href) {
                        t.current = i;
                    } else if (!t.options.lightboxGallery) {
                        return;
                    }

                    if (/youtube/i.test(href)) {
                        videoLink = href.substring(href.lastIndexOf('v=') + 2);

                        if (!(/autoplay=/i.test(videoLink))) {
                            videoLink += '&autoplay=1';
                        }

                        videoLink = videoLink.replace(/\?|&/, '?');

                        // create new href
                        src = '//www.youtube.com/embed/' + videoLink;

                        type = 'isYoutube';
                    } else if (/vimeo\.com/i.test(href)) {
                        videoLink = href.substring(href.lastIndexOf('/') + 1);

                        if (!(/autoplay=/i.test(videoLink))) {
                            videoLink += '&autoplay=1';
                        }

                        videoLink = videoLink.replace(/\?|&/, '?');

                        // create new href
                        src = '//player.vimeo.com/video/' + videoLink;

                        type = 'isVimeo';
                    } else if (/www\.ted\.com/i.test(href)) {
                        // create new href
                        src = 'http://embed.ted.com/talks/' + href.substring(href.lastIndexOf('/') + 1) + '.html';

                        type = 'isTed';
                    } else if (/soundcloud\.com/i.test(href)) {
                        // create new href
                        src = href;

                        type = 'isSoundCloud';
                    } else if (/(\.mp4)|(\.ogg)|(\.ogv)|(\.webm)/i.test(href)) {
                        if (href.indexOf('|') !== -1) {
                            // create new href
                            src = href.split('|');
                        } else {
                            // create new href
                            src = href.split('%7C');
                        }

                        type = 'isSelfHostedVideo';
                    } else if (/\.mp3$/i.test(href)) {
                        src = href;
                        type = 'isSelfHostedAudio';
                    }

                    t.dataArray.push({
                        src: src,
                        title: item.getAttribute(t.options.lightboxTitleSrc),
                        type: type
                    });

                    i++;
                }

                tempHref.push(href);
            });

            // total numbers of elements
            t.counterTotal = t.dataArray.length;

            if (t.counterTotal === 1) {
                t.nextButton.hide();
                t.prevButton.hide();
                t.dataActionImg = '';
            } else {
                t.nextButton.show();
                t.prevButton.show();
                t.dataActionImg = 'data-action="next"';
            }

            // append to body
            t.wrap.appendTo(document.body);

            t.scrollTop = $(window).scrollTop();

            t.originalStyle = $('html').attr('style');

            $('html').css({
                overflow: 'hidden',
                marginRight: window.innerWidth - $(document).width()
            });

            t.wrap.addClass('cbp-popup-transitionend');

            // show the wrapper (lightbox box)
            t.wrap.show();

            // get the current element
            element = t.dataArray[t.current];

            // call function if current element is image or video (iframe)
            t[element.type](element);
        },

        openSinglePage: function(blocks, currentBlock) {
            var t = this,
                i = 0,
                currentBlockHref, tempHref = [];

            if (t.isOpen) {
                return;
            }

            // check singlePageInline and close it
            if (t.cubeportfolio.singlePageInline && t.cubeportfolio.singlePageInline.isOpen) {
                t.cubeportfolio.singlePageInline.close();
            }

            // remember that the lightbox is open now
            t.isOpen = true;

            // remember to stop all events after the popup has been showing
            t.stopEvents = false;

            // array with elements
            t.dataArray = [];

            // reset current
            t.current = null;

            currentBlockHref = currentBlock.getAttribute('href');
            if (currentBlockHref === null) {
                throw new Error('HEI! Your clicked element doesn\'t have a href attribute.');
            }

            $.each(blocks, function(index, item) {
                var href = item.getAttribute('href');

                if ($.inArray(href, tempHref) === -1) {
                    if (currentBlockHref === href) {
                        t.current = i;
                    }

                    t.dataArray.push({
                        url: href,
                        element: item
                    });

                    i++;
                }

                tempHref.push(href);
            });

            // total numbers of elements
            t.counterTotal = t.dataArray.length;

            if (t.counterTotal === 1) {
                t.nextButton.hide();
                t.prevButton.hide();
            } else {
                t.nextButton.show();
                t.prevButton.show();
            }

            // append to body
            t.wrap.appendTo(document.body);

            t.scrollTop = $(window).scrollTop();

            // go to top of the page (reset scroll)
            t.wrap.scrollTop(0);

            // show the wrapper
            t.wrap.show();

            // finish the open animation
            t.finishOpen = 2;

            // if transitionend is not fulfilled
            t.navigationMobile = $();
            t.wrap.one(CubePortfolio.private.transitionend, function() {
                $('html').css({
                    overflow: 'hidden',
                    marginRight: window.innerWidth - $(document).width()
                });

                t.wrap.addClass('cbp-popup-transitionend');

                // make the navigation sticky
                if (t.options.singlePageStickyNavigation) {

                    t.wrap.addClass('cbp-popup-singlePage-sticky');

                    t.navigationWrap.width(t.wrap[0].clientWidth);

                    if (CubePortfolio.private.browser === 'android' || CubePortfolio.private.browser === 'ios') {
                        // wrap element
                        t.navigationMobile = $('<div/>', {
                            'class': 'cbp-popup-singlePage cbp-popup-singlePage-sticky',
                            'id': t.wrap.attr('id')
                        }).on('click.cbp', function(e) {
                            if (t.stopEvents) {
                                return;
                            }

                            var action = $(e.target).attr('data-action');

                            if (t[action]) {
                                t[action]();
                                e.preventDefault();
                            }
                        });

                        t.navigationMobile.appendTo(document.body).append(t.navigationWrap);
                    }
                }

                t.finishOpen--;

                if (t.finishOpen <= 0) {
                    t.updateSinglePageIsOpen.call(t);
                }
            });

            if (CubePortfolio.private.browser === 'ie8' || CubePortfolio.private.browser === 'ie9') {
                // make the navigation sticky
                if (t.options.singlePageStickyNavigation) {
                    t.navigationWrap.width(t.wrap[0].clientWidth);

                    setTimeout(function() {
                        t.wrap.addClass('cbp-popup-singlePage-sticky');
                    }, 1000);
                }

                t.finishOpen--;
            }

            t.wrap.addClass('cbp-popup-loading');

            // force reflow and then add class
            t.wrap.offset();
            t.wrap.addClass('cbp-popup-singlePage-open');

            // change link
            if (t.options.singlePageDeeplinking) {
                // ignore old #cbp from href
                t.url = t.url.split('#cbp=')[0];
                location.href = t.url + '#cbp=' + t.dataArray[t.current].url;
            }

            // run callback function
            if ($.isFunction(t.options.singlePageCallback)) {
                t.options.singlePageCallback.call(t, t.dataArray[t.current].url, t.dataArray[t.current].element);
            }
        },

        openSinglePageInline: function(blocks, currentBlock, fromOpen) {
            var t = this,
                start = 0,
                currentBlockHref,
                tempCurrent,
                cbpitem,
                parentElement;

            fromOpen = fromOpen || false;

            t.fromOpen = fromOpen;

            t.storeBlocks = blocks;
            t.storeCurrentBlock = currentBlock;

            // check singlePageInline and close it
            if (t.isOpen) {
                tempCurrent = $(currentBlock).closest('.cbp-item').index();

                if ((t.dataArray[t.current].url !== currentBlock.getAttribute('href')) || (t.current !== tempCurrent)) {
                    t.cubeportfolio.singlePageInline.close('open', {
                        blocks: blocks,
                        currentBlock: currentBlock,
                        fromOpen: true
                    });
                } else {
                    t.close();
                }

                return;
            }

            // remember that the lightbox is open now
            t.isOpen = true;

            // remember to stop all events after the popup has been showing
            t.stopEvents = false;

            // array with elements
            t.dataArray = [];

            // reset current
            t.current = null;

            currentBlockHref = currentBlock.getAttribute('href');
            if (currentBlockHref === null) {
                throw new Error('HEI! Your clicked element doesn\'t have a href attribute.');
            }

            cbpitem = $(currentBlock).closest('.cbp-item')[0];

            blocks.each(function(index, el) {
                if (cbpitem === el) {
                    t.current = index;
                }
            });

            t.dataArray[t.current] = {
                url: currentBlockHref,
                element: currentBlock
            };

            parentElement = $(t.dataArray[t.current].element).parents('.cbp-item').addClass('cbp-singlePageInline-active');

            // total numbers of elements
            t.counterTotal = blocks.length;

            t.wrap.insertBefore(t.cubeportfolio.wrapper);

            if (t.options.singlePageInlinePosition === 'top') {
                t.blocksToMove = blocks;
                t.top = 0;
            } else if (t.options.singlePageInlinePosition === 'bottom') {
                t.blocksToMove = $();
                t.top = t.cubeportfolio.height;
            } else if (t.options.singlePageInlinePosition === 'above') {
                t.top = $(blocks[t.current]).data('cbp').top;
                t.blocksToMove = $();

                blocks.each(function(index, el) {
                    var data = $(el).data('cbp');

                    if ((data.top + data.height) >= t.top) {
                        t.blocksToMove = t.blocksToMove.add(el);
                    }
                });

                t.top = Math.max(t.top - t.options.gapHorizontal, 0);
            } else { // below
                var dataBlock = $(blocks[t.current]).data('cbp');

                t.top = dataBlock.top + dataBlock.height;
                t.blocksToMove = $();

                blocks.each(function(index, el) {
                    var data = $(el).data('cbp');

                    if ((data.top + data.height) > t.top) {
                        t.blocksToMove = t.blocksToMove.add(el);
                    }
                });
            }

            t.wrap[0].style.height = t.wrap.outerHeight(true) + 'px';

            // debouncer for inline content
            t.deferredInline = $.Deferred();

            if (t.options.singlePageInlineInFocus) {
                t.scrollTop = $(window).scrollTop();

                var goToScroll = t.cubeportfolio.$obj.offset().top + t.top - 100;

                if (t.scrollTop !== goToScroll) {
                    $('html,body').animate({
                            scrollTop: goToScroll
                        }, 350)
                        .promise()
                        .then(function() {
                            t.resizeSinglePageInline();
                            t.deferredInline.resolve();
                        });
                } else {
                    t.resizeSinglePageInline();
                    t.deferredInline.resolve();
                }
            } else {
                t.resizeSinglePageInline();
                t.deferredInline.resolve();
            }

            t.cubeportfolio.$obj.addClass('cbp-popup-singlePageInline-open');

            t.wrap.css({
                top: t.top
            });

            // change link
            if (t.options.singlePageInlineDeeplinking) {
                // ignore old #cbpi from href
                t.url = t.url.split('#cbpi=')[0];
                location.href = t.url + '#cbpi=' + t.dataArray[t.current].url;
            }

            // register callback function
            if ($.isFunction(t.options.singlePageInlineCallback)) {
                t.options.singlePageInlineCallback.call(t, t.dataArray[t.current].url, t.dataArray[t.current].element);
            }
        },

        resizeSinglePageInline: function() {
            var t = this;

            t.height = ((t.top === 0) || (t.top === t.cubeportfolio.height)) ? t.wrap.outerHeight(true) : t.wrap.outerHeight(true) - t.options.gapHorizontal;

            t.storeBlocks.each(function(index, el) {
                if (CubePortfolio.private.modernBrowser) {
                    el.style[CubePortfolio.private.transform] = '';
                } else {
                    el.style.marginTop = '';
                }
            });

            t.blocksToMove.each(function(index, el) {
                if (CubePortfolio.private.modernBrowser) {
                    el.style[CubePortfolio.private.transform] = 'translate3d(0px, ' + t.height + 'px, 0)';
                } else {
                    el.style.marginTop = t.height + 'px';
                }
            });

            t.cubeportfolio.obj.style.height = t.cubeportfolio.height + t.height + 'px';
        },

        revertResizeSinglePageInline: function() {
            var t = this;

            // reset deferred object
            t.deferredInline = $.Deferred();

            t.storeBlocks.each(function(index, el) {
                if (CubePortfolio.private.modernBrowser) {
                    el.style[CubePortfolio.private.transform] = '';
                } else {
                    el.style.marginTop = '';
                }
            });

            t.cubeportfolio.obj.style.height = t.cubeportfolio.height + 'px';
        },

        appendScriptsToWrap: function(scripts) {
            var t = this,
                index = 0,
                loadScripts = function(item) {
                    var script = document.createElement('script'),
                        src = item.src;

                    script.type = 'text/javascript';

                    if (script.readyState) { // ie
                        script.onreadystatechange = function() {
                            if (script.readyState == 'loaded' || script.readyState == 'complete') {
                                script.onreadystatechange = null;
                                index++;
                                if (scripts[index]) {
                                    loadScripts(scripts[index]);
                                }
                            }
                        };
                    } else {
                        script.onload = function() {
                            index++;
                            if (scripts[index]) {
                                loadScripts(scripts[index]);
                            }
                        };
                    }

                    if (src) {
                        script.src = src;
                    } else {
                        script.text = item.text;
                    }

                    t.content[0].appendChild(script);

                };

            loadScripts(scripts[0]);
        },

        updateSinglePage: function(html, scripts, isWrap) {
            var t = this,
                counterMarkup,
                animationFinish;

            t.content.addClass('cbp-popup-content').removeClass('cbp-popup-content-basic');

            if (isWrap === false) {
                t.content.removeClass('cbp-popup-content').addClass('cbp-popup-content-basic');
            }

            // update counter navigation
            if (t.counter) {
                counterMarkup = $(t.getCounterMarkup(t.options.singlePageCounter, t.current + 1, t.counterTotal));
                t.counter.text(counterMarkup.text());
            }

            t.fromAJAX = {
                html: html,
                scripts: scripts
            };

            t.finishOpen--;

            if (t.finishOpen <= 0) {
                t.updateSinglePageIsOpen.call(t);
            }
        },

        updateSinglePageIsOpen: function() {
            var t = this,
                selectorSlider;

            t.wrap.addClass('cbp-popup-ready');
            t.wrap.removeClass('cbp-popup-loading');

            t.content.html(t.fromAJAX.html);

            if (t.fromAJAX.scripts) {
                t.appendScriptsToWrap(t.fromAJAX.scripts);
            }

            t.fromAJAX = {};


            // trigger public event
            t.cubeportfolio.$obj.trigger('updateSinglePageStart.cbp');

            // instantiate slider if exists
            selectorSlider = t.content.find('.cbp-slider');
            if (selectorSlider) {
                selectorSlider.find('.cbp-slider-item').addClass('cbp-item');
                t.slider = selectorSlider.cubeportfolio({
                    layoutMode: 'slider',
                    mediaQueries: [{
                        width: 1,
                        cols: 1
                    }],
                    gapHorizontal: 0,
                    gapVertical: 0,
                    caption: '',
                    coverRatio: '', // wp version only
                });
            } else {
                t.slider = null;
            }

            // check for social share icons
            t.checkForSocialLinks(t.content);

            // scroll bug on android and ios
            if (CubePortfolio.private.browser === 'android' || CubePortfolio.private.browser === 'ios') {
                $('html').css({
                    position: 'fixed'
                });
            }

            // trigger public event
            t.cubeportfolio.$obj.trigger('updateSinglePageComplete.cbp');
        },

        checkForSocialLinks: function(content) {
            var t = this;

            t.createFacebookShare(content.find('.cbp-social-fb'));
            t.createTwitterShare(content.find('.cbp-social-twitter'));
            t.createGooglePlusShare(content.find('.cbp-social-googleplus'));
            t.createPinterestShare(content.find('.cbp-social-pinterest'));
        },

        createFacebookShare: function(item) {
            if (item.length && !item.attr('onclick')) {
                item.attr('onclick', "window.open('http://www.facebook.com/sharer.php?u=" + encodeURIComponent(window.location.href) + "', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=400'); return false;");
            }
        },

        createTwitterShare: function(item) {
            if (item.length && !item.attr('onclick')) {
                item.attr('onclick', "window.open('https://twitter.com/intent/tweet?source=" + encodeURIComponent(window.location.href) + "&text=" + encodeURIComponent(document.title) + "', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=300'); return false;");
            }
        },

        createGooglePlusShare: function(item) {
            if (item.length && !item.attr('onclick')) {
                item.attr('onclick', "window.open('https://plus.google.com/share?url=" + encodeURIComponent(window.location.href) + "', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=450'); return false;");
            }
        },

        createPinterestShare: function(item) {
            if (item.length && !item.attr('onclick')) {
                var media = '';
                var firstImg = this.content.find('img')[0];

                if(firstImg) {
                    media = firstImg.src;
                }

                item.attr('onclick', "window.open('http://pinterest.com/pin/create/button/?url=" + encodeURIComponent(window.location.href) + "&media=" + media + "', '_blank', 'top=100,left=100,toolbar=0,status=0,width=620,height=400'); return false;");
            }
        },

        updateSinglePageInline: function(html, scripts) {
            var t = this;

            t.content.html(html);

            if (scripts) {
                t.appendScriptsToWrap(scripts);
            }
            // trigger public event
            t.cubeportfolio.$obj.trigger('updateSinglePageInlineStart.cbp');

            t.singlePageInlineIsOpen.call(t);
        },

        singlePageInlineIsOpen: function() {
            var t = this;

            function finishLoading() {
                t.wrap.addClass('cbp-popup-singlePageInline-ready');
                t.wrap[0].style.height = '';

                t.resizeSinglePageInline();

                // trigger public event
                t.cubeportfolio.$obj.trigger('updateSinglePageInlineComplete.cbp');
            }

            // wait to load all images
            t.cubeportfolio.loadImages(t.wrap, function() {
                // instantiate slider if exists
                var selectorSlider = t.content.find('.cbp-slider');

                if (selectorSlider.length) {
                    selectorSlider.find('.cbp-slider-item').addClass('cbp-item');

                    selectorSlider.one('initComplete.cbp', function() {
                        t.deferredInline.done(finishLoading);
                    });

                    selectorSlider.on('pluginResize.cbp', function() {
                        t.deferredInline.done(finishLoading);
                    });

                    t.slider = selectorSlider.cubeportfolio({
                        layoutMode: 'slider',
                        displayType: 'default',
                        mediaQueries: [{
                            width: 1,
                            cols: 1
                        }],
                        gapHorizontal: 0,
                        gapVertical: 0,
                        caption: '',
                        coverRatio: '', // wp version only
                    });
                } else {
                    t.slider = null;
                    t.deferredInline.done(finishLoading);
                }

                // check for social share icons
                t.checkForSocialLinks(t.content);
            });
        },

        isImage: function(el) {
            var t = this,
                img = new Image();

            t.tooggleLoading(true);

            t.cubeportfolio.loadImages($('<div><img src="' + el.src + '"></div>'), function() {
                t.updateImagesMarkup(el.src, el.title, t.getCounterMarkup(t.options.lightboxCounter, t.current + 1, t.counterTotal));

                t.tooggleLoading(false);
            });
        },

        isVimeo: function(el) {
            var t = this;
            t.updateVideoMarkup(el.src, el.title, t.getCounterMarkup(t.options.lightboxCounter, t.current + 1, t.counterTotal));
        },

        isYoutube: function(el) {
            var t = this;
            t.updateVideoMarkup(el.src, el.title, t.getCounterMarkup(t.options.lightboxCounter, t.current + 1, t.counterTotal));

        },

        isTed: function(el) {
            var t = this;
            t.updateVideoMarkup(el.src, el.title, t.getCounterMarkup(t.options.lightboxCounter, t.current + 1, t.counterTotal));
        },

        isSoundCloud: function(el) {
            var t = this;
            t.updateVideoMarkup(el.src, el.title, t.getCounterMarkup(t.options.lightboxCounter, t.current + 1, t.counterTotal));
        },

        isSelfHostedVideo: function(el) {
            var t = this;
            t.updateSelfHostedVideo(el.src, el.title, t.getCounterMarkup(t.options.lightboxCounter, t.current + 1, t.counterTotal));
        },

        isSelfHostedAudio: function(el) {
            var t = this;
            t.updateSelfHostedAudio(el.src, el.title, t.getCounterMarkup(t.options.lightboxCounter, t.current + 1, t.counterTotal));
        },

        getCounterMarkup: function(markup, current, total) {
            if (!markup.length) {
                return '';
            }

            var mapObj = {
                current: current,
                total: total
            };

            return markup.replace(/\{\{current}}|\{\{total}}/gi, function(matched) {
                return mapObj[matched.slice(2, -2)];
            });
        },

        updateSelfHostedVideo: function(src, title, counter) {
            var t = this,
                i;

            t.wrap.addClass('cbp-popup-lightbox-isIframe');

            var markup = '<div class="cbp-popup-lightbox-iframe">' +
                '<video controls="controls" height="auto" style="width: 100%">';

            for (i = 0; i < src.length; i++) {
                if (/(\.mp4)/i.test(src[i])) {
                    markup += '<source src="' + src[i] + '" type="video/mp4">';
                } else if (/(\.ogg)|(\.ogv)/i.test(src[i])) {
                    markup += '<source src="' + src[i] + '" type="video/ogg">';
                } else if (/(\.webm)/i.test(src[i])) {
                    markup += '<source src="' + src[i] + '" type="video/webm">';
                }
            }

            markup += 'Your browser does not support the video tag.' +
                '</video>' +
                '<div class="cbp-popup-lightbox-bottom">' +
                ((title) ? '<div class="cbp-popup-lightbox-title">' + title + '</div>' : '') +
                counter +
                '</div>' +
                '</div>';

            t.content.html(markup);
            t.wrap.addClass('cbp-popup-ready');
            t.preloadNearbyImages();
        },

        updateSelfHostedAudio: function(src, title, counter) {
            var t = this,
                i;

            t.wrap.addClass('cbp-popup-lightbox-isIframe');

            var markup = '<div class="cbp-popup-lightbox-iframe">' +
                '<div class="cbp-misc-video"><audio controls="controls" height="auto" style="width: 75%">' +
                '<source src="' + src + '" type="audio/mpeg">' +
                'Your browser does not support the audio tag.' +
                '</audio></div>' +
                '<div class="cbp-popup-lightbox-bottom">' +
                ((title) ? '<div class="cbp-popup-lightbox-title">' + title + '</div>' : '') +
                counter +
                '</div>' +
                '</div>';

            t.content.html(markup);
            t.wrap.addClass('cbp-popup-ready');
            t.preloadNearbyImages();
        },

        updateVideoMarkup: function(src, title, counter) {
            var t = this;
            t.wrap.addClass('cbp-popup-lightbox-isIframe');

            var markup = '<div class="cbp-popup-lightbox-iframe">' +
                '<iframe src="' + src + '" frameborder="0" allowfullscreen scrolling="no"></iframe>' +
                '<div class="cbp-popup-lightbox-bottom">' +
                ((title) ? '<div class="cbp-popup-lightbox-title">' + title + '</div>' : '') +
                counter +
                '</div>' +
                '</div>';

            t.content.html(markup);
            t.wrap.addClass('cbp-popup-ready');
            t.preloadNearbyImages();
        },

        updateImagesMarkup: function(src, title, counter) {
            var t = this;

            t.wrap.removeClass('cbp-popup-lightbox-isIframe');

            var markup = '<div class="cbp-popup-lightbox-figure">' +
                '<img src="' + src + '" class="cbp-popup-lightbox-img" ' + t.dataActionImg + ' />' +
                '<div class="cbp-popup-lightbox-bottom">' +
                ((title) ? '<div class="cbp-popup-lightbox-title">' + title + '</div>' : '') +
                counter +
                '</div>' +
                '</div>';

            t.content.html(markup);
            t.wrap.addClass('cbp-popup-ready');
            t.resizeImage();
            t.preloadNearbyImages();
        },

        next: function() {
            var t = this;
            t[t.type + 'JumpTo'](1);
        },

        prev: function() {
            var t = this;
            t[t.type + 'JumpTo'](-1);
        },

        lightboxJumpTo: function(index) {
            var t = this,
                el;

            t.current = t.getIndex(t.current + index);

            // get the current element
            el = t.dataArray[t.current];

            // call function if current element is image or video (iframe)
            t[el.type](el);
        },


        singlePageJumpTo: function(index) {
            var t = this;

            t.current = t.getIndex(t.current + index);

            // register singlePageCallback function
            if ($.isFunction(t.options.singlePageCallback)) {
                t.resetWrap();

                // go to top of the page (reset scroll)
                t.wrap.scrollTop(0);

                t.wrap.addClass('cbp-popup-loading');
                t.options.singlePageCallback.call(t, t.dataArray[t.current].url, t.dataArray[t.current].element);

                if (t.options.singlePageDeeplinking) {
                    location.href = t.url + '#cbp=' + t.dataArray[t.current].url;
                }
            }
        },

        resetWrap: function() {
            var t = this;

            if (t.type === 'singlePage' && t.options.singlePageDeeplinking) {
                location.href = t.url + '#';
            }

            if (t.type === 'singlePageInline' && t.options.singlePageInlineDeeplinking) {
                location.href = t.url + '#';
            }
        },

        getIndex: function(index) {
            var t = this;

            // go to interval [0, (+ or -)this.counterTotal.length - 1]
            index = index % t.counterTotal;

            // if index is less then 0 then go to interval (0, this.counterTotal - 1]
            if (index < 0) {
                index = t.counterTotal + index;
            }

            return index;
        },

        close: function(method, data) {
            var t = this;

            function finishClose() {
                // reset content
                t.content.html('');

                // hide the wrap
                t.wrap.detach();

                t.cubeportfolio.$obj.removeClass('cbp-popup-singlePageInline-open cbp-popup-singlePageInline-close');

                if (method === 'promise') {
                    if ($.isFunction(data.callback)) {
                        data.callback.call(t.cubeportfolio);
                    }
                }

                t.resetWrap();
            }

            function checkFocusInline() {
                if (t.options.singlePageInlineInFocus && method !== 'promise') {
                    $('html,body').animate({
                            scrollTop: t.scrollTop
                        }, 350)
                        .promise()
                        .then(function() {
                            finishClose();
                        });
                } else {
                    finishClose();
                }
            }

            // now the popup is closed
            t.isOpen = false;

            if (t.type === 'singlePageInline') {
                if (method === 'open') {
                    t.wrap.removeClass('cbp-popup-singlePageInline-ready');
                    $(t.dataArray[t.current].element).closest('.cbp-item').removeClass('cbp-singlePageInline-active');
                    t.openSinglePageInline(data.blocks, data.currentBlock, data.fromOpen);
                } else {
                    t.height = 0;

                    t.revertResizeSinglePageInline();
                    t.wrap.removeClass('cbp-popup-singlePageInline-ready');
                    t.cubeportfolio.$obj.addClass('cbp-popup-singlePageInline-close');
                    t.cubeportfolio.$obj.find('.cbp-item').removeClass('cbp-singlePageInline-active');

                    if (CubePortfolio.private.modernBrowser) {
                        t.wrap.one(CubePortfolio.private.transitionend, function() {
                            checkFocusInline();
                        });
                    } else {
                        checkFocusInline();
                    }
                }

            } else if (t.type === 'singlePage') {
                t.resetWrap();

                t.wrap.removeClass('cbp-popup-ready cbp-popup-transitionend');

                // scroll bug on android and ios
                if (CubePortfolio.private.browser === 'android' || CubePortfolio.private.browser === 'ios') {
                    $('html').css({
                        position: ''
                    });

                    t.navigationWrap.appendTo(t.wrap);
                    t.navigationMobile.remove();
                }

                $(window).scrollTop(t.scrollTop);

                // weird bug on mozilla. fixed with setTimeout
                setTimeout(function() {
                    t.stopScroll = true;

                    t.navigationWrap.css({
                        top: t.wrap.scrollTop()
                    });

                    t.wrap.removeClass('cbp-popup-singlePage-open cbp-popup-singlePage-sticky');

                    if (CubePortfolio.private.browser === 'ie8' || CubePortfolio.private.browser === 'ie9') {
                        // reset content
                        t.content.html('');

                        // hide the wrap
                        t.wrap.detach();

                        $('html').css({
                            overflow: '',
                            marginRight: '',
                            position: ''
                        });

                        t.navigationWrap.removeAttr('style');
                    }
                }, 0);

                $('html').css({
                    overflow: '',
                    marginRight: '',
                    position: ''
                });

                t.wrap.one(CubePortfolio.private.transitionend, function() {
                    // reset content
                    t.content.html('');

                    // hide the wrap
                    t.wrap.detach();


                    t.navigationWrap.removeAttr('style');
                });
            } else {
                if (t.originalStyle) {
                    $('html').attr('style', t.originalStyle);
                } else {
                    $('html').css({
                        overflow: '',
                        marginRight: ''
                    });
                }

                $(window).scrollTop(t.scrollTop);

                // reset content
                t.content.html('');

                // hide the wrap
                t.wrap.detach();
            }
        },

        tooggleLoading: function(state) {
            var t = this;

            t.stopEvents = state;
            t.wrap[(state) ? 'addClass' : 'removeClass']('cbp-popup-loading');
        },

        resizeImage: function() {
            // if lightbox is not open go out
            if (!this.isOpen) {
                return;
            }

            var height = $(window).height(),
                img = this.content.find('img'),
                padding = parseInt(img.css('margin-top'), 10) + parseInt(img.css('margin-bottom'), 10);

            img.css('max-height', (height - padding) + 'px');
        },

        preloadNearbyImages: function() {
            var arr = [],
                img, t = this,
                src;

            arr.push(t.getIndex(t.current + 1));
            arr.push(t.getIndex(t.current + 2));
            arr.push(t.getIndex(t.current + 3));
            arr.push(t.getIndex(t.current - 1));
            arr.push(t.getIndex(t.current - 2));
            arr.push(t.getIndex(t.current - 3));

            for (var i = arr.length - 1; i >= 0; i--) {
                if (t.dataArray[arr[i]].type === 'isImage') {
                    t.cubeportfolio.checkSrc(t.dataArray[arr[i]].src);
                }
            }
        }
    };

    function Plugin(parent) {
        var t = this;

        t.parent = parent;

        // if lightboxShowCounter is false, put lightboxCounter to ''
        if (parent.options.lightboxShowCounter === false) {
            parent.options.lightboxCounter = '';
        }

        // if singlePageShowCounter is false, put singlePageCounter to ''
        if (parent.options.singlePageShowCounter === false) {
            parent.options.singlePageCounter = '';
        }

        // @todo - schedule this in  future
        parent.registerEvent('initStartRead', function() {
            t.run();
        }, true);
    }

    var lightboxInit = false,
        singlePageInit = false;

    Plugin.prototype.run = function() {
        var t = this,
            p = t.parent,
            body = $(document.body);

        // default value for lightbox
        p.lightbox = null;

        // LIGHTBOX
        if (p.options.lightboxDelegate && !lightboxInit) {
            // init only one time @todo
            lightboxInit = true;

            p.lightbox = Object.create(popup);
            p.lightbox.init(p, 'lightbox');

            body.on('click.cbp', p.options.lightboxDelegate, function(e) {
                e.preventDefault();

                var self = $(this),
                    gallery = self.attr('data-cbp-lightbox'),
                    scope = t.detectScope(self),
                    cbp = scope.data('cubeportfolio'),
                    blocks = [];

                // is inside a cbp
                if (cbp) {
                    cbp.blocksOn.each(function(index, el) {
                        var item = $(el);

                        if (item.not('.cbp-item-off')) {
                            item.find(p.options.lightboxDelegate).each(function(index2, el2) {
                                if (gallery) {
                                    if ($(el2).attr('data-cbp-lightbox') === gallery) {
                                        blocks.push(el2);
                                    }
                                } else {
                                    blocks.push(el2);
                                }
                            });
                        }
                    });
                } else {
                    if (gallery) {
                        blocks = scope.find(p.options.lightboxDelegate + '[data-cbp-lightbox=' + gallery + ']');
                    } else {
                        blocks = scope.find(p.options.lightboxDelegate);
                    }
                }

                p.lightbox.openLightbox(blocks, self[0]);
            });
        }

        // default value for singlePage
        p.singlePage = null;

        // SINGLEPAGE
        if (p.options.singlePageDelegate && !singlePageInit) {
            // init only one time @todo
            singlePageInit = true;

            p.singlePage = Object.create(popup);
            p.singlePage.init(p, 'singlePage');

            body.on('click.cbp', p.options.singlePageDelegate, function(e) {
                e.preventDefault();

                var self = $(this),
                    gallery = self.attr('data-cbp-singlePage'),
                    scope = t.detectScope(self),
                    cbp = scope.data('cubeportfolio'),
                    blocks = [];

                // is inside a cbp
                if (cbp) {
                    cbp.blocksOn.each(function(index, el) {
                        var item = $(el);

                        if (item.not('.cbp-item-off')) {
                            item.find(p.options.singlePageDelegate).each(function(index2, el2) {
                                if (gallery) {
                                    if ($(el2).attr('data-cbp-singlePage') === gallery) {
                                        blocks.push(el2);
                                    }
                                } else {
                                    blocks.push(el2);
                                }
                            });
                        }
                    });
                } else {
                    if (gallery) {
                        blocks = scope.find(p.options.singlePageDelegate + '[data-cbp-singlePage=' + gallery + ']');
                    } else {
                        blocks = scope.find(p.options.singlePageDelegate);
                    }
                }

                p.singlePage.openSinglePage(blocks, self[0]);
            });
        }

        // default value for singlePageInline
        p.singlePageInline = null;

        // SINGLEPAGEINLINE
        if (p.options.singlePageInlineDelegate) {
            p.singlePageInline = Object.create(popup);

            p.singlePageInline.init(p, 'singlePageInline');

            p.$obj.on('click.cbp', p.options.singlePageInlineDelegate, function(e) {
                e.preventDefault();

                var oldDate = $.data(this, 'cbp-locked'),
                    newDate = $.data(this, 'cbp-locked', +new Date());

                if(!oldDate || ((newDate - oldDate) > 300)) {
                    p.singlePageInline.openSinglePageInline(p.blocksOn, this);
                }
            });
        }
    };

    Plugin.prototype.detectScope = function(item) {
        var singlePageInline,
            singlePage,
            cbp;

        singlePageInline = item.closest('.cbp-popup-singlePageInline');
        if (singlePageInline.length) {
            cbp = item.closest('.cbp', singlePageInline[0]);
            return (cbp.length) ? cbp : singlePageInline;
        }

        singlePage = item.closest('.cbp-popup-singlePage');
        if (singlePage.length) {
            cbp = item.closest('.cbp', singlePage[0]);
            return (cbp.length) ? cbp : singlePage;
        }

        cbp = item.closest('.cbp');
        return (cbp.length) ? cbp : $(document.body);

    };

    Plugin.prototype.destroy = function() {
        var p = this.parent;

        $(document.body).off('click.cbp');

        // @todo - remove these from here
        lightboxInit = false;
        singlePageInit = false;

        // destroy lightbox if enabled
        if (p.lightbox) {
            p.lightbox.destroy();
        }

        // destroy singlePage if enabled
        if (p.singlePage) {
            p.singlePage.destroy();
        }

        // destroy singlePage inline if enabled
        if (p.singlePageInline) {
            p.singlePageInline.destroy();
        }
    };

    CubePortfolio.plugins.popUp = function(parent) {
        return new Plugin(parent);
    };
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var t = this;

        t.parent = parent;

        t.searchInput = $(parent.options.search);

        t.searchInput.each(function(index, el) {
            var selector = el.getAttribute('data-search');

            if (!selector) {
                selector = '*';
            }

            $.data(el, 'searchData', {
                value: el.value,
                el: selector
            });
        });

        var timeout = null;

        t.searchInput.on('keyup.cbp paste.cbp', function(e) {
            e.preventDefault();

            var el = $(this);

            clearTimeout(timeout);
            timeout = setTimeout(function() {
                t.runEvent.call(t, el);
            }, 300);
        });

        t.searchNothing = t.searchInput.siblings('.cbp-search-nothing').detach();
        t.searchNothingHeight = null;
        t.searchNothingHTML = t.searchNothing.html();

        t.searchInput.siblings('.cbp-search-icon').on('click.cbp', function(e) {
            e.preventDefault();

            t.runEvent.call(t, $(this).prev().val(''));
        });
    }

    Plugin.prototype.runEvent = function(el) {
        var t = this,
            value = el.val(),
            searchData = el.data('searchData'),
            reg = new RegExp(value, 'i');

        if (searchData.value === value || t.parent.isAnimating) {
            return;
        }

        searchData.value = value;

        if (value.length > 0) {
            el.attr('value', value);
        } else {
            el.removeAttr('value');
        }

        t.parent.$obj.cubeportfolio('filter', function(blocks) {
            var blocksNew = blocks.filter(function(index, block) {
                var text = $(block).find(searchData.el).text();

                if (text.search(reg) > -1) {
                    return true;
                }
            });

            if (blocksNew.length === 0 && t.searchNothing.length) {
                var innerText = t.searchNothingHTML.replace('{{query}}', value);
                t.searchNothing.html(innerText);

                t.searchNothing.appendTo(t.parent.$obj);

                if (t.searchNothingHeight === null) {
                    t.searchNothingHeight = t.searchNothing.outerHeight(true);
                }

                t.parent.registerEvent('resizeMainContainer', function() {
                    t.parent.height = t.parent.height + t.searchNothingHeight;
                    t.parent.obj.style.height = t.parent.height + 'px';
                }, true);
            } else {
                t.searchNothing.detach();
            }

            return blocksNew;
        }, function() {
            el.trigger('keyup.cbp');
        });
    };

    Plugin.prototype.destroy = function() {
        var t = this;

        t.searchInput.off('.cbp');
        t.searchInput.next('.cbp-search-icon').off('.cbp');

        t.searchInput.each(function(index, el) {
            $.removeData(el);
        });
    };

    CubePortfolio.plugins.search = function(parent) {
        if (parent.options.search === '') {
            return null;
        }

        return new Plugin(parent);
    };
})(jQuery, window, document);

(function($, window, document, undefined) {
    'use strict';

    var options = {
        /**
         *  Pagination custom selector
         *  Values: strings that represent the elements in the document (DOM selector).
         */
        pagination: '',
        paginationClass: 'cbp-pagination-active',
    };

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var t = this;

        t.parent = parent;

        t.options = $.extend({}, options, t.parent.options.plugins.slider);

        var customPagination = $(t.options.pagination);

        if (customPagination.length > 0) {
            t.parent.customPagination = customPagination;
            t.parent.customPaginationItems = customPagination.children();
            t.parent.customPaginationClass = t.options.paginationClass;

            t.parent.customPaginationItems.on('click.cbp', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                e.stopPropagation();

                if (t.parent.sliderStopEvents) {
                    return;
                }

                t.parent.jumpToSlider($(this));
            });
        }

        t.parent.registerEvent('gridAdjust', function() {
            t.sliderMarkup.call(t.parent);

            t.parent.registerEvent('gridAdjust', function() {
                t.updateSlider.call(t.parent);
            });
        }, true);
    }

    /**
     * Create mark-up for slider layout
     */
    Plugin.prototype.sliderMarkup = function() {
        var t = this;

        t.sliderStopEvents = false;

        t.sliderActive = 0;

        t.$obj.one('initComplete.cbp', function() {
            t.$obj.addClass('cbp-mode-slider');
        });

        t.nav = $('<div/>', {
            'class': 'cbp-nav'
        });

        t.nav.on('click.cbp', '[data-slider-action]', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            e.stopPropagation();

            if (t.sliderStopEvents) {
                return;
            }

            var el = $(this),
                action = el.attr('data-slider-action');

            if (t[action + 'Slider']) {
                t[action + 'Slider'](el);
            }
        });

        if (t.options.showNavigation) {
            t.controls = $('<div/>', {
                'class': 'cbp-nav-controls'
            });

            t.navPrev = $('<div/>', {
                'class': 'cbp-nav-prev',
                'data-slider-action': 'prev'
            }).appendTo(t.controls);

            t.navNext = $('<div/>', {
                'class': 'cbp-nav-next',
                'data-slider-action': 'next'
            }).appendTo(t.controls);

            t.controls.appendTo(t.nav);
        }

        if (t.options.showPagination) {
            t.navPagination = $('<div/>', {
                'class': 'cbp-nav-pagination'
            }).appendTo(t.nav);
        }

        if (t.controls || t.navPagination) {
            t.nav.appendTo(t.$obj);
        }

        t.updateSliderPagination();

        if (t.options.auto) {
            if (t.options.autoPauseOnHover) {
                t.mouseIsEntered = false;
                t.$obj.on('mouseenter.cbp', function(e) {
                    t.mouseIsEntered = true;
                    t.stopSliderAuto();
                }).on('mouseleave.cbp', function(e) {
                    t.mouseIsEntered = false;
                    t.startSliderAuto();
                });
            }

            t.startSliderAuto();
        }

        if (t.options.drag && CubePortfolio.private.modernBrowser) {
            t.dragSlider();
        }
    };

    Plugin.prototype.updateSlider = function() {
        var t = this;

        t.updateSliderPosition();

        t.updateSliderPagination();
    };

    Plugin.prototype.destroy = function() {
        var t = this;

        if (t.parent.customPaginationItems) {
            t.parent.customPaginationItems.off('.cbp');
        }

        if (t.parent.controls || t.parent.navPagination) {
            t.parent.nav.off('.cbp');
            t.parent.nav.remove();
        }
    };

    CubePortfolio.plugins.slider = function(parent) {
        if (parent.options.layoutMode !== 'slider') {
            return null;
        }

        return new Plugin(parent);
    };
})(jQuery, window, document);
