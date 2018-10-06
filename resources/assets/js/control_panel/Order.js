'use strict';

class Order {
  constructor() {
  }

  editOrder(o) {
    console.log('o ==================>', o);
    const dp = o.find('[data-fn="datepicker"]').datepicker();
    
    o.find('[data-fn="datepicker-click"]').click(function () {
      dp.datepicker('show');
    });
  }
}

module.exports = Order;
