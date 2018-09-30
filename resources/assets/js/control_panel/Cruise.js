'use strict';
require('datatables.net');
require('jquery-ui/ui/widgets/datepicker');
require('jquery-timepicker/jquery.timepicker');
const { timepicker } = require('../global');
const { SeatLayout } = require('../utils');

class Cruise {
  constructor() {
    this.routesVars = {};
  }

  changeDestinationsStatus({ t, id, value }) {
    return $.ajax({
      url: `/api/destinations/${id}`,
      method: 'PUT',
      data: {
        value,
      },
    })
    .done(res => {
      const td = t.closest('td');

      if (value) {
        td.addClass('active');
      } else {
        td.removeClass('active');
      }
    });
  }

  destinationsActionHandler({ target }) {
    const t = $(target);
    const action = t.data('action');

    switch (action) {
      case 'status':
        this.changeDestinationsStatus({
          t,
          id: t.data('id'),
          value: t.data('value'),
        });
        break;
    }
  }

  initDestinationsTable() {
    this.destTblWrap
      .find('[data-table-id="destinations"]')
      .click(this.destinationsActionHandler)
      .DataTable().draw(false);
  }

  destinations(o) {
    const destEl = o.find('[name="name"]')[0];
    const destTblWrap = o.find('[data-table-wrap]');
    this.destTblWrap = destTblWrap;

    this.initDestinationsTable();

    o.find('[data-fn="submit"]').click(e => {
      let name = $(destEl).val();
      name = $.trim(name);
      
      if (name.length === 0) {
        alert('empty string');
        return;
      }

      const data = {
        name,
        withResult: 'table',
      };

      $.post('/api/destinations', data)
        .done(res => {
          destTblWrap
            .empty()
            .html(res);

          this.initDestinationsTable();
        });
    });
  }

  editRoute(o) {
    const dp = o.find('[data-fn="datepicker"]').datepicker();
    const tp = o.find('[data-fn="timepicker"]').timepicker(timepicker);
    const rId = o.find('[name="rId"]').val();
    const fromDestSel = o.find('[data-fn="fromDest"]');
    const toDestSel = o.find('[data-fn="toDest"]');
    const ferrySel = o.find('[data-fn="ferry"]');
    const redirectUrl = '/cruise/routeList';

    o.find('[data-fn="datepicker-click"]').click(function () {
      dp.datepicker('show');
    });

    o.find('[data-fn="submit"]').click(() => {
      const from = fromDestSel.val();
      const to = toDestSel.val();
      const fId = ferrySel.val();
      let date = dp.val();
      let time = tp.val();

      if (from === to) {
        alert('請選擇不同地點');
        return;
      }

      if (!date) {
        alert('請選擇日期');
        return;
      }

      if (!time) {
        alert('請選擇時間');
        return;
      }

      date = date.replace(/\//g, '-');
      time += ':00';

      const data = {
        from,
        to,
        fId,
        dt: `${date} ${time}`,
      };

      if (rId) {
        data.rId = rId;

        $.ajax({
          url: `/api/routes/${rId}`,
          method: 'PUT',
          data,
        })
        .done(res => {
          window.location.replace(redirectUrl);
        });
      } else {
        $.post('/api/routes', data)
          .done(res => {
            window.location.replace(redirectUrl);
          });
        }
    });

    o.find('[data-fn="back"]').click(() => {
      window.history.back();
    });
  }

  routesTableUpdateStatus(target, status) {
    const { routesVars: {
      statusMap,
      table,
    }} = this;
    const tr = target.closest('tr[data-row-index]');
    const rowIndex = tr.data('rowIndex');
    const currentStatusName = tr.find('[data-cell-key="status"]').html();
    const data = table.row(rowIndex).data();

    switch (status) {
      case 'active':
        tr.removeClass('pending').addClass('active');
        break;
      case 'cancelled':
        tr.removeClass('active').addClass('cancelled');
        break;
    }

    data[data.indexOf(currentStatusName)] = statusMap[status];
    table.row(rowIndex).data(data).draw();
  }

  routesActionHandler({ target }) {
    const t = $(target);
    const id = t.data('id');

    switch (t.data('action')) {
      case 'activate':
        if (!window.confirm('確定要開啟此航班')) {
          return;
        }

        $.post(`/api/routes/updateStatus`, {
          id,
          status: 'active',
        })
        .done(() => this.routesTableUpdateStatus(t, 'active'));
        break;
      case 'cancel':
        if (!window.confirm('確定要停售此航班')) {
          return;
        }

        // loading icon
        // get if ticket sold
        // if has ticket confirm('refund')
        $.post(`/api/routes/updateStatus`, {
          id,
          status: 'cancelled',
        })
        .done(() => this.routesTableUpdateStatus(t, 'cancelled'));
        break;
      case 'delete':
        const { routesVars: {
          table,
        }} = this;

        $.ajax({
          url: `/api/routes/${id}`,
          method: 'DELETE',
        })
        .done(() => {
          const { routesVars: {
            table,
          }} = this;

          const rowIndex = t.closest('tr[data-row-index]').data('rowIndex'); 

          table.row(rowIndex).remove().draw();
        });
        break;
      case 'reserve':
        const fId = t.data('fid');
        const { routesVars: { seatLayoutContainer } } = this;

        $.get('/api/seats/layout', { rId: id, fId, })
          .done(res => {
            seatLayoutContainer.empty();
            seatLayoutContainer.html(res);
            new SeatLayout({
              action: 'reserve',
              o: seatLayoutContainer.find('[data-fn="seatLayout"]'),
            });
          });
        break;
      default:
        break;
    } 
  }

  routeList(o) {
    const { routesVars } = this;
    const table = o.find('[data-table-id="routes"]');
    routesVars.statusMap = table.data('statusMap');
    routesVars.table = table.click(this.routesActionHandler).DataTable();
    routesVars.seatLayoutContainer = o.find('[data-fn="seatLayoutContainer"]');
  } 
}

module.exports = Cruise;