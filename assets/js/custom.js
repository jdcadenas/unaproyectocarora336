/**
 * Resize function without multiple trigger
 *
 * Usage:
 * $(window).smartresize(function(){
 *     // code here
 * });
 */
(function($, sr) {
    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function(func, threshold, execAsap) {
        var timeout;
        return function debounced() {
            var obj = this,
                args = arguments;

            function delayed() {
                if (!execAsap) func.apply(obj, args);
                timeout = null;
            }
            if (timeout) clearTimeout(timeout);
            else if (execAsap) func.apply(obj, args);
            timeout = setTimeout(delayed, threshold || 100);
        };
    };
    // smartresize
    jQuery.fn[sr] = function(fn) {
        return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
    };
})(jQuery, 'smartresize');
/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
    $BODY = $('body'),
    $MENU_TOGGLE = $('#menu_toggle'),
    $SIDEBAR_MENU = $('#sidebar-menu'),
    $SIDEBAR_FOOTER = $('.sidebar-footer'),
    $LEFT_COL = $('.left_col'),
    $RIGHT_COL = $('.right_col'),
    $NAV_MENU = $('.nav_menu'),
    $FOOTER = $('footer');
// Sidebar
function init_sidebar() {
    // TODO: This is some kind of easy fix, maybe we can improve this
    var setContentHeight = function() {
        // reset height
        $RIGHT_COL.css('min-height', $(window).height());
        var bodyHeight = $BODY.outerHeight(),
            footerHeight = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(),
            leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
            contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;
        // normalize content
        contentHeight -= $NAV_MENU.height() + footerHeight;
        $RIGHT_COL.css('min-height', contentHeight);
    };
    $SIDEBAR_MENU.find('a').on('click', function(ev) {
        // console.log('clicked - sidebar_menu');
        var $li = $(this).parent();
        if ($li.is('.active')) {
            $li.removeClass('active active-sm');
            $('ul:first', $li).slideUp(function() {
                setContentHeight();
            });
        } else {
            // prevent closing menu if we are on child menu
            if (!$li.parent().is('.child_menu')) {
                $SIDEBAR_MENU.find('li').removeClass('active active-sm');
                $SIDEBAR_MENU.find('li ul').slideUp();
            } else {
                if ($BODY.is(".nav-sm")) {
                    $SIDEBAR_MENU.find("li").removeClass("active active-sm");
                    $SIDEBAR_MENU.find("li ul").slideUp();
                }
            }
            $li.addClass('active');
            $('ul:first', $li).slideDown(function() {
                setContentHeight();
            });
        }
    });
    // toggle small or large menu
    $MENU_TOGGLE.on('click', function() {
        // console.log('clicked - menu toggle');
        if ($BODY.hasClass('nav-md')) {
            $SIDEBAR_MENU.find('li.active ul').hide();
            $SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
        } else {
            $SIDEBAR_MENU.find('li.active-sm ul').show();
            $SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
        }
        $BODY.toggleClass('nav-md nav-sm');
        setContentHeight();
        $('.dataTable').each(function() {
            $(this).dataTable().fnDraw();
        });
    });
    // check active menu
    $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');
    $SIDEBAR_MENU.find('a').filter(function() {
        return this.href == CURRENT_URL;
    }).parent('li').addClass('current-page').parents('ul').slideDown(function() {
        setContentHeight();
    }).parent().addClass('active');
    // recompute content when resizing
    $(window).smartresize(function() {
        setContentHeight();
    });
    setContentHeight();
    // fixed sidebar
    if ($.fn.mCustomScrollbar) {
        $('.menu_fixed').mCustomScrollbar({
            autoHideScrollbar: true,
            theme: 'minimal',
            mouseWheel: {
                preventDefault: true
            }
        });
    }
};
// /Sidebar
var randNum = function() {
    return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
};
// Panel toolbox
$(document).ready(function() {
    $('.collapse-link').on('click', function() {
        var $BOX_PANEL = $(this).closest('.x_panel'),
            $ICON = $(this).find('i'),
            $BOX_CONTENT = $BOX_PANEL.find('.x_content');
        // fix for some div with hardcoded fix class
        if ($BOX_PANEL.attr('style')) {
            $BOX_CONTENT.slideToggle(200, function() {
                $BOX_PANEL.removeAttr('style');
            });
        } else {
            $BOX_CONTENT.slideToggle(200);
            $BOX_PANEL.css('height', 'auto');
        }
        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
    });
    $('.close-link').click(function() {
        var $BOX_PANEL = $(this).closest('.x_panel');
        $BOX_PANEL.remove();
    });
});
// /Panel toolbox
// Tooltip
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
});
// /Tooltip
// Progressbar
if ($(".progress .progress-bar")[0]) {
    $('.progress .progress-bar').progressbar();
}
// /Progressbar
// Switchery
$(document).ready(function() {
    if ($(".js-switch")[0]) {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#26B99A'
            });
        });
    }
});
// /Switchery
// iCheck
$(document).ready(function() {
    if ($("input.flat")[0]) {
        $(document).ready(function() {
            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    }
});
// /iCheck
// Table
$('table input').on('ifChecked', function() {
    checkState = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('table input').on('ifUnchecked', function() {
    checkState = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});
var checkState = '';
$('.bulk_action input').on('ifChecked', function() {
    checkState = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('.bulk_action input').on('ifUnchecked', function() {
    checkState = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});
$('.bulk_action input#check-all').on('ifChecked', function() {
    checkState = 'all';
    countChecked();
});
$('.bulk_action input#check-all').on('ifUnchecked', function() {
    checkState = 'none';
    countChecked();
});

function countChecked() {
    if (checkState === 'all') {
        $(".bulk_action input[name='table_records']").iCheck('check');
    }
    if (checkState === 'none') {
        $(".bulk_action input[name='table_records']").iCheck('uncheck');
    }
    var checkCount = $(".bulk_action input[name='table_records']:checked").length;
    if (checkCount) {
        $('.column-title').hide();
        $('.bulk-actions').show();
        $('.action-cnt').html(checkCount + ' Records Selected');
    } else {
        $('.column-title').show();
        $('.bulk-actions').hide();
    }
}
// Accordion
$(document).ready(function() {
    $(".expand").on("click", function() {
        $(this).next().slideToggle(200);
        $expand = $(this).find(">:first-child");
        if ($expand.text() == "+") {
            $expand.text("-");
        } else {
            $expand.text("+");
        }
    });
});
// NProgress
if (typeof NProgress != 'undefined') {
    $(document).ready(function() {
        NProgress.start();
    });
    $(window).load(function() {
        NProgress.done();
    });
}
//hover and retain popover when on popover content
var originalLeave = $.fn.popover.Constructor.prototype.leave;
$.fn.popover.Constructor.prototype.leave = function(obj) {
    var self = obj instanceof this.constructor ? obj : $(obj.currentTarget)[this.type](this.getDelegateOptions()).data('bs.' + this.type);
    var container, timeout;
    originalLeave.call(this, obj);
    if (obj.currentTarget) {
        container = $(obj.currentTarget).siblings('.popover');
        timeout = self.timeout;
        container.one('mouseenter', function() {
            //We entered the actual popover – call off the dogs
            clearTimeout(timeout);
            //Let's monitor popover content instead
            container.one('mouseleave', function() {
                $.fn.popover.Constructor.prototype.leave.call(self, self);
            });
        });
    }
};
$('body').popover({
    selector: '[data-popover]',
    trigger: 'click hover',
    delay: {
        show: 50,
        hide: 400
    }
});

function gd(year, month, day) {
    return new Date(year, month - 1, day).getTime();
}
/* AUTOSIZE */
function init_autosize() {
    if (typeof $.fn.autosize !== 'undefined') {
        autosize($('.resizable_textarea'));
    }
};
/* PARSLEY */
function init_parsley() {
    if (typeof(parsley) === 'undefined') {
        return;
    }
    // console.log('init_parsley');
    $ /*.listen*/ ('parsley:field:validate', function() {
        validateFront();
    });
    $('#demo-form .btn').on('click', function() {
        $('#demo-form').parsley().validate();
        validateFront();
    });
    var validateFront = function() {
        if (true === $('#demo-form').parsley().isValid()) {
            $('.bs-callout-info').removeClass('hidden');
            $('.bs-callout-warning').addClass('hidden');
        } else {
            $('.bs-callout-info').addClass('hidden');
            $('.bs-callout-warning').removeClass('hidden');
        }
    };
    $ /*.listen*/ ('parsley:field:validate', function() {
        validateFront();
    });
    $('#demo-form2 .btn').on('click', function() {
        $('#demo-form2').parsley().validate();
        validateFront();
    });
    var validateFront = function() {
        if (true === $('#demo-form2').parsley().isValid()) {
            $('.bs-callout-info').removeClass('hidden');
            $('.bs-callout-warning').addClass('hidden');
        } else {
            $('.bs-callout-info').addClass('hidden');
            $('.bs-callout-warning').removeClass('hidden');
        }
    };
    try {
        hljs.initHighlightingOnLoad();
    } catch (err) {}
};
/* INPUTS */
function onAddTag(tag) {
    alert("Added a tag: " + tag);
}

function onRemoveTag(tag) {
    alert("Removed a tag: " + tag);
}

function onChangeTag(input, tag) {
    alert("Changed a tag: " + tag);
}
//tags input
function init_TagsInput() {
    if (typeof $.fn.tagsInput !== 'undefined') {
        $('#tags_1').tagsInput({
            width: 'auto'
        });
    }
};
/* SELECT2 */
function init_select2() {
    if (typeof(select2) === 'undefined') {
        return;
    }
    // console.log('init_toolbox');
    $(".select2_single").select2({
        placeholder: "Select a state",
        allowClear: true
    });
    $(".select2_group").select2({});
    $(".select2_multiple").select2({
        maximumSelectionLength: 4,
        placeholder: "With Max Selection limit 4",
        allowClear: true
    });
};
/* DATERANGEPICKER */
function init_daterangepicker() {
    if (typeof($.fn.daterangepicker) === 'undefined') {
        return;
    }
    // console.log('init_daterangepicker');
    var cb = function(start, end, label) {
        // console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    };
    var optionSet1 = {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: {
            days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    };
    $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    $('#reportrange').daterangepicker(optionSet1, cb);
    $('#reportrange').on('show.daterangepicker', function() {
        // console.log("show event fired");
    });
    $('#reportrange').on('hide.daterangepicker', function() {
        // console.log("hide event fired");
    });
    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        // console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
    });
    $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
        // console.log("cancel event fired");
    });
    $('#options1').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
    });
    $('#options2').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
    });
    $('#destroy').click(function() {
        $('#reportrange').data('daterangepicker').remove();
    });
}

