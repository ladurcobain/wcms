/*!
 * Star Rating <LANG> Translations
 *
 * This file must be loaded after 'star-rating.js'. Patterns in braces '{}', or
 * any HTML markup tags in the messages must not be converted or translated.
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 *
 * bootstrap-star-rating v4.1.2
 * http://plugins.krajee.com/star-rating
 *
 * Copyright: 2013 - 2021, Kartik Visweswaran, Krajee.com
 *
 * Licensed under the BSD 3-Clause
 * https://github.com/kartik-v/bootstrap-star-rating/blob/master/LICENSE.md
 */  
(function (factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof module === 'object' && typeof module.exports === 'object') { 
        factory(require('jquery'));
    } else { 
        factory(window.jQuery);
    }
}(function ($) {
    "use strict";
    $.fn.ratingLocales['<LANG>'] = {
        defaultCaption: '{rating} Stars',
        starCaptions: {
            0.5: 'Sangat Buruk',
            1: 'Buruk',
            1.5: 'Sangat Kurang',
            2: 'Kurang',
            2.5: 'Kurang Baik',
            3: 'Sedang',
            3.5: 'Cukup',
            4: 'Cukup Baik',
            4.5: 'Baik',
            5: 'Sangat Baik'
        },
        clearButtonTitle: 'Batal',
        clearCaption: 'Gagal Menilai'
    };
}));
