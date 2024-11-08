
<!-- Bloque scripts get-glid -->

<!-- //////////////Part 2 -->
<script type="text/javascript" charset="utf-8">
    var UtmCookie;
    UtmCookie = function() {
        function UtmCookie(options) {
            null == options && (options = {}),
                this._cookieNamePrefix = options.cookieNamePrefix,
                this._domain = options.domain,
                this._hostname = options.hostname,
                this.__visitTime = options._visitTime || 1,
                this._cookieExpiryDays = options.cookieExpiryDays || 365,
                this._additionalParams = options.additionalParams || [],
                this._utmParams = ["utm_source", "utm_medium", "utm_campaign", "utm_term", "utm_content"],
                this._isReturningVisitor = this.setReturningVisitor();
            if (!this.isCurrentSession()) {
                if (this._isReturningVisitor !== 1) {
                    this.writeInitialReferrer();
                    this.writeInitialLandingPageUrl();
                }
                this.writeLastReferrer();
                this.writeFullReferrer();
                this.writeLastLandingPageUrl();
                this.additionalParamsPresentInUrl() && this.writeAdditionalParams();
                this.executeFlow();
            } else {
                if (this.isNewGASession()) {
                    this.clearOldCookies();
                    this.writeLastReferrer();
                    this.writeFullReferrer();
                    this.writeLastLandingPageUrl();
                    this.additionalParamsPresentInUrl() && this.writeAdditionalParams();
                    this.executeFlow();
                    this.incrementVisitCount();
                }
            }
            this.setCurrentSession();
        }
        return UtmCookie.prototype.createCookie = function(name, value, duration, path, domain, secure) {
            var d = new Date();
            if (duration) {
                if (duration.minutes) {
                    calc_duration = duration.minutes * 60 * 1000;
                } else if (duration.hours) {
                    calc_duration = duration.hours * 60 * 60 * 1000;
                } else if (duration.days) {
                    calc_duration = duration.days * 24 * 60 * 60 * 1000;
                } else if (duration.months) {
                    calc_duration = duration.months * 30 * 24 * 60 * 60 * 1000;
                } else if (duration.years) {
                    calc_duration = duration.years * 365 * 24 * 60 * 60 * 1000;
                }
                d.setTime(d.getTime() + calc_duration);
            }

            var cookieDomain, cookieExpire, cookiePath, cookieSecure, date, expireDate;
            expireDate = d;
            cookieExpire = null != expireDate ? "; expires=" + expireDate.toGMTString() : "";
            cookiePath = null != path ? "; path=" + path : "; path=/";
            cookieDomain = null != domain ? "; domain=" + domain : "";
            cookieSecure = null != secure ? "; secure " : "";
            document.cookie = this._cookieNamePrefix + name + " =" + escape(value) + cookieExpire + cookiePath +
                cookieDomain + cookieSecure;
        }, UtmCookie.prototype.readCookie = function(name) {
            var c, ca, i, nameEQ;
            for (nameEQ = this._cookieNamePrefix + name + "=", ca = document.cookie.split(";"), i = 0; i < ca.length;) {
                for (c = ca[i];
                    " " === c.charAt(0);) c = c.substring(1, c.length);
                if (0 === c.indexOf(nameEQ)) return unescape(c.substring(nameEQ.length,
                    c.length));
                i++
            }
            return null
        }, UtmCookie.prototype.eraseCookie = function(name) {
            this.createCookie(name, "", {
                days: -1
            }, null, this._domain)
        }, UtmCookie.prototype.isNewGASession = function() {
            var last_campaign_source = this.readCookie("utm_source");
            var last_campaign_medium = this.readCookie("utm_medium");
            var last_campaign_name = this.readCookie("utm_campaign");
            var last_campaign_content = this.readCookie("utm_content");
            var last_campaign_term = this.readCookie("utm_term");
            var last_gclid = this.readCookie("utm_glid");

            var ga_last_source = this.readCookie("ga_last_source");
            var ga_last_val = this.readCookie("ga_last_val");

            var current_campaign_source = this.getParameterByName('utm_source') ? this.getParameterByName(
                'utm_medium') : '(direct)';
            var current_campaign_medium = this.getParameterByName('utm_medium') ? this.getParameterByName(
                'utm_medium') : '(none)';
            var current_campaign_name = this.getParameterByName('utm_campaign') ? this.getParameterByName(
                'utm_campaign') : '';
            var current_campaign_content = this.getParameterByName('utm_content') ? this.getParameterByName(
                'utm_content') : '';
            var current_campaign_term = this.getParameterByName('utm_term') ? this.getParameterByName(
                'utm_term') : '';
            var current_gclid = this.getParameterByName('gclid') ? this.getParameterByName('gclid') : '';

            var checkReferrer = document.referrer ? document.referrer.replace(
                /(?:http:\/\/|https:\/\/)(?:www.)?([a-zA-Z0-9\.-]*)\/.*/g, '$1') : '';
            var organic_val = checkReferrer.match(
                /(google|bing|ask|yahoo|msn|babylon|google-play|google_app|com.yandex.launcher)/g);
            var ga_current_source = 'direct';

            if (current_gclid) ga_current_source = 'gclid';
            if (current_campaign_source != "(direct)") ga_current_source = "utm";
            if (organic_val) ga_current_source = 'organic';
            if (checkReferrer && checkReferrer != this._hostname) ga_current_source = 'referrer';

            if (ga_current_source == 'direct') return false;

            if (ga_last_source != ga_current_source) {
                return true;
            } else {
                if (ga_last_source == "gclid") {
                    if (ga_last_val != current_gclid)
                        return true;
                } else if (ga_last_source == "utm") {
                    if (ga_last_val != current_campaign_source + "_" + current_campaign_medium + "_" +
                        current_campaign_name + "_" + current_campaign_content + "_" + current_campaign_term)
                        return true;
                } else if (ga_last_source == "organic") {
                    if (organic_val)
                        if (ga_last_val != organic_val[0]) return true;
                } else if (ga_last_source == "referrer") {
                    if (ga_last_val != checkReferrer && checkReferrer != this._hostname)
                        return true;
                } else if (ga_last_source == "direct") {
                    if (current_gclid) return true;
                    if (current_campaign_source != "(direct)") return true;
                    if (checkReferrer.match(
                            /(google|bing|ask|yahoo|msn|babylon|google-play|google_app|com.yandex.launcher)/g))
                        return true;
                }
            }
            return false;
        }, UtmCookie.prototype.clearOldCookies = function() {
            this.eraseCookie("utm_source");
            this.eraseCookie("utm_medium");
            this.eraseCookie("utm_campaign");
            this.eraseCookie("utm_content");
            this.eraseCookie("utm_term");
            this.eraseCookie("utm_glid");
        }, UtmCookie.prototype.setReturningVisitor = function() {
            var cookieName = "ReturnVisitor",
                existing_value = parseInt(this.readCookie(cookieName), 10);
            if (isNaN(existing_value)) existing_value = 0;
            else
                existing_value = 1;
            this.createCookie(cookieName, existing_value, {
                    days: this._cookieExpiryDays
                }, null,
                this._domain);
            return existing_value;
        }, UtmCookie.prototype.getParameterByName = function(name) {
            var regex,
                regexS, results;
            return name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]"), regexS = "[\\?&]" + name +
                "=([^&#]*)", regex = new RegExp(regexS), results = regex.exec(window.location.search), results ?
                decodeURIComponent(results[1].replace(/\+/g, " ")) : ""
        }, UtmCookie.prototype.additionalParamsPresentInUrl = function() {
            var j, len, param, ref;
            for (ref = this._additionalParams, j = 0, len = ref.length; len > j; j++)
                if (param = ref[j], this.getParameterByName(param)) return !0;
            return !1
        }, UtmCookie.prototype.utmPresentInUrl = function() {
            var j, len, param, ref;
            for (ref = this._utmParams, j = 0, len = ref.length; len > j; j++)
                if (param = ref[j], this.getParameterByName(param)) return !0;
            return !1
        }, UtmCookie.prototype.writeCookie = function(name, value) {
            this.createCookie(name, value, {
                days: this._cookieExpiryDays
            }, null, this._domain)
        }, UtmCookie.prototype.setUtmCookie = function(name, value, minutes) {
            this.createCookie(name, value, {
                'minutes': minutes
            }, null, this._domain)
        }, UtmCookie.prototype.writeAdditionalParams = function() {
            var j, len, param, ref, value;
            for (ref = this._additionalParams, j = 0, len = ref.length; len > j; j++) param = ref[j], value =
                this.getParameterByName(param), this.writeCookie(param, value)
        }, UtmCookie.prototype.writeUtmCookieFromQueryParams = function() {
            var j, len, param, ref, value;
            for (ref = this._utmParams, j = 0, len = ref.length; len > j; j++) param = ref[j], value =
                this.getParameterByName(param), this.writeCookie(param, value)
        }, UtmCookie.prototype.writeUtmCookieFromParams = function(utm_source, utm_medium, utm_campaign,
            utm_content,
            utm_term, utm_gclid, last_source, last_source_value) {
            this.writeCookie("utm_source", utm_source);
            this.writeCookie("utm_medium", utm_medium);
            this.writeCookie("utm_campaign", utm_campaign);
            this.writeCookie("utm_content", utm_content);
            this.writeCookie("utm_term", utm_term);
            this.writeCookie("utm_glid", utm_gclid);
            this.writeCookie("ga_last_source", last_source);
            this.writeCookie("ga_last_val", last_source_value);
        }, UtmCookie.prototype.writeCookieOnce = function(name, value) {
            var existingValue;
            existingValue = this.readCookie(name), existingValue || this.writeCookie(name, value)
        }, UtmCookie.prototype._sameDomainReferrer = function(referrer) {
            var hostname = document.location.hostname;
            return referrer.indexOf(this._domain) > -1 || referrer.indexOf(hostname) > -1
        }, UtmCookie.prototype._isInvalidReferrer = function(referrer) {
            return "" === referrer || void 0 === referrer
        }, UtmCookie.prototype.writeInitialReferrer = function() {
            var value;
            value = document.referrer.split(/[?#]/)[0], this._isInvalidReferrer(value) && (value = "direct"),
                this.writeCookieOnce("initial_referrer", value)
        }, UtmCookie.prototype.writeLastReferrer = function() {
            var value;
            value = document.referrer.split(/[?#]/)[0], this._sameDomainReferrer(value) || (this._isInvalidReferrer(
                value) && (
                value =
                "direct"), this.writeCookie("latest_referrer", value))
        }, UtmCookie.prototype.writeFullReferrer = function() {
            var value;
            value = document.referrer, this._sameDomainReferrer(value) || (this._isInvalidReferrer(value) && (
                value =
                "direct"), this.writeCookie("full_document.referrer", value))
        }, UtmCookie.prototype.writeInitialLandingPageUrl = function() {
            var value;
            value = this.cleanUrl(), value && this.writeCookieOnce("initial_lp", value)
        }, UtmCookie.prototype.writeLastLandingPageUrl = function() {
            var value;
            value = this.cleanUrl(), value && this.writeCookieOnce("latest_lp", value)
        }, UtmCookie.prototype.initialReferrer = function() {
            return this.readCookie("initial_referrer")
        }, UtmCookie.prototype.lastReferrer = function() {
            return this.readCookie("latest_referrer")
        }, UtmCookie.prototype.fullReferrer = function() {
            return this.readCookie("full_document.referrer")
        }, UtmCookie.prototype.initialLandingPageUrl = function() {
            return this.readCookie("initial_lp")
        }, UtmCookie.prototype.LatestLandingPageUrl = function() {
            return this.readCookie("latest_lp")
        }, UtmCookie.prototype.incrementVisitCount = function() {
            var cookieName, existingValue, newValue;
            cookieName = "totalvisits", existingValue = parseInt(this.readCookie(cookieName), 10), newValue = 1,
                newValue =
                isNaN(existingValue) ? 1 : existingValue + 1, this.writeCookie(cookieName, newValue)
        }, UtmCookie.prototype.visits = function() {
            return this.readCookie("totalvisits")
        }, UtmCookie.prototype.isCurrentSession = function() {
            return this.readCookie("current_session")
        }, UtmCookie.prototype.setCurrentSession = function() {
            var cookieName, existingValue;
            cookieName = "current_session",
                existingValue = this.readCookie(cookieName),
                existingValue || (this.createCookie(cookieName, "true", {
                        hours: this.__visitTime
                    }, null, this._domain),
                    this.incrementVisitCount())
        }, UtmCookie.prototype.cleanUrl = function() {
            var cleanSearch;
            return cleanSearch = window.location.search.replace(/utm_[^&]+&?/g, "").replace(/&$/, "").replace(
                    /^\?$/, ""),
                window.location.origin + window.location.pathname + cleanSearch + window.location.hash
        }, UtmCookie.prototype.executeFlow = function() {
            var checkReferrer = document.referrer ?
                document.referrer.replace(/(?:http:\/\/|https:\/\/)(?:www.)?([a-zA-Z0-9\.-]*)\/.*/g, '$1') : '';
            var last_campaign_source = this.readCookie("utm_source");
            var last_campaign_medium = this.readCookie("utm_medium");
            var last_campaign_name = this.readCookie("utm_campaign");
            var last_campaign_content = this.readCookie("utm_content");
            var last_campaign_term = this.readCookie("utm_term");
            var last_gclid = this.readCookie("utm_glid");

            if (!document.referrer.match(this._domain) || (document.referrer.match(this._domain) &&
                    last_campaign_source ==
                    null)) {
                var campaign_source = '';
                var campaign_medium = '';
                var campaign_name = '';
                var campaign_content = '';
                var campaign_term = '';
                var gclid = '';
                var referral_exclusion = [this._hostname];

                var last_source = "direct";
                var last_source_value = "direct";

                if (this.getParameterByName('gclid') || this.getParameterByName('gclsrc')) {
                    gclid = this.getParameterByName('gclid') ? this.getParameterByName('gclid') : '';
                    last_source = "gclid";
                    last_source_value = gclid;
                    if (this.getParameterByName('utm_source')) {
                        campaign_source = this.getParameterByName('utm_source');
                        campaign_medium = this.getParameterByName('utm_medium') ? this.getParameterByName(
                            'utm_medium') : '';
                        campaign_name = this.getParameterByName('utm_campaign') ? this.getParameterByName(
                            'utm_campaign') : '';
                        campaign_content = this.getParameterByName('utm_content') ? this.getParameterByName(
                            'utm_content') : '';
                        campaign_term = this.getParameterByName('utm_term') ? this.getParameterByName(
                            'utm_term') : '';
                    } else {
                        campaign_source = 'Paid Google Search';
                        campaign_medium = 'cpc';
                        campaign_name = this.getParameterByName('gclid');
                    }
                } else if (this.getParameterByName('utm_source')) {
                    campaign_source = this.getParameterByName('utm_source');
                    campaign_medium = this.getParameterByName('utm_medium') ? this.getParameterByName(
                        'utm_medium') : '';
                    campaign_name = this.getParameterByName('utm_campaign') ? this.getParameterByName(
                        'utm_campaign') : '';
                    campaign_content = this.getParameterByName('utm_content') ? this.getParameterByName(
                        'utm_content') : '';
                    campaign_term = this.getParameterByName('utm_term') ? this.getParameterByName('utm_term') :
                        '';
                    gclid = '';
                    last_source = "utm";
                    last_source_value = campaign_source + "_" + campaign_medium + "_" + campaign_name + "_" +
                        campaign_content + "_" + campaign_term;
                } else if (checkReferrer && referral_exclusion.indexOf(checkReferrer) == -1) {
                    if (checkReferrer.match(
                            /(google\..*|bing.com|ask.com|yahoo.com|msn.com|isearch.babylon.com|google-play|google_app|com.yandex.launcher)/g
                        )) {
                        campaign_source =
                            checkReferrer.match(
                                /(google|bing|ask|yahoo|msn|babylon|google-play|google_app|com.yandex.launcher)/g
                            )[0];
                        campaign_medium = 'organic';

                        last_source = "organic";
                        last_source_value = campaign_source;
                    } else {
                        campaign_source = checkReferrer;
                        campaign_medium = 'referral';

                        last_source = "referral";
                        last_source_value = campaign_source;
                    }
                    gclid = '';
                    campaign_name = '';
                    campaign_content = '';
                    campaign_term = '';
                } else {
                    campaign_source = '(direct)';
                    campaign_medium = '(none)';
                    gclid = '';
                    campaign_name = '';
                    campaign_content = '';
                    campaign_term = '';

                    last_source = "direct";
                    last_source_value = "direct";
                }

                this.writeUtmCookieFromParams(campaign_source, campaign_medium, campaign_name, campaign_content,
                    campaign_term,
                    gclid, last_source, last_source_value);
            } else {
                this.writeUtmCookieFromParams(last_campaign_source, last_campaign_medium, last_campaign_name,
                    last_campaign_content, last_campaign_term, last_gclid);
            }
        }, UtmCookie
    }();
    var UtmForm, _uf;
    UtmForm = function() {
        function UtmForm(options) {
            null == options && (options = {}),
                this._utmParamsMap = {},
                this._utmParamsMap.utm_source = options.utm_source_field || "USOURCE",
                this._utmParamsMap.utm_medium = options.utm_medium_field || "UMEDIUM",
                this._utmParamsMap.utm_campaign = options.utm_campaign_field || "UCAMPAIGN",
                this._utmParamsMap.utm_content = options.utm_content_field || "UCONTENT",
                this._utmParamsMap.utm_term = options.utm_term_field || "UTERM",
                this._additionalParamsMap = options.additional_params_map || {},
                this._initialReferrerField = options.initial_referrer_field || "IREFERRER",
                this._lastReferrerField = options.last_referrer_field || "LREFERRER",
                this._initialLandingPageField = options.initial_landing_page_field || "ILANDPAGE",
                this._visitsField = options.visits_field || "VISITS",
                this._formSelector = options._formSelector || "all",
                this._customFormSelector = options._customFormSelector || "form",
                this.utmCookie = new UtmCookie({
                    domain: options.domain,
                    _visitTime: options._visitTime,
                    cookieExpiryDays: options.cookieExpiryDays,
                    additionalParams: Object.getOwnPropertyNames(this._additionalParamsMap),
                    hostname: options.hostname,
                    cookieNamePrefix: options.cookieNamePrefix
                }),
                this.addAllFields()
        }
        return UtmForm.prototype.addAllFields = function() {
            var allForms, i, len;
            for (allForms = document.querySelectorAll(this._customFormSelector), len = "none" === this._formSelector ?
                0 : "first" ===
                this._formSelector ? Math.min(1, allForms.length) : allForms.length, i = 0; len > i;)
                this.addAllFieldsToForm(allForms[i]), i++
        }, UtmForm.prototype.addAllFieldsToForm = function(form) {
            var fieldName, param, ref, ref1;
            if (form && !form._utm_tagged) {
                form._utm_tagged = !0, ref = this._utmParamsMap;
                for (param in ref) fieldName = ref[param], this.addFormElem(form, fieldName, this.utmCookie.readCookie(
                    param));
                ref1 = this._additionalParamsMap;
                for (param in ref1) fieldName = ref1[param], this.addFormElem(form, fieldName, this.utmCookie.readCookie(
                    param));
                this.addFormElem(form, this._initialReferrerField, this.utmCookie.initialReferrer()), this.addFormElem(
                    form,
                    this._lastReferrerField, this.utmCookie.lastReferrer()), this.addFormElem(form, this._initialLandingPageField,
                    this.utmCookie.initialLandingPageUrl()), this.addFormElem(form, this._visitsField, this
                    .utmCookie.visits())
            }
        }, UtmForm.prototype.addFormElem = function(form, fieldName, fieldValue) {
            this.insertAfter(this.getFieldEl(fieldName, fieldValue), form.lastChild)
        }, UtmForm.prototype.getFieldEl = function(fieldName, fieldValue) {
            var fieldEl;
            return fieldEl = document.createElement("input"), fieldEl.type = "hidden", fieldEl.name = fieldName,
                fieldEl.value = fieldValue, fieldEl
        }, UtmForm.prototype.insertAfter = function(newNode, referenceNode) {
            return referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling)
        }, UtmForm
    }(), _uf = window._uf || {}, window.UtmForm = new UtmForm(_uf);


    // get google analytics client id
    var getClientId = function() {
        try {
            var trackers = ga.getAll();
            var i, len;
            for (i = 0, len = trackers.length; i < len; i += 1) {
                if (trackers[i].get('trackingId') === _uf.PropertyId) {
                    return trackers[i].get('clientId');
                }
            }
        } catch (e) {}
        return 'false';
    };
</script>