function init_daterangepicker_right() {
    if (typeof($.fn.daterangepicker) === 'undefined') {
        return;
    }
    // console.log('init_daterangepicker_right');
    var cb = function(start, end, label) {
        // console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange_right span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    };
    var optionSet1 = {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2020',
        dateLimit: {
            days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'right',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    };
    $('#reportrange_right span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    $('#reportrange_right').daterangepicker(optionSet1, cb);
    $('#reportrange_right').on('show.daterangepicker', function() {
        // console.log("show event fired");
    });
    $('#reportrange_right').on('hide.daterangepicker', function() {
        // console.log("hide event fired");
    });
    $('#reportrange_right').on('apply.daterangepicker', function(ev, picker) {
        // console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
    });
    $('#reportrange_right').on('cancel.daterangepicker', function(ev, picker) {
        // console.log("cancel event fired");
    });
    $('#options1').click(function() {
        $('#reportrange_right').data('daterangepicker').setOptions(optionSet1, cb);
    });
    $('#options2').click(function() {
        $('#reportrange_right').data('daterangepicker').setOptions(optionSet2, cb);
    });
    $('#destroy').click(function() {
        $('#reportrange_right').data('daterangepicker').remove();
    });
}

function init_daterangepicker_single_call() {
    if (typeof($.fn.daterangepicker) === 'undefined') {
        return;
    }
    // console.log('init_daterangepicker_single_call');
    $('#single_cal1').daterangepicker({
        singleDatePicker: true,
        singleClasses: "picker_1"
    }, function(start, end, label) {
        // console.log(start.toISOString(), end.toISOString(), label);
    });
    $('#single_cal2').daterangepicker({
        singleDatePicker: true,
        singleClasses: "picker_2"
    }, function(start, end, label) {
        // console.log(start.toISOString(), end.toISOString(), label);
    });
    $('#single_cal3').daterangepicker({
        singleDatePicker: true,
        singleClasses: "picker_3"
    }, function(start, end, label) {
        // console.log(start.toISOString(), end.toISOString(), label);
    });
    $('#single_cal4').daterangepicker({
        singleDatePicker: true,
        singleClasses: "picker_4"
    }, function(start, end, label) {
        // console.log(start.toISOString(), end.toISOString(), label);
    });
}

function init_daterangepicker_reservation() {
    if (typeof($.fn.daterangepicker) === 'undefined') {
        return;
    }
    // console.log('init_daterangepicker_reservation');
    $('#reservation').daterangepicker(null, function(start, end, label) {
        // console.log(start.toISOString(), end.toISOString(), label);
    });
    $('#reservation-time').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY h:mm A'
        }
    });
}
/* VALIDATOR */
function init_validator() {
    if (typeof(validator) === 'undefined') {
        return;
    }
    // console.log('init_validator');
    // initialize the validator function
    validator.message.date = 'not a real date';
    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form').on('blur', 'input[required], input.optional, select.required', validator.checkField).on('change', 'select.required', validator.checkField).on('keypress', 'input[required][pattern]', validator.keypress);
    $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
    });
    $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;
        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
            submit = false;
        }
        if (submit) this.submit();
        return false;
    });
};
/* CUSTOM NOTIFICATION */
function init_CustomNotification() {
    // console.log('run_customtabs');
    if (typeof(CustomTabs) === 'undefined') {
        return;
    }
    // console.log('init_CustomTabs');
    var cnt = 10;
    TabbedNotification = function(options) {
        var message = "<div id='ntf" + cnt + "' class='text alert-" + options.type + "' style='display:none'><h2><i class='fa fa-bell'></i> " + options.title + "</h2><div class='close'><a href='javascript:;' class='notification_close'><i class='fa fa-close'></i></a></div><p>" + options.text + "</p></div>";
        if (!document.getElementById('custom_notifications')) {
            alert('doesnt exists');
        } else {
            $('#custom_notifications ul.notifications').append("<li><a id='ntlink" + cnt + "' class='alert-" + options.type + "' href='#ntf" + cnt + "'><i class='fa fa-bell animated shake'></i></a></li>");
            $('#custom_notifications #notif-group').append(message);
            cnt++;
            CustomTabs(options);
        }
    };
    CustomTabs = function(options) {
        $('.tabbed_notifications > div').hide();
        $('.tabbed_notifications > div:first-of-type').show();
        $('#custom_notifications').removeClass('dsp_none');
        $('.notifications a').click(function(e) {
            e.preventDefault();
            var $this = $(this),
                tabbed_notifications = '#' + $this.parents('.notifications').data('tabbed_notifications'),
                others = $this.closest('li').siblings().children('a'),
                target = $this.attr('href');
            others.removeClass('active');
            $this.addClass('active');
            $(tabbed_notifications).children('div').hide();
            $(target).show();
        });
    };
    CustomTabs();
    var tabid = idname = '';
    $(document).on('click', '.notification_close', function(e) {
        idname = $(this).parent().parent().attr("id");
        tabid = idname.substr(-2);
        $('#ntf' + tabid).remove();
        $('#ntlink' + tabid).parent().remove();
        $('.notifications a').first().addClass('active');
        $('#notif-group div').first().css('display', 'block');
    });
};

