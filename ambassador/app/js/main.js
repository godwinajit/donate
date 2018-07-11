function initLightbox() {
    jQuery('a.open-lightbox, a[rel*="open-lightbox"]').fancybox({
        helpers: {
            overlay: {
                css: {
                    background: "rgba(0, 0, 0, 0.80)"
                }
            }
        },
        afterLoad: function(e, t) {
            0 === e.href.indexOf("#") && jQuery(e.href).find("a.close").off("click.fb").on("click.fb", function(e) {
                e.preventDefault(), jQuery.fancybox.close()
            })
        },
        padding: 0
    })
}

function initCustomForms() {
    jcf.setOptions("Select", {
        wrapNative: !1
    }), jcf.replaceAll()
}

function initHeaderCollapsed() {
    var e = ".header-extended",
        t = "header-collapsed",
        i = "header-expanded",
        n = $(".header"),
        s = n.outerHeight();
    $(document).find(e).length > 0 && $(window).on("scroll.header", function() {
        $(document).scrollTop() > s ? n.addClass(t).removeClass(i) : n.hasClass(t) && n.addClass(i).removeClass(t)
    }).trigger("scroll")
}

function initToggleContent() {
    jQuery("div.toggle-content").openClose({
        hideOnClickOutside: !1,
        activeClass: "expanded",
        opener: "a.toggle-content-opener",
        slider: "div.toggle-content-slide",
        animSpeed: 500,
        effect: "slide"
    })
}

function initRetinaCover() {
    jQuery(".bg-stretch").retinaCover()
}

function scrollBarWidth() {
    var e = document.createElement("div");
    $(e).css({
        width: "100",
        height: "100",
        overflow: "scroll",
        position: "absolute",
        top: "-9999"
    }), document.body.appendChild(e);
    var t = e.offsetWidth - e.clientWidth;
    return document.body.removeChild(e), t
}

function initAccordion() {
    jQuery(".accordion").slideAccordion({
        allowClickWhenExpanded: !0,
        activeClass: "accordion-active",
        opener: "> a.accordion-opener",
        slider: "> div.accordion-slide",
        collapsible: !0,
        animSpeed: 300
    })
}

function initPopup(e, t, i) {
    var n = ".popup-close",
        s = $("body"),
        o = $(".header"),
        a = scrollBarWidth();
    "popup-nav" != e && $(t).on("click", function(e) {
        e.preventDefault(), s.toggleClass("search-open").css("padding-right", a + "px"), o.css("padding-right", a + "px")
    }), s.on("click", n, function(e) {
        e.preventDefault(), s.hasClass("search-open") && (s.toggleClass("search-open").css("padding-right", "0px"), o.css("padding-right", "0px")), s.hasClass("nav-open") && s.toggleClass("nav-open")
    })
}

function initEnquire() {
    function e(e) {
        e.preventDefault();
        var t = jQuery(this);
        t.parent().hasClass(o) ? t.parent().removeClass(o) : (d.removeClass(o), t.parent().addClass(o))
    }

    function t(e) {
        e.preventDefault(), r.toggleClass("nav-open")
    }

    function i(e) {
        var t = jQuery((e.changedTouches ? e.changedTouches[0] : e).target);
        t.closest(".accordion-slide").length || t.closest(".accordion-opener").length || d.removeClass(o)
    }

    function n() {
        $(document).scrollTop() >= m && (initPieChart(129, 9), $(window).off("scroll.chart"))
    }

    function s() {
        $(document).scrollTop() >= m && (initPieChart(166, 10), $(window).off("scroll.chart"))
    }
    var o = "drop-active",
        a = jQuery(document),
        r = jQuery("body"),
        l = jQuery(".popup-nav .accordion"),
        c = jQuery(".nav-list"),
        h = jQuery(".nav-opener"),
        d = c.find(">li");
    if (l.html(c.html()), d.each(function() {
            var e = jQuery(this),
                t = e.find("> .accordion-opener"),
                i = e.find("> .accordion-slide"),
                n = $("<strong>"),
                s = $("<a>");
            s.attr("href", t.attr("href")), s.text(t.text()), n.addClass("title").append(s), i.prepend(n)
        }), initAccordion(), enquire.register("screen and (max-width: 1023px)", {
            match: function() {
                h.on("click", t), c.off("click", ">li>a", e), a.off("click touchstart", i)
            }
        }).register("screen and (min-width: 1024px)", {
            match: function() {
                c.on("click", ">li>a", e), a.on("click touchstart", i), h.off("click", t), r.removeClass("nav-open")
            }
        }), $(document).find(".chart").length > 0) {
        var u = $(".chart"),
            p = u.offset().top,
            f = u.height(),
            m = p + f - $(window).height();
        enquire.register("screen and (max-width: 767px)", {
            match: function() {
                $(window).on("scroll.chart", n).trigger("scroll")
            }
        }).register("screen and (min-width: 768px)", {
            match: function() {
                $(window).on("scroll.chart", s).trigger("scroll")
            }
        }).register("screen and (min-width: 1024px)", {
            match: function() {
                initHeaderCollapsed()
            },
            unmatch: function() {
                $(window).off("scroll.header")
            }
        })
    }
}

