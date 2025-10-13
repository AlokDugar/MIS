$(document).ready(function() {
    // Datepicker
    $('.datetimepicker').datetimepicker({
      format: 'DD/MM/YYYY LT',
      icons: {
        up: 'bi bi-chevron-up',
        down: 'bi bi-chevron-down',
      },
      useCurrent: false,
      sideBySide: true,
    });
  
    // Timepicker
    $('.timepicker').datetimepicker({
      format: 'LT',
      icons: {
        up: 'bi bi-chevron-up',
        down: 'bi bi-chevron-down',
      }
    });
  
    // Datetimepicker
    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
      autoclose: true,
      todayBtn: true,
      clearBtn: true,
      todayHighlight: true,
      calendarWeeks: true,
      orientation: 'auto'
    });
  
    // Daterangepicker
    $('.daterangepicker').daterangepicker({
      autoApply: true,
      opens: 'left',
      locale: {
        format: 'DD/MM/YYYY',
        separator: ' - ',
        applyLabel: 'Apply',
        cancelLabel: 'Cancel',
        fromLabel: 'From',
        toLabel: 'To',
        customRangeLabel: 'Custom',
        weekLabel: 'W',
        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        firstDay: 1
      },
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    });
  });
  