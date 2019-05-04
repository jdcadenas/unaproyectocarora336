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
        if (!execAsap)
          func.apply(obj, args);
        timeout = null;
      }
      if (timeout)
        clearTimeout(timeout);
      else if (execAsap)
        func.apply(obj, args);
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
    if (submit)
      this.submit();
    return false;
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
  $('#datatable-keytable').DataTable({
    keys: true
  });
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
  $('#datatable-scroller').DataTable({
    ajax: "js/datatables/json/scroller-demo.json",
    deferRender: true,
    scrollY: 380,
    scrollCollapse: true,
    scroller: true
  });
  $('#datatable-fixed-header').DataTable({
    fixedHeader: true
  });
  var $datatable = $('#datatable-checkbox');
  $datatable.dataTable({
    'order': [
      [1, 'asc']
    ],
    'columnDefs': [{
      orderable: false,
      targets: [0]
    }]
  });
  $datatable.on('draw.dt', function() {
    $('checkbox input').iCheck({
      checkboxClass: 'icheckbox_flat-green'
    });
  });
  TableManageButtons.init();
};



$(document).ready(function() {

  init_sidebar();
  init_DataTables();
  init_validator();

  //init_autocomplete();

  var year = (new Date).getFullYear();

  datagrafico(base_url, year);


  $("#year").on('change', function() {
    yearselect = $(this).val();

    datagrafico(base_url, yearselect);

  });


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
        url: base_url + "movimientos/ventas/getproductos",
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
      })
      .done(function(data) {
        console.log("success");
        $(".modal-default .modal-body").html(data);


      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

    /* Act on the event */
  });

}); //fin de document ready


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

function datagrafico(base_url, year) {
  mesesMonth = ["Ene", "Feb", "Mar",
    "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"
  ];
  $.ajax({
      url: base_url + "principal/getData",
      type: 'POST',
      dataType: 'json',
      data: {
        year: year
      },
    })
    .done(function(data) {
      console.log("success");
      var meses = new Array();
      var montos = new Array();
      $.each(data, function(index, value) {
        meses.push(mesesMonth[value.mes - 1]);
        valor = Number(value.monto);
        montos.push(valor);
      });
      graficar(meses, montos, year);

    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });

}



function graficar(meses, montos, year) {

  Highcharts.chart('grafico', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Monto acumulado por las ventas de los meses'
    },
    subtitle: {
      text: 'Año ' + year
    },
    xAxis: {
      categories: meses,
      crosshair: true
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Monto acumulado Bs'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
        '<td style="padding:0"><b>{point.y:.2f} Bolívares Soberanos</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      },
      series: {
        dataLabels: {
          enabled: true,
          formatter: function() {
            return Highcharts.numberFormat(this.y, 2)
          }
        }
      }
    },
    series: [{
      name: 'Meses',
      data: montos

    }]
  });
}