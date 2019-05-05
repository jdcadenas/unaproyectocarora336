$(document).ready(function() {
    var year = (new Date).getFullYear();
    datagrafico(base_url, year);
    $("#year").on('change', function() {
        yearselect = $(this).val();
        datagrafico(base_url, yearselect);
    });
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

function datagrafico(base_url, year) {
    mesesMonth = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
    $.ajax({
        url: base_url + "principal/getData",
        type: 'POST',
        dataType: 'json',
        data: {
            year: year
        },
    }).done(function(data) {
        console.log("success");
        var meses = new Array();
        var montos = new Array();
        $.each(data, function(index, value) {
            meses.push(mesesMonth[value.mes - 1]);
            valor = Number(value.monto);
            montos.push(valor);
        });
        graficar(meses, montos, year);
    }).fail(function() {
        console.log("error");
    }).always(function() {
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
            pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' + '<td style="padding:0"><b>{point.y:.2f} Bolívares Soberanos</b></td></tr>',
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