'use strict';

class Order {
  constructor() {
  }

  editOrder(o) {
    const dp = o.find('[data-fn="datepicker"]').datepicker();
    
    o.find('[data-fn="datepicker-click"]').click(() => {
      dp.datepicker('show');
    });

    /*
    $('#jexcel').jexcel({
      data: [
        ['hi'],
        ['wtf'],
        ['shit'],
      ],
    });
    */
    o.find('[data-container]').each((i, el) => {
      const jE = $(el).find('[data-fn="jexcel"]');

      $(el).find('[data-action="add"]').click(() => {
        jE.jexcel('insertRow', 1);
      }); 

      $(el).find('[data-action="get"]').click(() => {
        const data = jE.jexcel('getData');
        console.log(data);
      }); 

      jE.jexcel({
        colHeaders: ['姓', '名', '身份證 / 護照', 'ID', '姓別', '生日', 'Email', '電話號碼', '艙等'],
        colWidths: [100, 100, 100, 100, 100, 100, 100, 100, 100],
        columns: [
          { type: 'string' },
          { type: 'string' },
          { type: 'autocomplete', source: ['<span data-val=id>身份證</span>', '<span data-val=passport>護照</span>'] },
          { type: 'string' },
          { type: 'autocomplete', source: ['<span data-val=1>男</span>', '<span data-val=0>女</span>'] },
          { type: 'string' },
          { type: 'string' },
          { type: 'string' },
          { type: 'autocomplete', source: ['<span data-val=E>經濟艙</span>', '<span data-val=B>商務艙</span>'] },
        ],
        data: [],
      });
    });
  }
}

module.exports = Order;
