'use strict';
require('datatables.net');
require('jquery-ui/ui/widgets/datepicker');
require('jquery-timepicker/jquery.timepicker');
const { timepicker } = require('../global');

class Cruise {
  constructor() {}

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

  routes(o) {
    const dp = o.find('[data-fn="datepicker"]').datepicker();
    const tp = o.find('[data-fn="timepicker"]').timepicker(timepicker);
    const fromDestSel = o.find('[data-fn="fromDest"]');
    const toDestSel = o.find('[data-fn="toDest"]');
    const ferrySel = o.find('[data-fn="ferry"]');

    o.find('[data-fn="datepicker-click"]').click(function () {
      dp.datepicker('show');
    });

    o.find('[data-fn="submit"]').click(() => {
      const from = fromDestSel.val();
      const to = toDestSel.val();
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
        from: fromDestSel.val(),
        to: toDestSel.val(),
        fId: ferrySel.val(),
        dt: `${date} ${time}`,
      };

      $.post('/api/routes', data)
        .done(res => {
          console.log('redirect...');
        });
    });
  }
}

module.exports = Cruise;