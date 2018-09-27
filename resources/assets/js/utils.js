'use strict';
var exports = module.exports = {};

exports.SeatLayout = class SeatLayout {
  constructor(props) {
    const {
      action,
      o,
    } = props;

    let obj = o;

    if (!(obj instanceof jQuery)) {
      obj = $(obj);
    } 

    if (!action) {
      console.log('no action');
      return;
    }

    const seats = {
      reserved: {},
      sold: {},
      na: {},
      selected: {},
    };

    obj.find('[data-type="cell"]').each((i, item) => {
      const cell = $(item);
      const status = cell.data('status');

      if (seats[status]) {
        const row = cell.data('row');
        const col = cell.data('col');

        seats[status][`${row}${col}`] = true;
      }
    }) 

    this.o = obj;
    this.seats = seats;
    this.action = action;
    this.init();
  }  

  init() {
    const fn = this[`${this.action}Action`];
    let cb;

    if (typeof fn === 'function') {
      cb = fn.call(this);
    }

    this.o.on('click', ({ target }) => {
      let o = $(target);
      let type = o.data('type');

      if (type === 'text') {
        o = o.parent();
        type = o.data('type');
      }

      if (type !== 'cell') {
        return;
      }

      this.cell = o;
      this.toggleCell();

      if (typeof cb !== 'function') {
        return;
      }

      cb();
    });

  }

  toggleCell() {
    const {
      cell,
      seats: { selected },
    } = this;

    cell.toggleClass('selected');
    const isSelected = cell.hasClass('selected');
    const row = cell.data('row');
    const col = cell.data('col');
    const pos = `${row}${col}`;

    if (isSelected) {
      selected[pos] = true;
    } else {
      delete selected[pos];
    }

    cell.row = row;
    cell.col = col;
    cell.pos = pos;
    cell.isSelected = isSelected;
  }

  getNextCell() {
    if (!(this.cell instanceof jQuery)) {
      return;
    }

    let next = this.cell.next('[data-type="cell"]');

    if (next.length === 0) {
      next = this.cell
              .closest('[data-type="row"]')
              .next('[data-type="row"]')
              .find('[data-type="cell"]:first-child');
    }

    return next.length === 0 ? null : next;
  }

  moveToNextCell() {
    this.cell = this.getNextCell();
    return this.cell;
  }

  reserveAction() {
    const {
      o,
      seats,
    } = this;
    const auto = o.find('[data-autoFill]');
    const autoNum = o.find('[data-autoFillNum]')

    o.find('.seat-layout-options').addClass('reserve');
    o.find('[data-action="selectAllReserved"]')
    .on('click', () => {
      o.find('.seat-layout-cell.reserved').each((i, el) => {
        const o = $(el);

        if (!o.hasClass('selected')) {
          this.cell = o;
          this.toggleCell();
        }
      });
    });
    o.find('[data-action="reset"]')
    .on('click', () => {
      o.find('.seat-layout-cell.selected').removeClass('selected');
      seats.selected = [];
    });
    o.find('[data-action="submit"]')
    .on('click', ({ target }) => {
      const a = Object.keys(seats.selected).map(key => key).sort();
      const val = $(target).val();

      console.log('val =============>', val);
      console.log('a =============>', a);
      
      if (!a.length) {
        return;
      }

    });

    const cb = () => {
      const isAuto = auto.is(":checked");

      if (isAuto) {
        let n = parseInt(autoNum.val(), 10);

        if (isNaN(n)) {
          this.toggleCell();
          return alert('請填入座位數量');
        }

        if (!this.cell.hasClass('selected')) {
          this.toggleCell();
        }

        n -= 1;

        while (n) {
          const cell = this.moveToNextCell();

          if (!cell) {
            break;
          }

          const status = cell.data('status');
          const isSelected = cell.hasClass('selected');
          
          if (isSelected) {
            n -= 1;
          } else if (status === 'av' || status === 'reserved') {
            this.toggleCell();
            n -= 1;
          } 
        }
      }
    };

    return cb;
  }


}