function init_charts() {
    // console.log('run_charts  typeof [' + typeof (Chart) + ']');
    if (typeof(Chart) === 'undefined') {
        return;
    }
    // console.log('init_charts');
    Chart.defaults.global.legend = {
        enabled: false
    };
    if ($('#canvas_line').length) {
        var canvas_line_00 = new Chart(document.getElementById("canvas_line"), {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    backgroundColor: "rgba(38, 185, 154, 0.31)",
                    borderColor: "rgba(38, 185, 154, 0.7)",
                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointBorderWidth: 1,
                    data: [31, 74, 6, 39, 20, 85, 7]
                }, {
                    label: "My Second dataset",
                    backgroundColor: "rgba(3, 88, 106, 0.3)",
                    borderColor: "rgba(3, 88, 106, 0.70)",
                    pointBorderColor: "rgba(3, 88, 106, 0.70)",
                    pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(151,187,205,1)",
                    pointBorderWidth: 1,
                    data: [82, 23, 66, 9, 99, 4, 2]
                }]
            },
        });
    }
    if ($('#canvas_line1').length) {
        var canvas_line_01 = new Chart(document.getElementById("canvas_line1"), {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    backgroundColor: "rgba(38, 185, 154, 0.31)",
                    borderColor: "rgba(38, 185, 154, 0.7)",
                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointBorderWidth: 1,
                    data: [31, 74, 6, 39, 20, 85, 7]
                }, {
                    label: "My Second dataset",
                    backgroundColor: "rgba(3, 88, 106, 0.3)",
                    borderColor: "rgba(3, 88, 106, 0.70)",
                    pointBorderColor: "rgba(3, 88, 106, 0.70)",
                    pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(151,187,205,1)",
                    pointBorderWidth: 1,
                    data: [82, 23, 66, 9, 99, 4, 2]
                }]
            },
        });
    }
    if ($('#canvas_line2').length) {
        var canvas_line_02 = new Chart(document.getElementById("canvas_line2"), {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    backgroundColor: "rgba(38, 185, 154, 0.31)",
                    borderColor: "rgba(38, 185, 154, 0.7)",
                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointBorderWidth: 1,
                    data: [31, 74, 6, 39, 20, 85, 7]
                }, {
                    label: "My Second dataset",
                    backgroundColor: "rgba(3, 88, 106, 0.3)",
                    borderColor: "rgba(3, 88, 106, 0.70)",
                    pointBorderColor: "rgba(3, 88, 106, 0.70)",
                    pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(151,187,205,1)",
                    pointBorderWidth: 1,
                    data: [82, 23, 66, 9, 99, 4, 2]
                }]
            },
        });
    }
    if ($('#canvas_line3').length) {
        var canvas_line_03 = new Chart(document.getElementById("canvas_line3"), {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    backgroundColor: "rgba(38, 185, 154, 0.31)",
                    borderColor: "rgba(38, 185, 154, 0.7)",
                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointBorderWidth: 1,
                    data: [31, 74, 6, 39, 20, 85, 7]
                }, {
                    label: "My Second dataset",
                    backgroundColor: "rgba(3, 88, 106, 0.3)",
                    borderColor: "rgba(3, 88, 106, 0.70)",
                    pointBorderColor: "rgba(3, 88, 106, 0.70)",
                    pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(151,187,205,1)",
                    pointBorderWidth: 1,
                    data: [82, 23, 66, 9, 99, 4, 2]
                }]
            },
        });
    }
    if ($('#canvas_line4').length) {
        var canvas_line_04 = new Chart(document.getElementById("canvas_line4"), {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    backgroundColor: "rgba(38, 185, 154, 0.31)",
                    borderColor: "rgba(38, 185, 154, 0.7)",
                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointBorderWidth: 1,
                    data: [31, 74, 6, 39, 20, 85, 7]
                }, {
                    label: "My Second dataset",
                    backgroundColor: "rgba(3, 88, 106, 0.3)",
                    borderColor: "rgba(3, 88, 106, 0.70)",
                    pointBorderColor: "rgba(3, 88, 106, 0.70)",
                    pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(151,187,205,1)",
                    pointBorderWidth: 1,
                    data: [82, 23, 66, 9, 99, 4, 2]
                }]
            },
        });
    }
}
// Line chart
if ($('#lineChart').length) {
    var ctx = document.getElementById("lineChart");
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "My First dataset",
                backgroundColor: "rgba(38, 185, 154, 0.31)",
                borderColor: "rgba(38, 185, 154, 0.7)",
                pointBorderColor: "rgba(38, 185, 154, 0.7)",
                pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointBorderWidth: 1,
                data: [31, 74, 6, 39, 20, 85, 7]
            }, {
                label: "My Second dataset",
                backgroundColor: "rgba(3, 88, 106, 0.3)",
                borderColor: "rgba(3, 88, 106, 0.70)",
                pointBorderColor: "rgba(3, 88, 106, 0.70)",
                pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(151,187,205,1)",
                pointBorderWidth: 1,
                data: [82, 23, 66, 9, 99, 4, 2]
            }]
        },
    });
}
// Bar chart
if ($('#mybarChart').length) {
    var ctx = document.getElementById("mybarChart");
    var mybarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: '# of Votes',
                backgroundColor: "#26B99A",
                data: [51, 30, 40, 28, 92, 50, 45]
            }, {
                label: '# of Votes',
                backgroundColor: "#03586A",
                data: [41, 56, 25, 48, 72, 34, 12]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}