function initPieChart(e, t) {
    var i = $(".chart .chart-box").map(function(e, t) {
        return $(t).data("pieChart")
    });
    return i.length && i[0] ? void i.each(function(i, n) {
        n.redraw({
            size: e,
            lineWidth: t
        })
    }) : ($(".chart .chart-box").pieChart({
        colorStart: "#429321",
        colorFinish: "#b4ec51",
        trackColor: "#e9e9e9",
        lineCap: "round",
        size: e,
        lineWidth: t,
        onStep: function(e, t, i) {
            $(this.element).find(".chart-value").text(Math.round(i) + "%")
        }
    }), void $(".chart").addClass("chart-activated"))
}
jQuery(function(e) {
        var t = e("#ambassador-form");
        if (t.length) {
            var i = t.validate({
                errorPlacement: function() {
                    var t;
                    return function(i, n) {
                        clearTimeout(t), t = setTimeout(function() {
                            e(n).closest(".ambassador-form-step").find(".form-note").show()
                        }, 50)
                    }
                }(),
                errorClass: "error",
                validClass: "valid"
            });
            t.on("submit", function(s) {
                /*s.preventDefault(),*/ t.valid() && (t.addClass("sending"), e.post(/*t.attr("action"), t.serialize()*/).done(function() {
                    n.nextStep(), s.currentTarget.reset(), i.resetForm(), t.find(".form-note").hide()
                }).fail(function(e) {
                    console.error(e)
                }).always(function() {
                    t.removeClass("sending")
                }))
            }), e(document).on("click", ".ambassador-form-nav > li", function(i) {
                i.preventDefault();
                var s = e(this),
                    o = s.index();
                o < n._currentIndex ? n.toStep(o) : o > n._currentIndex && (o === n.stepsLength() - 1 && n._currentIndex === n.stepsLength() - 2 ? n.nextStep() : n.nextStep())
            });
            var n = new Steps("#ambassador-form", {
                steps: ".ambassador-form-step",
                btnNext: ".js-btn-step-next",
                activeClass: "active",
                isCanChange: function(e, i) {
                    return !(e < i) || t.valid()
                },
                onChange: function(t, i) {
                    var n = e(".ambassador-form-nav > li"),
                        s = n.eq(t);
					jQuery('html, body').animate({scrollTop: $("#step-change-scroll-to").offset().top}, 1000);
                    s.prevAll().removeClass("step-active").addClass("step-passed"), s.nextAll().removeClass("step-active").removeClass("step-passed"), s.addClass("step-active")
                }
            })
        }
    }), jQuery(function(e) {
        var t = e("#donate-form");
        if (t.length) {
            var i = t.validate({
                errorPlacement: function() {
                    var t;
                    return function(i, n) {
                        clearTimeout(t), t = setTimeout(function() {
                            e(n).closest(".donate-form-step").find(".form-note").show()
                        }, 50)
                    }
                }(),
                errorClass: "error",
                validClass: "valid",
                ignore: function(t, i) {
                    return e(i).is(":disabled,:hidden") || !e(i).closest(".donate-form-step").is(n.getCurrentStep()) || !!e(i).closest(".js-slide-hidden").length
                }
            });
            t.on("submit", function(s) {
                s.preventDefault(), t.valid() && (t.addClass("sending"), e.post(t.attr("action"), t.serialize()).done(function() {
                    n.nextStep(), s.currentTarget.reset(), i.resetForm(), t.find(".form-note").hide()
                }).fail(function(e) {
                    console.error(e)
                }).always(function() {
                    t.removeClass("sending")
                }))
            }), t.on("click", ".donate-sum-box", function(e) {
                e.preventDefault(), t.find('[name^="donate-sum-"]').val(this.dataset.donateSum), n.nextStep()
            }), t.on("change", '[name^="donate-sum-"]', function(e) {
                var i = e.currentTarget.value;
                t.find('[name^="donate-sum-"]').not(e.currentTarget).val(i)
            }), e(document).on("click", ".donate-form-nav > li", function(i) {
                i.preventDefault();
                var s = e(this),
                    o = s.index();
                o < n._currentIndex ? n.toStep(o) : o > n._currentIndex && (o === n.stepsLength() - 1 && n._currentIndex === n.stepsLength() - 2 ? t.submit() : n.nextStep())
            });
            var n = new Steps("#donate-form", {
                steps: ".donate-form-step",
                btnNext: ".js-btn-step-next",
                activeClass: "active",
                isCanChange: function(e, i) {
                    return !(e < i) || t.valid()
                },
                onChange: function(t, i) {
                    var n = e(".donate-form-nav > li"),
                        s = n.eq(t);
                    s.prevAll().removeClass("step-active").addClass("step-passed"), s.nextAll().removeClass("step-active").removeClass("step-passed"), s.addClass("step-active")
                }
            })
        }
    }), jQuery(function() {
        initToggleContent(), initCustomForms(), initRetinaCover(), initEnquire(), initPopup("search-nav", ".search-opener"), initLightbox()
    }),
    function(e, t) {
        "use strict";
        "function" == typeof define && define.amd ? define(["jquery"], t) : "object" == typeof exports ? module.exports = t(require("jquery")) : e.jcf = t(jQuery)
    }(this, function(e) {
        "use strict";
        var t = "1.1.3",
            i = [],
            n = {
                optionsKey: "jcf",
                dataKey: "jcf-instance",
                rtlClass: "jcf-rtl",
                focusClass: "jcf-focus",
                pressedClass: "jcf-pressed",
                disabledClass: "jcf-disabled",
                hiddenClass: "jcf-hidden",
                resetAppearanceClass: "jcf-reset-appearance",
                unselectableClass: "jcf-unselectable"
            },
            s = "ontouchstart" in window || window.DocumentTouch && document instanceof window.DocumentTouch,
            o = /Windows Phone/.test(navigator.userAgent);
        n.isMobileDevice = !(!s && !o);
        var a = /(iPad|iPhone).*OS ([0-9_]*) .*/.exec(navigator.userAgent);
        a && (a = parseFloat(a[2].replace(/_/g, "."))), n.ios = a;
        var r = function() {
            var t = e("<style>").appendTo("head"),
                i = t.prop("sheet") || t.prop("styleSheet"),
                s = function(e, t, n) {
                    i.insertRule ? i.insertRule(e + "{" + t + "}", n) : i.addRule(e, t, n)
                };
            s("." + n.hiddenClass, "position:absolute !important;left:-9999px !important;height:1px !important;width:1px !important;margin:0 !important;border-width:0 !important;-webkit-appearance:none;-moz-appearance:none;appearance:none"), s("." + n.rtlClass + " ." + n.hiddenClass, "right:-9999px !important; left: auto !important"), s("." + n.unselectableClass, "-webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-tap-highlight-color: rgba(0,0,0,0);"), s("." + n.resetAppearanceClass, "background: none; border: none; -webkit-appearance: none; appearance: none; opacity: 0; filter: alpha(opacity=0);");
            var o = e("html"),
                a = e("body");
            "rtl" !== o.css("direction") && "rtl" !== a.css("direction") || o.addClass(n.rtlClass), o.on("reset", function() {
                setTimeout(function() {
                    c.refreshAll()
                }, 0)
            }), n.styleSheetCreated = !0
        };
        ! function() {
            var t, i = navigator.pointerEnabled || navigator.msPointerEnabled,
                n = "ontouchstart" in window || window.DocumentTouch && document instanceof window.DocumentTouch,
                s = {},
                o = "jcf-";
            t = i ? {
                pointerover: navigator.pointerEnabled ? "pointerover" : "MSPointerOver",
                pointerdown: navigator.pointerEnabled ? "pointerdown" : "MSPointerDown",
                pointermove: navigator.pointerEnabled ? "pointermove" : "MSPointerMove",
                pointerup: navigator.pointerEnabled ? "pointerup" : "MSPointerUp"
            } : {
                pointerover: "mouseover",
                pointerdown: "mousedown" + (n ? " touchstart" : ""),
                pointermove: "mousemove" + (n ? " touchmove" : ""),
                pointerup: "mouseup" + (n ? " touchend" : "")
            }, e.each(t, function(t, i) {
                e.each(i.split(" "), function(e, i) {
                    s[i] = t
                })
            }), e.each(t, function(t, i) {
                i = i.split(" "), e.event.special[o + t] = {
                    setup: function() {
                        var t = this;
                        e.each(i, function(e, i) {
                            t.addEventListener ? t.addEventListener(i, l, !1) : t["on" + i] = l
                        })
                    },
                    teardown: function() {
                        var t = this;
                        e.each(i, function(e, i) {
                            t.addEventListener ? t.removeEventListener(i, l, !1) : t["on" + i] = null
                        })
                    }
                }
            });
            var a = null,
                r = function(e) {
                    var t = Math.abs(e.pageX - a.x),
                        i = Math.abs(e.pageY - a.y),
                        n = 25;
                    if (t <= n && i <= n) return !0
                },
                l = function(t) {
                    var i = t || window.event,
                        n = null,
                        l = s[i.type];
                    if (t = e.event.fix(i), t.type = o + l, i.pointerType) switch (i.pointerType) {
                        case 2:
                            t.pointerType = "touch";
                            break;
                        case 3:
                            t.pointerType = "pen";
                            break;
                        case 4:
                            t.pointerType = "mouse";
                            break;
                        default:
                            t.pointerType = i.pointerType
                    } else t.pointerType = i.type.substr(0, 5);
                    return t.pageX || t.pageY || (n = i.changedTouches ? i.changedTouches[0] : i, t.pageX = n.pageX, t.pageY = n.pageY), "touchend" === i.type && (a = {
                        x: t.pageX,
                        y: t.pageY
                    }), "mouse" === t.pointerType && a && r(t) ? void 0 : (e.event.dispatch || e.event.handle).call(this, t)
                }
        }(),
        function() {
            var t = ("onwheel" in document || document.documentMode >= 9 ? "wheel" : "mousewheel DOMMouseScroll").split(" "),
                i = "jcf-mousewheel";
            e.event.special[i] = {
                setup: function() {
                    var i = this;
                    e.each(t, function(e, t) {
                        i.addEventListener ? i.addEventListener(t, n, !1) : i["on" + t] = n
                    })
                },
                teardown: function() {
                    var i = this;
                    e.each(t, function(e, t) {
                        i.addEventListener ? i.removeEventListener(t, n, !1) : i["on" + t] = null
                    })
                }
            };
            var n = function(t) {
                var n = t || window.event;
                if (t = e.event.fix(n), t.type = i, "detail" in n && (t.deltaY = -n.detail), "wheelDelta" in n && (t.deltaY = -n.wheelDelta), "wheelDeltaY" in n && (t.deltaY = -n.wheelDeltaY), "wheelDeltaX" in n && (t.deltaX = -n.wheelDeltaX), "deltaY" in n && (t.deltaY = n.deltaY), "deltaX" in n && (t.deltaX = n.deltaX), t.delta = t.deltaY || t.deltaX, 1 === n.deltaMode) {
                    var s = 16;
                    t.delta *= s, t.deltaY *= s, t.deltaX *= s
                }
                return (e.event.dispatch || e.event.handle).call(this, t)
            }
        }();
        var l = {
                fireNativeEvent: function(t, i) {
                    e(t).each(function() {
                        var e, t = this;
                        t.dispatchEvent ? (e = document.createEvent("HTMLEvents"), e.initEvent(i, !0, !0), t.dispatchEvent(e)) : document.createEventObject && (e = document.createEventObject(), e.target = t, t.fireEvent("on" + i, e))
                    })
                },
                bindHandlers: function() {
                    var t = this;
                    e.each(t, function(i, n) {
                        0 === i.indexOf("on") && e.isFunction(n) && (t[i] = function() {
                            return n.apply(t, arguments)
                        })
                    })
                }
            },
            c = {
                version: t,
                modules: {},
                getOptions: function() {
                    return e.extend({}, n)
                },
                setOptions: function(t, i) {
                    arguments.length > 1 ? this.modules[t] && e.extend(this.modules[t].prototype.options, i) : e.extend(n, t)
                },
                addModule: function(t) {
                    var s = function(t) {
                            t.element.data(n.dataKey) || t.element.data(n.dataKey, this), i.push(this), this.options = e.extend({}, n, this.options, o(t.element), t), this.bindHandlers(), this.init.apply(this, arguments)
                        },
                        o = function(t) {
                            var i = t.data(n.optionsKey),
                                s = t.attr(n.optionsKey);
                            if (i) return i;
                            if (s) try {
                                return e.parseJSON(s)
                            } catch (o) {}
                        };
                    s.prototype = t, e.extend(t, l), t.plugins && e.each(t.plugins, function(t, i) {
                        e.extend(i.prototype, l)
                    });
                    var a = s.prototype.destroy;
                    s.prototype.destroy = function() {
                        this.options.element.removeData(this.options.dataKey);
                        for (var e = i.length - 1; e >= 0; e--)
                            if (i[e] === this) {
                                i.splice(e, 1);
                                break
                            }
                        a && a.apply(this, arguments)
                    }, this.modules[t.name] = s
                },
                getInstance: function(t) {
                    return e(t).data(n.dataKey)
                },
                replace: function(t, i, s) {
                    var o, a = this;
                    return n.styleSheetCreated || r(), e(t).each(function() {
                        var t, r = e(this);
                        o = r.data(n.dataKey), o ? o.refresh() : (i || e.each(a.modules, function(e, t) {
                            if (t.prototype.matchElement.call(t.prototype, r)) return i = e, !1
                        }), i && (t = e.extend({
                            element: r
                        }, s), o = new a.modules[i](t)))
                    }), o
                },
                refresh: function(t) {
                    e(t).each(function() {
                        var t = e(this).data(n.dataKey);
                        t && t.refresh()
                    })
                },
                destroy: function(t) {
                    e(t).each(function() {
                        var t = e(this).data(n.dataKey);
                        t && t.destroy()
                    })
                },
                replaceAll: function(t) {
                    var i = this;
                    e.each(this.modules, function(n, s) {
                        e(s.prototype.selector, t).each(function() {
                            this.className.indexOf("jcf-ignore") < 0 && i.replace(this, n)
                        })
                    })
                },
                refreshAll: function(t) {
                    if (t) e.each(this.modules, function(i, s) {
                        e(s.prototype.selector, t).each(function() {
                            var t = e(this).data(n.dataKey);
                            t && t.refresh()
                        })
                    });
                    else
                        for (var s = i.length - 1; s >= 0; s--) i[s].refresh()
                },
                destroyAll: function(t) {
                    if (t) e.each(this.modules, function(i, s) {
                        e(s.prototype.selector, t).each(function(t, i) {
                            var s = e(i).data(n.dataKey);
                            s && s.destroy()
                        })
                    });
                    else
                        for (; i.length;) i[0].destroy()
                }
            };
        return window.jcf = c, c
    }),
    function(e, t) {
        "use strict";

        function i(t) {
            this.options = e.extend({
                wrapNative: !0,
                wrapNativeOnMobile: !0,
                fakeDropInBody: !0,
                useCustomScroll: !0,
                flipDropToFit: !0,
                maxVisibleItems: 10,
                fakeAreaStructure: '<span class="jcf-select"><span class="jcf-select-text"></span><span class="jcf-select-opener"></span></span>',
                fakeDropStructure: '<div class="jcf-select-drop"><div class="jcf-select-drop-content"></div></div>',
                optionClassPrefix: "jcf-option-",
                selectClassPrefix: "jcf-select-",
                dropContentSelector: ".jcf-select-drop-content",
                selectTextSelector: ".jcf-select-text",
                dropActiveClass: "jcf-drop-active",
                flipDropClass: "jcf-drop-flipped"
            }, t), this.init()
        }

        function n(t) {
            this.options = e.extend({
                wrapNative: !0,
                useCustomScroll: !0,
                fakeStructure: '<span class="jcf-list-box"><span class="jcf-list-wrapper"></span></span>',
                selectClassPrefix: "jcf-select-",
                listHolder: ".jcf-list-wrapper"
            }, t), this.init()
        }

        function s(t) {
            this.options = e.extend({
                holder: null,
                maxVisibleItems: 10,
                selectOnClick: !0,
                useHoverClass: !1,
                useCustomScroll: !1,
                handleResize: !0,
                multipleSelectWithoutKey: !1,
                alwaysPreventMouseWheel: !1,
                indexAttribute: "data-index",
                cloneClassPrefix: "jcf-option-",
                containerStructure: '<span class="jcf-list"><span class="jcf-list-content"></span></span>',
                containerSelector: ".jcf-list-content",
                captionClass: "jcf-optgroup-caption",
                disabledClass: "jcf-disabled",
                optionClass: "jcf-option",
                groupClass: "jcf-optgroup",
                hoverClass: "jcf-hover",
                selectedClass: "jcf-selected",
                scrollClass: "jcf-scroll-active"
            }, t), this.init()
        }
        jcf.addModule({
            name: "Select",
            selector: "select",
            options: {
                element: null,
                multipleCompactStyle: !1
            },
            plugins: {
                ListBox: n,
                ComboBox: i,
                SelectList: s
            },
            matchElement: function(e) {
                return e.is("select")
            },
            init: function() {
                this.element = e(this.options.element), this.createInstance()
            },
            isListBox: function() {
                return this.element.is("[size]:not([jcf-size]), [multiple]")
            },
            createInstance: function() {
                this.instance && this.instance.destroy(), this.isListBox() && !this.options.multipleCompactStyle ? this.instance = new n(this.options) : this.instance = new i(this.options)
            },
            refresh: function() {
                var e = this.isListBox() && this.instance instanceof i || !this.isListBox() && this.instance instanceof n;
                e ? this.createInstance() : this.instance.refresh()
            },
            destroy: function() {
                this.instance.destroy()
            }
        }), e.extend(i.prototype, {
            init: function() {
                this.initStructure(), this.bindHandlers(), this.attachEvents(), this.refresh()
            },
            initStructure: function() {
                this.win = e(t), this.doc = e(document), this.realElement = e(this.options.element), this.fakeElement = e(this.options.fakeAreaStructure).insertAfter(this.realElement), this.selectTextContainer = this.fakeElement.find(this.options.selectTextSelector), this.selectText = e("<span></span>").appendTo(this.selectTextContainer), a(this.fakeElement), this.fakeElement.addClass(o(this.realElement.prop("className"), this.options.selectClassPrefix)), this.realElement.prop("multiple") && this.fakeElement.addClass("jcf-compact-multiple"), this.options.isMobileDevice && this.options.wrapNativeOnMobile && !this.options.wrapNative && (this.options.wrapNative = !0), this.options.wrapNative ? this.realElement.prependTo(this.fakeElement).css({
                    position: "absolute",
                    height: "100%",
                    width: "100%"
                }).addClass(this.options.resetAppearanceClass) : (this.realElement.addClass(this.options.hiddenClass), this.fakeElement.attr("title", this.realElement.attr("title")), this.fakeDropTarget = this.options.fakeDropInBody ? e("body") : this.fakeElement)
            },
            attachEvents: function() {
                var e = this;
                this.delayedRefresh = function() {
                    setTimeout(function() {
                        e.refresh(), e.list && (e.list.refresh(), e.list.scrollToActiveOption())
                    }, 1)
                }, this.options.wrapNative ? this.realElement.on({
                    focus: this.onFocus,
                    change: this.onChange,
                    click: this.onChange,
                    keydown: this.onChange
                }) : (this.realElement.on({
                    focus: this.onFocus,
                    change: this.onChange,
                    keydown: this.onKeyDown
                }), this.fakeElement.on({
                    "jcf-pointerdown": this.onSelectAreaPress
                }))
            },
            onKeyDown: function(e) {
                13 === e.which ? this.toggleDropdown() : this.dropActive && this.delayedRefresh()
            },
            onChange: function() {
                this.refresh()
            },
            onFocus: function() {
                this.pressedFlag && this.focusedFlag || (this.fakeElement.addClass(this.options.focusClass), this.realElement.on("blur", this.onBlur), this.toggleListMode(!0), this.focusedFlag = !0)
            },
            onBlur: function() {
                this.pressedFlag || (this.fakeElement.removeClass(this.options.focusClass), this.realElement.off("blur", this.onBlur), this.toggleListMode(!1), this.focusedFlag = !1)
            },
            onResize: function() {
                this.dropActive && this.hideDropdown()
            },
            onSelectDropPress: function() {
                this.pressedFlag = !0
            },
            onSelectDropRelease: function(e, t) {
                this.pressedFlag = !1, "mouse" === t.pointerType && this.realElement.focus()
            },
            onSelectAreaPress: function(t) {
                var i = !this.options.fakeDropInBody && e(t.target).closest(this.dropdown).length;
                i || t.button > 1 || this.realElement.is(":disabled") || (this.selectOpenedByEvent = t.pointerType, this.toggleDropdown(), this.focusedFlag || ("mouse" === t.pointerType ? this.realElement.focus() : this.onFocus(t)), this.pressedFlag = !0, this.fakeElement.addClass(this.options.pressedClass), this.doc.on("jcf-pointerup", this.onSelectAreaRelease))
            },
            onSelectAreaRelease: function(e) {
                this.focusedFlag && "mouse" === e.pointerType && this.realElement.focus(), this.pressedFlag = !1, this.fakeElement.removeClass(this.options.pressedClass), this.doc.off("jcf-pointerup", this.onSelectAreaRelease)
            },
            onOutsideClick: function(t) {
                var i = e(t.target),
                    n = i.closest(this.fakeElement).length || i.closest(this.dropdown).length;
                n || this.hideDropdown()
            },
            onSelect: function() {
                this.refresh(), this.realElement.prop("multiple") ? this.repositionDropdown() : this.hideDropdown(), this.fireNativeEvent(this.realElement, "change")
            },
            toggleListMode: function(e) {
                this.options.wrapNative || (e ? this.realElement.attr({
                    size: 4,
                    "jcf-size": ""
                }) : this.options.wrapNative || this.realElement.removeAttr("size jcf-size"))
            },
            createDropdown: function() {
                this.dropdown && (this.list.destroy(), this.dropdown.remove()), this.dropdown = e(this.options.fakeDropStructure).appendTo(this.fakeDropTarget), this.dropdown.addClass(o(this.realElement.prop("className"), this.options.selectClassPrefix)), a(this.dropdown), this.realElement.prop("multiple") && this.dropdown.addClass("jcf-compact-multiple"), this.options.fakeDropInBody && this.dropdown.css({
                    position: "absolute",
                    top: -9999
                }), this.list = new s({
                    useHoverClass: !0,
                    handleResize: !1,
                    alwaysPreventMouseWheel: !0,
                    maxVisibleItems: this.options.maxVisibleItems,
                    useCustomScroll: this.options.useCustomScroll,
                    holder: this.dropdown.find(this.options.dropContentSelector),
                    multipleSelectWithoutKey: this.realElement.prop("multiple"),
                    element: this.realElement
                }), e(this.list).on({
                    select: this.onSelect,
                    press: this.onSelectDropPress,
                    release: this.onSelectDropRelease
                })
            },
            repositionDropdown: function() {
                var e, t, i, n = this.fakeElement.offset(),
                    s = this.fakeElement.outerWidth(),
                    o = this.fakeElement.outerHeight(),
                    a = this.dropdown.css("width", s).outerHeight(),
                    r = this.win.scrollTop(),
                    l = this.win.height(),
                    c = !1;
                n.top + o + a > r + l && n.top - a > r && (c = !0), this.options.fakeDropInBody && (i = "static" !== this.fakeDropTarget.css("position") ? this.fakeDropTarget.offset().top : 0, this.options.flipDropToFit && c ? (t = n.left, e = n.top - a - i) : (t = n.left, e = n.top + o - i), this.dropdown.css({
                    width: s,
                    left: t,
                    top: e
                })), this.dropdown.add(this.fakeElement).toggleClass(this.options.flipDropClass, this.options.flipDropToFit && c)
            },
            showDropdown: function() {
                this.realElement.prop("options").length && (this.dropdown || this.createDropdown(), this.dropActive = !0, this.dropdown.appendTo(this.fakeDropTarget), this.fakeElement.addClass(this.options.dropActiveClass), this.refreshSelectedText(), this.repositionDropdown(), this.list.setScrollTop(this.savedScrollTop), this.list.refresh(), this.win.on("resize", this.onResize), this.doc.on("jcf-pointerdown", this.onOutsideClick))
            },
            hideDropdown: function() {
                this.dropdown && (this.savedScrollTop = this.list.getScrollTop(), this.fakeElement.removeClass(this.options.dropActiveClass + " " + this.options.flipDropClass), this.dropdown.removeClass(this.options.flipDropClass).detach(), this.doc.off("jcf-pointerdown", this.onOutsideClick), this.win.off("resize", this.onResize), this.dropActive = !1, "touch" === this.selectOpenedByEvent && this.onBlur())
            },
            toggleDropdown: function() {
                this.dropActive ? this.hideDropdown() : this.showDropdown()
            },
            refreshSelectedText: function() {
                var t, i = this.realElement.prop("selectedIndex"),
                    n = this.realElement.prop("options")[i],
                    s = n ? n.getAttribute("data-image") : null,
                    a = "",
                    r = this;
                this.realElement.prop("multiple") ? (e.each(this.realElement.prop("options"), function(e, t) {
                    t.selected && (a += (a ? ", " : "") + t.innerHTML)
                }), a || (a = r.realElement.attr("placeholder") || ""), this.selectText.removeAttr("class").html(a)) : n ? this.currentSelectedText === n.innerHTML && this.currentSelectedImage === s || (t = o(n.className, this.options.optionClassPrefix), this.selectText.attr("class", t).html(n.innerHTML), s ? (this.selectImage || (this.selectImage = e("<img>").prependTo(this.selectTextContainer).hide()), this.selectImage.attr("src", s).show()) : this.selectImage && this.selectImage.hide(), this.currentSelectedText = n.innerHTML, this.currentSelectedImage = s) : (this.selectImage && this.selectImage.hide(), this.selectText.removeAttr("class").empty())
            },
            refresh: function() {
                "none" === this.realElement.prop("style").display ? this.fakeElement.hide() : this.fakeElement.show(), this.refreshSelectedText(), this.fakeElement.toggleClass(this.options.disabledClass, this.realElement.is(":disabled"))
            },
            destroy: function() {
                this.options.wrapNative ? this.realElement.insertBefore(this.fakeElement).css({
                    position: "",
                    height: "",
                    width: ""
                }).removeClass(this.options.resetAppearanceClass) : (this.realElement.removeClass(this.options.hiddenClass), this.realElement.is("[jcf-size]") && this.realElement.removeAttr("size jcf-size")), this.fakeElement.remove(), this.doc.off("jcf-pointerup", this.onSelectAreaRelease), this.realElement.off({
                    focus: this.onFocus
                })
            }
        }), e.extend(n.prototype, {
            init: function() {
                this.bindHandlers(), this.initStructure(), this.attachEvents()
            },
            initStructure: function() {
                this.realElement = e(this.options.element), this.fakeElement = e(this.options.fakeStructure).insertAfter(this.realElement), this.listHolder = this.fakeElement.find(this.options.listHolder), a(this.fakeElement), this.fakeElement.addClass(o(this.realElement.prop("className"), this.options.selectClassPrefix)), this.realElement.addClass(this.options.hiddenClass), this.list = new s({
                    useCustomScroll: this.options.useCustomScroll,
                    holder: this.listHolder,
                    selectOnClick: !1,
                    element: this.realElement
                })
            },
            attachEvents: function() {
                var t = this;
                this.delayedRefresh = function(e) {
                    e && 16 === e.which || (clearTimeout(t.refreshTimer), t.refreshTimer = setTimeout(function() {
                        t.refresh(), t.list.scrollToActiveOption()
                    }, 1))
                }, this.realElement.on({
                    focus: this.onFocus,
                    click: this.delayedRefresh,
                    keydown: this.delayedRefresh
                }), e(this.list).on({
                    select: this.onSelect,
                    press: this.onFakeOptionsPress,
                    release: this.onFakeOptionsRelease
                })
            },
            onFakeOptionsPress: function(e, t) {
                this.pressedFlag = !0, "mouse" === t.pointerType && this.realElement.focus()
            },
            onFakeOptionsRelease: function(e, t) {
                this.pressedFlag = !1, "mouse" === t.pointerType && this.realElement.focus()
            },
            onSelect: function() {
                this.fireNativeEvent(this.realElement, "change"), this.fireNativeEvent(this.realElement, "click")
            },
            onFocus: function() {
                this.pressedFlag && this.focusedFlag || (this.fakeElement.addClass(this.options.focusClass), this.realElement.on("blur", this.onBlur), this.focusedFlag = !0)
            },
            onBlur: function() {
                this.pressedFlag || (this.fakeElement.removeClass(this.options.focusClass), this.realElement.off("blur", this.onBlur), this.focusedFlag = !1)
            },
            refresh: function() {
                this.fakeElement.toggleClass(this.options.disabledClass, this.realElement.is(":disabled")), this.list.refresh()
            },
            destroy: function() {
                this.list.destroy(), this.realElement.insertBefore(this.fakeElement).removeClass(this.options.hiddenClass), this.fakeElement.remove()
            }
        }), e.extend(s.prototype, {
            init: function() {
                this.initStructure(), this.refreshSelectedClass(), this.attachEvents()
            },
            initStructure: function() {
                this.element = e(this.options.element), this.indexSelector = "[" + this.options.indexAttribute + "]", this.container = e(this.options.containerStructure).appendTo(this.options.holder), this.listHolder = this.container.find(this.options.containerSelector), this.lastClickedIndex = this.element.prop("selectedIndex"), this.rebuildList()
            },
            attachEvents: function() {
                this.bindHandlers(), this.listHolder.on("jcf-pointerdown", this.indexSelector, this.onItemPress), this.listHolder.on("jcf-pointerdown", this.onPress), this.options.useHoverClass && this.listHolder.on("jcf-pointerover", this.indexSelector, this.onHoverItem)
            },
            onPress: function(t) {
                e(this).trigger("press", t), this.listHolder.on("jcf-pointerup", this.onRelease)
            },
            onRelease: function(t) {
                e(this).trigger("release", t), this.listHolder.off("jcf-pointerup", this.onRelease)
            },
            onHoverItem: function(e) {
                var t = parseFloat(e.currentTarget.getAttribute(this.options.indexAttribute));
                this.fakeOptions.removeClass(this.options.hoverClass).eq(t).addClass(this.options.hoverClass)
            },
            onItemPress: function(e) {
                "touch" === e.pointerType || this.options.selectOnClick ? (this.tmpListOffsetTop = this.list.offset().top, this.listHolder.on("jcf-pointerup", this.indexSelector, this.onItemRelease)) : this.onSelectItem(e)
            },
            onItemRelease: function(e) {
                this.listHolder.off("jcf-pointerup", this.indexSelector, this.onItemRelease), this.tmpListOffsetTop === this.list.offset().top && this.listHolder.on("click", this.indexSelector, {
                    savedPointerType: e.pointerType
                }, this.onSelectItem), delete this.tmpListOffsetTop
            },
            onSelectItem: function(t) {
                var i, n = parseFloat(t.currentTarget.getAttribute(this.options.indexAttribute)),
                    s = t.data && t.data.savedPointerType || t.pointerType || "mouse";
                this.listHolder.off("click", this.indexSelector, this.onSelectItem), t.button > 1 || this.realOptions[n].disabled || (this.element.prop("multiple") ? t.metaKey || t.ctrlKey || "touch" === s || this.options.multipleSelectWithoutKey ? this.realOptions[n].selected = !this.realOptions[n].selected : t.shiftKey ? (i = [this.lastClickedIndex, n].sort(function(e, t) {
                    return e - t
                }), this.realOptions.each(function(e, t) {
                    t.selected = e >= i[0] && e <= i[1]
                })) : this.element.prop("selectedIndex", n) : this.element.prop("selectedIndex", n), t.shiftKey || (this.lastClickedIndex = n), this.refreshSelectedClass(), "mouse" === s && this.scrollToActiveOption(), e(this).trigger("select"))
            },
            rebuildList: function() {
                var t = this,
                    i = this.element[0];
                this.storedSelectHTML = i.innerHTML, this.optionIndex = 0, this.list = e(this.createOptionsList(i)), this.listHolder.empty().append(this.list), this.realOptions = this.element.find("option"), this.fakeOptions = this.list.find(this.indexSelector), this.fakeListItems = this.list.find("." + this.options.captionClass + "," + this.indexSelector), delete this.optionIndex;
                var n = this.options.maxVisibleItems,
                    s = this.element.prop("size");
                s > 1 && !this.element.is("[jcf-size]") && (n = s);
                var o = this.fakeOptions.length > n;
                return this.container.toggleClass(this.options.scrollClass, o), o && (this.listHolder.css({
                    maxHeight: this.getOverflowHeight(n),
                    overflow: "auto"
                }), this.options.useCustomScroll && jcf.modules.Scrollable) ? void jcf.replace(this.listHolder, "Scrollable", {
                    handleResize: this.options.handleResize,
                    alwaysPreventMouseWheel: this.options.alwaysPreventMouseWheel
                }) : void(this.options.alwaysPreventMouseWheel && (this.preventWheelHandler = function(e) {
                    var i = t.listHolder.scrollTop(),
                        n = t.listHolder.prop("scrollHeight") - t.listHolder.innerHeight();
                    (i <= 0 && e.deltaY < 0 || i >= n && e.deltaY > 0) && e.preventDefault()
                }, this.listHolder.on("jcf-mousewheel", this.preventWheelHandler)))
            },
            refreshSelectedClass: function() {
                var e, t = this,
                    i = this.element.prop("multiple"),
                    n = this.element.prop("selectedIndex");
                i ? this.realOptions.each(function(e, i) {
                    t.fakeOptions.eq(e).toggleClass(t.options.selectedClass, !!i.selected)
                }) : (this.fakeOptions.removeClass(this.options.selectedClass + " " + this.options.hoverClass), e = this.fakeOptions.eq(n).addClass(this.options.selectedClass), this.options.useHoverClass && e.addClass(this.options.hoverClass))
            },
            scrollToActiveOption: function() {
                var e = this.getActiveOptionOffset();
                "number" == typeof e && this.listHolder.prop("scrollTop", e)
            },
            getSelectedIndexRange: function() {
                var e = -1,
                    t = -1;
                return this.realOptions.each(function(i, n) {
                    n.selected && (e < 0 && (e = i), t = i)
                }), [e, t]
            },
            getChangedSelectedIndex: function() {
                var e, t = this.element.prop("selectedIndex");
                return this.element.prop("multiple") ? (this.previousRange || (this.previousRange = [t, t]), this.currentRange = this.getSelectedIndexRange(), e = this.currentRange[this.currentRange[0] !== this.previousRange[0] ? 0 : 1], this.previousRange = this.currentRange, e) : t
            },
            getActiveOptionOffset: function() {
                var e = this.listHolder.height(),
                    t = this.listHolder.prop("scrollTop"),
                    i = this.getChangedSelectedIndex(),
                    n = this.fakeOptions.eq(i),
                    s = n.offset().top - this.list.offset().top,
                    o = n.innerHeight();
                return s + o >= t + e ? s - e + o : s < t ? s : void 0
            },
            getOverflowHeight: function(e) {
                var t = this.fakeListItems.eq(e - 1),
                    i = this.list.offset().top,
                    n = t.offset().top,
                    s = t.innerHeight();
                return n + s - i
            },
            getScrollTop: function() {
                return this.listHolder.scrollTop()
            },
            setScrollTop: function(e) {
                this.listHolder.scrollTop(e)
            },
            createOption: function(e) {
                var t = document.createElement("span");
                t.className = this.options.optionClass, t.innerHTML = e.innerHTML, t.setAttribute(this.options.indexAttribute, this.optionIndex++);
                var i, n = e.getAttribute("data-image");
                return n && (i = document.createElement("img"), i.src = n, t.insertBefore(i, t.childNodes[0])), e.disabled && (t.className += " " + this.options.disabledClass), e.className && (t.className += " " + o(e.className, this.options.cloneClassPrefix)), t
            },
            createOptGroup: function(e) {
                var t, i, n = document.createElement("span"),
                    s = e.getAttribute("label");
                return t = document.createElement("span"), t.className = this.options.captionClass, t.innerHTML = s, n.appendChild(t), e.children.length && (i = this.createOptionsList(e), n.appendChild(i)), n.className = this.options.groupClass, n
            },
            createOptionContainer: function() {
                var e = document.createElement("li");
                return e
            },
            createOptionsList: function(t) {
                var i = this,
                    n = document.createElement("ul");
                return e.each(t.children, function(e, t) {
                    var s, o = i.createOptionContainer(t);
                    switch (t.tagName.toLowerCase()) {
                        case "option":
                            s = i.createOption(t);
                            break;
                        case "optgroup":
                            s = i.createOptGroup(t)
                    }
                    n.appendChild(o).appendChild(s)
                }), n
            },
            refresh: function() {
                this.storedSelectHTML !== this.element.prop("innerHTML") && this.rebuildList();
                var e = jcf.getInstance(this.listHolder);
                e && e.refresh(), this.refreshSelectedClass()
            },
            destroy: function() {
                this.listHolder.off("jcf-mousewheel", this.preventWheelHandler), this.listHolder.off("jcf-pointerdown", this.indexSelector, this.onSelectItem), this.listHolder.off("jcf-pointerover", this.indexSelector, this.onHoverItem), this.listHolder.off("jcf-pointerdown", this.onPress)
            }
        });
        var o = function(e, t) {
                return e ? e.replace(/[\s]*([\S]+)+[\s]*/gi, t + "$1 ") : ""
            },
            a = function() {
                function e(e) {
                    e.preventDefault()
                }
                var t = jcf.getOptions().unselectableClass;
                return function(i) {
                    i.addClass(t).on("selectstart", e)
                }
            }()
    }(jQuery, this),
    function(e) {
        "use strict";
        jcf.addModule({
            name: "Radio",
            selector: 'input[type="radio"]',
            options: {
                wrapNative: !0,
                checkedClass: "jcf-checked",
                uncheckedClass: "jcf-unchecked",
                labelActiveClass: "jcf-label-active",
                fakeStructure: '<span class="jcf-radio"><span></span></span>'
            },
            matchElement: function(e) {
                return e.is(":radio")
            },
            init: function() {
                this.initStructure(), this.attachEvents(), this.refresh()
            },
            initStructure: function() {
                this.doc = e(document), this.realElement = e(this.options.element), this.fakeElement = e(this.options.fakeStructure).insertAfter(this.realElement), this.labelElement = this.getLabelFor(), this.options.wrapNative ? this.realElement.prependTo(this.fakeElement).css({
                    position: "absolute",
                    opacity: 0
                }) : this.realElement.addClass(this.options.hiddenClass)
            },
            attachEvents: function() {
                this.realElement.on({
                    focus: this.onFocus,
                    click: this.onRealClick
                }), this.fakeElement.on("click", this.onFakeClick), this.fakeElement.on("jcf-pointerdown", this.onPress)
            },
            onRealClick: function(e) {
                var t = this;
                this.savedEventObject = e, setTimeout(function() {
                    t.refreshRadioGroup()
                }, 0)
            },
            onFakeClick: function(e) {
                this.options.wrapNative && this.realElement.is(e.target) || this.realElement.is(":disabled") || (delete this.savedEventObject, this.currentActiveRadio = this.getCurrentActiveRadio(), this.stateChecked = this.realElement.prop("checked"), this.realElement.prop("checked", !0), this.fireNativeEvent(this.realElement, "click"), this.savedEventObject && this.savedEventObject.isDefaultPrevented() ? (this.realElement.prop("checked", this.stateChecked), this.currentActiveRadio.prop("checked", !0)) : this.fireNativeEvent(this.realElement, "change"), delete this.savedEventObject)
            },
            onFocus: function() {
                this.pressedFlag && this.focusedFlag || (this.focusedFlag = !0, this.fakeElement.addClass(this.options.focusClass), this.realElement.on("blur", this.onBlur))
            },
            onBlur: function() {
                this.pressedFlag || (this.focusedFlag = !1, this.fakeElement.removeClass(this.options.focusClass), this.realElement.off("blur", this.onBlur))
            },
            onPress: function(e) {
                this.focusedFlag || "mouse" !== e.pointerType || this.realElement.focus(), this.pressedFlag = !0, this.fakeElement.addClass(this.options.pressedClass), this.doc.on("jcf-pointerup", this.onRelease)
            },
            onRelease: function(e) {
                this.focusedFlag && "mouse" === e.pointerType && this.realElement.focus(), this.pressedFlag = !1, this.fakeElement.removeClass(this.options.pressedClass), this.doc.off("jcf-pointerup", this.onRelease)
            },
            getCurrentActiveRadio: function() {
                return this.getRadioGroup(this.realElement).filter(":checked")
            },
            getRadioGroup: function(t) {
                var i = t.attr("name"),
                    n = t.parents("form");
                return i ? n.length ? n.find('input[name="' + i + '"]') : e('input[name="' + i + '"]:not(form input)') : t
            },
            getLabelFor: function() {
                var t = this.realElement.closest("label"),
                    i = this.realElement.prop("id");
                return !t.length && i && (t = e('label[for="' + i + '"]')), t.length ? t : null
            },
            refreshRadioGroup: function() {
                this.getRadioGroup(this.realElement).each(function() {
                    jcf.refresh(this)
                })
            },
            refresh: function() {
                var e = this.realElement.is(":checked"),
                    t = this.realElement.is(":disabled");
                this.fakeElement.toggleClass(this.options.checkedClass, e).toggleClass(this.options.uncheckedClass, !e).toggleClass(this.options.disabledClass, t), this.labelElement && this.labelElement.toggleClass(this.options.labelActiveClass, e)
            },
            destroy: function() {
                this.options.wrapNative ? this.realElement.insertBefore(this.fakeElement).css({
                    position: "",
                    width: "",
                    height: "",
                    opacity: "",
                    margin: ""
                }) : this.realElement.removeClass(this.options.hiddenClass), this.fakeElement.off("jcf-pointerdown", this.onPress), this.fakeElement.remove(), this.doc.off("jcf-pointerup", this.onRelease), this.realElement.off({
                    blur: this.onBlur,
                    focus: this.onFocus,
                    click: this.onRealClick
                })
            }
        })
    }(jQuery),
    function(e) {
        "use strict";
        jcf.addModule({
            name: "Checkbox",
            selector: 'input[type="checkbox"]',
            options: {
                wrapNative: !0,
                checkedClass: "jcf-checked",
                uncheckedClass: "jcf-unchecked",
                labelActiveClass: "jcf-label-active",
                fakeStructure: '<span class="jcf-checkbox"><span></span></span>'
            },
            matchElement: function(e) {
                return e.is(":checkbox")
            },
            init: function() {
                this.initStructure(), this.attachEvents(), this.refresh()
            },
            initStructure: function() {
                this.doc = e(document), this.realElement = e(this.options.element), this.fakeElement = e(this.options.fakeStructure).insertAfter(this.realElement), this.labelElement = this.getLabelFor(), this.options.wrapNative ? this.realElement.appendTo(this.fakeElement).css({
                    position: "absolute",
                    height: "100%",
                    width: "100%",
                    opacity: 0,
                    margin: 0
                }) : this.realElement.addClass(this.options.hiddenClass)
            },
            attachEvents: function() {
                this.realElement.on({
                    focus: this.onFocus,
                    click: this.onRealClick
                }), this.fakeElement.on("click", this.onFakeClick), this.fakeElement.on("jcf-pointerdown", this.onPress)
            },
            onRealClick: function(e) {
                var t = this;
                this.savedEventObject = e, setTimeout(function() {
                    t.refresh()
                }, 0)
            },
            onFakeClick: function(e) {
                this.options.wrapNative && this.realElement.is(e.target) || this.realElement.is(":disabled") || (delete this.savedEventObject, this.stateChecked = this.realElement.prop("checked"), this.realElement.prop("checked", !this.stateChecked), this.fireNativeEvent(this.realElement, "click"), this.savedEventObject && this.savedEventObject.isDefaultPrevented() ? this.realElement.prop("checked", this.stateChecked) : this.fireNativeEvent(this.realElement, "change"), delete this.savedEventObject)
            },
            onFocus: function() {
                this.pressedFlag && this.focusedFlag || (this.focusedFlag = !0, this.fakeElement.addClass(this.options.focusClass), this.realElement.on("blur", this.onBlur))
            },
            onBlur: function() {
                this.pressedFlag || (this.focusedFlag = !1, this.fakeElement.removeClass(this.options.focusClass), this.realElement.off("blur", this.onBlur))
            },
            onPress: function(e) {
                this.focusedFlag || "mouse" !== e.pointerType || this.realElement.focus(), this.pressedFlag = !0, this.fakeElement.addClass(this.options.pressedClass), this.doc.on("jcf-pointerup", this.onRelease)
            },
            onRelease: function(e) {
                this.focusedFlag && "mouse" === e.pointerType && this.realElement.focus(), this.pressedFlag = !1, this.fakeElement.removeClass(this.options.pressedClass), this.doc.off("jcf-pointerup", this.onRelease)
            },
            getLabelFor: function() {
                var t = this.realElement.closest("label"),
                    i = this.realElement.prop("id");
                return !t.length && i && (t = e('label[for="' + i + '"]')), t.length ? t : null
            },
            refresh: function() {
                var e = this.realElement.is(":checked"),
                    t = this.realElement.is(":disabled");
                this.fakeElement.toggleClass(this.options.checkedClass, e).toggleClass(this.options.uncheckedClass, !e).toggleClass(this.options.disabledClass, t), this.labelElement && this.labelElement.toggleClass(this.options.labelActiveClass, e)
            },
            destroy: function() {
                this.options.wrapNative ? this.realElement.insertBefore(this.fakeElement).css({
                    position: "",
                    width: "",
                    height: "",
                    opacity: "",
                    margin: ""
                }) : this.realElement.removeClass(this.options.hiddenClass), this.fakeElement.off("jcf-pointerdown", this.onPress), this.fakeElement.remove(), this.doc.off("jcf-pointerup", this.onRelease), this.realElement.off({
                    focus: this.onFocus,
                    click: this.onRealClick
                })
            }
        })
    }(jQuery),
    function(e) {
        "use strict";
        jcf.addModule({
            name: "Number",
            selector: 'input[type="number"]',
            options: {
                realElementClass: "jcf-real-element",
                fakeStructure: '<span class="jcf-number"><span class="jcf-btn-inc"></span><span class="jcf-btn-dec"></span></span>',
                btnIncSelector: ".jcf-btn-inc",
                btnDecSelector: ".jcf-btn-dec",
                pressInterval: 150
            },
            matchElement: function(e) {
                return e.is(this.selector)
            },
            init: function() {
                this.initStructure(), this.attachEvents(), this.refresh()
            },
            initStructure: function() {
                this.page = e("html"), this.realElement = e(this.options.element).addClass(this.options.realElementClass), this.fakeElement = e(this.options.fakeStructure).insertBefore(this.realElement).prepend(this.realElement), this.btnDec = this.fakeElement.find(this.options.btnDecSelector), this.btnInc = this.fakeElement.find(this.options.btnIncSelector), this.initialValue = parseFloat(this.realElement.val()) || 0, this.minValue = parseFloat(this.realElement.attr("min")), this.maxValue = parseFloat(this.realElement.attr("max")), this.stepValue = parseFloat(this.realElement.attr("step")) || 1, this.minValue = isNaN(this.minValue) ? -(1 / 0) : this.minValue, this.maxValue = isNaN(this.maxValue) ? 1 / 0 : this.maxValue, isFinite(this.maxValue) && (this.maxValue -= (this.maxValue - this.minValue) % this.stepValue)
            },
            attachEvents: function() {
                this.realElement.on({
                    focus: this.onFocus
                }), this.btnDec.add(this.btnInc).on("jcf-pointerdown", this.onBtnPress)
            },
            onBtnPress: function(e) {
                var t, i = this;
                this.realElement.is(":disabled") || (t = this.btnInc.is(e.currentTarget), i.step(t), clearInterval(this.stepTimer), this.stepTimer = setInterval(function() {
                    i.step(t)
                }, this.options.pressInterval), this.page.on("jcf-pointerup", this.onBtnRelease))
            },
            onBtnRelease: function() {
                clearInterval(this.stepTimer), this.page.off("jcf-pointerup", this.onBtnRelease)
            },
            onFocus: function() {
                this.fakeElement.addClass(this.options.focusClass), this.realElement.on({
                    blur: this.onBlur,
                    keydown: this.onKeyPress
                })
            },
            onBlur: function() {
                this.fakeElement.removeClass(this.options.focusClass), this.realElement.off({
                    blur: this.onBlur,
                    keydown: this.onKeyPress
                })
            },
            onKeyPress: function(e) {
                38 !== e.which && 40 !== e.which || (e.preventDefault(), this.step(38 === e.which))
            },
            step: function(e) {
                var t = parseFloat(this.realElement.val()),
                    i = t || 0,
                    n = this.stepValue * (e ? 1 : -1),
                    s = isFinite(this.minValue) ? this.minValue : this.initialValue - Math.abs(i * this.stepValue),
                    o = Math.abs(s - i) % this.stepValue;
                o ? e ? i += n - o : i -= o : i += n, i < this.minValue ? i = this.minValue : i > this.maxValue && (i = this.maxValue), i !== t && (this.realElement.val(i).trigger("change"), this.refresh())
            },
            refresh: function() {
                var e = this.realElement.is(":disabled"),
                    t = parseFloat(this.realElement.val());
                this.fakeElement.toggleClass(this.options.disabledClass, e), this.btnDec.toggleClass(this.options.disabledClass, t === this.minValue), this.btnInc.toggleClass(this.options.disabledClass, t === this.maxValue)
            },
            destroy: function() {
                this.realElement.removeClass(this.options.realElementClass).insertBefore(this.fakeElement), this.fakeElement.remove(), clearInterval(this.stepTimer), this.page.off("jcf-pointerup", this.onBtnRelease), this.realElement.off({
                    keydown: this.onKeyPress,
                    focus: this.onFocus,
                    blur: this.onBlur
                })
            }
        })
    }(jQuery),
    function(e, t, i) {
        var n = window.matchMedia;
        "undefined" != typeof module && module.exports ? module.exports = i(n) : "function" == typeof define && define.amd ? define(function() {
            return t[e] = i(n)
        }) : t[e] = i(n)
    }("enquire", this, function(e) {
        "use strict";

        function t(e, t) {
            var i, n = 0,
                s = e.length;
            for (n; n < s && (i = t(e[n], n), i !== !1); n++);
        }

        function i(e) {
            return "[object Array]" === Object.prototype.toString.apply(e)
        }

        function n(e) {
            return "function" == typeof e
        }

        function s(e) {
            this.options = e, !e.deferSetup && this.setup()
        }

        function o(t, i) {
            this.query = t, this.isUnconditional = i, this.handlers = [], this.mql = e(t);
            var n = this;
            this.listener = function(e) {
                n.mql = e, n.assess()
            }, this.mql.addListener(this.listener)
        }

        function a() {
            if (!e) throw new Error("matchMedia not present, legacy browsers require a polyfill");
            this.queries = {}, this.browserIsIncapable = !e("only all").matches
        }
        return s.prototype = {
            setup: function() {
                this.options.setup && this.options.setup(), this.initialised = !0
            },
            on: function() {
                !this.initialised && this.setup(), this.options.match && this.options.match()
            },
            off: function() {
                this.options.unmatch && this.options.unmatch()
            },
            destroy: function() {
                this.options.destroy ? this.options.destroy() : this.off()
            },
            equals: function(e) {
                return this.options === e || this.options.match === e
            }
        }, o.prototype = {
            addHandler: function(e) {
                var t = new s(e);
                this.handlers.push(t), this.matches() && t.on()
            },
            removeHandler: function(e) {
                var i = this.handlers;
                t(i, function(t, n) {
                    if (t.equals(e)) return t.destroy(), !i.splice(n, 1)
                })
            },
            matches: function() {
                return this.mql.matches || this.isUnconditional
            },
            clear: function() {
                t(this.handlers, function(e) {
                    e.destroy()
                }), this.mql.removeListener(this.listener), this.handlers.length = 0
            },
            assess: function() {
                var e = this.matches() ? "on" : "off";
                t(this.handlers, function(t) {
                    t[e]()
                })
            }
        }, a.prototype = {
            register: function(e, s, a) {
                var r = this.queries,
                    l = a && this.browserIsIncapable;
                return r[e] || (r[e] = new o(e, l)), n(s) && (s = {
                    match: s
                }), i(s) || (s = [s]), t(s, function(t) {
                    n(t) && (t = {
                        match: t
                    }), r[e].addHandler(t)
                }), this
            },
            unregister: function(e, t) {
                var i = this.queries[e];
                return i && (t ? i.removeHandler(t) : (i.clear(), delete this.queries[e])), this
            }
        }, new a
    }),
    function(e, t, i, n) {
        var s = i("html"),
            o = i(e),
            a = i(t),
            r = i.fancybox = function() {
                r.open.apply(this, arguments)
            },
            l = navigator.userAgent.match(/msie/i),
            c = null,
            h = t.createTouch !== n,
            d = function(e) {
                return e && e.hasOwnProperty && e instanceof i
            },
            u = function(e) {
                return e && "string" === i.type(e)
            },
            p = function(e) {
                return u(e) && 0 < e.indexOf("%")
            },
            f = function(e, t) {
                var i = parseInt(e, 10) || 0;
                return t && p(e) && (i *= r.getViewport()[t] / 100), Math.ceil(i)
            },
            m = function(e, t) {
                return f(e, t) + "px"
            };
        i.extend(r, {
            version: "2.1.5",
            defaults: {
                padding: 15,
                margin: 20,
                width: 800,
                height: 600,
                minWidth: 100,
                minHeight: 100,
                maxWidth: 9999,
                maxHeight: 9999,
                pixelRatio: 1,
                autoSize: !0,
                autoHeight: !1,
                autoWidth: !1,
                autoResize: !0,
                autoCenter: !h,
                fitToView: !0,
                aspectRatio: !1,
                topRatio: .5,
                leftRatio: .5,
                scrolling: "auto",
                wrapCSS: "",
                arrows: !0,
                closeBtn: !0,
                closeClick: !1,
                nextClick: !1,
                mouseWheel: !0,
                autoPlay: !1,
                playSpeed: 3e3,
                preload: 3,
                modal: !1,
                loop: !0,
                ajax: {
                    dataType: "html",
                    headers: {
                        "X-fancyBox": !0
                    }
                },
                iframe: {
                    scrolling: "auto",
                    preload: !0
                },
                swf: {
                    wmode: "transparent",
                    allowfullscreen: "true",
                    allowscriptaccess: "always"
                },
                keys: {
                    next: {
                        13: "left",
                        34: "up",
                        39: "left",
                        40: "up"
                    },
                    prev: {
                        8: "right",
                        33: "down",
                        37: "right",
                        38: "down"
                    },
                    close: [27],
                    play: [32],
                    toggle: [70]
                },
                direction: {
                    next: "left",
                    prev: "right"
                },
                scrollOutside: !0,
                index: 0,
                type: null,
                href: null,
                content: null,
                title: null,
                tpl: {
                    wrap: '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
                    image: '<img class="fancybox-image" src="{href}" alt="" />',
                    iframe: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen' + (l ? ' allowtransparency="true"' : "") + "></iframe>",
                    error: '<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',
                    closeBtn: '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"></a>',
                    next: '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
                    prev: '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
                },
                openEffect: "fade",
                openSpeed: 250,
                openEasing: "swing",
                openOpacity: !0,
                openMethod: "zoomIn",
                closeEffect: "fade",
                closeSpeed: 250,
                closeEasing: "swing",
                closeOpacity: !0,
                closeMethod: "zoomOut",
                nextEffect: "elastic",
                nextSpeed: 250,
                nextEasing: "swing",
                nextMethod: "changeIn",
                prevEffect: "elastic",
                prevSpeed: 250,
                prevEasing: "swing",
                prevMethod: "changeOut",
                helpers: {
                    overlay: !0,
                    title: !0
                },
                onCancel: i.noop,
                beforeLoad: i.noop,
                afterLoad: i.noop,
                beforeShow: i.noop,
                afterShow: i.noop,
                beforeChange: i.noop,
                beforeClose: i.noop,
                afterClose: i.noop
            },
            group: {},
            opts: {},
            previous: null,
            coming: null,
            current: null,
            isActive: !1,
            isOpen: !1,
            isOpened: !1,
            wrap: null,
            skin: null,
            outer: null,
            inner: null,
            player: {
                timer: null,
                isActive: !1
            },
            ajaxLoad: null,
            imgPreload: null,
            transitions: {},
            helpers: {},
            open: function(e, t) {
                if (e && (i.isPlainObject(t) || (t = {}), !1 !== r.close(!0))) return i.isArray(e) || (e = d(e) ? i(e).get() : [e]), i.each(e, function(s, o) {
                    var a, l, c, h, p, f = {};
                    "object" === i.type(o) && (o.nodeType && (o = i(o)), d(o) ? (f = {
                        href: o.data("fancybox-href") || o.attr("href"),
                        title: o.data("fancybox-title") || o.attr("title"),
                        isDom: !0,
                        element: o
                    }, i.metadata && i.extend(!0, f, o.metadata())) : f = o), a = t.href || f.href || (u(o) ? o : null), l = t.title !== n ? t.title : f.title || "", h = (c = t.content || f.content) ? "html" : t.type || f.type, !h && f.isDom && (h = o.data("fancybox-type"), h || (h = (h = o.prop("class").match(/fancybox\.(\w+)/)) ? h[1] : null)), u(a) && (h || (r.isImage(a) ? h = "image" : r.isSWF(a) ? h = "swf" : "#" === a.charAt(0) ? h = "inline" : u(o) && (h = "html", c = o)), "ajax" === h && (p = a.split(/\s+/, 2), a = p.shift(), p = p.shift())), c || ("inline" === h ? a ? c = i(u(a) ? a.replace(/.*(?=#[^\s]+$)/, "") : a) : f.isDom && (c = o) : "html" === h ? c = a : !h && !a && f.isDom && (h = "inline", c = o)), i.extend(f, {
                        href: a,
                        type: h,
                        content: c,
                        title: l,
                        selector: p
                    }), e[s] = f
                }), r.opts = i.extend(!0, {}, r.defaults, t), t.keys !== n && (r.opts.keys = !!t.keys && i.extend({}, r.defaults.keys, t.keys)), r.group = e, r._start(r.opts.index)
            },
            cancel: function() {
                var e = r.coming;
                e && !1 !== r.trigger("onCancel") && (r.hideLoading(), r.ajaxLoad && r.ajaxLoad.abort(), r.ajaxLoad = null, r.imgPreload && (r.imgPreload.onload = r.imgPreload.onerror = null), e.wrap && e.wrap.stop(!0, !0).trigger("onReset").remove(), r.coming = null, r.current || r._afterZoomOut(e))
            },
            close: function(e) {
                r.cancel(), !1 !== r.trigger("beforeClose") && (r.unbindEvents(), r.isActive && (r.isOpen && !0 !== e ? (r.isOpen = r.isOpened = !1, r.isClosing = !0, i(".fancybox-item, .fancybox-nav").remove(), r.wrap.stop(!0, !0).removeClass("fancybox-opened"), r.transitions[r.current.closeMethod]()) : (i(".fancybox-wrap").stop(!0).trigger("onReset").remove(), r._afterZoomOut())))
            },
            play: function(e) {
                var t = function() {
                        clearTimeout(r.player.timer)
                    },
                    i = function() {
                        t(), r.current && r.player.isActive && (r.player.timer = setTimeout(r.next, r.current.playSpeed))
                    },
                    n = function() {
                        t(), a.unbind(".player"), r.player.isActive = !1, r.trigger("onPlayEnd")
                    };
                !0 === e || !r.player.isActive && !1 !== e ? r.current && (r.current.loop || r.current.index < r.group.length - 1) && (r.player.isActive = !0, a.bind({
                    "onCancel.player beforeClose.player": n,
                    "onUpdate.player": i,
                    "beforeLoad.player": t
                }), i(), r.trigger("onPlayStart")) : n()
            },
            next: function(e) {
                var t = r.current;
                t && (u(e) || (e = t.direction.next), r.jumpto(t.index + 1, e, "next"))
            },
            prev: function(e) {
                var t = r.current;
                t && (u(e) || (e = t.direction.prev), r.jumpto(t.index - 1, e, "prev"))
            },
            jumpto: function(e, t, i) {
                var s = r.current;
                s && (e = f(e), r.direction = t || s.direction[e >= s.index ? "next" : "prev"], r.router = i || "jumpto", s.loop && (0 > e && (e = s.group.length + e % s.group.length), e %= s.group.length), s.group[e] !== n && (r.cancel(), r._start(e)))
            },
            reposition: function(e, t) {
                var n, s = r.current,
                    o = s ? s.wrap : null;
                o && (n = r._getPosition(t), e && "scroll" === e.type ? (delete n.position, o.stop(!0, !0).animate(n, 200)) : (o.css(n), s.pos = i.extend({}, s.dim, n)))
            },
            update: function(e) {
                var t = e && e.type,
                    i = !t || "orientationchange" === t;
                i && (clearTimeout(c), c = null), r.isOpen && !c && (c = setTimeout(function() {
                    var n = r.current;
                    n && !r.isClosing && (r.wrap.removeClass("fancybox-tmp"), (i || "load" === t || "resize" === t && n.autoResize) && r._setDimension(), "scroll" === t && n.canShrink || r.reposition(e), r.trigger("onUpdate"), c = null)
                }, i && !h ? 0 : 300))
            },
            toggle: function(e) {
                r.isOpen && (r.current.fitToView = "boolean" === i.type(e) ? e : !r.current.fitToView, h && (r.wrap.removeAttr("style").addClass("fancybox-tmp"), r.trigger("onUpdate")), r.update())
            },
            hideLoading: function() {
                a.unbind(".loading"), i("#fancybox-loading").remove()
            },
            showLoading: function() {
                var e, t;
                r.hideLoading(), e = i('<div id="fancybox-loading"><div></div></div>').click(r.cancel).appendTo("body"), a.bind("keydown.loading", function(e) {
                    27 === (e.which || e.keyCode) && (e.preventDefault(), r.cancel())
                }), r.defaults.fixed || (t = r.getViewport(), e.css({
                    position: "absolute",
                    top: .5 * t.h + t.y,
                    left: .5 * t.w + t.x
                }))
            },
            getViewport: function() {
                var t = r.current && r.current.locked || !1,
                    i = {
                        x: o.scrollLeft(),
                        y: o.scrollTop()
                    };
                return t ? (i.w = t[0].clientWidth, i.h = t[0].clientHeight) : (i.w = h && e.innerWidth ? e.innerWidth : o.width(), i.h = h && e.innerHeight ? e.innerHeight : o.height()), i
            },
            unbindEvents: function() {
                r.wrap && d(r.wrap) && r.wrap.unbind(".fb"), a.unbind(".fb"), o.unbind(".fb")
            },
            bindEvents: function() {
                var e, t = r.current;
                t && (o.bind("orientationchange.fb" + (h ? "" : " resize.fb") + (t.autoCenter && !t.locked ? " scroll.fb" : ""), r.update), (e = t.keys) && a.bind("keydown.fb", function(s) {
                    var o = s.which || s.keyCode,
                        a = s.target || s.srcElement;
                    return (27 !== o || !r.coming) && void(!s.ctrlKey && !s.altKey && !s.shiftKey && !s.metaKey && (!a || !a.type && !i(a).is("[contenteditable]")) && i.each(e, function(e, a) {
                        return 1 < t.group.length && a[o] !== n ? (r[e](a[o]), s.preventDefault(), !1) : -1 < i.inArray(o, a) ? (r[e](), s.preventDefault(), !1) : void 0
                    }))
                }), i.fn.mousewheel && t.mouseWheel && r.wrap.bind("mousewheel.fb", function(e, n, s, o) {
                    for (var a = i(e.target || null), l = !1; a.length && !l && !a.is(".fancybox-skin") && !a.is(".fancybox-wrap");) l = a[0] && !(a[0].style.overflow && "hidden" === a[0].style.overflow) && (a[0].clientWidth && a[0].scrollWidth > a[0].clientWidth || a[0].clientHeight && a[0].scrollHeight > a[0].clientHeight), a = i(a).parent();
                    0 !== n && !l && 1 < r.group.length && !t.canShrink && (0 < o || 0 < s ? r.prev(0 < o ? "down" : "left") : (0 > o || 0 > s) && r.next(0 > o ? "up" : "right"), e.preventDefault())
                }))
            },
            trigger: function(e, t) {
                var n, s = t || r.coming || r.current;
                if (s) {
                    if (i.isFunction(s[e]) && (n = s[e].apply(s, Array.prototype.slice.call(arguments, 1))), !1 === n) return !1;
                    s.helpers && i.each(s.helpers, function(t, n) {
                        n && r.helpers[t] && i.isFunction(r.helpers[t][e]) && r.helpers[t][e](i.extend(!0, {}, r.helpers[t].defaults, n), s)
                    }), a.trigger(e)
                }
            },
            isImage: function(e) {
                return u(e) && e.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i)
            },
            isSWF: function(e) {
                return u(e) && e.match(/\.(swf)((\?|#).*)?$/i)
            },
            _start: function(e) {
                var t, n, s = {};
                if (e = f(e), t = r.group[e] || null, !t) return !1;
                if (s = i.extend(!0, {}, r.opts, t), t = s.margin, n = s.padding, "number" === i.type(t) && (s.margin = [t, t, t, t]), "number" === i.type(n) && (s.padding = [n, n, n, n]), s.modal && i.extend(!0, s, {
                        closeBtn: !1,
                        closeClick: !1,
                        nextClick: !1,
                        arrows: !1,
                        mouseWheel: !1,
                        keys: null,
                        helpers: {
                            overlay: {
                                closeClick: !1
                            }
                        }
                    }), s.autoSize && (s.autoWidth = s.autoHeight = !0), "auto" === s.width && (s.autoWidth = !0), "auto" === s.height && (s.autoHeight = !0), s.group = r.group, s.index = e, r.coming = s, !1 === r.trigger("beforeLoad")) r.coming = null;
                else {
                    if (n = s.type, t = s.href, !n) return r.coming = null, !(!r.current || !r.router || "jumpto" === r.router) && (r.current.index = e, r[r.router](r.direction));
                    if (r.isActive = !0, "image" !== n && "swf" !== n || (s.autoHeight = s.autoWidth = !1, s.scrolling = "visible"), "image" === n && (s.aspectRatio = !0), "iframe" === n && h && (s.scrolling = "scroll"), s.wrap = i(s.tpl.wrap).addClass("fancybox-" + (h ? "mobile" : "desktop") + " fancybox-type-" + n + " fancybox-tmp " + s.wrapCSS).appendTo(s.parent || "body"), i.extend(s, {
                            skin: i(".fancybox-skin", s.wrap),
                            outer: i(".fancybox-outer", s.wrap),
                            inner: i(".fancybox-inner", s.wrap)
                        }), i.each(["Top", "Right", "Bottom", "Left"], function(e, t) {
                            s.skin.css("padding" + t, m(s.padding[e]))
                        }), r.trigger("onReady"), "inline" === n || "html" === n) {
                        if (!s.content || !s.content.length) return r._error("content")
                    } else if (!t) return r._error("href");
                    "image" === n ? r._loadImage() : "ajax" === n ? r._loadAjax() : "iframe" === n ? r._loadIframe() : r._afterLoad()
                }
            },
            _error: function(e) {
                i.extend(r.coming, {
                    type: "html",
                    autoWidth: !0,
                    autoHeight: !0,
                    minWidth: 0,
                    minHeight: 0,
                    scrolling: "no",
                    hasError: e,
                    content: r.coming.tpl.error
                }), r._afterLoad()
            },
            _loadImage: function() {
                var e = r.imgPreload = new Image;
                e.onload = function() {
                    this.onload = this.onerror = null, r.coming.width = this.width / r.opts.pixelRatio, r.coming.height = this.height / r.opts.pixelRatio, r._afterLoad()
                }, e.onerror = function() {
                    this.onload = this.onerror = null, r._error("image")
                }, e.src = r.coming.href, !0 !== e.complete && r.showLoading()
            },
            _loadAjax: function() {
                var e = r.coming;
                r.showLoading(), r.ajaxLoad = i.ajax(i.extend({}, e.ajax, {
                    url: e.href,
                    error: function(e, t) {
                        r.coming && "abort" !== t ? r._error("ajax", e) : r.hideLoading()
                    },
                    success: function(t, i) {
                        "success" === i && (e.content = t, r._afterLoad())
                    }
                }))
            },
            _loadIframe: function() {
                var e = r.coming,
                    t = i(e.tpl.iframe.replace(/\{rnd\}/g, (new Date).getTime())).attr("scrolling", h ? "auto" : e.iframe.scrolling).attr("src", e.href);
                i(e.wrap).bind("onReset", function() {
                    try {
                        i(this).find("iframe").hide().attr("src", "//about:blank").end().empty()
                    } catch (e) {}
                }), e.iframe.preload && (r.showLoading(), t.one("load", function() {
                    i(this).data("ready", 1), h || i(this).bind("load.fb", r.update), i(this).parents(".fancybox-wrap").width("100%").removeClass("fancybox-tmp").show(), r._afterLoad()
                })), e.content = t.appendTo(e.inner), e.iframe.preload || r._afterLoad()
            },
            _preloadImages: function() {
                var e, t, i = r.group,
                    n = r.current,
                    s = i.length,
                    o = n.preload ? Math.min(n.preload, s - 1) : 0;
                for (t = 1; t <= o; t += 1) e = i[(n.index + t) % s], "image" === e.type && e.href && ((new Image).src = e.href)
            },
            _afterLoad: function() {
                var e, t, n, s, o, a = r.coming,
                    l = r.current;
                if (r.hideLoading(), a && !1 !== r.isActive)
                    if (!1 === r.trigger("afterLoad", a, l)) a.wrap.stop(!0).trigger("onReset").remove(), r.coming = null;
                    else {
                        switch (l && (r.trigger("beforeChange", l), l.wrap.stop(!0).removeClass("fancybox-opened").find(".fancybox-item, .fancybox-nav").remove()), r.unbindEvents(), e = a.content, t = a.type, n = a.scrolling, i.extend(r, {
                            wrap: a.wrap,
                            skin: a.skin,
                            outer: a.outer,
                            inner: a.inner,
                            current: a,
                            previous: l
                        }), s = a.href, t) {
                            case "inline":
                            case "ajax":
                            case "html":
                                a.selector ? e = i("<div>").html(e).find(a.selector) : d(e) && (e.data("fancybox-placeholder") || e.data("fancybox-placeholder", i('<div class="fancybox-placeholder"></div>').insertAfter(e).hide()), e = e.show().detach(), a.wrap.bind("onReset", function() {
                                    i(this).find(e).length && e.hide().replaceAll(e.data("fancybox-placeholder")).data("fancybox-placeholder", !1)
                                }));
                                break;
                            case "image":
                                e = a.tpl.image.replace("{href}", s);
                                break;
                            case "swf":
                                e = '<object id="fancybox-swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="movie" value="' + s + '"></param>', o = "", i.each(a.swf, function(t, i) {
                                    e += '<param name="' + t + '" value="' + i + '"></param>', o += " " + t + '="' + i + '"'
                                }), e += '<embed src="' + s + '" type="application/x-shockwave-flash" width="100%" height="100%"' + o + "></embed></object>"
                        }(!d(e) || !e.parent().is(a.inner)) && a.inner.append(e), r.trigger("beforeShow"), a.inner.css("overflow", "yes" === n ? "scroll" : "no" === n ? "hidden" : n), r._setDimension(), r.reposition(), r.isOpen = !1, r.coming = null, r.bindEvents(), r.isOpened ? l.prevMethod && r.transitions[l.prevMethod]() : i(".fancybox-wrap").not(a.wrap).stop(!0).trigger("onReset").remove(), r.transitions[r.isOpened ? a.nextMethod : a.openMethod](), r._preloadImages()
                    }
            },
            _setDimension: function() {
                var e, t, n, s, o, a, l, c, h, d = r.getViewport(),
                    u = 0,
                    g = !1,
                    v = !1,
                    g = r.wrap,
                    b = r.skin,
                    y = r.inner,
                    C = r.current,
                    v = C.width,
                    x = C.height,
                    w = C.minWidth,
                    k = C.minHeight,
                    E = C.maxWidth,
                    S = C.maxHeight,
                    j = C.scrolling,
                    T = C.scrollOutside ? C.scrollbarWidth : 0,
                    R = C.margin,
                    A = f(R[1] + R[3]),
                    F = f(R[0] + R[2]);
                if (g.add(b).add(y).width("auto").height("auto").removeClass("fancybox-tmp"), R = f(b.outerWidth(!0) - b.width()), e = f(b.outerHeight(!0) - b.height()), t = A + R, n = F + e, s = p(v) ? (d.w - t) * f(v) / 100 : v, o = p(x) ? (d.h - n) * f(x) / 100 : x, "iframe" === C.type) {
                    if (h = C.content, C.autoHeight && 1 === h.data("ready")) try {
                        h[0].contentWindow.document.location && (y.width(s).height(9999), a = h.contents().find("body"), T && a.css("overflow-x", "hidden"), o = a.outerHeight(!0))
                    } catch (O) {}
                } else(C.autoWidth || C.autoHeight) && (y.addClass("fancybox-tmp"), C.autoWidth || y.width(s), C.autoHeight || y.height(o), C.autoWidth && (s = y.width()), C.autoHeight && (o = y.height()), y.removeClass("fancybox-tmp"));
                if (v = f(s), x = f(o), c = s / o, w = f(p(w) ? f(w, "w") - t : w), E = f(p(E) ? f(E, "w") - t : E), k = f(p(k) ? f(k, "h") - n : k), S = f(p(S) ? f(S, "h") - n : S), a = E, l = S, C.fitToView && (E = Math.min(d.w - t, E), S = Math.min(d.h - n, S)), t = d.w - A, F = d.h - F, C.aspectRatio ? (v > E && (v = E, x = f(v / c)), x > S && (x = S, v = f(x * c)), v < w && (v = w, x = f(v / c)), x < k && (x = k, v = f(x * c))) : (v = Math.max(w, Math.min(v, E)), C.autoHeight && "iframe" !== C.type && (y.width(v), x = y.height()), x = Math.max(k, Math.min(x, S))), C.fitToView)
                    if (y.width(v).height(x), g.width(v + R), d = g.width(), A = g.height(), C.aspectRatio)
                        for (;
                            (d > t || A > F) && v > w && x > k && !(19 < u++);) x = Math.max(k, Math.min(S, x - 10)), v = f(x * c), v < w && (v = w, x = f(v / c)), v > E && (v = E, x = f(v / c)), y.width(v).height(x), g.width(v + R), d = g.width(), A = g.height();
                    else v = Math.max(w, Math.min(v, v - (d - t))), x = Math.max(k, Math.min(x, x - (A - F)));
                T && "auto" === j && x < o && v + R + T < t && (v += T), y.width(v).height(x), g.width(v + R), d = g.width(), A = g.height(), g = (d > t || A > F) && v > w && x > k, v = C.aspectRatio ? v < a && x < l && v < s && x < o : (v < a || x < l) && (v < s || x < o), i.extend(C, {
                    dim: {
                        width: m(d),
                        height: m(A)
                    },
                    origWidth: s,
                    origHeight: o,
                    canShrink: g,
                    canExpand: v,
                    wPadding: R,
                    hPadding: e,
                    wrapSpace: A - b.outerHeight(!0),
                    skinSpace: b.height() - x
                }), !h && C.autoHeight && x > k && x < S && !v && y.height("auto")
            },
            _getPosition: function(e) {
                var t = r.current,
                    i = r.getViewport(),
                    n = t.margin,
                    s = r.wrap.width() + n[1] + n[3],
                    o = r.wrap.height() + n[0] + n[2],
                    n = {
                        position: "absolute",
                        top: n[0],
                        left: n[3]
                    };
                return t.autoCenter && t.fixed && !e && o <= i.h && s <= i.w ? n.position = "fixed" : t.locked || (n.top += i.y, n.left += i.x), n.top = m(Math.max(n.top, n.top + (i.h - o) * t.topRatio)), n.left = m(Math.max(n.left, n.left + (i.w - s) * t.leftRatio)), n
            },
            _afterZoomIn: function() {
                var e = r.current;
                e && (r.isOpen = r.isOpened = !0, r.wrap.css("overflow", "visible").addClass("fancybox-opened"), r.update(), (e.closeClick || e.nextClick && 1 < r.group.length) && r.inner.css("cursor", "pointer").bind("click.fb", function(t) {
                    !i(t.target).is("a") && !i(t.target).parent().is("a") && (t.preventDefault(), r[e.closeClick ? "close" : "next"]())
                }), e.closeBtn && i(e.tpl.closeBtn).appendTo(r.skin).bind("click.fb", function(e) {
                    e.preventDefault(), r.close()
                }), e.arrows && 1 < r.group.length && ((e.loop || 0 < e.index) && i(e.tpl.prev).appendTo(r.outer).bind("click.fb", r.prev), (e.loop || e.index < r.group.length - 1) && i(e.tpl.next).appendTo(r.outer).bind("click.fb", r.next)), r.trigger("afterShow"), e.loop || e.index !== e.group.length - 1 ? r.opts.autoPlay && !r.player.isActive && (r.opts.autoPlay = !1, r.play()) : r.play(!1))
            },
            _afterZoomOut: function(e) {
                e = e || r.current, i(".fancybox-wrap").trigger("onReset").remove(), i.extend(r, {
                    group: {},
                    opts: {},
                    router: !1,
                    current: null,
                    isActive: !1,
                    isOpened: !1,
                    isOpen: !1,
                    isClosing: !1,
                    wrap: null,
                    skin: null,
                    outer: null,
                    inner: null
                }), r.trigger("afterClose", e)
            }
        }), r.transitions = {
            getOrigPosition: function() {
                var e = r.current,
                    t = e.element,
                    i = e.orig,
                    n = {},
                    s = 50,
                    o = 50,
                    a = e.hPadding,
                    l = e.wPadding,
                    c = r.getViewport();
                return !i && e.isDom && t.is(":visible") && (i = t.find("img:first"), i.length || (i = t)), d(i) ? (n = i.offset(), i.is("img") && (s = i.outerWidth(), o = i.outerHeight())) : (n.top = c.y + (c.h - o) * e.topRatio, n.left = c.x + (c.w - s) * e.leftRatio), ("fixed" === r.wrap.css("position") || e.locked) && (n.top -= c.y, n.left -= c.x), n = {
                    top: m(n.top - a * e.topRatio),
                    left: m(n.left - l * e.leftRatio),
                    width: m(s + l),
                    height: m(o + a)
                }
            },
            step: function(e, t) {
                var i, n, s = t.prop;
                n = r.current;
                var o = n.wrapSpace,
                    a = n.skinSpace;
                "width" !== s && "height" !== s || (i = t.end === t.start ? 1 : (e - t.start) / (t.end - t.start), r.isClosing && (i = 1 - i), n = "width" === s ? n.wPadding : n.hPadding, n = e - n, r.skin[s](f("width" === s ? n : n - o * i)), r.inner[s](f("width" === s ? n : n - o * i - a * i)))
            },
            zoomIn: function() {
                var e = r.current,
                    t = e.pos,
                    n = e.openEffect,
                    s = "elastic" === n,
                    o = i.extend({
                        opacity: 1
                    }, t);
                delete o.position, s ? (t = this.getOrigPosition(), e.openOpacity && (t.opacity = .1)) : "fade" === n && (t.opacity = .1), r.wrap.css(t).animate(o, {
                    duration: "none" === n ? 0 : e.openSpeed,
                    easing: e.openEasing,
                    step: s ? this.step : null,
                    complete: r._afterZoomIn
                })
            },
            zoomOut: function() {
                var e = r.current,
                    t = e.closeEffect,
                    i = "elastic" === t,
                    n = {
                        opacity: .1
                    };
                i && (n = this.getOrigPosition(), e.closeOpacity && (n.opacity = .1)), r.wrap.animate(n, {
                    duration: "none" === t ? 0 : e.closeSpeed,
                    easing: e.closeEasing,
                    step: i ? this.step : null,
                    complete: r._afterZoomOut
                })
            },
            changeIn: function() {
                var e, t = r.current,
                    i = t.nextEffect,
                    n = t.pos,
                    s = {
                        opacity: 1
                    },
                    o = r.direction;
                n.opacity = .1, "elastic" === i && (e = "down" === o || "up" === o ? "top" : "left", "down" === o || "right" === o ? (n[e] = m(f(n[e]) - 200), s[e] = "+=200px") : (n[e] = m(f(n[e]) + 200), s[e] = "-=200px")), "none" === i ? r._afterZoomIn() : r.wrap.css(n).animate(s, {
                    duration: t.nextSpeed,
                    easing: t.nextEasing,
                    complete: r._afterZoomIn
                })
            },
            changeOut: function() {
                var e = r.previous,
                    t = e.prevEffect,
                    n = {
                        opacity: .1
                    },
                    s = r.direction;
                "elastic" === t && (n["down" === s || "up" === s ? "top" : "left"] = ("up" === s || "left" === s ? "-" : "+") + "=200px"), e.wrap.animate(n, {
                    duration: "none" === t ? 0 : e.prevSpeed,
                    easing: e.prevEasing,
                    complete: function() {
                        i(this).trigger("onReset").remove()
                    }
                })
            }
        }, r.helpers.overlay = {
            defaults: {
                closeClick: !0,
                speedOut: 200,
                showEarly: !0,
                css: {},
                locked: !h,
                fixed: !0
            },
            overlay: null,
            fixed: !1,
            el: i("html"),
            create: function(e) {
                e = i.extend({}, this.defaults, e), this.overlay && this.close(), this.overlay = i('<div class="fancybox-overlay"></div>').appendTo(r.coming ? r.coming.parent : e.parent), this.fixed = !1, e.fixed && r.defaults.fixed && (this.overlay.addClass("fancybox-overlay-fixed"), this.fixed = !0)
            },
            open: function(e) {
                var t = this;
                e = i.extend({}, this.defaults, e), this.overlay ? this.overlay.unbind(".overlay").width("auto").height("auto") : this.create(e), this.fixed || (o.bind("resize.overlay", i.proxy(this.update, this)), this.update()), e.closeClick && this.overlay.bind("click.overlay", function(e) {
                    if (i(e.target).hasClass("fancybox-overlay")) return r.isActive ? r.close() : t.close(), !1
                }), this.overlay.css(e.css).show()
            },
            close: function() {
                var e, t;
                o.unbind("resize.overlay"), this.el.hasClass("fancybox-lock") && (i(".fancybox-margin").removeClass("fancybox-margin"), e = o.scrollTop(), t = o.scrollLeft(), this.el.removeClass("fancybox-lock"), o.scrollTop(e).scrollLeft(t)), i(".fancybox-overlay").remove().hide(), i.extend(this, {
                    overlay: null,
                    fixed: !1
                })
            },
            update: function() {
                var e, i = "100%";
                this.overlay.width(i).height("100%"), l ? (e = Math.max(t.documentElement.offsetWidth, t.body.offsetWidth),
                    a.width() > e && (i = a.width())) : a.width() > o.width() && (i = a.width()), this.overlay.width(i).height(a.height())
            },
            onReady: function(e, t) {
                var n = this.overlay;
                i(".fancybox-overlay").stop(!0, !0), n || this.create(e), e.locked && this.fixed && t.fixed && (n || (this.margin = a.height() > o.height() && i("html").css("margin-right").replace("px", "")), t.locked = this.overlay.append(t.wrap), t.fixed = !1), !0 === e.showEarly && this.beforeShow.apply(this, arguments)
            },
            beforeShow: function(e, t) {
                var n, s;
                t.locked && (!1 !== this.margin && (i("*").filter(function() {
                    return "fixed" === i(this).css("position") && !i(this).hasClass("fancybox-overlay") && !i(this).hasClass("fancybox-wrap")
                }).addClass("fancybox-margin"), this.el.addClass("fancybox-margin")), n = o.scrollTop(), s = o.scrollLeft(), this.el.addClass("fancybox-lock"), o.scrollTop(n).scrollLeft(s)), this.open(e)
            },
            onUpdate: function() {
                this.fixed || this.update()
            },
            afterClose: function(e) {
                this.overlay && !r.coming && this.overlay.fadeOut(e.speedOut, i.proxy(this.close, this))
            }
        }, r.helpers.title = {
            defaults: {
                type: "float",
                position: "bottom"
            },
            beforeShow: function(e) {
                var t = r.current,
                    n = t.title,
                    s = e.type;
                if (i.isFunction(n) && (n = n.call(t.element, t)), u(n) && "" !== i.trim(n)) {
                    switch (t = i('<div class="fancybox-title fancybox-title-' + s + '-wrap">' + n + "</div>"), s) {
                        case "inside":
                            s = r.skin;
                            break;
                        case "outside":
                            s = r.wrap;
                            break;
                        case "over":
                            s = r.inner;
                            break;
                        default:
                            s = r.skin, t.appendTo("body"), l && t.width(t.width()), t.wrapInner('<span class="child"></span>'), r.current.margin[2] += Math.abs(f(t.css("margin-bottom")))
                    }
                    t["top" === e.position ? "prependTo" : "appendTo"](s)
                }
            }
        }, i.fn.fancybox = function(e) {
            var t, n = i(this),
                s = this.selector || "",
                o = function(o) {
                    var a, l, c = i(this).blur(),
                        h = t;
                    !o.ctrlKey && !o.altKey && !o.shiftKey && !o.metaKey && !c.is(".fancybox-wrap") && (a = e.groupAttr || "data-fancybox-group", l = c.attr(a), l || (a = "rel", l = c.get(0)[a]), l && "" !== l && "nofollow" !== l && (c = s.length ? i(s) : n, c = c.filter("[" + a + '="' + l + '"]'), h = c.index(this)), e.index = h, !1 !== r.open(c, e) && o.preventDefault())
                };
            return e = e || {}, t = e.index || 0, s && !1 !== e.live ? a.undelegate(s, "click.fb-start").delegate(s + ":not('.fancybox-item, .fancybox-nav')", "click.fb-start", o) : n.unbind("click.fb-start").bind("click.fb-start", o), this.filter("[data-fancybox-start=1]").trigger("click"), this
        }, a.ready(function() {
            var t, o;
            if (i.scrollbarWidth === n && (i.scrollbarWidth = function() {
                    var e = i('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo("body"),
                        t = e.children(),
                        t = t.innerWidth() - t.height(99).innerWidth();
                    return e.remove(), t
                }), i.support.fixedPosition === n) {
                t = i.support, o = i('<div style="position:fixed;top:20px;"></div>').appendTo("body");
                var a = 20 === o[0].offsetTop || 15 === o[0].offsetTop;
                o.remove(), t.fixedPosition = a
            }
            i.extend(r.defaults, {
                scrollbarWidth: i.scrollbarWidth(),
                fixed: i.support.fixedPosition,
                parent: i("body")
            }), t = i(e).width(), s.addClass("fancybox-lock-test"), o = i(e).width(), s.removeClass("fancybox-lock-test"), i("<style type='text/css'>.fancybox-margin{margin-right:" + (o - t) + "px;}</style>").appendTo("head")
        })
    }(window, document, jQuery),
    function(e) {
        e.fn.slideAccordion = function(n) {
            var s = e.extend({
                addClassBeforeAnimation: !1,
                allowClickWhenExpanded: !1,
                activeClass: "active",
                opener: ".opener",
                slider: ".slide",
                animSpeed: 300,
                collapsible: !1,
                event: "click"
            }, n);
            return this.each(function() {
                var n = e(this),
                    o = n.find(":has(" + s.slider + ")");
                o.each(function() {
                    var n = e(this),
                        o = n.find(s.opener),
                        a = n.find(s.slider);
                    o.bind(s.event, function(e) {
                        if (!a.is(":animated"))
                            if (n.hasClass(s.activeClass)) {
                                if (s.allowClickWhenExpanded) return;
                                s.collapsible && a.slideUp(s.animSpeed, function() {
                                    i(a), n.removeClass(s.activeClass)
                                })
                            } else {
                                var o = n.siblings("." + s.activeClass),
                                    r = o.find(s.slider);
                                n.addClass(s.activeClass), t(a).hide().slideDown(s.animSpeed), r.slideUp(s.animSpeed, function() {
                                    o.removeClass(s.activeClass), i(r)
                                })
                            }
                        e.preventDefault()
                    }), n.hasClass(s.activeClass) ? t(a) : i(a)
                })
            })
        };
        var t = function(e) {
                return e.css({
                    position: "",
                    top: "",
                    left: "",
                    width: ""
                })
            },
            i = function(e) {
                return e.show().css({
                    position: "absolute",
                    top: -9999,
                    left: -9999,
                    width: e.width()
                })
            }
    }(jQuery),
    function(e) {
        function t(t) {
            this.options = e.extend({
                addClassBeforeAnimation: !0,
                hideOnClickOutside: !1,
                activeClass: "active",
                opener: ".opener",
                slider: ".slide",
                animSpeed: 400,
                effect: "fade",
                event: "click"
            }, t), this.init()
        }
        t.prototype = {
            init: function() {
                this.options.holder && (this.findElements(), this.attachEvents(), this.makeCallback("onInit", this))
            },
            findElements: function() {
                this.holder = e(this.options.holder), this.opener = this.holder.find(this.options.opener), this.slider = this.holder.find(this.options.slider)
            },
            attachEvents: function() {
                var t = this;
                this.eventHandler = function(e) {
                    e.preventDefault(), t.slider.hasClass(i) ? t.showSlide() : t.hideSlide()
                }, t.opener.bind(t.options.event, this.eventHandler), "over" === t.options.event && (t.opener.bind("mouseenter", function() {
                    t.holder.hasClass(t.options.activeClass) || t.showSlide()
                }), t.holder.bind("mouseleave", function() {
                    t.hideSlide()
                })), t.outsideClickHandler = function(i) {
                    if (t.options.hideOnClickOutside) {
                        var n = e(i.target);
                        n.is(t.holder) || n.closest(t.holder).length || t.hideSlide()
                    }
                }, this.holder.hasClass(this.options.activeClass) ? e(document).bind("click touchstart", t.outsideClickHandler) : this.slider.addClass(i)
            },
            showSlide: function() {
                var t = this;
                t.options.addClassBeforeAnimation && t.holder.addClass(t.options.activeClass), t.slider.removeClass(i), e(document).bind("click touchstart", t.outsideClickHandler), t.makeCallback("animStart", !0), n[t.options.effect].show({
                    box: t.slider,
                    speed: t.options.animSpeed,
                    complete: function() {
                        t.options.addClassBeforeAnimation || t.holder.addClass(t.options.activeClass), t.makeCallback("animEnd", !0)
                    }
                })
            },
            hideSlide: function() {
                var t = this;
                t.options.addClassBeforeAnimation && t.holder.removeClass(t.options.activeClass), e(document).unbind("click touchstart", t.outsideClickHandler), t.makeCallback("animStart", !1), n[t.options.effect].hide({
                    box: t.slider,
                    speed: t.options.animSpeed,
                    complete: function() {
                        t.options.addClassBeforeAnimation || t.holder.removeClass(t.options.activeClass), t.slider.addClass(i), t.makeCallback("animEnd", !1)
                    }
                })
            },
            destroy: function() {
                this.slider.removeClass(i).css({
                    display: ""
                }), this.opener.unbind(this.options.event, this.eventHandler), this.holder.removeClass(this.options.activeClass).removeData("OpenClose"), e(document).unbind("click touchstart", this.outsideClickHandler)
            },
            makeCallback: function(e) {
                if ("function" == typeof this.options[e]) {
                    var t = Array.prototype.slice.call(arguments);
                    t.shift(), this.options[e].apply(this, t)
                }
            }
        };
        var i = "js-slide-hidden";
        ! function() {
            var t = e('<style type="text/css">')[0],
                n = "." + i;
            n += "{position:absolute !important;left:-9999px !important;top:-9999px !important;display:block !important}", t.styleSheet ? t.styleSheet.cssText = n : t.appendChild(document.createTextNode(n)), e("head").append(t)
        }();
        var n = {
            slide: {
                show: function(e) {
                    e.box.stop(!0).hide().slideDown(e.speed, e.complete)
                },
                hide: function(e) {
                    e.box.stop(!0).slideUp(e.speed, e.complete)
                }
            },
            fade: {
                show: function(e) {
                    e.box.stop(!0).hide().fadeIn(e.speed, e.complete)
                },
                hide: function(e) {
                    e.box.stop(!0).fadeOut(e.speed, e.complete)
                }
            },
            none: {
                show: function(e) {
                    e.box.hide().show(0, e.complete)
                },
                hide: function(e) {
                    e.box.hide(0, e.complete)
                }
            }
        };
        e.fn.openClose = function(i) {
            return this.each(function() {
                jQuery(this).data("OpenClose", new t(e.extend(i, {
                    holder: this
                })))
            })
        }
    }(jQuery),
    function(e) {
        "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof module && module.exports ? module.exports = e(require("jquery")) : e(jQuery)
    }(function(e) {
        e.extend(e.fn, {
            validate: function(t) {
                if (!this.length) return void(t && t.debug && window.console && console.warn("Nothing selected, can't validate, returning nothing."));
                var i = e.data(this[0], "validator");
                return i ? i : (this.attr("novalidate", "novalidate"), i = new e.validator(t, this[0]), e.data(this[0], "validator", i), i.settings.onsubmit && (this.on("click.validate", ":submit", function(t) {
                    i.settings.submitHandler && (i.submitButton = t.target), e(this).hasClass("cancel") && (i.cancelSubmit = !0), void 0 !== e(this).attr("formnovalidate") && (i.cancelSubmit = !0)
                }), this.on("submit.validate", function(t) {
                    function n() {
                        var n, s;
                        return !i.settings.submitHandler || (i.submitButton && (n = e("<input type='hidden'/>").attr("name", i.submitButton.name).val(e(i.submitButton).val()).appendTo(i.currentForm)), s = i.settings.submitHandler.call(i, i.currentForm, t), i.submitButton && n.remove(), void 0 !== s && s)
                    }
                    return i.settings.debug && t.preventDefault(), i.cancelSubmit ? (i.cancelSubmit = !1, n()) : i.form() ? i.pendingRequest ? (i.formSubmitted = !0, !1) : n() : (i.focusInvalid(), !1)
                })), i)
            },
            valid: function() {
                var t, i, n;
                return e(this[0]).is("form") ? t = this.validate().form() : (n = [], t = !0, i = e(this[0].form).validate(), this.each(function() {
                    t = i.element(this) && t, t || (n = n.concat(i.errorList))
                }), i.errorList = n), t
            },
            rules: function(t, i) {
                if (this.length) {
                    var n, s, o, a, r, l, c = this[0];
                    if (t) switch (n = e.data(c.form, "validator").settings, s = n.rules, o = e.validator.staticRules(c), t) {
                        case "add":
                            e.extend(o, e.validator.normalizeRule(i)), delete o.messages, s[c.name] = o, i.messages && (n.messages[c.name] = e.extend(n.messages[c.name], i.messages));
                            break;
                        case "remove":
                            return i ? (l = {}, e.each(i.split(/\s/), function(t, i) {
                                l[i] = o[i], delete o[i], "required" === i && e(c).removeAttr("aria-required")
                            }), l) : (delete s[c.name], o)
                    }
                    return a = e.validator.normalizeRules(e.extend({}, e.validator.classRules(c), e.validator.attributeRules(c), e.validator.dataRules(c), e.validator.staticRules(c)), c), a.required && (r = a.required, delete a.required, a = e.extend({
                        required: r
                    }, a), e(c).attr("aria-required", "true")), a.remote && (r = a.remote, delete a.remote, a = e.extend(a, {
                        remote: r
                    })), a
                }
            }
        }), e.extend(e.expr[":"], {
            blank: function(t) {
                return !e.trim("" + e(t).val())
            },
            filled: function(t) {
                var i = e(t).val();
                return null !== i && !!e.trim("" + i)
            },
            unchecked: function(t) {
                return !e(t).prop("checked")
            }
        }), e.validator = function(t, i) {
            this.settings = e.extend(!0, {}, e.validator.defaults, t), this.currentForm = i, this.init()
        }, e.validator.format = function(t, i) {
            return 1 === arguments.length ? function() {
                var i = e.makeArray(arguments);
                return i.unshift(t), e.validator.format.apply(this, i)
            } : void 0 === i ? t : (arguments.length > 2 && i.constructor !== Array && (i = e.makeArray(arguments).slice(1)), i.constructor !== Array && (i = [i]), e.each(i, function(e, i) {
                t = t.replace(new RegExp("\\{" + e + "\\}", "g"), function() {
                    return i
                })
            }), t)
        }, e.extend(e.validator, {
            defaults: {
                messages: {},
                groups: {},
                rules: {},
                errorClass: "error",
                pendingClass: "pending",
                validClass: "valid",
                errorElement: "label",
                focusCleanup: !1,
                focusInvalid: !0,
                errorContainer: e([]),
                errorLabelContainer: e([]),
                onsubmit: !0,
                ignore: ":hidden",
                ignoreTitle: !1,
                onfocusin: function(e) {
                    this.lastActive = e, this.settings.focusCleanup && (this.settings.unhighlight && this.settings.unhighlight.call(this, e, this.settings.errorClass, this.settings.validClass), this.hideThese(this.errorsFor(e)))
                },
                onfocusout: function(e) {
                    this.checkable(e) || !(e.name in this.submitted) && this.optional(e) || this.element(e)
                },
                onkeyup: function(t, i) {
                    var n = [16, 17, 18, 20, 35, 36, 37, 38, 39, 40, 45, 144, 225];
                    9 === i.which && "" === this.elementValue(t) || e.inArray(i.keyCode, n) !== -1 || (t.name in this.submitted || t.name in this.invalid) && this.element(t)
                },
                onclick: function(e) {
                    e.name in this.submitted ? this.element(e) : e.parentNode.name in this.submitted && this.element(e.parentNode)
                },
                highlight: function(t, i, n) {
                    "radio" === t.type ? this.findByName(t.name).addClass(i).removeClass(n) : e(t).addClass(i).removeClass(n)
                },
                unhighlight: function(t, i, n) {
                    "radio" === t.type ? this.findByName(t.name).removeClass(i).addClass(n) : e(t).removeClass(i).addClass(n)
                }
            },
            setDefaults: function(t) {
                e.extend(e.validator.defaults, t)
            },
            messages: {
                required: "This field is required.",
                remote: "Please fix this field.",
                email: "Please enter a valid email address.",
                url: "Please enter a valid URL.",
                date: "Please enter a valid date.",
                dateISO: "Please enter a valid date ( ISO ).",
                number: "Please enter a valid number.",
                digits: "Please enter only digits.",
                equalTo: "Please enter the same value again.",
                maxlength: e.validator.format("Please enter no more than {0} characters."),
                minlength: e.validator.format("Please enter at least {0} characters."),
                rangelength: e.validator.format("Please enter a value between {0} and {1} characters long."),
                range: e.validator.format("Please enter a value between {0} and {1}."),
                max: e.validator.format("Please enter a value less than or equal to {0}."),
                min: e.validator.format("Please enter a value greater than or equal to {0}."),
                step: e.validator.format("Please enter a multiple of {0}.")
            },
            autoCreateRanges: !1,
            prototype: {
                init: function() {
                    function t(t) {
                        var i = e.data(this.form, "validator"),
                            n = "on" + t.type.replace(/^validate/, ""),
                            s = i.settings;
                        s[n] && !e(this).is(s.ignore) && s[n].call(i, this, t)
                    }
                    this.labelContainer = e(this.settings.errorLabelContainer), this.errorContext = this.labelContainer.length && this.labelContainer || e(this.currentForm), this.containers = e(this.settings.errorContainer).add(this.settings.errorLabelContainer), this.submitted = {}, this.valueCache = {}, this.pendingRequest = 0, this.pending = {}, this.invalid = {}, this.reset();
                    var i, n = this.groups = {};
                    e.each(this.settings.groups, function(t, i) {
                        "string" == typeof i && (i = i.split(/\s/)), e.each(i, function(e, i) {
                            n[i] = t
                        })
                    }), i = this.settings.rules, e.each(i, function(t, n) {
                        i[t] = e.validator.normalizeRule(n)
                    }), e(this.currentForm).on("focusin.validate focusout.validate keyup.validate", ":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'], [type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'], [type='radio'], [type='checkbox'], [contenteditable]", t).on("click.validate", "select, option, [type='radio'], [type='checkbox']", t), this.settings.invalidHandler && e(this.currentForm).on("invalid-form.validate", this.settings.invalidHandler), e(this.currentForm).find("[required], [data-rule-required], .required").attr("aria-required", "true")
                },
                form: function() {
                    return this.checkForm(), e.extend(this.submitted, this.errorMap), this.invalid = e.extend({}, this.errorMap), this.valid() || e(this.currentForm).triggerHandler("invalid-form", [this]), this.showErrors(), this.valid()
                },
                checkForm: function() {
                    this.prepareForm();
                    for (var e = 0, t = this.currentElements = this.elements(); t[e]; e++) this.check(t[e]);
                    return this.valid()
                },
                element: function(t) {
                    var i, n, s = this.clean(t),
                        o = this.validationTargetFor(s),
                        a = this,
                        r = !0;
                    return void 0 === o ? delete this.invalid[s.name] : (this.prepareElement(o), this.currentElements = e(o), n = this.groups[o.name], n && e.each(this.groups, function(e, t) {
                        t === n && e !== o.name && (s = a.validationTargetFor(a.clean(a.findByName(e))), s && s.name in a.invalid && (a.currentElements.push(s), r = r && a.check(s)))
                    }), i = this.check(o) !== !1, r = r && i, i ? this.invalid[o.name] = !1 : this.invalid[o.name] = !0, this.numberOfInvalids() || (this.toHide = this.toHide.add(this.containers)), this.showErrors(), e(t).attr("aria-invalid", !i)), r
                },
                showErrors: function(t) {
                    if (t) {
                        var i = this;
                        e.extend(this.errorMap, t), this.errorList = e.map(this.errorMap, function(e, t) {
                            return {
                                message: e,
                                element: i.findByName(t)[0]
                            }
                        }), this.successList = e.grep(this.successList, function(e) {
                            return !(e.name in t)
                        })
                    }
                    this.settings.showErrors ? this.settings.showErrors.call(this, this.errorMap, this.errorList) : this.defaultShowErrors()
                },
                resetForm: function() {
                    e.fn.resetForm && e(this.currentForm).resetForm(), this.invalid = {}, this.submitted = {}, this.prepareForm(), this.hideErrors();
                    var t = this.elements().removeData("previousValue").removeAttr("aria-invalid");
                    this.resetElements(t)
                },
                resetElements: function(e) {
                    var t;
                    if (this.settings.unhighlight)
                        for (t = 0; e[t]; t++) this.settings.unhighlight.call(this, e[t], this.settings.errorClass, ""), this.findByName(e[t].name).removeClass(this.settings.validClass);
                    else e.removeClass(this.settings.errorClass).removeClass(this.settings.validClass)
                },
                numberOfInvalids: function() {
                    return this.objectLength(this.invalid)
                },
                objectLength: function(e) {
                    var t, i = 0;
                    for (t in e) e[t] && i++;
                    return i
                },
                hideErrors: function() {
                    this.hideThese(this.toHide)
                },
                hideThese: function(e) {
                    e.not(this.containers).text(""), this.addWrapper(e).hide()
                },
                valid: function() {
                    return 0 === this.size()
                },
                size: function() {
                    return this.errorList.length
                },
                focusInvalid: function() {
                    if (this.settings.focusInvalid) try {
                        e(this.findLastActive() || this.errorList.length && this.errorList[0].element || []).filter(":visible").focus().trigger("focusin")
                    } catch (t) {}
                },
                findLastActive: function() {
                    var t = this.lastActive;
                    return t && 1 === e.grep(this.errorList, function(e) {
                        return e.element.name === t.name
                    }).length && t
                },
                elements: function() {
                    var t = this,
                        i = {};
                    return e(this.currentForm).find("input, select, textarea, [contenteditable]").not(":submit, :reset, :image, :disabled").not(this.settings.ignore).filter(function() {
                        var n = this.name || e(this).attr("name");
                        return !n && t.settings.debug && window.console && console.error("%o has no name assigned", this), this.hasAttribute("contenteditable") && (this.form = e(this).closest("form")[0]), !(n in i || !t.objectLength(e(this).rules())) && (i[n] = !0, !0)
                    })
                },
                clean: function(t) {
                    return e(t)[0]
                },
                errors: function() {
                    var t = this.settings.errorClass.split(" ").join(".");
                    return e(this.settings.errorElement + "." + t, this.errorContext)
                },
                resetInternals: function() {
                    this.successList = [], this.errorList = [], this.errorMap = {}, this.toShow = e([]), this.toHide = e([])
                },
                reset: function() {
                    this.resetInternals(), this.currentElements = e([])
                },
                prepareForm: function() {
                    this.reset(), this.toHide = this.errors().add(this.containers)
                },
                prepareElement: function(e) {
                    this.reset(), this.toHide = this.errorsFor(e)
                },
                elementValue: function(t) {
                    var i, n, s = e(t),
                        o = t.type;
                    return "radio" === o || "checkbox" === o ? this.findByName(t.name).filter(":checked").val() : "number" === o && "undefined" != typeof t.validity ? t.validity.badInput ? "NaN" : s.val() : (i = t.hasAttribute("contenteditable") ? s.text() : s.val(), "file" === o ? "C:\\fakepath\\" === i.substr(0, 12) ? i.substr(12) : (n = i.lastIndexOf("/"), n >= 0 ? i.substr(n + 1) : (n = i.lastIndexOf("\\"), n >= 0 ? i.substr(n + 1) : i)) : "string" == typeof i ? i.replace(/\r/g, "") : i)
                },
                check: function(t) {
                    t = this.validationTargetFor(this.clean(t));
                    var i, n, s, o = e(t).rules(),
                        a = e.map(o, function(e, t) {
                            return t
                        }).length,
                        r = !1,
                        l = this.elementValue(t);
                    if ("function" == typeof o.normalizer) {
                        if (l = o.normalizer.call(t, l), "string" != typeof l) throw new TypeError("The normalizer should return a string value.");
                        delete o.normalizer
                    }
                    for (n in o) {
                        s = {
                            method: n,
                            parameters: o[n]
                        };
                        try {
                            if (i = e.validator.methods[n].call(this, l, t, s.parameters), "dependency-mismatch" === i && 1 === a) {
                                r = !0;
                                continue
                            }
                            if (r = !1, "pending" === i) return void(this.toHide = this.toHide.not(this.errorsFor(t)));
                            if (!i) return this.formatAndAdd(t, s), !1
                        } catch (c) {
                            throw this.settings.debug && window.console && console.log("Exception occurred when checking element " + t.id + ", check the '" + s.method + "' method.", c), c instanceof TypeError && (c.message += ".  Exception occurred when checking element " + t.id + ", check the '" + s.method + "' method."), c
                        }
                    }
                    if (!r) return this.objectLength(o) && this.successList.push(t), !0
                },
                customDataMessage: function(t, i) {
                    return e(t).data("msg" + i.charAt(0).toUpperCase() + i.substring(1).toLowerCase()) || e(t).data("msg")
                },
                customMessage: function(e, t) {
                    var i = this.settings.messages[e];
                    return i && (i.constructor === String ? i : i[t])
                },
                findDefined: function() {
                    for (var e = 0; e < arguments.length; e++)
                        if (void 0 !== arguments[e]) return arguments[e]
                },
                defaultMessage: function(t, i) {
                    var n = this.findDefined(this.customMessage(t.name, i.method), this.customDataMessage(t, i.method), !this.settings.ignoreTitle && t.title || void 0, e.validator.messages[i.method], "<strong>Warning: No message defined for " + t.name + "</strong>"),
                        s = /\$?\{(\d+)\}/g;
                    return "function" == typeof n ? n = n.call(this, i.parameters, t) : s.test(n) && (n = e.validator.format(n.replace(s, "{$1}"), i.parameters)), n
                },
                formatAndAdd: function(e, t) {
                    var i = this.defaultMessage(e, t);
                    this.errorList.push({
                        message: i,
                        element: e,
                        method: t.method
                    }), this.errorMap[e.name] = i, this.submitted[e.name] = i
                },
                addWrapper: function(e) {
                    return this.settings.wrapper && (e = e.add(e.parent(this.settings.wrapper))), e
                },
                defaultShowErrors: function() {
                    var e, t, i;
                    for (e = 0; this.errorList[e]; e++) i = this.errorList[e], this.settings.highlight && this.settings.highlight.call(this, i.element, this.settings.errorClass, this.settings.validClass), this.showLabel(i.element, i.message);
                    if (this.errorList.length && (this.toShow = this.toShow.add(this.containers)), this.settings.success)
                        for (e = 0; this.successList[e]; e++) this.showLabel(this.successList[e]);
                    if (this.settings.unhighlight)
                        for (e = 0, t = this.validElements(); t[e]; e++) this.settings.unhighlight.call(this, t[e], this.settings.errorClass, this.settings.validClass);
                    this.toHide = this.toHide.not(this.toShow), this.hideErrors(), this.addWrapper(this.toShow).show()
                },
                validElements: function() {
                    return this.currentElements.not(this.invalidElements())
                },
                invalidElements: function() {
                    return e(this.errorList).map(function() {
                        return this.element
                    })
                },
                showLabel: function(t, i) {
                    var n, s, o, a, r = this.errorsFor(t),
                        l = this.idOrName(t),
                        c = e(t).attr("aria-describedby");
                    r.length ? (r.removeClass(this.settings.validClass).addClass(this.settings.errorClass), r.html(i)) : (r = e("<" + this.settings.errorElement + ">").attr("id", l + "-error").addClass(this.settings.errorClass).html(i || ""), n = r, this.settings.wrapper && (n = r.hide().show().wrap("<" + this.settings.wrapper + "/>").parent()), this.labelContainer.length ? this.labelContainer.append(n) : this.settings.errorPlacement ? this.settings.errorPlacement(n, e(t)) : n.insertAfter(t), r.is("label") ? r.attr("for", l) : 0 === r.parents("label[for='" + this.escapeCssMeta(l) + "']").length && (o = r.attr("id"), c ? c.match(new RegExp("\\b" + this.escapeCssMeta(o) + "\\b")) || (c += " " + o) : c = o, e(t).attr("aria-describedby", c), s = this.groups[t.name], s && (a = this, e.each(a.groups, function(t, i) {
                        i === s && e("[name='" + a.escapeCssMeta(t) + "']", a.currentForm).attr("aria-describedby", r.attr("id"))
                    })))), !i && this.settings.success && (r.text(""), "string" == typeof this.settings.success ? r.addClass(this.settings.success) : this.settings.success(r, t)), this.toShow = this.toShow.add(r)
                },
                errorsFor: function(t) {
                    var i = this.escapeCssMeta(this.idOrName(t)),
                        n = e(t).attr("aria-describedby"),
                        s = "label[for='" + i + "'], label[for='" + i + "'] *";
                    return n && (s = s + ", #" + this.escapeCssMeta(n).replace(/\s+/g, ", #")), this.errors().filter(s)
                },
                escapeCssMeta: function(e) {
                    return e.replace(/([\\!"#$%&'()*+,.\/:;<=>?@\[\]^`{|}~])/g, "\\$1")
                },
                idOrName: function(e) {
                    return this.groups[e.name] || (this.checkable(e) ? e.name : e.id || e.name)
                },
                validationTargetFor: function(t) {
                    return this.checkable(t) && (t = this.findByName(t.name)), e(t).not(this.settings.ignore)[0]
                },
                checkable: function(e) {
                    return /radio|checkbox/i.test(e.type)
                },
                findByName: function(t) {
                    return e(this.currentForm).find("[name='" + this.escapeCssMeta(t) + "']")
                },
                getLength: function(t, i) {
                    switch (i.nodeName.toLowerCase()) {
                        case "select":
                            return e("option:selected", i).length;
                        case "input":
                            if (this.checkable(i)) return this.findByName(i.name).filter(":checked").length
                    }
                    return t.length
                },
                depend: function(e, t) {
                    return !this.dependTypes[typeof e] || this.dependTypes[typeof e](e, t)
                },
                dependTypes: {
                    "boolean": function(e) {
                        return e
                    },
                    string: function(t, i) {
                        return !!e(t, i.form).length
                    },
                    "function": function(e, t) {
                        return e(t)
                    }
                },
                optional: function(t) {
                    var i = this.elementValue(t);
                    return !e.validator.methods.required.call(this, i, t) && "dependency-mismatch"
                },
                startRequest: function(t) {
                    this.pending[t.name] || (this.pendingRequest++, e(t).addClass(this.settings.pendingClass), this.pending[t.name] = !0)
                },
                stopRequest: function(t, i) {
                    this.pendingRequest--, this.pendingRequest < 0 && (this.pendingRequest = 0), delete this.pending[t.name], e(t).removeClass(this.settings.pendingClass), i && 0 === this.pendingRequest && this.formSubmitted && this.form() ? (e(this.currentForm).submit(), this.formSubmitted = !1) : !i && 0 === this.pendingRequest && this.formSubmitted && (e(this.currentForm).triggerHandler("invalid-form", [this]), this.formSubmitted = !1)
                },
                previousValue: function(t, i) {
                    return e.data(t, "previousValue") || e.data(t, "previousValue", {
                        old: null,
                        valid: !0,
                        message: this.defaultMessage(t, {
                            method: i
                        })
                    })
                },
                destroy: function() {
                    this.resetForm(), e(this.currentForm).off(".validate").removeData("validator").find(".validate-equalTo-blur").off(".validate-equalTo").removeClass("validate-equalTo-blur")
                }
            },
            classRuleSettings: {
                required: {
                    required: !0
                },
                email: {
                    email: !0
                },
                url: {
                    url: !0
                },
                date: {
                    date: !0
                },
                dateISO: {
                    dateISO: !0
                },
                number: {
                    number: !0
                },
                digits: {
                    digits: !0
                },
                creditcard: {
                    creditcard: !0
                }
            },
            addClassRules: function(t, i) {
                t.constructor === String ? this.classRuleSettings[t] = i : e.extend(this.classRuleSettings, t)
            },
            classRules: function(t) {
                var i = {},
                    n = e(t).attr("class");
                return n && e.each(n.split(" "), function() {
                    this in e.validator.classRuleSettings && e.extend(i, e.validator.classRuleSettings[this])
                }), i
            },
            normalizeAttributeRule: function(e, t, i, n) {
                /min|max|step/.test(i) && (null === t || /number|range|text/.test(t)) && (n = Number(n), isNaN(n) && (n = void 0)), n || 0 === n ? e[i] = n : t === i && "range" !== t && (e[i] = !0)
            },
            attributeRules: function(t) {
                var i, n, s = {},
                    o = e(t),
                    a = t.getAttribute("type");
                for (i in e.validator.methods) "required" === i ? (n = t.getAttribute(i), "" === n && (n = !0), n = !!n) : n = o.attr(i), this.normalizeAttributeRule(s, a, i, n);
                return s.maxlength && /-1|2147483647|524288/.test(s.maxlength) && delete s.maxlength, s
            },
            dataRules: function(t) {
                var i, n, s = {},
                    o = e(t),
                    a = t.getAttribute("type");
                for (i in e.validator.methods) n = o.data("rule" + i.charAt(0).toUpperCase() + i.substring(1).toLowerCase()), this.normalizeAttributeRule(s, a, i, n);
                return s
            },
            staticRules: function(t) {
                var i = {},
                    n = e.data(t.form, "validator");
                return n.settings.rules && (i = e.validator.normalizeRule(n.settings.rules[t.name]) || {}), i
            },
            normalizeRules: function(t, i) {
                return e.each(t, function(n, s) {
                    if (s === !1) return void delete t[n];
                    if (s.param || s.depends) {
                        var o = !0;
                        switch (typeof s.depends) {
                            case "string":
                                o = !!e(s.depends, i.form).length;
                                break;
                            case "function":
                                o = s.depends.call(i, i)
                        }
                        o ? t[n] = void 0 === s.param || s.param : (e.data(i.form, "validator").resetElements(e(i)), delete t[n])
                    }
                }), e.each(t, function(n, s) {
                    t[n] = e.isFunction(s) && "normalizer" !== n ? s(i) : s
                }), e.each(["minlength", "maxlength"], function() {
                    t[this] && (t[this] = Number(t[this]))
                }), e.each(["rangelength", "range"], function() {
                    var i;
                    t[this] && (e.isArray(t[this]) ? t[this] = [Number(t[this][0]), Number(t[this][1])] : "string" == typeof t[this] && (i = t[this].replace(/[\[\]]/g, "").split(/[\s,]+/), t[this] = [Number(i[0]), Number(i[1])]))
                }), e.validator.autoCreateRanges && (null != t.min && null != t.max && (t.range = [t.min, t.max], delete t.min, delete t.max), null != t.minlength && null != t.maxlength && (t.rangelength = [t.minlength, t.maxlength], delete t.minlength, delete t.maxlength)), t
            },
            normalizeRule: function(t) {
                if ("string" == typeof t) {
                    var i = {};
                    e.each(t.split(/\s/), function() {
                        i[this] = !0
                    }), t = i
                }
                return t
            },
            addMethod: function(t, i, n) {
                e.validator.methods[t] = i, e.validator.messages[t] = void 0 !== n ? n : e.validator.messages[t], i.length < 3 && e.validator.addClassRules(t, e.validator.normalizeRule(t))
            },
            methods: {
                required: function(t, i, n) {
                    if (!this.depend(n, i)) return "dependency-mismatch";
                    if ("select" === i.nodeName.toLowerCase()) {
                        var s = e(i).val();
                        return s && s.length > 0
                    }
                    return this.checkable(i) ? this.getLength(t, i) > 0 : t.length > 0
                },
                email: function(e, t) {
                    return this.optional(t) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(e)
                },
                url: function(e, t) {
                    return this.optional(t) || /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[\/?#]\S*)?$/i.test(e)
                },
                date: function(e, t) {
                    return this.optional(t) || !/Invalid|NaN/.test(new Date(e).toString())
                },
                dateISO: function(e, t) {
                    return this.optional(t) || /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(e)
                },
                number: function(e, t) {
                    return this.optional(t) || /^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(e)
                },
                digits: function(e, t) {
                    return this.optional(t) || /^\d+$/.test(e)
                },
                minlength: function(t, i, n) {
                    var s = e.isArray(t) ? t.length : this.getLength(t, i);
                    return this.optional(i) || s >= n
                },
                maxlength: function(t, i, n) {
                    var s = e.isArray(t) ? t.length : this.getLength(t, i);
                    return this.optional(i) || s <= n
                },
                rangelength: function(t, i, n) {
                    var s = e.isArray(t) ? t.length : this.getLength(t, i);
                    return this.optional(i) || s >= n[0] && s <= n[1]
                },
                min: function(e, t, i) {
                    return this.optional(t) || e >= i
                },
                max: function(e, t, i) {
                    return this.optional(t) || e <= i
                },
                range: function(e, t, i) {
                    return this.optional(t) || e >= i[0] && e <= i[1]
                },
                step: function(t, i, n) {
                    var s = e(i).attr("type"),
                        o = "Step attribute on input type " + s + " is not supported.",
                        a = ["text", "number", "range"],
                        r = new RegExp("\\b" + s + "\\b"),
                        l = s && !r.test(a.join());
                    if (l) throw new Error(o);
                    return this.optional(i) || t % n === 0
                },
                equalTo: function(t, i, n) {
                    var s = e(n);
                    return this.settings.onfocusout && s.not(".validate-equalTo-blur").length && s.addClass("validate-equalTo-blur").on("blur.validate-equalTo", function() {
                        e(i).valid()
                    }), t === s.val()
                },
                remote: function(t, i, n, s) {
                    if (this.optional(i)) return "dependency-mismatch";
                    s = "string" == typeof s && s || "remote";
                    var o, a, r, l = this.previousValue(i, s);
                    return this.settings.messages[i.name] || (this.settings.messages[i.name] = {}), l.originalMessage = l.originalMessage || this.settings.messages[i.name][s], this.settings.messages[i.name][s] = l.message, n = "string" == typeof n && {
                        url: n
                    } || n, r = e.param(e.extend({
                        data: t
                    }, n.data)), l.old === r ? l.valid : (l.old = r, o = this, this.startRequest(i), a = {}, a[i.name] = t, e.ajax(e.extend(!0, {
                        mode: "abort",
                        port: "validate" + i.name,
                        dataType: "json",
                        data: a,
                        context: o.currentForm,
                        success: function(e) {
                            var n, a, r, c = e === !0 || "true" === e;
                            o.settings.messages[i.name][s] = l.originalMessage, c ? (r = o.formSubmitted, o.resetInternals(), o.toHide = o.errorsFor(i), o.formSubmitted = r, o.successList.push(i), o.invalid[i.name] = !1, o.showErrors()) : (n = {}, a = e || o.defaultMessage(i, {
                                method: s,
                                parameters: t
                            }), n[i.name] = l.message = a, o.invalid[i.name] = !0, o.showErrors(n)), l.valid = c, o.stopRequest(i, c)
                        }
                    }, n)), "pending")
                }
            }
        });
        var t, i = {};
        e.ajaxPrefilter ? e.ajaxPrefilter(function(e, t, n) {
            var s = e.port;
            "abort" === e.mode && (i[s] && i[s].abort(), i[s] = n)
        }) : (t = e.ajax, e.ajax = function(n) {
            var s = ("mode" in n ? n : e.ajaxSettings).mode,
                o = ("port" in n ? n : e.ajaxSettings).port;
            return "abort" === s ? (i[o] && i[o].abort(), i[o] = t.apply(this, arguments), i[o]) : t.apply(this, arguments)
        })
    }),
    function(e, t) {
        t(e.jQuery)
    }(this, function(e) {
        var t = function(e, t) {
                function i(e) {
                    s = e, o.width = o.height = s.size, a.ctx = o.getContext("2d"), a.radius = (s.size - s.lineWidth) / 2, a.ctx.translate(s.size / 2, s.size / 2), a.ctx.rotate((-.5 + s.rotate / 180) * Math.PI)
                }
                var n, s, o = document.createElement("canvas");
                e.appendChild(o);
                var a = {};
                i(t), Date.now = Date.now || function() {
                    return +new Date
                };
                var r = function(e, t, i, n) {
                        n = Math.min(Math.max(-1, n || 0), 1);
                        var s = n <= 0,
                            o = a.ctx.createLinearGradient(a.radius, a.radius, 0, a.radius);
                        o.addColorStop(0, e), o.addColorStop(1, t), a.ctx.beginPath(), a.ctx.arc(0, 0, a.radius, 0, 2 * Math.PI * n, s), a.ctx.strokeStyle = o, a.ctx.lineWidth = i, a.ctx.stroke()
                    },
                    l = function() {
                        return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function(e) {
                            window.setTimeout(e, 1e3 / 60)
                        }
                    }();
                this.init = function(e) {
                    i(e)
                };
                var c = function() {
                    s.trackColor && r(s.trackColor, s.trackColor, s.lineWidth, 1)
                };
                this.clear = function() {
                    a.ctx.clearRect(s.size / -2, s.size / -2, s.size, s.size), n = null
                }, this.draw = function(e) {
                    s.trackColor ? a.ctx.getImageData && a.ctx.putImageData ? n ? a.ctx.putImageData(n, 0, 0) : (c(), n = a.ctx.getImageData(0, 0, s.size, s.size)) : (this.clear(), c()) : this.clear(), a.ctx.lineCap = s.lineCap, r(s.colorStart, s.colorFinish, s.lineWidth, e / 100)
                }.bind(this), this.animate = function(e, t) {
                    var i = Date.now(),
                        n = function() {
                            var o = Math.min(Date.now() - i, s.animate.duration),
                                a = s.easing(this, o, e, t - e, s.animate.duration);
                            this.draw(a), s.onStep(e, t, a), o != s.animate.duration && l(n)
                        }.bind(this);
                    l(n)
                }.bind(this)
            },
            i = function(i, n) {
                function s(e, t) {
                    var n = 0;
                    if (e.draw(n), i.getAttribute && i.getAttribute("data-percent")) {
                        var s = parseFloat(i.getAttribute("data-percent"));
                        t.animate.enabled ? e.animate(n, s) : e.draw(s), n = s
                    }
                }
                var o = {
                        colorStart: "#000",
                        colorFinish: "#fff",
                        trackColor: "#fff000",
                        lineCap: "round",
                        lineWidth: 3,
                        size: 150,
                        rotate: 0,
                        animate: {
                            duration: 1e3,
                            enabled: !0
                        },
                        easing: function(e, t, i, n, s) {
                            return t /= s / 2, t < 1 ? n / 2 * t * t + i : -n / 2 * (--t * (t - 2) - 1) + i
                        },
                        onStep: function(e, t, i) {},
                        renderer: t
                    },
                    a = {};
                (function() {
                    this.element = i, this.options = a;
                    for (var e in o) o.hasOwnProperty(e) && (a[e] = n && "undefined" != typeof n[e] ? n[e] : o[e], "function" == typeof a[e] && (a[e] = a[e].bind(this)));
                    "string" == typeof a.easing && "undefined" != typeof jQuery && jQuery.isFunction(jQuery.easing[a.easing]) ? a.easing = jQuery.easing[a.easing] : a.easing = o.easing, this.renderer = new a.renderer(i, a), s(this.renderer, a)
                }).bind(this)();
                this.redraw = function(t) {
                    var t = e.extend({}, this.options, t);
                    this.renderer.clear(), this.renderer.init(t), s(this.renderer, t)
                }
            };
        e.fn.pieChart = function(t) {
            return this.each(function() {
                if (!e.data(this, "pieChart")) {
                    var n = e.extend({}, t, e(this).data());
                    e.data(this, "pieChart", new i(this, n))
                }
            })
        }
    }),
    function(e) {
        "use strict";

        function t(e, t, i) {
            var o = n(i, e);
            s(t, o)
        }

        function i(t, i, o) {
            var r = a[t[1]].slice(),
                l = r,
                c = n(o, t[0]);
            "default" !== i && (l = e.map(r, function(e, t) {
                return e + " and " + i
            })), i = l.join(","), s(i, c)
        }

        function n(e, t) {
            return "#" + e + '{background-image: url("' + t + '");}'
        }

        function s(t, i) {
            var n, s = o[t],
                a = "";
            a = "default" === t ? i + " " : "@media " + t + "{" + i + "}", s ? (n = s.text(), n = n.substring(0, n.length - 2) + " }" + i + "}", s.text(n)) : o[t] = e("<style>").text(a).appendTo("head")
        }
        var o = {},
            a = {
                "2x": ["(-webkit-min-device-pixel-ratio: 1.5)", "(min-resolution: 192dpi)", "(min-device-pixel-ratio: 1.5)", "(min-resolution: 1.5dppx)"],
                "3x": ["(-webkit-min-device-pixel-ratio: 3)", "(min-resolution: 384dpi)", "(min-device-pixel-ratio: 3)", "(min-resolution: 3dppx)"]
            };
        e.fn.retinaCover = function() {
            return this.each(function() {
                var n = e(this),
                    s = n.children("[data-srcset]"),
                    o = "bg-stretch" + Date.now() + (1e3 * Math.random()).toFixed(0);
                s.length && (n.attr("id", o), s.each(function() {
                    var n, s, a = e(this),
                        r = a.data("srcset").split(", "),
                        l = a.data("media") || "default",
                        c = r.length;
                    for (s = 0; s < c; s++) n = r[s].split(" "), 1 === n.length ? t(n[0], l, o) : i(n, l, o)
                })), s.detach()
            })
        }
    }(jQuery),
    function(e) {
        "use strict";
        var t = function() {
            function t(t, n) {
                var s = this;
                return s.$holder = e(t), s._options = e.extend({}, i, n), s._steps = e(s._options.steps), s._steps.length ? (s._currentIndex = 0, s._steps.eq(s._currentIndex).addClass(s._options.activeClass), void s.$holder.on("click", s._options.btnNext, function(e) {
                    e.preventDefault(), s.nextStep()
                })) : void console.error(new Error("Steps is not defined"))
            }
            var i = {
                    steps: ".step",
                    btnNext: ".next",
                    transition: "none",
                    activeClass: "active-step",
                    isCanChange: function(e, t) {
                        return !0
                    },
                    onChange: function(e, t) {}
                },
                n = {
                    none: function(e, t) {
                        e.hide(), t.show()
                    }
                };
            return t.setTransition = function(t) {
                return e.isPlainObject(t) ? void Object.keys(t).forEach(function(i) {
                    return n[i] ? void console.warn("Transition effect " + i + " already exist") : void(e.isFunction(t[i]) ? n[i] = t[i] : console.warn(i + " is not a function"))
                }) : void console.warn("Not valid data")
            }, t.prototype.toStep = function(t) {
                var i = this;
                if (!(i.isCanChange || t < 0 || t > i._steps.length - 1)) {
                    var s = i._currentIndex,
                        o = i._steps.eq(s),
                        a = i._steps.eq(t),
                        r = function() {
                            n[i._options.transition](o, a), o.removeClass(i._options.activeClass), a.addClass(i._options.activeClass), i._currentIndex = t, i._options.onChange.call(i, t, s), i.isCanChange = null
                        };
                    i.isCanChange = i._options.isCanChange.call(i, s, t), e.isFunction(i.isCanChange.then) ? i.isCanChange.then(function() {
                        r()
                    }).fail(function(e) {
                        e && console.error(e), i.isCanChange = null
                    }) : i.isCanChange && r()
                }
            }, t.prototype.nextStep = function() {
                this.toStep(this._currentIndex + 1)
            }, t.prototype.prevStep = function() {
                this.toStep(this._currentIndex - 1)
            }, t.prototype.stepsLength = function() {
                return this._steps.length
            }, t.prototype.getCurrentStep = function() {
                return this._steps.eq(this._currentIndex)
            }, t
        }();
        window.Steps = t
    }(jQuery);