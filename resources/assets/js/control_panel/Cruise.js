'use strict';
require('datatables.net');

function Cruise() {};

Cruise.prototype.destinations = function (o) {
  const destEl = o.find('[name="name"]')[0];

  o.find('[data-fn="submit"]').click(function (e) {
    let name = $(destEl).val();
    name = $.trim(name);
    
    if (name.length === 0) {
      alert('empty string');
      return;
    }

    const data = {
      name,
    };

    $.post('/api/destinations', data)
      .done(function (res) {
        console.log('res ==================>', res);
        tbl.row.add([
          5,
          name,
          '',
        ]).draw(false); 
      });
  });

  const tbl = o.find('[data-table-id="destinations"]')
    .click(({ target }) => {
      const t = $(target);
      const action = t.data('action');
      const id = t.data('id');

      $.ajax({
        url: `/api/destinations/${id}`,
        method: 'PUT',
        data: {
          action,
        },
      })
      .done(res => {
        console.log('change class ===================>', res);
      });
    })
    .DataTable({
      order: [[1, 'asc']],
    });

  /*
  var table = o.find('#example-table2');
  var cols = table.data('tableCols');
  cols[1].formatter = function (cell, param) {
    console.log('cell~~~~~~~', cell);
    console.log('param~~~~~~~', param);
  };
  console.log(table.data());

  table.tabulator({
    data: table.data('tableSource'),
    columns: cols
  });

  o.find('#example-table').tabulator();
  /*
  $.get('/api/destinations')
    .done(function (res) {
      console.log('res ==================>', res);
    });
  */
};

module.exports = Cruise;