// Doughnut chart
if ($('#canvasDoughnut').length) {
    var ctx = document.getElementById("canvasDoughnut");
    var data = {
        labels: ["Dark Grey", "Purple Color", "Gray Color", "Green Color", "Blue Color"],
        datasets: [{
            data: [120, 50, 140, 180, 100],
            backgroundColor: ["#455C73", "#9B59B6", "#BDC3C7", "#26B99A", "#3498DB"],
            hoverBackgroundColor: ["#34495E", "#B370CF", "#CFD4D8", "#36CAAB", "#49A9EA"]
        }]
    };
    var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: data
    });
}
// Radar chart
if ($('#canvasRadar').length) {
    var ctx = document.getElementById("canvasRadar");
    var data = {
        labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
        datasets: [{
            label: "My First dataset",
            backgroundColor: "rgba(3, 88, 106, 0.2)",
            borderColor: "rgba(3, 88, 106, 0.80)",
            pointBorderColor: "rgba(3, 88, 106, 0.80)",
            pointBackgroundColor: "rgba(3, 88, 106, 0.80)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            data: [65, 59, 90, 81, 56, 55, 40]
        }, {
            label: "My Second dataset",
            backgroundColor: "rgba(38, 185, 154, 0.2)",
            borderColor: "rgba(38, 185, 154, 0.85)",
            pointColor: "rgba(38, 185, 154, 0.85)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 96, 27, 100]
        }]
    };
    var canvasRadar = new Chart(ctx, {
        type: 'radar',
        data: data,
    });
}
// Pie chart
if ($('#pieChart').length) {
    var ctx = document.getElementById("pieChart");
    var data = {
        datasets: [{
            data: [120, 50, 140, 180, 100],
            backgroundColor: ["#455C73", "#9B59B6", "#BDC3C7", "#26B99A", "#3498DB"],
            label: 'My dataset' // for legend
        }],
        labels: ["Dark Gray", "Purple", "Gray", "Green", "Blue"]
    };
    var pieChart = new Chart(ctx, {
        data: data,
        type: 'pie',
        otpions: {
            legend: false
        }
    });
}
/* COMPOSE */
function init_compose() {
    if (typeof($.fn.slideToggle) === 'undefined') {
        return;
    }
    // console.log('init_compose');
    $('#compose, .compose-close').click(function() {
        $('.compose').slideToggle();
    });
};
/* DATA TABLES */
function init_DataTables() {
    // console.log('run_datatables');
    if (typeof($.fn.DataTable) === 'undefined') {
        return;
    }
    // console.log('init_DataTables');
    var handleDataTableButtons = function() {
        if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
                dom: "Bfrtip",
                buttons: [{
                    extend: "copy",
                    className: "btn-sm"
                }, {
                    extend: "csv",
                    className: "btn-sm"
                }, {
                    extend: "excel",
                    className: "btn-sm"
                }, {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                }, {
                    extend: "print",
                    className: "btn-sm"
                }, ],
                responsive: true
            });
        }
    };
    TableManageButtons = function() {
        "use strict";
        return {
            init: function() {
                handleDataTableButtons();
            }
        };
    }();
    $('#datatable').dataTable();
    $('#datatable-responsive').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
};
$(document).ready(function() {
    init_sidebar();
    init_TagsInput();
    init_parsley();
    init_validator();
    init_DataTables();
    init_compose();
    init_CustomNotification();
    init_autosize();
    //init_autocomplete();
    $(".btn-view").on('click', function(event) {
        var id = $(this).val();
        $.ajax({
            url: base_url + "lineas/view/" + id,
            type: 'POST',
            success: function(resp) {
                $(".bs-example-modal-lg .modal-body").html(resp);
                //alert(resp);
            }
        });
    });
    $(".btn-view-emple").on('click', function(event) {
        var id = $(this).val();
        $.ajax({
            url: base_url + "empleados/view/" + id,
            type: 'POST',
            success: function(resp) {
                $(".bs-example-modal-lg .modal-body-emple").html(resp);
                //alert(resp);
            }
        });
    });
    $(".btn-remove").on('click', function(e) {
        e.preventDefault();
        var ruta = $(this).attr("href");
        // alert(ruta);
        $.ajax({
            url: ruta,
            type: 'POST',
            success: function(resp) {
                //  alert(base_url + resp);
                window.location.href = base_url + resp;
            }
        });
    });
    $(document).on('click', ".btn-check", function() {
        empleado = $(this).val();
        infoempleado = empleado.split("*");
        //$('#empleado_id').val(infoempleado[0]);
        //  $('#empleado').val('id:'+infoempleado[0]+' '+infoempleado[2] + ' ' + infoempleado[3]);
        $('#id_empleado').val(infoempleado[0]);
        $('#empleado').val(infoempleado[2] + ' ' + infoempleado[3]);
        $("modal-default").modal("hide");
        return false;
    });
    $(document).on('click', ".btn-check-sucur", function() {
        sucursal = $(this).val();
        infosucursal = sucursal.split("*");
        $('#id_sucursal').val(infosucursal[0]);
        $('#sucursal').val(infosucursal[1] + " Ubicación: " + infosucursal[2]);
        $("modal-default").modal("hide");
        return false;
    });
    $('#producto').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: base_url + "movimientos/ventas/getproductos/" + $('#id_sucursal').val(),
                type: "POST",
                dataType: "json",
                data: {
                    valor: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minlength: 2,
        select: function(event, ui) {
            data = ui.item.id_producto + "*" + ui.item.codigo + "*" + ui.item.label + "*" + ui.item.precio + "*" + ui.item.cantidad;
            $("#btn-agregar").val(data);
        },
    });
    $("#btn-agregar").on('click', function() {
        data = $(this).val();
        if (data != '') {
            infoproducto = data.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' name='idproductos[]' value='" + infoproducto[0] + "'>" + infoproducto[1] + "</td>";
            html += "<td>" + infoproducto[2] + "</td>";
            html += "<td><input type='hidden' name='precios[]' value='" + infoproducto[3] + "'>" + infoproducto[3] + "</td>";
            html += "<td>" + infoproducto[4] + "</td>";
            html += "<td><input type='text' name='cantidades[]' value='1' class='cantidades'></td>";
            html += "<td><input type='hidden' name='importes[]' value='" + infoproducto[3] + "'><p>" + infoproducto[3] + "</p></td>";
            html += "<td> <button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>";
            html += "</tr>";
            $("#tbventas tbody").append(html);
            sumar();
            $('#btn-agregar').val(null);
            $('#producto').val(null);
        } else {
            alert("seleccionar un producto ...")
        }
        /* Act on the event */
    });
    $(document).on('click', '.btn-remove-producto', function(event) {
        $(this).closest('tr').remove();
        sumar();
    });
    $(document).on('keyup', '#tbventas input.cantidades', function(event) {
        cantidad = $(this).val();
        precio = $(this).closest('tr').find('td:eq(2)').text();
        subtotal = cantidad * precio;
        $(this).closest('tr').find('td:eq(5)').children('p').text(subtotal.toFixed(2));
        $(this).closest('tr').find('td:eq(5)').children('input').val(subtotal.toFixed(2));
        sumar();
    });
    $(document).on('click', '.btn-view-venta', function(event) {
        valor_id = $(this).val();
        $.ajax({
            url: base_url + "movimientos/ventas/view",
            type: 'POST',
            dataType: 'html',
            data: {
                id: valor_id
            },
        }).done(function(data) {
            console.log("success");
            $(".modal-default .modal-body").html(data);
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
        /* Act on the event */
    });
    $(document).on('change', '#sucursalselect', function(event) {
        valor_id = $(this).val();
        window.location.href = base_url + "productos/" + valor_id;
    });
    //fin de document ready
});

function sumar() {
    subtotalFactura = 0;
    $("#tbventas tbody tr").each(function(index, el) {
        subtotalFactura = subtotalFactura + Number($(this).find('td:eq(5)').text());
    });
    $('input[name=subtotalFactura]').val(subtotalFactura.toFixed(2));
    iva = 12 / 100;
    montoiva = iva * subtotalFactura;
    total = subtotalFactura + montoiva;
    $('input[name=iva]').val(montoiva.toFixed(2));
    $('input[name=total]').val(total.toFixed(2));
}